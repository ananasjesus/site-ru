<?php

use yii\helpers\Html;

$this->title = 'Администратор';
?>
<div class="admin-default-index">
    <h1>Панель администратора</h1>

    <p>
        <?= Html::a('Популярные дни', ['announcement/popular-days'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Активные пользователи', ['user/popular-users'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Популярные категории', ['category/popular-category'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
