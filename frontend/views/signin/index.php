<?php
use yii\widgets\ActiveForm;
use common\widgets\Alert;

$this->title = 'Masuk | ' . Yii::$app->name;

?>

<?php $form = ActiveForm::begin(['id' => 'loginform', 'options' => ['class' => 'form-vertical']]); ?>
    <div class="control-group normal_text"> <h3><img src="themes/maruti/img/logo.png" alt="Logo" /></h3></div>
    
    <div class="col-md-12">
        <div class="clearfix">&nbsp;</div>
        <?= Alert::widget() ?>
    </div>
    
    <?= $form->field($model, 'username', [
            'inputOptions' => ['autofocus' => 'autofocus', 'autocomplete' => 'off', 'placeholder' => 'Login Pengguna'],
            'template' => '<div class="control-group"><div class="controls"><div class="main_input_box"><span class="add-on"><i class="icon-user"></i></span>{input}<div class="help-block"></div></div></div></div>'
    ])->textInput()->label(false) ?>
    <?= $form->field($model, 'password', [
            'inputOptions' => ['placeholder' => 'Kata Kunci'],
            'template' => '<div class="control-group"><div class="controls"><div class="main_input_box"><span class="add-on"><i class="icon-lock"></i></span>{input}<div class="help-block"></div></div></div></div>'
    ])->passwordInput()->label(false) ?>
    
    <div class="form-actions">
        <span class="pull-right"><input type="submit" class="btn btn-success" value="Masuk"/></span>
    </div>
<?php ActiveForm::end(); ?>