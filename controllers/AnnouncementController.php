<?php
namespace app\controllers;



use app\models\Announcement;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AnnouncementController extends Controller
{

    public function actionIndex() {
        return 'index';
    }

    public function actionView($id) {
        return 'view';
    }

    public function actionDelete($id) {
        return 'delete';
    }
}