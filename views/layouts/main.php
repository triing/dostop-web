<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;

use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use kartik\widgets\Select2;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
	
	$org = \app\models\Organization::find()->where(['domain' => $_SERVER['SERVER_NAME']])->one();	
	
    NavBar::begin([
        'brandLabel' => $org->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	
	$navItems=[
		['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
		['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
	];
	$navItemsGuest = [
		['label' => Yii::t('app', 'Sign In'), 'url' => ['/user/login']]
	];
	$navItemsUser = [
		['label' => Yii::t('app', 'Global codes'), 'items' => [
			['label' => Yii::t('app', 'Country codes'), 'url' => 'http://www.iso.org/iso/home/standards/country_codes/country_names_and_code_elements_txt-temp.htm'],
			['label' => Yii::t('app', 'Municipality IDs'), 'url' => 'http://www.e-prostor.gov.si/fileadmin/BREZPLACNI_POD/RPE/OB_C.txt'],
			['label' => Yii::t('app', 'Postal codes'), 'url' => 'http://www.posta.si/downloadfile.aspx?fileid=25874'],
			['label' => Yii::t('app', 'Street IDs'), 'url' => 'http://www.e-prostor.gov.si/fileadmin/BREZPLACNI_POD/RPE/UL_S.zip'],
			['label' => Yii::t('app', 'Activity type codes'), 'url' => 'http://www.stat.si/doc/klasif/SKD2008-KPP-SL-Klasje-SL.xls'],
			['label' => Yii::t('app', 'Tax IDs'), 'items' => [
				['label' => Yii::t('app', 'Organizations'), 'url' => 'http://datoteke.durs.gov.si/DURS_zavezanci_PO.zip'],
				['label' => Yii::t('app', 'People'), 'url' => 'http://datoteke.durs.gov.si/DURS_zavezanci_DEJ.zip'],			
			]]
		]],
		['label' => Yii::t('app', 'Local codes'), 'items' => [
			['label' => Yii::t('app', 'Management types'), 'url' => ['/management-type']],
			['label' => Yii::t('app', 'Room types'), 'url' => ['#']],
			['label' => Yii::t('app', 'Organization types'), 'url' => ['#']],
			['label' => Yii::t('app', 'Membership types'), 'url' => ['/membership-type']],
			['label' => Yii::t('app', 'Statuses'), 'url' => ['#']],
			['label' => Yii::t('app', 'Role types'), 'url' => ['/role-type']],
			['label' => Yii::t('app', 'Participation types'), 'url' => ['#']],
			['label' => Yii::t('app', 'Event types'), 'url' => ['#']],
			['label' => Yii::t('app', 'Product types'), 'url' => ['#']],
			['label' => Yii::t('app', 'Project types'), 'url' => ['/project-type']],
			['label' => Yii::t('app', 'Partnership types'), 'url' => ['/partnership-type']],
			['label' => Yii::t('app', 'Lock types'), 'url' => ['/lock-type']],
			['label' => Yii::t('app', 'Tag types'), 'url' => ['/tag-type']],
		]],
		['label' => Yii::t('app', 'Administration'), 'items' => [
			['label' => Yii::t('app', 'Buildings'), 'url' => ['/building']],
			['label' => Yii::t('app', 'Organizations'), 'url' => ['/organization']],
			['label' => Yii::t('app', 'People'), 'url' => ['/person']],
			['label' => Yii::t('app', 'Users'), 'url' => ['/user/admin']],
		]],
		['label' => Yii::t('app', 'Logout') . '(' . Yii::$app->user->identity->username . ')',	'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
	];
	if (Yii::$app->user->isGuest) {
		$navItems = array_merge ($navItems, $navItemsGuest);
	}
	else {
		$navItems = array_merge ($navItems, $navItemsUser);
	}
	
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => $navItems,
	]);	
	
    NavBar::end();
	
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; TRI-ING d.o.o. Maribor <?= date('Y') ?></p>

        <!--p class="pull-right"><?= Yii::powered() ?></p-->
    </div>
</footer>

<?php
	yii\bootstrap\Modal::begin([
		'headerOptions' => ['id' => 'modalHeader'],
		'closeButton' => ['id' => 'close-button'],
		'id' => 'modal',
		'size' => 'modal-lg',
//        'tabindex' => false, // important for Select2 to work properly
		//keeps from closing modal with esc key or by clicking out of the modal.
		// user must click cancel or X to close
//		'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
	]);
	echo '<div id="modalContent"><div style="text-align:center"><img src="/img/ajax-preloader.gif"></div></div>';
	yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
