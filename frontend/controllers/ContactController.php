<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Contact;

/**
 * Site controller
 */
class ContactController extends Controller {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model = new Contact();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate() {
        $model = new Contact();
        $model->attributes = $_POST;
        if ($model->validate()) {
            $model->created = time();
            $model->updated = time();
            $model->save();
        }
    }

    public function actionLoad() {
        $data = [];
        $model = new Contact();
        $model->attributes = $_POST;
        $data['html'] = $this->renderAjax('table', ['model' => $model]);
        return json_encode($data);
    }

}
