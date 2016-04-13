<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>


<div class="row" style="margin-top: 12%">
    <a  href="/site/posts/" style="text-decoration: none"><div class="col-lg-4" id="posts" >
           <p class="center"><span class="glyphicon glyphicon-th-list"></span> <span style="font-size: 62px"><?=$posts?></span> </p>
    </div></a>

        <a  href="/site/poems/" style="text-decoration: none"> <div class="col-lg-4" id="poems" >
                <p class="center"><span class="glyphicon glyphicon-leaf"></span> <span style="font-size: 62px"><?=$poems?></span></p>
    </div></a>

            <a  href="/site/music/" style="text-decoration: none"><div class="col-lg-4" id="music" >
                   <p class="center"><span class="glyphicon glyphicon-music"></span> <span style="font-size: 62px"><?=$music?></span></p>
    </div></a>
</div>




