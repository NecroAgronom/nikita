<?php

use yii\helpers\Html;
use yii\grid\GridView;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Музыка';
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

            <div class="col-sm-6 col-md-6" style="opacity: 0.8" >
                <div class="thumbnail">
                    <?php if($post->img){ ?>
                    <img src="<?=$post->img?>" alt="..." style="width: 380px; height: 220px; opacity: 1">
                    <?php } ?>
                    <div class="caption">
                        <p><h3> <?=$post->title?> </h3></p>
                        <p> <?=$post->text_prev?> </p>
                        <?php if($post->aud){ ?>

                            <object type="application/x-shockwave-flash"
                                    style="margin-bottom: 10px"
                                    data="/static/audios/ump3player_500x70.swf"
                                    height="70"
                                    width="470">
                                <param
                                    name="wmode"
                                    value="transparent" />
                                <param name="allowFullScreen" value="true" />

                                <param name="allowScriptAccess"
                                       value="always" />

                                <param name="movie"
                                       value="/static/audios/ump3player_500x70.swf" />
                                <param name="FlashVars"
                                       value="way=<?=$post->aud?>&amp;swf=/static/audios/ump3player_500x70.swf&amp;w=270&amp;h=70&amp;time_seconds=164&amp;autoplay=0&amp;q=&amp;skin=sky&amp;volume=60&amp;comment=" />
                            </object>
                        <?php } ?>
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
