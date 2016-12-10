<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManagementType */

$this->title = Yii::t('app', 'Create Management Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Management Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="management-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
