<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TagType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'updated_by')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
