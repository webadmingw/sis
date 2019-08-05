<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Tambah Pengguna';

$this->params['breadcrumbs'][] = "Pengguna & Pelanggan";
$this->params['breadcrumbs'][] = Html::a('Pengguna');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-user"></i></span> 
                <h5>Profil</h5>
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
                    
                    $roleOptions = (Yii::$app->user->identity->role == $model->role ?['disabled' => 'disabled'] : []);
                ?>
                <?= $form->field($model, 'username', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'fullname', ['inputOptions' => ['class' => 'form-control span5'],])->textInput() ?>
                <?= $form->field($model, 'role', ['inputOptions' => yii\helpers\ArrayHelper::merge(['class' => 'form-control span5'], $roleOptions)])->dropDownList(Yii::$app->params['user.type']) ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>