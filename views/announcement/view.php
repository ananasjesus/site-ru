<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = $model->title;

?>
<div class="announcement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->id === $model->user_id): ?>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить объявление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?php
    $category = ArrayHelper::getColumn($model->getCategory()->select('title')->asArray()->all(), 'title');
    $category = implode(', ', $category);
    ?>
    <?= Html::img(Yii::getAlias('@web/') . $model->getImage(), ['width' => 300])?>
    <p>
        <b>Имя: <?= $model->user->name?>, </b> Создано: <?= $model->created?>, Актуально до <?= $model->expired?>, Просмотров: <?= $model->viewed?>
    </p>
    <p>
        <?= $model->content ?>
    </p>

</div>
