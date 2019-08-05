<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id ID
 * @property int $order_id Order
 * @property string $catalog_id Produk
 * @property double $fix_price Harga Unit
 * @property int $qty Jumlah
 * @property double $disc Diskon
 * @property double $tax Pajak
 * @property string $note Memo
 * @property string $type i=in, o=out
 * @property string $created_date Tgl. Buat
 *
 * @property Catalog $catalog
 * @property Order $order
 */
class OrderItems extends \yii\db\ActiveRecord
{
    const TYPE_IN = 'i';
    const TYPE_OUT = 'o';
    const TYPE_DEL = 'd';
    const TYPE_RET = 'r';
    
    const TYPES = [
        self::TYPE_IN => 'Masuk',
        self::TYPE_OUT => 'Keluar',
        self::TYPE_DEL => 'Kurang'
    ];


    public static function tableName()
    {
        return 'order_items';
    }

    public function rules()
    {
        return [
            [['order_id', 'qty'], 'integer'],
            [['catalog_id'], 'required'],
            [['fix_price', 'disc', 'tax'], 'number'],
            [['created_date'], 'safe'],
            [['catalog_id'], 'string', 'max' => 7],
            [['note'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 1],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order',
            'catalog_id' => 'Produk',
            'fix_price' => 'Harga Unit',
            'qty' => 'Jumlah',
            'disc' => 'Diskon',
            'tax' => 'Pajak',
            'note' => 'Memo',
            'type' => 'i=in, o=out',
            'created_date' => 'Tgl. Buat',
        ];
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
