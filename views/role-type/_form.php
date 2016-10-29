<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoleType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description_sl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allow_edit_project')->checkbox() ?>

    <?= $form->field($model, 'allow_edit_partners')->checkbox() ?>

    <?= $form->field($model, 'allow_edit_products')->checkbox() ?>

    <?= $form->field($model, 'allow_edit_events')->checkbox() ?>

    <?= $form->field($model, 'allow_edit_participants')->checkbox() ?>

    <?= $form->field($model, 'allow_edit_roles')->checkbox() ?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'updated_by')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
