<?php
namespace app\controllers;



use app\models\AnnouncementItem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AnnouncementController extends Controller
{

    public function actionIndex($category = null) {
        $dataProvider = AnnouncementItem::findByCategory($category);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return 'view';
    }

    public function actionDelete($id) {
        return 'delete';
    }
}