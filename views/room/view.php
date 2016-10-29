<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['building/index']];
$this->params['breadcrumbs'][] = [
	'label' => $model->getFloor()->one()->getBuilding()->one()->name, 
	'url' => ['building/view', 'id' => $model->getFloor()->one()->getBuilding()->one()->id]
];
$this->params['breadcrumbs'][] = [
	'label' => $model->getFloor()->one()->name, 
	'url' => ['floor/view', 'id' => $model->getFloor()->one()->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'floor_id',
            'code',
            'name',
            'area',
        ],
    ]) ?>

</div>
