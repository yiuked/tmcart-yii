<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;

//配置分页信息
$dataProvider->setPagination(
    [
        'pageSize' => 20,
    ]
);
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if (Yii::$app->session->hasFlash('error')) {
     ?>
    <div class="alert alert-error"><?php echo Yii::$app->session->getFlash('error');?></div>
    <?php
        } elseif (Yii::$app->session->hasFlash('conf')) {
     ?>
    <div class="alert alert-success"><?php echo Yii::$app->session->getFlash('conf');?></div>
    <?php
        }
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'dataColumnClass' => 'app\components\grid\MyColumn', //使用自定行，MyColumn中对columnFooter进行了重写，如果为空或未设置，则不生成td.
        'columns' => [
            [
                //content必须是以回调函数的方式调用
                'content' => function ($model) {
                    return '<input type="checkbox" name="id_employee[]" value="' . $model->id_employee . '">';
                },
                'footer' => '<input type="checkbox" class="check-all" data-items="id_employee[]"> 全选 <button class="btn btn-default btn-xs" type="submit">删除选中</button> ',
                'footerOptions' => [
                    'colspan' => 9,
                ],
            ],
            [
                'attribute' => 'id_employee',
                'headerOptions' => [//行首HTML属性
                    'width' => '100px'
                ]
            ],
            'name',
            [
                'attribute' => 'id_profile',
                //value默认是输出的text格式，如果要让其显示成html,请设置属性format => html
                'value' => 'profile.name',
                //attribute必须已注册成来modelsearch的属性，否则filter无法显示
                'filter' => [
                    0 => '禁用',
                    1 => '启用',
                ],
            ],//关联表查询的时候，使用【表名+字段名】取值，需要在Employee【Model】中初始化载入getProfile()
            'email:email',
            [
                'attribute' => 'active',
                'format' => 'html',
                //value与content的区别， value输出比较严格，过虑了一切可能产生XSS攻击的因素，content则可以输出用户自定义任意内容.
                'content' => function ($model) {
                    if ($model->active) {
                        $icon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-ok']);
                        return Html::a($icon, 'javascript:;', ['class' =>  'ajax-toggle', 'data' =>  ['id' => $model->id_employee, 'model' => 'Employee', 'primary' => 'id_profile', 'toggle' => 'active']]);
                    } else {
                        $icon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-remove']);
                        return Html::a($icon, 'javascript:;', ['class' =>  'ajax-toggle', 'data' =>  ['id' => $model->id_employee, 'model' => 'Employee', 'primary' => 'id_profile', 'toggle' => 'active']]);
                    }
                },
                'contentOptions' => ['class' => 'text-center'],
                'filter' => [
                    0 => '禁用',
                    1 => '启用',
                ],

            ],
            [
                'attribute' => 'add_date',
                'filter' => \yii\jui\DatePicker::widget(['language' => 'zh-CN', 'dateFormat' => 'yyyy-MM-dd']),
                'contentOptions' => ['class' => 'form-horizontal', 'name' => 'add_date'],
                'format' => 'html',
            ],
            [
                'attribute' => 'last_date',
                'filter' => \yii\jui\DatePicker::widget(['language' => 'zh-CN', 'dateFormat' => 'yyyy-MM-dd']),
                'contentOptions' => ['class' => 'form-horizontal', 'name' => 'last_date'],
                'format' => 'html',
            ],
            [
                'class' => 'app\components\grid\MyActionColumn',
                'headerOptions' => [
                    'width' => '70'
                ]
            ],
        ],
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
