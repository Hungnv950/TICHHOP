<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\ServiceAccess */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-access-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id') ->dropDownList(
        ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username')
    ) ?>

    <?= $form->field($model, 'id1')->textInput() ?>

    <?= $form->field($model, 'pw1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id2')->textInput() ?>

    <?= $form->field($model, 'pw2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id3')->textInput() ?>

    <?= $form->field($model, 'pw3')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
