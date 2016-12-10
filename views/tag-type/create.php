<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TagType */

$this->title = Yii::t('app', 'Create Tag Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tag Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
