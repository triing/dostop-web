<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoomManagement */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Room Management',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Managements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-management-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
