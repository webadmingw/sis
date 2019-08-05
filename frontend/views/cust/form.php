<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Tambah Pengguna';

$this->params['breadcrumbs'][] = "Pengguna & Pelanggan";
$this->params['breadcrumbs'][] = 'Pelanggan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-user"></i></span> 
                <h5>Pelanggan</h5>
            </div>
            <div class="widget-content nopadding">
                <?php \Yii::$app->session->getAllFlashes(); ?>
                <?php 
                    $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => '<div class="control-group">{label}<div class="controls">{input}{error}</div></div>',
                            'horizontalCssClasses' => ['label' => '', 'offset' => '', 'wrapper' => '', 'error' => '', 'hint' => '']
                        ],
                    ]); 
                ?>
                <?= $form->field($model, 'id', ['inputOptions' => ['type' => 'number', 'class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'fullname', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'address', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'city', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'province', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'phone', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'contact_person', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'email', ['inputOptions' => ['type' => 'email', 'class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'web_page', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'terms', ['inputOptions' => ['class' => 'form-control span5']])->dropDownList($terms) ?>
                <?= $form->field($model, 'owing', ['inputOptions' => ['type' => 'number', 'class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'currency_code', ['inputOptions' => ['class' => 'form-control span5']])->dropDownList($cur) ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>