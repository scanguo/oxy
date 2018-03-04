<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "expend".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $contact
 * @property integer $type
 * @property double $size
 * @property double $unit
 * @property double $sum
 * @property integer $time
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class Expend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'contact', 'type', 'time', 'status', 'created', 'updated'], 'integer'],
            [['size', 'unit', 'sum'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'contact' => 'Contact',
            'type' => 'Type',
            'size' => 'Size',
            'unit' => 'Unit',
            'sum' => 'Sum',
            'time' => 'Time',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
