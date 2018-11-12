<?php

use yii\widgets\ListView;
?>
<div class="body-content">

    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'layout' => "{pager}\n{items}\n{pager}",
]); ?>
</div>

