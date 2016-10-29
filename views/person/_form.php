<?php

use yii\widgets\ActiveForm;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\tabs\TabsX;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
//use kartik\date\DatePicker;
//use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

use app\models\Country;
use app\models\Post;
use app\models\Municipality;
use app\models\Street;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

<?php 

	$form = ActiveForm::begin(); 
	$general_content =
		$form->field($model, 'first_name')->textInput(['maxlength' => true]) .
		$form->field($model, 'last_name')->textInput(['maxlength' => true]) .
		$form->field($model, 'sex')->radioList(['M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female')]) .
		
		$form->field($model, 'birth_date')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATE,
		]) .
		
		$form->field($model, 'email')->textInput(['maxlength' => true]) .
		$form->field($model, 'phone')->textInput(['maxlength' => true]);

	$location_content = 
		$form->field($model, 'language')->textInput(['maxlength' => true]) .
		$form->field($model, 'municipality_id')->textInput() .
		$form->field($model, 'postal_code')->textInput() .
		$form->field($model, 'street_id')->textInput() .
		$form->field($model, 'house_no')->textInput(['maxlength' => true]);

	$status_content =
		$form->field($model, 'status_id')->textInput();

	echo TabsX::widget([
		'position' => TabsX::POS_ABOVE,
		'align' => TabsX::ALIGN_LEFT,
		'encodeLabels' => false,
		'items' => [
			[
				'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
				'content' => $general_content,
			],
			[
				'label' => '<i class="glyphicon glyphicon-map-marker"></i> ' . Yii::t('app', 'Location'),
				'content' => $location_content,
			],
		],
	]);

?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
