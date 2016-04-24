<?php
/**
 * 2016/4/23 Yiuked
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

use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    public $layout = false;
    /**
     * 管理员登录操作
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAuth()
    {
        $request = Yii::$app->getRequest();
        if ($request->isAjax) {
            echo 123;
            die();
        }
    }
}