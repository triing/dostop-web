<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MembershipTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membership-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description_sl') ?>

    <?= $form->field($model, 'description_en') ?>

    <?= $form->field($model, 'allow_edit_organization') ?>

    <?= $form->field($model, 'allow_edit_projects') ?>

    <?php // echo $form->field($model, 'allow_edit_members') ?>

    <?php // echo $form->field($model, 'allow_edit_rooms') ?>

    <?php // echo $form->field($model, 'allow_edit_resources') ?>

    <?php // echo $form->field($model, 'allow_edit_products') ?>

    <?php // echo $form->field($model, 'allow_edit_events') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
