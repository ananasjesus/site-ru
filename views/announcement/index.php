<?php

use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Html;
?>
<div class="body-content">

    <?php $form = ActiveForm::begin(['action' => 'index', 'method' => 'get']); ?>

    <?= Html::dropDownList('category', Yii::$app->request->get('category', 0), $categories, ['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'layout' => "{pager}\n{items}\n{pager}",
]); ?>
</div>

