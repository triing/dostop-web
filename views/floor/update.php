<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Floor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Floor',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['building/index']];
$this->params['breadcrumbs'][] = [
	'label' => $model->getBuilding()->one()->name, 
	'url' => ['building/view', 'id' => $model->getBuilding()->one()->id]
];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="floor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
