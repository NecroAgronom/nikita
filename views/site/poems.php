<?php

use yii\helpers\Html;
use yii\grid\GridView;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стихи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['index'], ['class' => 'btn btn-danger']) ?>
        <?php if(!Yii::$app->user->getisGuest()){ ?>


            <?= Html::a('Создать новый <span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>

        <?php } ?>
    </p>

    <div class="row">
        <?php foreach ($posts as $post){ ?>

            <div class="col-sm-6 col-md-4" style="opacity: 0.8">
                <div class="thumbnail">
                    <?php if($post->img){ ?>
                        <img src="<?=$post->img?>" alt="..." style="width: 380px; height: 220px; opacity: 1">
                    <?php } ?>
                    <div class="caption">
                        <h3> <?=$post->title?> </h3>
                        <p> <?=$post->text_prev?> </p>
                        <p> <?= Html::a('<span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span>', ['view', 'id' => $post->id], ['class' => 'btn btn-primary']) ?> </p>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>

</div>
<div style="text-align: center">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>