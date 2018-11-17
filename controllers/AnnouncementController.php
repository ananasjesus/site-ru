<?php
namespace app\controllers;



use app\models\Announcement;
use app\models\AnnouncementItem;
use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->viewed++;
        $model->save();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Announcement();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    protected function findModel($id)
    {
        if (($model = Announcement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}