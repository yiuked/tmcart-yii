<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{
    /** @var  字符串 指定当前模块默认的控制器命名空间 **/
    public $controllerNamespace = 'app\modules\admin\controllers';

    /** @var  字符串 指定当前模块默认的控制器和方法 **/
    public $defaultRoute = 'dashboard/index';

    public function init()
    {
        parent::init();
        //设置Layout路径，否则默认会调用根目录themes\defaulte\layouts下的布局文件
        Yii::$app->setLayoutPath("@app/modules/admin/views/layouts");
        // custom initialization code goes here
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/admin/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/admin/translations',
            'fileMap' => [
                'modules/admin/global' => 'global.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/admin/' . $category, $message, $params, $language);
    }
}
