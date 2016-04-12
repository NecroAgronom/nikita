<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
    VK.init({apiId: API_ID, onlyWidgets: true});
</script>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if($model->category_id == 1){ ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/posts/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
        <?php if($model->category_id == 2){ ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/poems/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
        <?php if($model->category_id == 3){ ?>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> Назад', ['/site/music/'], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
    <?php if(!Yii::$app->user->getisGuest()){ ?>





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
    <div class="panel panel-default" >
        <div class="panel-heading"><span style="font-weight: 700"><?= $model->title ?></span></div>
        <div class="panel-body">
            <?php if($model->img){ ?>
            <img src="<?=$model->img?>"/>
            <?php } ?><br>
            <?php if($model->aud){ ?>

            <object type="application/x-shockwave-flash"
                    style="margin-bottom: 10px; "
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
                       value="way=<?=$model->aud?>&amp;swf=/static/audios/ump3player_500x70.swf&amp;w=470&amp;h=70&amp;time_seconds=164&amp;autoplay=0&amp;q=&amp;skin=sky&amp;volume=60&amp;comment=" />
            </object><br>


                <a href="/site/download?id=<?=$model->id?>" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span></a>


            <?php } ?>


            <?= Html::decode($model->text); ?>
        </div>
        <div id="vk_comments"></div>
        <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 15, width: "665", attach: "*"});
        </script>
    </div>

</div>


