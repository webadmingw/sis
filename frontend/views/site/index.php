<?php
use yii\helpers\Url;

$this->title = 'Selamat Datang';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="text-capitalize"><?= Yii::$app->name ?> V.1</h1>
<p class="text-muted">
    Selamat datang di Sistem Informasi Penjualan <b>PT. Inti Abadi Sentosa Bandung</b>
</p>

<div class="row-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li> <a href="<?= Url::toRoute(['/catalog/add']) ?>"> <i class="icon-survey"></i> Tambah Produk </a> </li>
            <li> <a href="<?= Url::toRoute(['/cust']) ?>"> <i class="icon-people"></i> Pelanggan </a> </li>
            <li> <a href="<?= Url::toRoute(['/sales/add-inv']) ?>"> <i class="icon-shopping-bag"></i> Buat Invoice</a> </li>
            <li> <a href="<?= Url::toRoute(['/sales/add-do']) ?>"> <i class="icon-shopping-bag"></i> Buat Surat Jalan</a> </li>
        </ul>
   </div>
</div>

<?php
$this->registerJs("

", yii\web\View::POS_READY);