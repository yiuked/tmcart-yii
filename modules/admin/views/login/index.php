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

use yii\helpers\Html;
use app\assets\LoginAsset;
use app\modules\admin\controllers\LoginController;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script language="JavaScript">
        var ajaxUrl = "<?=Yii::$app->getUrlManager()->createUrl('admin/login/auth');?>";
        var mailUrl = "<?=Yii::$app->getUrlManager()->createUrl('admin/dashboard');?>";
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div id="container">
    <div class="main-panel">
        <h1>If Shop</h1>
        <div class="login-panel">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="passwd">Password</label>
                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Check me out
                </label>
            </div>
            <div role="alert" class="alert alert-danger error-tip hidden"></div>
            <div class="form-group">
                <button type="button" id="submit-login-form" class="btn btn-default">登录</button>
                <p class="pull-left no-margin ajax-loader hidden"><?=Html::img("@web/img/loader.gif");?></p>
                <p class="pull-right no-margin"> <a href="javascript:void(0)" class="show-forgot-password">忘记密码?</a> </p>
            </div>
        </div>
        <!--找加密码-->
        <form action="#" id="forgot_password_form" method="post" class="hidden">
            <h3>忘记了你的密码吗?</h3>
            <span id="helpBlock" class="help-block">请输入注册过程中输入的邮箱地址，系统将发送密码到此邮箱.</span>
            <div class="form-group">
                <label for="email">Email 地址</label>
                <input type="email" class="form-control" id="email_forgot" name="email_forgot" placeholder="Email">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default  pull-left">发送</button>
                <p class="fl no-margin hide ajax-loader"><?=Html::img("@web/img/loader.gif");?></p>
                <div class="clearfix"></div>
            </div>
            <p> <a href="javascript:void(0)" class="show-login-form">返回登录</a> </p>
        </form>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>