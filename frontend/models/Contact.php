<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $type
 * @property string $name
 * @property string $phone
 * @property string $remark
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'status', 'created', 'updated'], 'integer'],
            [['name', 'phone', 'remark'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'name' => 'Name',
            'phone' => 'Phone',
            'remark' => 'Remark',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getTypes() {
        return [
            '' => '选择类型',
            1 => '新人',
            2 => '合作伙伴',
        ];
    }
    
    public function getTypeValue() {
        $typeArr = $this->getTypes();
        return isset($typeArr[$this->type]) ? $typeArr[$this->type] : '';
    }

    public function getDataProvider() {
        $query = self::find();
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
                'value' => 'name',
                'label' => '新人',
                'format' => 'raw'
            ],
            [
                'value' => 'typeValue',
                'label' => '类型',
            ],
            [
                'value' => 'phone',
                'label' => '电话',
            ],
            [
                'value' => 'remark',
                'label' => '备注',
            ],
        ];
    }
}
