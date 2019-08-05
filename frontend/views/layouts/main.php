<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;

use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
		
<!--Header-part-->
<div id="header">
    <h1><?= Html::a(Yii::$app->name, ['/']) ?></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse"><ul class="nav">
    <li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-cog"></i> <span class="text">Settings</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><?= Html::a('<i class="icon icon-user"></i> <span class="text">Profil</span>', ['/users/profile']) ?></li>
            <li><?= Html::a('<i class="icon icon-lock"></i> <span class="text">Ganti Kata Kunci</span>', ['/users/change-password']) ?></li>
        </ul>
    </li>
    <li class="">
        <?= Html::a('<i class="icon icon-share-alt"></i> <span class="text">Logout</span>', ['/site/logout'], ['data' => ['method' => 'post']]) ?>
    </li>
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
    <ul>
    <li><a href="<?= Url::toRoute(['/']) ?>"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-bookmark"></i> <span>Produk <i class="icon icon-chevron-down"></i></span></a>
        <ul>
            <li><a href="<?= Url::toRoute(['/catalog']) ?>">Daftar</a></li>
            <li><a href="<?= Url::toRoute(['/catalog/add']) ?>">Tambah</a></li>
            <li><a href="<?= Url::toRoute(['/catalog/history']) ?>">History</a></li>
        </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-shopping-cart"></i> <span>Sales <i class="icon icon-chevron-down"></i></span></a>
        <ul>
            <li><a href="<?= Url::toRoute(['/sales']) ?>">Invoice</a></li>
            <li><a href="<?= Url::toRoute(['/sales/do']) ?>">Surat Jalan</a></li>
        </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-book"></i> <span>Laporan <i class="icon icon-chevron-down"></i></span></a>
        <ul>
            <li><a href="<?= Url::toRoute(['/report/']) ?>">Penjualan Per Pelanggan</a></li>
            <li><a href="<?= Url::toRoute(['/report/sales-by-product']) ?>">Penjualan Per Produk</a></li>
        </ul>
    </li>
    <?php if(Yii::$app->user->identity->isAdmin()): ?>
    <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Pengguna &amp; Pelanggan <i class="icon icon-chevron-down"></i></span></a>
        <ul>
            <li><a href="<?= Url::toRoute(['/users/']) ?>">Pengguna</a></li>
            <li><a href="<?= Url::toRoute(['/cust/']) ?>">Pelanggan</a></li>
        </ul>
    </li>
    <?php endif; ?>
  </ul>
		
</div>
		
		
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a><i class="icon-home"></i> Beranda</a>
            <?php if(isset($this->params['breadcrumbs'])): ?>
                <?php 
                    $total = count($this->params['breadcrumbs']);
                    $i=1;
                ?>
                <?php foreach($this->params['breadcrumbs'] as $item): ?>
                    <?= '<a class="'.($i==$total ? 'current' : '').'">'.$item.'</a>' ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!--<h1><?= Yii::$app->name ?></h1>-->
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>
</div>
<div class="row-fluid">
    <div id="footer" class="span12"> 2018 &copy; Sales Information Sistem - Admin</a> </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
