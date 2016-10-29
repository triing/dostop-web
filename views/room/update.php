<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Room',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['building/index']];
$this->params['breadcrumbs'][] = [
	'label' => $model->getFloor()->one()->getBuilding()->one()->name, 
	'url' => ['building/view', 'id' => $model->getFloor()->one()->getBuilding()->one()->id]
];
$this->params['breadcrumbs'][] = [
	'label' => $model->getFloor()->one()->name, 
	'url' => ['floor/view', 'id' => $model->getFloor()->one()->id]
];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
