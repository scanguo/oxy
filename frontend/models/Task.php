<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $project
 * @property integer $io
 * @property integer $type
 * @property integer $contact
 * @property double $sum
 * @property integer $time
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'project', 'io', 'type', 'contact', 'time', 'status', 'created', 'updated'], 'integer'],
            [['sum'], 'number'],
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
            'project' => 'Project',
            'io' => 'Io',
            'type' => 'Type',
            'contact' => 'Contact',
            'sum' => 'Sum',
            'time' => 'Time',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
