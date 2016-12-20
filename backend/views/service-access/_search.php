<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceAccessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'id1') ?>

    <?= $form->field($model, 'pw1') ?>

    <?= $form->field($model, 'id2') ?>

    <?php // echo $form->field($model, 'pw2') ?>

    <?php // echo $form->field($model, 'id3') ?>

    <?php // echo $form->field($model, 'pw3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
