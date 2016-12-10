<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DoorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="door-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'to_room_id') ?>

    <?= $form->field($model, 'from_room_id') ?>

    <?= $form->field($model, 'lock_type_id') ?>

    <?= $form->field($model, 'secret') ?>

    <?php // echo $form->field($model, 'preference') ?>

    <?php // echo $form->field($model, 'xpos') ?>

    <?php // echo $form->field($model, 'ypos') ?>

    <?php // echo $form->field($model, 'direction') ?>

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
