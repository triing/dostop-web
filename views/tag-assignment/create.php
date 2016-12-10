<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TagAssignment */

$this->title = Yii::t('app', 'Create Tag Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tag Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
