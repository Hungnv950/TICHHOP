<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 28-Nov-16
 * Time: 11:27 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, '')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end()?>
