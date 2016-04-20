<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Tabs;
use yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $tabs = Tabs::getTabs();
        //echo json_encode($tabs);
        print_r($tabs);
        die();
        return $this->render('index');
    }
}
