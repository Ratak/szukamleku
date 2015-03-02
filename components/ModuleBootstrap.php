<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 07.02.15
 * Time: 13:22
 */

namespace app\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\FileHelper;

class ModuleBootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $modules = $app->getModules();

        foreach ($modules as $name => $config) {
            $namespace = (is_array($config))
                ? $config['class']
                : $config;

            if(strpos($namespace, 'app\modules') === 0) {
                $path = $this->getModulePath($namespace);
                $files = FileHelper::findFiles($path, ['only' => ['UrlRules.php']]);

                foreach($files as $file) {
                    if (file_exists($file)) {
                        $rules = require($file);

                        if(is_array($rules)) {
                            $app->getUrlManager()->addRules($rules);
                        }
                    }
                }
            }
        }
    }

    protected function getModulePath($namespace)
    {
        $path = explode('\\', $namespace);
        array_pop($path);

        return Yii::getAlias('@' . implode('/', $path));
    }
}