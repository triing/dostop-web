<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Door */

$this->title = Yii::t('app', 'Create Door');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="door-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
