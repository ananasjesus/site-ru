<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="news-item">
    <div class="card" style="width: 90%; border:2px solid #b4b2b3; border-radius: 8px; background-color: #5b92cb">
        <div class="card-body row" style="margin: 1rem;">
            <div class="col-md-3">
                <img class="card-img-left" style="width: 20rem; height: 20rem; object-fit: cover; border-radius: inherit;" src="<?= Yii::getAlias('@web/') . $model->getImage();?>" alt="">
            </div>
            <div class="col-md-9">
            <h4><?= strlen($model->title) < 100 ? $model->title : mb_substr($model->title, 0, 100) . '...' ?></h4>
            <h5><?= strlen($model->content) < 300 ? $model->content : mb_substr($model->content, 0, 300) . '...'?></h5>
            <a href="<?= Yii::getAlias('@web/announcement/view?id=') . $model->id ?>" class="btn btn-primary card-text-bottom">Подробнее</a>
            </div>
        </div>
    </div>
</div>