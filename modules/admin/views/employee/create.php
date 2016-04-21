<?php

use yii\helpers\Html;
use app\modules\admin\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Employee */

$this->title = Module::t('global', 'create_employee');
$this->params['breadcrumbs'][] = ['label' => Module::t('global', 'employee'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'profileData' => $profileData,
        'model' => $model,
    ]) ?>

</div>
