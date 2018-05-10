<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->registerJsFile('/js/expend.js');
$this->title = 'Expend';
$class = 'col-lg-12 col-md-12 col-sm-12 col-sx-12';
?>
<div class="row col-lg-2 col-md-2 col-sm-2 col-sx-2 common-select">
    <div class="<?= $class ?>">
        <?= Html::activeDropDownList($model, 'contact', $model->contacts, ['class' => $class]); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeDropDownList($model, 'type', $model->types, ['class' => $class]); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'size', ['class' => $class, 'placeHolder' => '尺寸']); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'unit', ['class' => $class, 'placeHolder' => '单价']); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'sum', ['class' => $class, 'placeHolder' => '合计']); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'time', ['class' => $class, 'placeHolder' => date('Y-m-d')]); ?>
    </div>
    <div class="<?= $class ?>">
        <button class="btn btn-success btn-sm" id="common-submit">Submit</button>
    </div>
</div>

<div class="row col-lg-10 col-md-10 col-sm-10 col-sx-10 common-table" id="common-table">

</div>

<style>
    .common-select div {
        margin: 0 5px 5px 5px;
    }
</style>