<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RoomManagement */

$this->title = Yii::t('app', 'Create Room Management');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Managements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-management-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
