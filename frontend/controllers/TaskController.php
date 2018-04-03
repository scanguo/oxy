<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Task;

/**
 * Site controller
 */
class TaskController extends Controller {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model = new Task();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate() {
        $model = new Task();
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
        $model = new Task();
        $model->attributes = $_POST;
        $data['html'] = $this->renderAjax('table', ['model' => $model]);
        return json_encode($data);
    }

}
