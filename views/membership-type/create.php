<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MembershipType */

$this->title = Yii::t('app', 'Create Membership Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Membership Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
