<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать объявление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'created',
            'expired',
            'viewed',
            [
                'label' => 'Category',
                'value' => function($data) {
                    $result = ArrayHelper::getColumn($data->getCategory()->select('title')->asArray()->all(), 'title');
                    return implode(', ', $result);
                }
            ],
            'user_id',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img(Yii::getAlias('@web/') . $data->getImage(), ['width' => 200]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>