<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "wool_count".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $aid
 * @property double $in
 * @property double $cash
 * @property double $back
 * @property string $date
 * @property string $status
 * @property integer $created
 * @property integer $updated
 */
class WoolCount extends \yii\db\ActiveRecord {

    CONST STATUS_NORMAL = 0;
    CONST STATUS_BACK = 1;
    CONST STATUS_LOST = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wool_count';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pid', 'aid', 'in'], 'required'],
            [['cash', 'back', 'date', 'status', 'created', 'updated'], 'safe'],
        ];
    }

    public function getProfit() {
        $cash = WoolCount::find()->select(['cash' => 'sum(cash)'])->where(['>', 'cash', 0])->asArray()->one()['cash'];
        $return = WoolCount::find()->select(['return' => 'sum(back-`in`)'])->where(['status' => self::STATUS_BACK])->asArray()->one()['return'];
        return $cash + $return;
    }

    public function getPrincipal() {
        $principal = WoolCount::find()->select(['in' => 'sum(`in`)'])->where(['status' => self::STATUS_NORMAL])->asArray()->one()['in'];
        return $principal;
    }

    public function getLost() {
        $lost = WoolCount::find()->select(['lost' => 'sum(`in`-back)'])->where(['status' => self::STATUS_LOST])->asArray()->one()['lost'];
        return $lost;
    }

    public function getPids() {
        return ArrayHelper::merge(['' => '选择账户'], ArrayHelper::map(WoolPerson::find()->all(), 'id', 'name'));
    }

    public function getAids() {
        return ArrayHelper::merge(['' => '选择平台'], ArrayHelper::map(WoolApp::find()->all(), 'id', 'name'));
    }

    public function getDataProvider() {
        $query = self::find();
        if ($this->pid) {
            $query->andWhere(['pid' => $this->pid]);
        }
        if ($this->aid) {
            $query->andWhere(['aid' => $this->aid]);
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
                'value' => 'date',
                'label' => '日期',
            ],
            [
                'value' => 'person.name',
                'label' => '账户',
            ],
            [
                'value' => 'app.name',
                'label' => '平台',
            ],
            [
                'value' => 'in',
                'label' => '本金',
            ],
            [
                'value' => 'backValue',
                'label' => '已收',
                'format' => 'raw'
            ],
            [
                'value' => 'cashValue',
                'label' => '返现',
                'format' => 'raw'
            ],
            [
                'value' => 'statusValue',
                'label' => '状态',
                'format' => 'raw'
            ],
        ];
    }

    public function getBackValue() {
        return '<span>' . $this->back . '</span>';
    }

    public function getCashValue() {
        if ($this->cash < 0) {
            return '<input> <a href="" class="set-data" key="' . $this->id . '" ac="-1">返</a>';
        } else {
            return $this->cash;
        }
    }

    public function getStatusValue() {
        $status = [
            self::STATUS_NORMAL => '<input> <a href="" class="set-data" key="' . $this->id . '" ac="0">回</a> | <a href="" class="set-data" key="' . $this->id . '" ac="1">结</a> | <a href="" class="set-data" key="' . $this->id . '" ac="2">雷</a>',
            self::STATUS_BACK => ($this->back + $this->cash - $this->in) . ' <i class="glyphicon glyphicon-thumbs-up"></i>',
            self::STATUS_LOST => ($this->in - $this->back - $this->cash) . ' <i class="glyphicon glyphicon-certificate"></i>'
        ];
        return $status[$this->status];
    }

    public function getPerson() {
        return $this->hasOne(WoolPerson::className(), ['id' => 'pid']);
    }

    public function getApp() {
        return $this->hasOne(WoolApp::className(), ['id' => 'aid']);
    }

}
