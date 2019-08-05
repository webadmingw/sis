<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id ID
 * @property string $name Kategori
 * @property int $status 10=available, 30=removed
 *
 * @property Catalog[] $catalogs
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 30;
    
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 35],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Kategori',
            'status' => '10=available, 30=removed',
        ];
    }

    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['category_id' => 'id']);
    }
}
