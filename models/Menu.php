<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $language_id
 * @property string $title
 * @property string $link
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'language_id'], 'integer'],
            [['language_id', 'title', 'link'], 'required'],
            [['link'], 'string'],
            [['title'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pid' => Yii::t('app', 'Pid'),
            'language_id' => Yii::t('app', 'Language ID'),
            'title' => Yii::t('app', 'Title'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

	public function getSubcategories()
	{
		// Customer has_many Order via Order.customer_id -> id
		return $this->hasMany(self::className(), ['pid' => 'id']);
	}

	public function getLanguages()
	{
		return $this->hasMany(Language::className(), ['id' => 'language_id']);
	}

	public static function hasChildren($id)
	{
		return self::model()->exists('pid = :pid', array(":pid" => $id));
	}


	public static $asTree = array();

	public static function getTree()
	{
		if (empty(self::$asTree)) {

			$rows = self::find()
				->innerJoinWith('languages')
				->where('pid IS NULL
					AND language_id = languages.id
					AND languages.id = :lang_id')
				->addParams([':lang_id' => Language::getCurrent()->id])
				->all();

			foreach ($rows as $item) {
				self::$asTree[] = self::getTreeItems($item);
			}
		}

		$menu_manual_set = [
			['label' => 'Admin', 'url' => ['/admin'], 'visible' => Yii::$app->user->can('admin')],

			Yii::$app->user->isGuest
				? ['label' => 'Login',  'url' => ['/auth/login']]
				: ['label' => 'Logout', 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']
			],
		];

		$menu['options'] = ['class' => 'navbar-nav navbar-right'];
		$menu['items'] = array_merge(self::$asTree, $menu_manual_set);

		return $menu;
	}

	private static function getTreeItems($modelRow, $is_sub = false)
	{

		if (!$modelRow)
			return;

		//modified version with span instead a on lives
		if (isset($modelRow->subcategories)) {
			$chump = self::getTreeItems($modelRow->subcategories);
			if ($chump != null) {
				$res = array(
					'label' => $modelRow->subcategories,
					'items' => $chump,
					'label' => $modelRow->title,
				);
			} else {
				if ($is_sub) {
					$res = ['label' => $modelRow->title, 'url' => [$modelRow->link]];
				} else {
					$res = ['label' => $modelRow->title, 'url' => [$modelRow->link]];
				}
			}
			return $res;
		} else {
			if (is_array($modelRow)) {
				$arr = array();
				foreach ($modelRow as $leaves) {
					$arr[] = self::getTreeItems($leaves, $is_sub = true);
				}
				return $arr;
			} else {
				return ['label' => $modelRow->title, 'url' => [$modelRow->link]];
			}
		}
	}
}