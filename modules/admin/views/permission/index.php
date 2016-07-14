<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('global', 'employee');
$this->params['breadcrumbs'][] = $this->title;
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
        <?= Html::a(Module::t('global', 'create_employee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter' => true,
        'dataColumnClass' => 'app\components\grid\MyColumn', //使用自定行，MyColumn中对columnFooter进行了重写，如果为空或未设置，则不生成td.
        'columns' => [
            'name',
            'description',
            [
                'attribute' => 'createdAt',
                'format' => 'html',
                'value' => function ($object) {
                    return date('Y-m-d H:i', $object->createdAt);
                }
            ],
            [
                'attribute' => 'updatedAt',
                'format' => 'html',
                'value' => function ($object) {
                    return date('Y-m-d H:i', $object->createdAt);
                }
            ],
            [
                'class' => 'app\components\grid\MyActionColumn',
                'headerOptions' => [
                    'width' => '70'
                ],
                'template' => '{update} {delete} ',
            ],
        ],
    ]); ?>
</div>
