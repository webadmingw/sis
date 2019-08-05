<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\User;

/**
 * Password reset request form
 */
class PasswordChangeForm extends Model
{
     public $password;
     public $confirm;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'confirm'], 'required'],
            [['password', 'confirm'], 'string', 'min' => 6],
            ['confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Password tidak sama." ],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'password' => 'Password Baru',
            'confirm' => 'Konfirmasi Ulang'
        ];
    }

    public function change(){
        $user = User::findOne(Yii::$app->user->id);
        $user->setPassword($this->password);
        
        return $user->save(false);
    }
    
}
