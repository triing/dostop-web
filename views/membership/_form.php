<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

use app\models\Person;
use app\models\MembershipType;

/* @var $this yii\web\View */
/* @var $model app\models\Membership */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membership-form">

    <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'membership-form'
                ]
    ]); ?>

    <?//= $form->field($model, 'person_id')->textInput() ?>
	<?= $form->field($model, 'person_id')->widget(Select2::classname(), [
		'options' => ['placeholder' => Yii::t('app', 'Select person ...')],
		'data' => ArrayHelper::map(Person::find()->all(),'id','firstnamelastnameemail'),
		'pluginOptions' => [
			'allowClear' => true
		],
		'addon' => [
			'append' => [
				'content' => Html::button('', [
					'value' => Url::to(['person/create', organization_id => $model->id]),
					'class' => 'showModalButton btn btn-primary glyphicon glyphicon-plus', 
					'title' => Yii::t('app', 'Create person'), 
				]),
				'asButton' => true
			]
        ]
	]) ?>

    <?//= $form->field($model, 'organization_id')->textInput() ?>

    <?//= $form->field($model, 'membership_type_id')->textInput() ?>
	<?= $form->field($model, 'membership_type_id')->widget(Select2::classname(), [
		'options' => ['placeholder' => Yii::t('app', 'Select membership type ...')],
		'pluginOptions' => [
			'allowClear' => true
		],
		'data' => ArrayHelper::map(MembershipType::find()->all(),'id','description_' . Yii::$app->language)
	]) ?>

    <?//= $form->field($model, 'valid_from')->textInput() ?>
	<?= $form->field($model, 'valid_from')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATETIME,
		])
	?>

    <?//= $form->field($model, 'valid_to')->textInput() ?>
	<?= $form->field($model, 'valid_to')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATETIME,
		])
	?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'updated_by')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
