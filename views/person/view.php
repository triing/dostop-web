<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

//$this->title = $model->id;
$this->title = $model->first_name . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

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
	
	$tag_assignments_content = GridView::widget([
		'dataProvider' => new ActiveDataProvider(['query' => $model->getTagAssignments()]),
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tag_id',
            'person_id',
            'tag_type_id',
            'start_date',
            'end_date',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

	$general_content = DetailView::widget([
//	= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            'language',
            'first_name',
            'last_name',
//            'user_id',
            'birth_date',
            'exact_birth_date',
            'sex',
            'status_id',
            'email:email',
            'phone',
            'municipality_id',
            'postal_code',
            'street_id',
            'house_no',
        ],
    ]);

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
            'label' => '<i class="glyphicon glyphicon-tag"></i> ' . Yii::t('app', 'Tag assignments'),
            'content' => $tag_assignments_content,
        ],
    ],
	]);

	
?>

</div>
