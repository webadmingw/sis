<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = ($act === 'i' ? 'Tambah Stok' : 'Kurangi Stok');

$this->params['breadcrumbs'][] = "Produk";
$this->params['breadcrumbs'][] = $prod->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-user"></i></span> 
                <h5><?= $this->title ?></h5>
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
                <?= $form->field($model, 'qty', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'note', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>