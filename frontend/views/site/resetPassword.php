<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Ganti Password | Narinos - Sistem Penjualan';

?>

<div class="login-page">
    <div class="login-main">  	
        <div class="login-head"><h1>Narinos - Ganti Password</h1></div>
        <div class="login-block">
        <?php $form = ActiveForm::begin(['id' => 'form-change-password', 'options' => ['class' => 'ui form']]); ?>
            <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'lock', 'placeholder' => 'Password Baru']])->passwordInput(['autofocus' => true])->label(false) ?>
            <div class="forgot-top-grids">
                <div class="forgot">
                    <a href="<?= Url::toRoute(['/sign-in']); ?>">Halaman Login</a>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="form-group compose-right">
                <input type="submit" name="simpan" value="Simpan">	
            </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>