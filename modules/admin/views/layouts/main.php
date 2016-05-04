<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\admin\views\dist\AdminAsset;
use app\modules\admin\models\Tabs;
use app\components\widgets\SideBar;

AppAsset::register($this);
AdminAsset::register($this);

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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'YiiShop',
        'brandUrl' => ['/admin/dashboard'],
        'innerContainerOptions' => [
            'class' => 'navbar-inner'
        ],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '管理员', 'url' => ['/admin/employee']],
            ['label' => '管理员分组', 'url' => ['/admin/profile']],
            Yii::$app->getModule('admin')->user->isGuest ?
                ['label' => '登录', 'url' => ['/admin/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->getModule('admin')->user->identity->email . ')',
                    'url' => ['/admin/login/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="layout-body <?php echo isset($_COOKIE['sidebar-fold']) && $_COOKIE['sidebar-fold'] == 'mini' ? "layout-sidebar-mini" : "layout-sidebar-full"; ?>">
        <div class="layout-sidebar">
            <div class="sidebar-fold"><span aria-hidden="true" class="glyphicon glyphicon-menu-hamburger"></span></div>
            <div class="sidebar-nav">
                <?php
                $tabs = Tabs::getTabs();
                $mainData = SideBar::initSideBarData($tabs['children']);
                echo SideBar::widget([
                    'type' =>SideBar::SIDEBAR_IS_MAIN,
                    'items' => $mainData,
                    'options' => ['class' => 'sidebar-trans']
                ]);
                ?>
            </div>
        </div>
        <?php
        $menData = SideBar::getSideBarMenuData($mainData);
        ?>
        <div class="layout-content <?php echo isset($_COOKIE['sidebar-fold']) && $_COOKIE['layout-content'] == 'close' ? "" : "navbar-open"; ?>">
            <div class="layout-content-navbar">
                <div class="content-nav-title"><?php echo $menData['name'];?></div>
                <div class="content-nav-list">
                    <?php
                    echo SideBar::widget([
                        'type' =>SideBar::SIDEBAR_IS_MENU,
                        'items' => $menData['children'],
                    ]);
                    ?>
                </div>
            </div>
            <div class="layout-content-navbar-collapse">
                <div class="collapse-inner">
                    <div class="collapse-bg"></div>
                    <div class="collapse-icon <?php echo isset($_COOKIE['sidebar-fold']) && $_COOKIE['layout-content'] == 'close' ? "close-status" : "open-status"; ?>">
                        <span class="glyphicon glyphicon-step-backward"></span>
                        <span class="glyphicon glyphicon-step-forward"></span>
                    </div>
                </div>
            </div>
            <div class="layout-content-body container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        </div>
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
