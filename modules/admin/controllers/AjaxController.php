<?php
/**
 * 2016/4/4 Yiuked
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future.
 *
 * @author    Yiuked SA <yiuked@vip.qq.com>
 * @copyright 2010-2015 Yiuked
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminController;
use yii;

class AjaxController extends AdminController
{
    public function actionToggle()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            $className = 'app\modules\admin\models\\' . $data['model'];
            if (class_exists($className)) {
                $model = $className::findOne($data['id']);
                $model->{$data['toggle']} = !$model->{$data['toggle']};
                if ($model->save()) {
                    echo json_encode(['status' => 'YES']);
                    exit(0);
                } else {
                    echo json_encode(['status' => 'NO', 'msg' => 'Save fail!']);
                    exit(0);
                }
            }
            echo json_encode(['status' => 'NO', 'msg' => 'Class not found!']);
            exit(0);
        }
        echo json_encode(['status' => 'NO', 'msg' => "It's not Ajax quest!"]);
        exit(0);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
