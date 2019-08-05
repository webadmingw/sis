<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<div class="inner-block" style="padding: 0em 2em 4em 2em;">
    <div class="error-404">  	
    	<div class="error-page-left">
            <!--<img src="<?= Yii::getAlias('@styles_img') . "/404.png" ?>" alt="">-->
    	</div>
    	<div class="error-right">
	    	<h2>Oops! Halaman tidak terbuka</h2>
	    	<h4><?= nl2br(Html::encode($message)) ?></h4>
                <a href="<?= Url::to(Url::previous(), true) ?>">Kembali</a>
    	</div>
    </div>
</div>