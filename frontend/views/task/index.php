<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->registerJsFile('/js/wool.js');
$this->title = 'Wool';
$class = 'col-lg-12 col-md-12 col-sm-12 col-sx-12';
?>
<div class="row col-lg-2 col-md-2 col-sm-2 col-sx-2 wool-select">
    <div class="<?= $class ?>" style="color: #33CC00">
        <span>收益: </span> 
        <?= number_format($model->profit - $model->lost, 2) ?>
    </div>
    <div class="<?= $class ?>">
        <span>待收: </span> 
        <?= number_format($model->principal, 2) ?>
    </div>
    <div class="<?= $class ?>" style="color: #FF0033">
        <span>坏账: </span> 
        <?= number_format($model->lost, 2) ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeDropDownList($model, 'pid', $model->pids, ['class' => $class]); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeDropDownList($model, 'aid', $model->aids, ['class' => $class]); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'date', ['class' => $class, 'placeHolder' => date('Y-m-d')]); ?>
    </div>
    <div class="<?= $class ?>">
        <?= Html::activeTextInput($model, 'in', ['class' => $class, 'placeHolder' => '金额']) ?>
    </div>
    <div class="<?= $class ?>">
        <button class="btn btn-success btn-sm" id="wool-submit">Submit</button>
    </div>
</div>

<div class="row col-lg-10 col-md-10 col-sm-10 col-sx-10 wool-table" id="wool-table">

</div>

<style>
    .wool-select div {
        margin: 0 5px 5px 5px;
    }
    .wool-table .glyphicon-thumbs-up {
        color: #33CC00;
    }
    .wool-table .glyphicon-certificate {
        color: #FF0033;
    }
    .wool-table input {
        width: 80px
    }
</style>