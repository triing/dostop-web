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
	
<?php

	$managements_content =
		'<p>' . Html::a(Yii::t('app', 'Create Management'), ['room-management/create'], ['class' => 'btn btn-success']) . '</p>' .
		GridView::widget([
			'dataProvider' => new ActiveDataProvider(['query' => $model->getManagements()]),
			'columns' => [
				'id',
				[
					'attribute' => 'organization_id',
					'label' => Yii::t('app', 'Organization'),
					'value' => 'organization.name',
				],
				[
					'attribute' => 'management_type_id',
					'label' => Yii::t('app', 'Management type'),
					'value' => 'managementType.description_' . Yii::$app->language,
				],
				'start_date',
				'end_date',
				[
					'class' => 'yii\grid\ActionColumn',
					'controller' => 'room-management'
				],
			]
		]);

	$doors_content = 
		'<p>' . Html::a(Yii::t('app', 'Create Door'), ['door/create'], ['class' => 'btn btn-success']) . '</p>' .
		GridView::widget([
			'dataProvider' => new ActiveDataProvider(['query' => $model->getDoorsTo()]),
			'columns' => [
				'id',
				'from_room_id',
				[
					'attribute' => 'lock_type_id',
					'label' => Yii::t('app', 'Lock type'),
					'value' => 'lockType.description',
				],
				// 'name',
				// 'area',
				[
					'class' => 'yii\grid\ActionColumn',
					'controller' => 'door'
				],
			]
		]);

    $general_content = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'floor_id',
            'code',
            'name',
            'area',
        ],
    ]);

	echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
	'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-briefcase"></i> ' . Yii::t('app', 'Management'),
            'content' => $managements_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Yii::t('app', 'Doors'),
            'content' => $doors_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
            'content' => $general_content,
        ],
    ],
	]);
	
?>

</div>
