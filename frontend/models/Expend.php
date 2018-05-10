<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

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
class Expend extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'expend';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['uid', 'contact', 'type', 'time', 'status', 'created', 'updated'], 'integer'],
            [['size', 'unit', 'sum'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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

    public function getContacts() {
        return ArrayHelper::merge(['' => '选择合作商'], ArrayHelper::map(Contact::find()->where(['type' => 2])->all(), 'id', 'name'));
    }

    public function getTypes() {
        return [
            '' => '选择类型',
            1 => 'a',
            2 => 'b',
            3 => 'c',
            4 => 'd',
        ];
    }

    public function getProjects() {
        return ArrayHelper::merge(['' => '选择项目'], ArrayHelper::map(Project::find()->all(), 'id', 'id'));
    }

    public function getDataProvider() {
        $query = self::find();
        if ($this->contact) {
            $query->andWhere(['contact' => $this->contact]);
        }
        if ($this->type) {
            $query->andWhere(['type' => $this->type]);
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
                'format' => 'raw'
            ],
            [
                'value' => 'timeValue',
                'label' => '日期',
            ],
            [
                'value' => 'projectModel.id',
                'label' => '项目',
                'format' => 'raw'
            ],
            [
                'value' => 'contactModel.name',
                'label' => '合作商',
                'format' => 'raw'
            ],
            [
                'value' => 'typeValue',
                'label' => '类型',
                'format' => 'raw'
            ],
            [
                'value' => 'size',
                'label' => '尺寸',
            ],
            [
                'value' => 'unit',
                'label' => '单价',
            ],
            [
                'value' => 'sum',
                'label' => '合计',
            ],
        ];
    }

    public function getTimeValue() {
        return date('Y-m-d', $this->time);
    }

    public function getTypeValue() {
        $arr = $this->getTypes();
        return isset($arr[$this->type]) ? $arr[$this->type] : '';
    }

    public function getProjectModel() {
        return $this->hasOne(Project::className(), ['id' => 'project']);
    }

    public function getContactModel() {
        return $this->hasOne(Contact::className(), ['id' => 'contact']);
    }

}
