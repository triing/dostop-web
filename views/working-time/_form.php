<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkingTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="working-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'room_management_id')->textInput() ?>

    <?= $form->field($model, 'building_management_id')->textInput() ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'updated_by')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
