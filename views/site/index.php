<?php

/** @var yii\web\View $this */
/** @var Link $model */

use app\assets\IndexAsset;
use app\models\Link;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '';

IndexAsset::register($this);
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <div class="row justify-content-center" id="container">
            <?php $form = ActiveForm::begin(); ?>
                <?= Html::input('text', 'url', '', ['id' => 'url']) ?>
                <?= Html::button('ОК', ['class' => 'btn btn-primary', 'id' => 'ok-button']) ?>
                <div id="error"></div>
            <?php ActiveForm::end(); ?>
            <div id="result"></div>
        </div>
    </div>
</div>
