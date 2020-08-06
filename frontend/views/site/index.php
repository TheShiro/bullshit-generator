<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Бредогенератор';
?>
<div class="site-index">

    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'count_sentence')->label('Количество предложений') ?>

    <div class="form-group">
        <?= Html::submitButton('Сгенерировать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>

    <div class="result-generation">
        <span>Результат</span>
        <p><?=$result ? $result : ''?></p>
    </div>

</div>
