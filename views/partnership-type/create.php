<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnershipType */

$this->title = Yii::t('app', 'Create Partnership Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partnership Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partnership-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
