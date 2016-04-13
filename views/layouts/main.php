<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="SHORTCUT ICON" href="/static/favicon.ico" type="image/x-icon">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Oumahnagi',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'id' => 'main-menu',
            //'class' => ' navbar-fixed-top'
        ],
        'renderInnerContainer' => true,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'ГЛАВНАЯ', 'url' => ['/site/index']],
            //['label' => 'Blog','url' => ['/'], 'items' => [
            //    ['label' => 'Посты', 'url' => ['/site/posts'], 'style' => 'color: #fff'],
            //    ['label' => 'Стихи', 'url' => ['/site/poems'], 'style' => 'color: #fff'],
            //    ['label' => 'Музыка', 'url' => ['/site/music'], 'style' => 'color: #fff'],
            //]],
            ['label' => 'Обо мне', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],

            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<span class="glyphicon glyphicon-log-out"></span>  Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-warning ', 'style' => 'font-weight: 700; margin-top: 8px;  opacity : 1']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="margin-top: 50px">

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Oumahnagi <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
