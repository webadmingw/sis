<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id ID
 * @property string $username Login Pengguna
 * @property string $fullname Nama Lengkap
 * @property string $password_hash Kata Kunci
 * @property string $password_reset_token Token
 * @property int $status 10=available, 30=removed
 * @property int $role 0=Admin, 10=Sales
 * @property int $created_at Tgl. Buat
 * @property int $updated_at Perubahan Terakhir
 *
 * @property Order[] $orders
 */

class User extends ActiveRecord implements IdentityInterface
{
    
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 30;
    
    const ROLE_ADMIN = 0;
    const ROLE_SALES = 10;
    
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'fullname', 'created_at', 'updated_at'], 'required'],
            [['status', 'role', 'created_at', 'updated_at'], 'integer'],
            [['username', 'fullname'], 'string', 'max' => 70],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login Pengguna',
            'fullname' => 'Nama Lengkap',
            'password_hash' => 'Kata Kunci',
            'password_reset_token' => 'Token',
            'status' => 'Status',
            'role' => 'Peran',
            'created_at' => 'Tgl. Buat',
            'updated_at' => 'Perubahan Terakhir',
        ];
    }
    
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function isAdmin(){
        return $this->role == self::ROLE_ADMIN;
    }
    
    public function isSales(){
        return $this->role == self::ROLE_SALES;
    }
    
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['sales_id' => 'id']);
    }
}
