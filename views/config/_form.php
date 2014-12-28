<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?php if($model->isNewRecord || $model->system == 0):?>
        <?= $form->field($model, 'code')->textInput(['maxlength' => 255]) ?>
    <?php else: ?>
        <?= $form->field($model, 'code')->widget(\app\widgets\FormValueWidget::className()); ?>
    <?php endif ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'system')->dropDownList($model->getDropdown(), ['prompt' => '---']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
