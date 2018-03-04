<?=

yii\grid\GridView::widget([
    'dataProvider' => $model->dataProvider,
    'columns' => $model->columns
]);
?>