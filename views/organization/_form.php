<?php

use yii\widgets\ActiveForm;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\tabs\TabsX;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

use app\models\Country;
use app\models\Post;
use app\models\Municipality;
use app\models\Street;

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
		$form->field($model, 'country_code')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Country::find()->all(),'code','name'),
		]) .
		
		$form->field($model, 'org_municipality_id')->hiddenInput(['value'=> ($model->municipality_id === null ? '' : $model->municipality_id)])->label(false) .
		$form->field($model, 'municipality_id')->widget(DepDrop::classname(), [
			'type'=>DepDrop::TYPE_SELECT2,
			'options'=>['id'=>'name', 'placeholder'=>Yii::t('app', 'Select municipality ...')],
			'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
			'data' =>($model->country_code)?ArrayHelper::map(Municipality::find()->where(['country_code'=>$model->country_code])->select(["id", "name"])->asArray()->all(), 'id', 'name'):[],
			'pluginOptions'=>[
				'depends'=>['organization-country_code'],
				'url'=>Url::to('/organization/country-municipality-ids/'),
				'params'=>['organization-org_municipality_id'],
			]
		]) .
		
		$form->field($model, 'org_postal_code')->hiddenInput(['value'=> ($model->postal_code === null ? '' : $model->postal_code)])->label(false) .
		$form->field($model, 'postal_code')->widget(DepDrop::classname(), [
			'type'=>DepDrop::TYPE_SELECT2,
			'options'=>['code'=>'postalCodeName', 'placeholder'=>Yii::t('app', 'Select post ...')],
			'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
			'data' =>($model->country_code)?ArrayHelper::map(Post::find()->where(['country_code'=>$model->country_code])->select(["code AS id", "CONCAT(code, ' ', name) AS name"])->asArray()->all(), 'id', 'name'):[],
			'pluginOptions'=>[
				'depends'=>['organization-country_code'],
				'url'=>Url::to('/organization/country-postal-codes/'),
				'params'=>['organization-org_postal_code'],
			]
		]) .
		
//		$form->field($model, 'street_id')->textInput() .
		$form->field($model, 'org_street_id')->hiddenInput(['value'=> ($model->street_id === null ? '' : $model->street_id)])->label(false) .
		$form->field($model, 'street_id')->widget(DepDrop::classname(), [
			'type'=>DepDrop::TYPE_SELECT2,
			'options'=>['street_id'=>'street_name', 'placeholder'=>Yii::t('app', 'Select street ...')],
			'select2Options'=>['pluginOptions'=>['allowClear'=>true,'minimumInputLength' => 3]],
			'data' =>($model->municipality_id)?ArrayHelper::map(Street::find()->where(['municipality_id'=>$model->municipality_id])->select(["id", "name"])->asArray()->all(), 'id', 'name'):[],
			'pluginOptions'=>[
				'depends'=>['organization-country_code', 'organization-municipality_id'],
				'url'=>Url::to('/organization/municipality-street-ids/'),
				'params'=>['organization-org_street_id'],
			]
		]) .

		
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
