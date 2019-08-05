<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Detail : ' . $model->detail->fullname;
?>

<div class="col-md-12 mailbox-content  tab-content tab-content-in">
    <div class="tab-pane active text-style" id="tab1">
        <div class="mailbox-border">
            <div class="mail-toolbar clearfix">
                <div class="float-left">
                    <a href="<?= Url::toRoute(['index']) ?>" class="btn btn-default mrg5R"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="float-right">
                    <a href="<?= Url::toRoute(['add']) ?>" class="btn btn-default mrg5R pull-right"><i class="fa fa-plus"></i></a>
                    <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-default mrg5R pull-right']) ?>
                    <?php if($model->id != Yii::$app->user->id): ?>
                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-default mrg5R pull-right',
                        'title' => 'Hapus',
                        'data-toggle' => 'modal',
                        'data-keyboard' => 'false',
                        'data-target' => '#mdl-confirm',
                        'data-fullname' => $model->detail->fullname,
                        'data-url' => Url::toRoute(['delete', 'id'=>$model->id])
                    ]) ?>
                    <?php endif; ?>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'detail.fullname',
                    'email:email',
                    'detail.phone',
                    [
                        'attribute' => 'role_id',
                        'value' => function($model){
                            return Yii::$app->params['user.type'][$model->role_id];
                        }
                    ],
                    'detail.lProvince.name:raw:Provinsi',
                    'detail.lCity.name:raw:Kota/Kab',
                    'detail.lDistrict.name:raw:Kecamatan',
                    'detail.address:raw:Alamat Lengkap',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>   
    </div>
</div>

<?php
$this->registerJs("
$('#mdl-confirm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var url = button.data('url');
    var fullname = button.data('fullname');

    var modal = $(this);
    modal.find('.modal-title').html('Konfirmasi - Hapus');
    modal.find('.modal-body').html('Kamu yakin akan menghapus pengguna `' + fullname + '`?');
    modal.find('.modal-footer button.btn-warning').click(function(){
        modal.modal('hide');
        $.post(url, {}, function(r){
            $('#mdl-alert').on('show.bs.modal', function(e){
                $('#mdl-alert-content').html('');
                $('#mdl-alert-content').append('<i class=\"fa fa-check-circle\"></i> <p>Data Berhasil dihapus.</p>');
            }).on('hidden.bs.modal', function (e) {
                window.location.href = '".Url::toRoute(['index'])."';
            }).modal({'keyboard':false});
        });
    });
});

", \yii\web\View::POS_READY);