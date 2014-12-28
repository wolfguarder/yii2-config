<?php

/**
 * @var yii\web\View $this
 */

?>

<?php if (Yii::$app->getSession()->hasFlash('config.success')): ?>
    <div class="alert alert-success">
        <p><?= Yii::$app->getSession()->getFlash('config.success') ?></p>
    </div>
<?php endif; ?>

<?php if (Yii::$app->getSession()->hasFlash('config.error')): ?>
    <div class="alert alert-danger">
        <p><?= Yii::$app->getSession()->getFlash('config.error') ?></p>
    </div>
<?php endif; ?>