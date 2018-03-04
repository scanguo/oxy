<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Project;

/**
 * Site controller
 */
class ProjectController extends Controller {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model = new Project();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate() {
        $model = new Project();
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
        $model = new Project();
        $model->attributes = $_POST;
        $data['html'] = $this->renderAjax('table', ['model' => $model]);
        return json_encode($data);
    }

    public function actionSet() {
        $model = Project::findOne($_POST['key']);
        if ($_POST['ac'] == '-1') {
            $model->cash = $_POST['val'];
            $model->updated = time();
            $model->save();
            return json_encode($model->cashValue);
        } else {
            $model->status = $_POST['ac'] ? : $model->status;
            if ($model->status != $model::STATUS_LOST) {
                $model->back += $_POST['val'];
            }
            $model->updated = time();
            $model->save();
            return json_encode($model->statusValue);
        }
    }

}
