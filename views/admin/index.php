<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var wolfguard\config\models\ConfigSearch $searchModel
 */

$this->title = Yii::t('config', 'Manage configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?> <?= Html::a(Yii::t('config', 'Create config'), ['create'], ['class' => 'btn btn-success']) ?></h1>

<?php echo $this->render('flash') ?>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        'code',
        [
            'attribute' => 'system',
            'filter' => ['0' => 'Нет', '1' => 'Да'],
            'value' => function ($model){
                $list = $model->getDropdown();
                return $list[$model->system];
            },
        ],
        'value:ntext',
        [
            'attribute' => 'created_at',
            'value' => function ($model, $key, $index, $widget) {
                return Yii::t('config', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
