<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Floor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['building/index']];
$this->params['breadcrumbs'][] = [
	'label' => $model->getBuilding()->one()->name, 
	'url' => ['building/view', 'id' => $model->getBuilding()->one()->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="floor-view">

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

	$rooms_content = 
		'<p>' . Html::a(Yii::t('app', 'Create Room'), ['room/create'], ['class' => 'btn btn-success']) . '</p>' .
		GridView::widget([
			'dataProvider' => new ActiveDataProvider(['query' => $model->getRooms()]),
			'columns' => [
				'fullcode',
				'name',
				'area',
				[
					'class' => 'yii\grid\ActionColumn',
					'controller' => 'room'
				],
			]
		]);

	$general_content = DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'label' => Yii::t('app', 'Building'),
				'attribute' => 'building.name',
			],
            'code',
            'name',
        ],
    ]);
	
	echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
	'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-tent"></i> ' . Yii::t('app', 'Rooms'),
            'content' => $rooms_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
            'content' => $general_content,
        ],
    ],
	]);

?>

</div>
