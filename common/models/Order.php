<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id ID
 * @property string $po_no No PO
 * @property int $delivery_no No Delivery
 * @property string $delivery_date Tgl. Kirim
 * @property string $inv_no No Tagihan
 * @property string $inv_date Tgl. Tagihan
 * @property string $cust_id Pelanggan
 * @property int $sales_id Sales
 * @property string $terms Terms CASH, NET90
 * @property string $courier Ship Via
 * @property double $discount Diskon
 * @property double $freight Ongkir
 * @property string $memo Memo
 * @property int $created_by Oleh
 * @property int $status 0=open,90=paid
 *
 * @property Cust $cust
 * @property User $createdBy
 * @property OrderItems[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_OPEN = 0;
    const STATUS_PAID = 90;
    
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['delivery_no', 'sales_id', 'created_by', 'status'], 'integer'],
            [['delivery_date', 'inv_date'], 'safe'],
            [['cust_id', 'terms', 'courier', 'created_by'], 'required'],
            [['discount', 'freight'], 'number'],
            [['po_no', 'inv_no'], 'string', 'max' => 10],
            [['cust_id'], 'string', 'max' => 7],
            [['terms'], 'string', 'max' => 5],
            [['courier'], 'string', 'max' => 30],
            [['memo'], 'string', 'max' => 255],
            [['cust_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cust::className(), 'targetAttribute' => ['cust_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_no' => 'No PO',
            'delivery_no' => 'No Delivery',
            'delivery_date' => 'Tgl. Kirim',
            'inv_no' => 'No Tagihan',
            'inv_date' => 'Tgl. Tagihan',
            'cust_id' => 'Pelanggan',
            'sales_id' => 'Sales',
            'terms' => 'Terms',
            'courier' => 'Ship Via',
            'discount' => 'Diskon',
            'freight' => 'Ongkir',
            'memo' => 'Memo',
            'created_by' => 'Oleh',
            'status' => '0=open,90=paid',
        ];
    }

    public function getCust()
    {
        return $this->hasOne(Cust::className(), ['id' => 'cust_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getSales()
    {
        return $this->hasOne(User::className(), ['id' => 'sales_id']);
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }
    
    public function getTotal()
    {
        return -($this->hasMany(OrderItems::className(), ['order_id' => 'id'])->where(['type' => OrderItems::TYPE_OUT])->sum('qty'));
    }
    
    public function getAmount()
    {
        return -($this->hasMany(OrderItems::className(), ['order_id' => 'id'])->where(['type' => OrderItems::TYPE_OUT])->sum('fix_price'));
    }
    
}
