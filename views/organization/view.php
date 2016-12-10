<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-view">

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

	$members_content = 
//		'<p>' . Html::a(Yii::t('app', 'Add Member'), Url::to(['membership/create', organization_id => $model->id]), ['class' => 'btn btn-success']) . '</p>' .
		'<p>' . Html::button(Yii::t('app', 'Add Member'), ['value' => Url::to(['membership/create', organization_id => $model->id]), 'title' => Yii::t('app', 'Add Member'), 'class' => 'showModalButton btn btn-success']) . '</p>' .
		
		GridView::widget([
			'dataProvider' => new ActiveDataProvider(['query' => $model->getMemberships()]),
			'columns' => [
				[
					'attribute' => 'person_id',
					'label' => Yii::t('app', 'Member'),
					'value' => 'person.firstnamelastnameemail',
				],
				[
					'attribute' => 'membership_type_id',
					'label' => Yii::t('app', 'Membership type'),
					'value' => 'membershipType.description_' . Yii::$app->language,
				],
				'valid_from',
				'valid_to',
				[
					'class' => 'yii\grid\ActionColumn',
					'controller' => 'membership',
					'template' => '{update} {delete}',
					'buttons' => [
						'update' => function ($url, $model) {
							return Html::button('', ['value' => $url, 'title' => Yii::t('app', 'Update Member'), 'class' => 'showModalButton glyphicon glyphicon-pencil']);
						},
						'delete' => function ($url, $model) {
							return Html::button('', ['value' => $url, 'title' => Yii::t('app', 'Delete Member'), 'class' => 'showModalButton glyphicon glyphicon-trash']);
						}
					],
				],
			]
		]);

	$general_content = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'slug',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            'name',
//            'domain',
            'description:html',
//            'language',
            'organization_type_id',
            'full_name',
            'email:email',
            'webpage',
            'phone',
            'country_code',
//			$model->country->name,
//          'country.name',
//            'municipality_id',
//            'postal_code',
//            'street_id',
//            'house_no',
//            'activity_type_id',
//            'registration_number',
//            'tax_id',
//            'promoted',
        ],
    ]);

	echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
	'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('app', 'Members'),
            'content' => $members_content,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'General'),
            'content' => $general_content,
        ],
    ],
	]);
	
?>

</div>
