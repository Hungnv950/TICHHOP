<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceAccess */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Service Access',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Accesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
