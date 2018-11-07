<?php

use yii\grid\GridView;

$this->title = 'Активные пользователи';

echo $this->render('_header');
?>
<div class = "default-users">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'name',
            'cnt',
        ],
    ]); ?>


</div>
