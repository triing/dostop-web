<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\tabs\TabsX;
use kartik\select2\Select2;

use app\models\Country;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form">

<?php 
	$form = ActiveForm::begin();
	
	$general_content =
		$form->field($model, 'name')->textInput(['maxlength' => true]) .
		$form->field($model, 'full_name')->textInput(['maxlength' => true]) .
		$form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className()) .
		$form->field($model, 'email')->textInput(['maxlength' => true]) .
		$form->field($model, 'webpage')->textInput(['maxlength' => true]) .
		$form->field($model, 'phone')->textInput(['maxlength' => true]) .
		$form->field($model, 'promoted')->checkBox(['selected' => $model->promoted]);
	
	$location_content = 
		$form->field($model, 'country_code')->widget(Select2::classname(), ['data' => ArrayHelper::map(Country::find()->all(),'code','name'),]) .	
		$form->field($model, 'municipality_id')->textInput() .
		$form->field($model, 'postal_code')->textInput() .
		$form->field($model, 'street_id')->textInput() .
		$form->field($model, 'house_no')->textInput(['maxlength' => true]);

	$data_content =
		$form->field($model, 'organization_type_id')->textInput() .
		$form->field($model, 'activity_type_id')->textInput(['maxlength' => true]) .
		$form->field($model, 'registration_number')->textInput() .
		$form->field($model, 'tax_id')->textInput();
		
	$system_content =
		$form->field($model, 'slug')->textInput(['maxlength' => true]) .
		$form->field($model, 'domain')->textInput(['maxlength' => true]) .
		$form->field($model, 'language')->textInput(['maxlength' => true]);

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
        [
            'label' => '<i class="glyphicon glyphicon-briefcase"></i> ' . Yii::t('app', 'Data'),
            'content' => $data_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-cog"></i> ' . Yii::t('app', 'System'),
            'content' => $system_content,
        ],
    ],
]);
?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
