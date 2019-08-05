<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cust".
 *
 * @property string $id Nomor Pelanggan
 * @property string $fullname Nama Pelanggan
 * @property string $address Alamat
 * @property string $city Kota
 * @property string $province Provinsi
 * @property string $phone Telepon
 * @property string $contact_person Penanggung Jawab
 * @property string $email Email
 * @property string $web_page Website
 * @property string $terms Terms CASH, NET90
 * @property double $owing Owing
 * @property string $currency_code Mata Uang
 * @property int $status 10=available, 30=removed
 *
 * @property Order[] $orders
 */
class Cust extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 30;
    
    public static $terms = [
        'cash' => 'Cash',
        'net90' => 'Net 90'
    ];


    public static function tableName()
    {
        return 'cust';
    }

    public function rules()
    {
        return [
            [['id', 'fullname', 'address', 'city', 'province', 'phone', 'contact_person', 'terms'], 'required'],
            [['owing'], 'number'],
            [['status'], 'integer'],
            [['id'], 'string', 'max' => 7],
            [['fullname'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['city', 'province'], 'string', 'max' => 77],
            [['phone'], 'string', 'max' => 13],
            [['contact_person', 'email'], 'string', 'max' => 70],
            [['web_page'], 'string', 'max' => 150],
            [['terms'], 'string', 'max' => 5],
            [['currency_code'], 'string', 'max' => 3],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Nomor Pelanggan',
            'fullname' => 'Nama Pelanggan',
            'address' => 'Alamat',
            'city' => 'Kota',
            'province' => 'Provinsi',
            'phone' => 'Telepon',
            'contact_person' => 'Penanggung Jawab',
            'email' => 'Email',
            'web_page' => 'Website',
            'terms' => 'Terms',
            'owing' => 'Owing',
            'currency_code' => 'Mata Uang',
            'status' => 'Status',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['cust_id' => 'id']);
    }
}
