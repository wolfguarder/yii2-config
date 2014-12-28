<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var wolfguard\config\models\Config $model
 */

$this->title = Yii::t('config', 'Update config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('config', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($model->name) ?></h1>

<?php echo $this->render('flash') ?>

<div class="panel panel-info">
    <div class="panel-heading"><?= Yii::t('config', 'Information') ?></div>
    <div class="panel-body">
        <?= Yii::t('config', 'Created at {0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]) ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus' => true]) ?>

        <?php if($model->isNewRecord || $model->system == 0):?>
            <?= $form->field($model, 'code')->textInput(['maxlength' => 255])->hint(Yii::t('config', 'Only latin characters, numbers and symbols (.-_) allowed. Spaces not allowed.')) ?>
        <?php else: ?>
            <?= $form->field($model, 'code')->widget(\wolfguard\config\widgets\FormValueWidget::className()); ?>
        <?php endif ?>

        <?= $form->field($model, 'value')->textarea() ?>

        <?= $form->field($model, 'system')->dropDownList($model->getDropdown(), ['prompt' => '---']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('config', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
