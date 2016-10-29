<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Building */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-form">

<?php
	$form = ActiveForm::begin();

	echo $form->field($model, 'name')->textInput(['maxlength' => true]);
	echo $form->field($model, 'code')->textInput(['maxlength' => true]);
	echo $form->field($model, 'separator')->textInput(['maxlength' => true]);

	
?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
