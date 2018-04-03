<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

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
class Task extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['uid', 'project', 'io', 'type', 'contact', 'time', 'status', 'created', 'updated'], 'integer'],
            [['sum'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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

    public function getContacts() {
        return ArrayHelper::merge(['' => '选择合作商'], ArrayHelper::map(Contact::find()->where(['type' => 2])->all(), 'id', 'name'));
    }

    public function getDataProvider() {
        $query = self::find();
        if ($this->contact) {
            $query->andWhere(['contact' => $this->contact]);
        }
        $query->orderBy('created DESC');
        return new ArrayDataProvider([
            'allModels' => $query->all(),
            'pagination' => false
        ]);
    }

    public function getColumns() {
        return [
            [
                'value' => 'id',
                'label' => 'ID',
            ],
            [
                'value' => 'timeValue',
                'label' => '日期',
            ],
            [
                'value' => 'contactModel.name',
                'label' => '合作商',
                'format' => 'raw'
            ],
        ];
    }

    public function getTimeValue() {
        return date('Y-m-d', $this->time);
    }

    public function getContactModel() {
        return $this->hasOne(Contact::className(), ['id' => 'contact']);
    }

}
