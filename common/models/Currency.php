<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property string $code Kode
 * @property string $name Mata Uang
 * @property int $status 10=available, 30=removed
 */
class Currency extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 30;
    
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 25],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Kode',
            'name' => 'Mata Uang',
            'status' => '10=available, 30=removed',
        ];
    }
}
