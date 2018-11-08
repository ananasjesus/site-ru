<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $announcements app\models\Announcement[] */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Поздравляем!</h1>

        <p class="lead">Вы зашли на лучший сайт с объявлениями. Здесь вас ждёт много интересного!</p>

        <p><?= Html::a('Создать объявление', ['announcement/create'], ['class' => 'btn btn-lg btn-success']) ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach($announcements as $announcement):?>
                <div class="col-md-4">
                    <div class="card" style="width: 28rem; border:1px solid #b4b2b3; border-radius: 8px; background-color: #5b92cb">
                        <img class="card-img-top" style="width: 100%; height: 20rem; object-fit: cover; border-radius: inherit;" src="<?= $announcement->getImage();?>" alt="">
                        <div class="card-body" style="margin: 1rem;">
                            <h5 class="card-title"><?= strlen($announcement->title) < 30 ? $announcement->title : mb_substr($announcement->title, 0, 30) . '...' ?></h5>
                            <p class="card-text" style="min-height: 5rem;"><?= strlen($announcement->content) < 100 ? $announcement->content : mb_substr($announcement->content, 0, 30) . '...'?></p>
                            <a href="#" class="btn btn-primary card-text-bottom">Подробнее</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
