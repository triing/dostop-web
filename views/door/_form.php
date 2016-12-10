<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

use kartik\select2\Select2;

use app\models\Room;
use app\models\LockType;

/* @var $this yii\web\View */
/* @var $model app\models\Door */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="door-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'to_room_id')->textInput() ?>
	<?= $form->field($model, 'to_room_id')->widget(Select2::classname(), [
		'options' => ['placeholder' => Yii::t('app', 'Select room to ...')],
		'pluginOptions' => [
			'allowClear' => true
		],
		'data' => ArrayHelper::map(Room::find()->all(),'id','codename')
	]) ?>

    <?//= $form->field($model, 'from_room_id')->textInput() ?>
	<?= $form->field($model, 'from_room_id')->widget(Select2::classname(), [
		'options' => ['placeholder' => Yii::t('app', 'Select room from ...')],
		'pluginOptions' => [
			'allowClear' => true
		],
		'data' => ArrayHelper::map(Room::find()->all(),'id','codename')
	]) ?>

    <?//= $form->field($model, 'lock_type_id')->textInput() ?>
	<?= $form->field($model, 'lock_type_id')->widget(Select2::classname(), [
		'options' => ['placeholder' => Yii::t('app', 'Select lock type ...')],
		'pluginOptions' => [
			'allowClear' => true
		],
		'data' => ArrayHelper::map(LockType::find()->all(),'id','description')
	]) ?>

    <?= $form->field($model, 'secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preference')->textInput() ?>

    <?= $form->field($model, 'xpos')->textInput() ?>

    <?= $form->field($model, 'ypos')->textInput() ?>

    <?= $form->field($model, 'direction')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'updated_by')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
