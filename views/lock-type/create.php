<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LockType */

$this->title = Yii::t('app', 'Create Lock Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lock Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lock-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
