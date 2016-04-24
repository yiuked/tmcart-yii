<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Tabs;
use yii;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $tabs = Tabs::getTabs();
        return $this->render('index');
    }
}
