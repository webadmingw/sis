<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Tambah Inoive';

$this->params['breadcrumbs'][] = "Sales";
$this->params['breadcrumbs'][] = 'Inoive';
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
                <?php $form = ActiveForm::begin(); ?>
                <div class="row-fluid" style="margin: 15px !important;">
                    <div class="span3">
                        <?= $form->field($model, 'cust_id', ['inputOptions' => ['class' => 'form-control']])->dropDownList($customers) ?>
                    </div>
                    <div class="span4">&nbsp;</div>
                    <div class="span2"><?= $form->field($model, 'inv_no', ['inputOptions' => ['class' => 'form-control'],])->textInput() ?></div>
                    <div class="span2"><?= $form->field($model, 'inv_date', ['inputOptions' => ['type' => 'date', 'class' => 'form-control'],])->textInput() ?></div>
                    <div class="span1"></div>
                </div>
                <div class="row-fluid" style="margin: 15px !important;">
                    <div class="span7">&nbsp;</div>
                    <div class="span2"><?= $form->field($model, 'terms', ['inputOptions' => ['class' => 'form-control span5']])->dropDownList($terms) ?></div>
                    <div class="span2"><?= $form->field($model, 'courier', ['inputOptions' => ['class' => 'form-control'],])->textInput() ?></div>
                    <div class="span1"></div>
                </div>
                
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>