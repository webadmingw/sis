<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Produk';

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
                <?= $form->field($searchModel, 'id', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<Nomor Item>'],])->textInput()->label(false) ?>
                <?= $form->field($searchModel, 'desc', ['inputOptions' => ['class' => 'form-control span11', 'placeholder' => '<Deskripsi item>'],])->textInput()->label(false) ?>
                <?= ""#$form->field($searchModel, 'status')->radioList([$searchModel::STATUS_ACTIVE => 'Aktif', $searchModel::STATUS_DELETED => 'Suspend'], [])->label(false) ?>
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
                <h5>Daftar Pengguna</h5>
                <a href="<?= Url::toRoute(['/catalog/add']) ?>" title="tambah" class="pull-right"><span class="icon"><i class="icon-plus"></i></span></a>
                <a href="<?= Url::toRoute(['/catalog']) ?>" title="Segarkan" class="pull-right"><span class="icon"><i class="icon-refresh"></i></span></a>
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
                        'id',
                        'name',
                        'desc',
                        'unit',
                        [
                            'header' => 'Qty',
                            'value' => function($model){
                                return ($model->stock ? $model->stock : 0);
                            }
                        ],
                        [
                            'attribute' => 'type',
                            'value' => function($model)use($type){
                                return $type[$model->type];
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'text-align:center;'],
                            'template' => '{history} | {addstock} {decstock} {delete} | {update}',
                            'buttons' => [
                                'history' => function($url, $model, $key) {
                                    return Html::a('History', Url::toRoute(['catalog/history', 'name'=>$model->name]));
                                },
                                'addstock' => function($url, $model, $key) {
                                    return Html::a('Tambah Stok', Url::toRoute(['catalog/update-qty', 'id'=>$model->id, 'act'=>'i'])) . ' | ';
                                },
                                'decstock' => function($url, $model, $key) {
                                    return ((int)$model->stock > 0 ? Html::a('Kurangi Stok', Url::toRoute(['catalog/update-qty', 'id'=>$model->id, 'act'=>'d'])) . ' | ' : '');
                                }
                            ]
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
