<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clearance */

$this->title = Yii::t('app', 'Create Clearance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clearances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
