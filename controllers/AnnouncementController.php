<?php
namespace app\controllers;



use app\models\AnnouncementItem;
use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AnnouncementController extends Controller
{

    public function actionIndex($category = 0) {
        $dataProvider = AnnouncementItem::findByCategory($category);
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        array_unshift($categories, 'Все');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    public function actionView($id) {
        return 'view';
    }

    public function actionDelete($id) {
        return 'delete';
    }
}