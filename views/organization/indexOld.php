<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Organization'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
             'slug',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            'name',
            'domain',
            // 'description:ntext',
            'language',

            ['class' => 'yii\grid\ActionColumn',
				'template'=>'{view} {update} {delete}',
				'buttons'=>[
					'view' => function ($url, $model) {     
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'organization/'.$model->slug, ['title' => Yii::t('yii', 'View'),]);  
				}],
			],
		],
	]); 
	?>

</div>
