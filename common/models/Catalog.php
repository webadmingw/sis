<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property string $id OD
 * @property string $name Nama
 * @property string $type Tipe Inventory Part, Non Inventory Part, Service
 * @property string $desc Ket
 * @property double $cost Harga Modal
 * @property double $min_price Harga Minimum
 * @property string $unit Satuan
 * @property string $merk Merk
 * @property string $loc_code Kode Lokasi
 * @property int $status 10=available, 30=removed
 * @property int $category_id Kategori
 *
 * @property Category $category
 * @property OrderItems[] $orderItems
 */
class Catalog extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 30;
    
    public $qty;


    public static $type = [
        'non' => 'Non Inventory',
        'inv' => 'Inventory',
        'service' => 'Service'
    ];
    
    public static function tableName()
    {
        return 'catalog';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'merk', 'category_id'], 'required'],
            [['cost', 'min_price', 'qty'], 'number'],
            [['status', 'category_id'], 'integer'],
            [['id'], 'string', 'max' => 7],
            [['name', 'type'], 'string', 'max' => 55],
            [['desc'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 10],
            [['merk'], 'string', 'max' => 70],
            [['loc_code'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'type' => 'Tipe',
            'qty' => 'Qty',
//            'type' => 'Tipe Inventory Part, Non Inventory Part, Service',
            'desc' => 'Desc',
            'cost' => 'Harga Modal',
            'min_price' => 'Harga Minimum',
            'unit' => 'Satuan',
            'merk' => 'Merk',
            'loc_code' => 'Kode Lokasi',
            'status' => 'Status',
            'category_id' => 'Kategori',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['catalog_id' => 'id']);
    }
    
    public function getStock(){
        return $this->hasMany(OrderItems::className(), ['catalog_id' => 'id'])->sum('qty');
    }
    
}
