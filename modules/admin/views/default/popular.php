<?php

use yii\grid\GridView;

$this->title = 'Популярные дни';

echo $this->render('_header');
?>
<div class = "default-popular">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'created',
            'cnt',
        ],
    ]); ?>


</div>
