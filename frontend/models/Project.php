<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $contact
 * @property double $cost
 * @property double $income
 * @property double $profit
 * @property integer $time
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'contact', 'time', 'status', 'created', 'updated'], 'integer'],
            [['cost', 'income', 'profit'], 'number'],
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
            'cost' => 'Cost',
            'income' => 'Income',
            'profit' => 'Profit',
            'time' => 'Time',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getContacts() {
        return ArrayHelper::merge(['' => '选择新人'], ArrayHelper::map(Contact::find()->where(['type' => 1])->all(), 'id', 'name'));
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
                'value' => 'idValue',
                'label' => 'ID',
                'format' => 'raw'
            ],
            [
                'value' => 'timeValue',
                'label' => '日期',
            ],
            [
                'value' => 'contactModel.name',
                'label' => '新人',
                'format' => 'raw'
            ],
            [
                'value' => 'cost',
                'label' => '支出',
            ],
            [
                'value' => 'income',
                'label' => '收入',
            ],
            [
                'value' => 'profit',
                'label' => '利润',
            ],
        ];
    }

    public function getIdValue() {
        return \yii\bootstrap\Html::a($this->id, '/task/index', ['product_id' => $this->id]);
    }

    public function getTimeValue() {
        return date('Y-m-d', $this->time);
    }

    public function getContactModel() {
        return $this->hasOne(Contact::className(), ['id' => 'contact']);
    }
}
