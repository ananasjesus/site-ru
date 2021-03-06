<?php
namespace app\controllers;



use app\models\Announcement;
use app\models\AnnouncementItem;
use app\models\Category;
use app\models\ImageUpload;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AnnouncementController extends Controller
{

    public function actionIndex($category = 0) {
        $dataProvider = AnnouncementItem::findByCategory($category);
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $categories[0] = 'Все';

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

    public function actionSetImage($id)
    {
        $model = new ImageUpload();

        if (Yii::$app->request->isPost) {
            $announcement = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');
            $currentImage = $announcement->image;

            if($announcement->saveImage($model->uploadFile($file)) && !empty($currentImage)) {
                is_file($currentImage) ? unlink($currentImage) : null;
            }

            return $this->redirect(['view', 'id' => $announcement->id]);
        }

        return $this->render('image', ['model' => $model]);
    }

    public function actionSetCategory($id)
    {
        $announcement = $this->findModel($id);
        $selectedCategory = $announcement->getSelectedCategory();
        $category = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost)
        {
            $category = Yii::$app->request->post('category');

            if (!Yii::$app->user->identity->isBanned($category))
                $announcement->saveCategory($category);
            else
                Yii::$app->session->setFlash('error', 'Вы не можете создавать объявления в этом разделе');

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('category', [
            'selectedCategory' => $selectedCategory,
            'category' => $category
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