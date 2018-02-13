<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wool_person".
 *
 * @property integer $id
 * @property string $name
 * @property string $mobile
 * @property string $idcard
 * @property string $bank
 */
class WoolPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wool_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mobile', 'idcard', 'bank'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'idcard' => 'Idcard',
            'bank' => 'Bank',
        ];
    }
}
