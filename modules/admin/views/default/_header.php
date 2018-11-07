<?php
use yii\helpers\Html;
?>
<div class="admin-default-index">
    <h1>Панель администратора</h1>

    <p>
        <?= Html::a('Популярные дни', ['default/popular-days'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Активные пользователи', ['default/popular-users'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Популярные категории', ['default/popular-category'], ['class' => 'btn btn-success']) ?>
    </p>

</div>