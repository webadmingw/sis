<?php
use yii\bootstrap\ActiveForm;

$this->title = "Ganti Kata Kunci";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-lock"></i></span> 
                <h5><?= $this->title ?></h5>
            </div>
            <div class="widget-content nopadding">
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => '<div class="control-group">{label}<div class="controls">{input}{error}</div></div>',
                        'horizontalCssClasses' => ['label' => '', 'offset' => '', 'wrapper' => '', 'error' => '', 'hint' => '']
                    ],
                ]); ?>
                <?= $form->field($model, 'eKey', ['inputOptions' => ['class' => 'form-control span5'],])->passwordInput() ?>
                <?= $form->field($model, 'nKey', ['inputOptions' => ['class' => 'form-control span5'],])->passwordInput() ?>
                <?= $form->field($model, 'cKey', ['inputOptions' => ['class' => 'form-control span5'],])->passwordInput() ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Ubah</button>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>