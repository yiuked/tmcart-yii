<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
?>

<div class="permission-form">

    <?php echo Html::beginForm('', 'post')?>
    <?php if (Yii::$app->session->hasFlash('PermissionUpdate')): ?>
        <div class="alert alert-success">更新权限成功</div>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::label("权限名", "name");?>
        <?= Html::textInput("name", $model->name, ["disabled" => "disabled", "class" => "form-control"]);?>
    </div>

    <div class="form-group">
        <?= Html::label("权限描述", "description");?>
        <?= Html::textInput("description", $model->description, ["class" => "form-control"]);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php echo Html::endForm()?>

</div>
