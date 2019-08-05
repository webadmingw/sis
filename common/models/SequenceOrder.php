<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sequence_order".
 *
 * @property int $no sequence
 */
class SequenceOrder extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'sequence_order';
    }

    public function rules()
    {
        return [];
    }

    public function attributeLabels()
    {
        return [
            'no' => 'sequence',
        ];
    }
    
}
