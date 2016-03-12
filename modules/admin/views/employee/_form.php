<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->radioList(array('1' => '启用', '0' => '停用')) ?>

    <?= $form->field($model, 'add_date')->textInput() ?>

    <?= $form->field($model, 'upd_date')->textInput() ?>

    <?= $form->field($model, 'last_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('global', 'test') : \Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
