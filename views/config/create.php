<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = 'Создание конфигурации';
$this->params['breadcrumbs'][] = ['label' => 'Конфигурация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
