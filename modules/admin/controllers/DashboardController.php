<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminController;
use app\modules\admin\models\Tabs;
use yii;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        //$tabs = Tabs::getTabs();
        $user =  Yii::$app->getModule('admin')->user->getId();
        return $this->render('index');
    }
}
