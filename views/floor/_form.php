<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

use app\models\Building;

/* @var $this yii\web\View */
/* @var $model app\models\Floor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="floor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'building_id')->textInput() ?>
	<?= $form->field($model, 'building_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Building::find()->all(),'id','name')]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'separator')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
