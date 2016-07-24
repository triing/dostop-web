<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Gateway');
\Yii::$app->language = \app\models\Organization::find()->where(['domain' => $_SERVER['SERVER_NAME']])->one()->language;

$org = \app\models\Organization::find()->where(['domain' => $_SERVER['SERVER_NAME']])->one();
$img = "/uploads/" . $org->slug . "/logo.png";
?>
<div class="site-index">

    <div class="jumbotron">
		<img src="<?=$img?>" alt="<?=$org->name?>"/>
    </div>
    <div class="body-content">

    </div>
</div>
