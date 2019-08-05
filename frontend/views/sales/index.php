<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Invoice';

$this->params['breadcrumbs'][] = "Sales";
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row-fluid">
    <div class="span2">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-filter"></i></span> 
                <h5>Filter</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="clearfix">&nbsp;</div>
                <?php $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => Url::toRoute(['index']),
                    'fieldConfig' => [
                        'template' => '<div class="control-group" style="padding-left:15px;">{label}<div class="controls">{input}{error}</div></div>',
                    ],
                ]); ?>
                <?= $form->field($searchModel, 'inv_no', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<No Invoice>'],])->textInput()->label(false) ?>
                <?= $form->field($searchModel, 'cust_id', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<ID Pelanggan>'],])->textInput()->label(false) ?>
                <?= $form->field($searchModel, 'start_date', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<Tanggal Mulai>', 'type' => 'date'],])->textInput()->label(false) ?>
                <?= $form->field($searchModel, 'end_date', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<Tanggal Akhir>', 'type' => 'date'],])->textInput()->label(false) ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
    <div class="span10">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-user"></i></span> 
                <h5>Daftar Invoice</h5>
                <a href="<?= Url::toRoute(['add']) ?>" title="tambah" class="pull-right"><span class="icon"><i class="icon-plus"></i></span></a>
                <a href="<?= Url::toRoute(['index']) ?>" title="Segarkan" class="pull-right"><span class="icon"><i class="icon-refresh"></i></span></a>
                <a class="pull-right"><span class="icon">&nbsp;</span></a>
            </div>
            <div class="widget-content nopadding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">{pager}</div>',
                    'pager' => [
                        'class' => '\common\components\CustomPagination',
                        'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                        'linkContainerOptions' => ['class' => 'btn btn-default'],
                        'linkOptions' => ['class' => 'btn btn-default'],
                        'options' => ['class' => 'btn-group pull-right'],
                    ],

                    'tableOptions' => [
                        'class' => 'table table-bordered table-striped'
                    ],
                    'columns' => [
                        'inv_no',
                        'inv_date:date',
                        [
                            'header' => 'Usia',
                            'value' => function($model){
                                $now = time();
                                $your_date = strtotime($model->inv_date);
                                $datediff = $now - $your_date;

                                return round($datediff / (60 * 60 * 24));
                            }
                        ],
                        'cust.id',
                        'cust.fullname',
                        'cust.owing',
                        [
                            'header' => 'Amount',
                            'value' => function($model){
                                return $model->amount;
                            }
                        ],
                        'memo',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'text-align:center;'],
                            'template' => '{delete} {update}',
                        ],
                    ],
                ]); ?>  
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
', yii\web\View::POS_READY);
