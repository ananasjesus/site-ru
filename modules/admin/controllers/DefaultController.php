<?php

namespace app\modules\admin\controllers;

use app\models\Announcement;
use app\models\Category;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPopularDays()
    {
        $dataProvider = Announcement::getPopularDays();

        return $this->render('popular', ['dataProvider' => $dataProvider]);
    }

    public function actionPopularUsers()
    {
        $dataProvider = Announcement::getPopularUsers();
        //dump($dataProvider);die;

        return $this->render('users', ['dataProvider' => $dataProvider]);
    }

    public function actionPopularCategory()
    {
        $dataProvider = Category::getPopularCategory();
        //dump($dataProvider);die;

        return $this->render('category', ['dataProvider' => $dataProvider]);
    }
}
