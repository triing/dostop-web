<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Person'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            // 'language',
            'first_name',
            'last_name',
            // 'user_id',
            // 'birth_date',
            // 'sex',
            // 'status_id',
            'email:email',
            // 'phone',
            // 'municipality_id',
            // 'postal_code',
            // 'street_id',
            // 'house_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
