<?php

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            'name',
            'domain',
            'description:html',
            'language',
            'organization_type_id',
            'full_name',
            'email:email',
            'webpage',
            'phone',
            'country_code',
//			$model->country->name,
//          'country.name',
            'municipality_id',
            'postal_code',
            'street_id',
            'house_no',
            'activity_type_id',
            'registration_number',
            'tax_id',
            'promoted',
        ],
    ]) ?>

</div>
