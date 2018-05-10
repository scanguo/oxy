<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Expend;

/**
 * Site controller
 */
class ExpendController extends Controller {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model = new Expend();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate() {
        $model = new Expend();
        $model->attributes = $_POST;
        if ($model->validate()) {
            $model->time = $model->time ? strtotime($model->time) : time();
            $model->created = time();
            $model->updated = time();
            $model->save();
        }
    }

    public function actionLoad() {
        $data = [];
        $model = new Expend();
        $model->attributes = $_POST;
        $data['html'] = $this->renderAjax('table', ['model' => $model]);
        return json_encode($data);
    }

}
