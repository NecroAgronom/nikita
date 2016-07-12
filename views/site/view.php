<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->category_id == 1) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/posts/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
        <?php if ($model->category_id == 2) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/poems/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
        <?php if ($model->category_id == 3) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/music/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
        <?php if (!Yii::$app->user->getisGuest()) { ?>





            <?= Html::a('Редактировать <span class="glyphicon glyphicon-wrench"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить <span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

        <?php } ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><span style="font-weight: 700"><?= $model->title ?></span></div>
        <div class="panel-body">
            <?php if ($model->img) { ?>
                <img src="<?= $model->img ?>"/>
            <?php } ?><br>
            <?php if ($model->aud) { ?>
                <audio src="<?=$model->aud?>" controls preload="auto"></audio>
            <?php } ?>


            <?= Html::decode($model->text); ?>
        </div>

    </div>

</div>



