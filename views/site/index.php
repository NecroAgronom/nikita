<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>


<div class="row" style="margin-top: 8%">
    <a  href="/site/posts/" style="text-decoration: none"><div class="col-lg-4" id="posts" >
           <p class="center"> <?=$posts?><span class="glyphicon glyphicon-chevron-right"> </p>
    </div></a>

        <a  href="/site/poems/" style="text-decoration: none"> <div class="col-lg-4" id="poems" >
                <p class="center">  <?=$poems?><span class="glyphicon glyphicon-chevron-right"></p>
    </div></a>

            <a  href="/site/music/" style="text-decoration: none"><div class="col-lg-4" id="music" >
                   <p class="center"> <?=$music?><span class="glyphicon glyphicon-chevron-right"></p>
    </div></a>
</div>



