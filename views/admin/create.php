<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var wolfguard\config\models\Config $model
 */

$this->title = Yii::t('config', 'Create config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('config', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo $this->render('flash') ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php if($model->isNewRecord || $model->system == 0):?>
            <div class="alert alert-info">
                <?= Yii::t('config', 'Be careful in Code field. Pay attention to field hint.') ?>
            </div>
        <?php endif; ?>

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
            <?= Html::submitButton(Yii::t('config', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
