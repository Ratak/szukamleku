<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Application;
use yii\base\Event;

class Settings extends Component
{
    public $table    = '{{%settings}}';
    public $cacheKey = 'settings';

    protected $items;
    protected $toBeSave = [];
    protected $toBeDelete = [];
    protected $catToBeDel = [];

    public function init()
    {
        Event::on(Application::className(), Application::EVENT_AFTER_REQUEST, [$this, 'commit']);
    }

    public function set($key, $value, $category = 'app')
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->set($k, $v, $category);
            }
        }
        elseif( !isset($this->items[$category][$key]) or $this->items[$category][$key] !== $value) {
            $this->items[$category][$key] = $this->toBeSave[$category][$key] = $value;
        }
    }

    /**
     * @param string $key
     * @param string $default
     * @param string $category
     *
     * @return null|string
     */
    public function get($key, $default = null, $category = 'app')
    {
        if ($key == '*') {
            return $this->getCategory($category, $default);
        }

        return isset($this->items[$category][$key])
            ? $this->items[$category][$key]
            : $default;
    }

    public function getCategory($category = 'app', $default = null)
    {
        if ( $this->items === null ) {
            $this->fetch();
        }

        return isset($this->items[$category])
            ? $this->items[$category]
            : $default;
    }

    public function delete($key, $category = 'app')
    {
        if ($key == '*') {
            $this->deleteCategory($category);
        }
        elseif (is_array($key)) {
            foreach($key as $k) {
                $this->delete($k, $category);
            }
        }
        elseif (isset($this->items[$category][$key])) {
            unset($this->items[$category][$key]);
            unset($this->toBeSave[$category][$key]);
            $this->toBeDelete[$category][] = $key;
        }
    }

    public function deleteCategory($category)
    {
        unset($this->items[$category]);
        unset($this->toBeDelete[$category]);
        $this->catToBeDel[] = $category;
    }

    public function fetch()
    {
        $this->items = Yii::$app->cache->get($this->cacheKey);

        if ( ! $this->items ) {
            $this->items = [];

            $result = Yii::$app->getDb()
                ->createCommand("SELECT * FROM {$this->table}")
                ->queryAll();

            foreach ($result as $row) {
                $this->items[$row['category']][$row['key']] = @unserialize($row['value']);
            }

            unset($result);

            Yii::$app->cache->add($this->cacheKey, $this->items);
        }

        return $this->items;
    }

    public function commit()
    {
        if ( $this->catToBeDel ) {
            Yii::$app->getDb()
                ->createCommand("DELETE FROM {$this->table} WHERE `category` IN (:categories)", [
                    ':categories' => implode(',', $this->catToBeDel)
                ])
                ->execute();
        }

        if ( $this->toBeDelete ) {
            foreach ($this->toBeDelete as $category => $keys) {
                Yii::$app->getDb()
                    ->createCommand("DELETE FROM {$this->table} WHERE `category`=:category AND `key` IN (:keys)", [
                        ':category' => $category,
                        ':keys' => implode(',', $keys)
                    ])
                    ->execute();
            }
        }

        if ( $this->toBeSave ) {
            $batchData = [];

            foreach ($this->toBeSave as $category => $keyValues) {
                foreach ($keyValues as $key => $value) {
                    $batchData[] = [
                        $category,
                        $key,
                        @serialize($value)
                    ];
                }
            }

            if( $batchData ) {
                $sql = Yii::$app->getDb()
                    ->createCommand()
                    ->batchInsert($this->table, ['category', 'key', 'value'], $batchData)
                    ->getSql();

                Yii::$app->getDb()
                    ->createCommand($sql . " ON DUPLICATE KEY UPDATE `value`=VALUES(`value`);")
                    ->execute();
            }
        }

        Yii::$app->cache->delete($this->cacheKey);
    }
}
