<?php

use yii\helpers\Html;
use yii\grid\GridView;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php if(!Yii::$app->user->getisGuest()){ ?>
        <p>
            <?= Html::a('New Post', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>

    <div class="row">
        <?php foreach ($posts as $post){ ?>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?=$post->img?>" alt="..." style="width: 380px; height: 220px">
                    <div class="caption">
                        <h3> <?=$post->title?> </h3>
                        <p> <?=$post->text_prev?> </p>
                        <p> <?= Html::a('Button', ['view', 'id' => $post->id], ['class' => 'btn btn-primary']) ?> </p>
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