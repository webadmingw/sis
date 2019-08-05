<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class ChangePassword extends Model
{
    public $eKey;
    public $nKey;
    public $cKey;

    private $_user;

    public function rules()
    {
        return [
            [['eKey', 'nKey', 'cKey'], 'required'],
            ['cKey', 'compare', 'compareAttribute' => 'nKey', 'message' => 'Konfirmasi harus sama dengan Kata Kunci Baru.'],
            ['eKey', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'eKey' => 'Kata Kunci Lama',
            'nKey' => 'Kata Kunci Baru',
            'cKey' => 'Konfirmasi',
        ];
    }
    
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->eKey)) {
                $this->addError($attribute, "Kata Kunci tidak sesuai.");
            }
        }
    }
    
    public function change()
    {
        if ($this->validate()) {
            $this->_user->setPassword($this->nKey);
            return $this->_user->save() ? true : false;
        } else {
            return false;
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity(Yii::$app->user->id);
        }

        return $this->_user;
    }
}
