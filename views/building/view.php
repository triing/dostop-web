<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Building */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-view">

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

<?php
	
	$floors_content = 
		'<p>' . Html::a(Yii::t('app', 'Create Floor'), ['floor/create'], ['class' => 'btn btn-success']) . '</p>' .
		GridView::widget([
			'dataProvider' => new ActiveDataProvider(['query' => $model->getFloors()]),
			'columns' => [
				'fullcode',
				'name',
				[
					'class' => 'yii\grid\ActionColumn',
					'controller' => 'floor'
				],
			]
		]);
	

	
    $general_content = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'code',
            'separator',
        ],
    ]);
	
	echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
	'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-tasks"></i> ' . Yii::t('app', 'Floors'),
            'content' => $floors_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
            'content' => $general_content,
        ],
    ],
	]);

	
	?>

</div>
