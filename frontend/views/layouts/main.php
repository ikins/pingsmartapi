<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
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
	$controller = Yii::$app->controller;
	$default_controller = Yii::$app->defaultRoute;
	$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
	
    NavBar::begin([
        'brandLabel' => 'PINGSMART',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
		['label' => 'Contact', 'url' => ['/site/contact']],
    ];
   


   if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Member Area', 'url' => ['/site/login']];
    } else {
		
		$menuItems[]=[
					'label' => 'Menu Saya',
					'items' =>[
						['label' => 'Akun Saya', 'url' => ['/member/index']],
						[
							'label' => 'Logout (' . Yii::$app->user->identity->Username . ')',
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'post']
						],
					],
				];
        
    }
			
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?php if(!$isHome):?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
	</div>
    <?php endif;?>
	<div class='main-page'>
		<?= $content ?>
	</div>
</div>
<?= $this->render('bottom');?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; pingSmart <?= date('Y') ?></p>

        <p class="pull-right">powered by ALGO</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
