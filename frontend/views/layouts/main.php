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
    <link  rel="icon" href="<?= \Yii::getAlias('/frontend/web/favicon.ico');?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= \frontend\widgets\Alert::widget(['options' => [

    'type' => \frontend\widgets\Alert::TYPE_WARNING,
],

]) ?>
<?= $this->render(
    'partials/header.php',
    []
) ?>
<?= $content ?>
<?= $this->render(
    'partials/footer.php',
    []
) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
