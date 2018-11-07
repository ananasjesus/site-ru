<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "announcement".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property string $expired
 *
 * @property CategoryAnnouncement[] $categoryAnnouncements
 */
class Announcement extends \yii\db\ActiveRecord
{
    public $cnt, $name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['viewed', 'user_id', 'cnt'], 'integer'],
            [['viewed'], 'default', 'value' => 0],
            [['expired', 'created'], 'date', 'format' => 'php:Y-m-d'],
            [['expired'], 'default', 'value' => date('Y-m-d', time() + 30 * 24 * 60 * 60)], //+30 days
            [['created'], 'default', 'value' => date('Y-m-d', time())],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'expired' => 'Expired',
            'created' => 'Created',
            'cnt' => 'Count',
            'name' => 'User name'
        ];
    }


   public function saveImage($filename)
   {
       $this->image = $filename;
       return $this->save(false);
   }

   public function getImage()
   {
       if(is_file($this->image))
           return $this->image;
       else
           return 'no_image.png';
   }

   public function beforeDelete()
   {
       if(is_file($this->image))
           unlink($this->image);

       return parent::beforeDelete();
   }

   public function getCategory()
   {
       return $this->hasMany(Category::className(), ['id' => 'category_id'])
           ->viaTable('category_announcement', ['announcement_id' => 'id']);
   }

   public function getSelectedCategory()
   {
       return ArrayHelper::getColumn($this->getCategory()->select('id')->asArray()->all(), 'id');
   }

   public function saveCategory($category)
   {
       if (is_array($category)) {

           CategoryAnnouncement::deleteAll(['announcement_id' => $this->id]);

           foreach ($category as $id) {
               $this->link('category', Category::findOne($id));
           }
       }
   }

   public static function getPopularDays()
   {
       $query = self::find()->select(['created', 'COUNT(*) AS cnt'])->groupBy('created')->distinct()->orderBy('cnt DESC');

       $provider = new ActiveDataProvider([
           'query' => $query,
           'pagination' => [
               'pageSize' => 10,
           ],
       ]);

       return $provider;
   }

    public static function getPopularUsers()
    {
        $query = self::find()->join('LEFT JOIN', 'user', 'announcement.user_id = user.id')->select(['announcement.user_id AS user_id', 'user.name AS name', 'COUNT(*) AS cnt'])->groupBy('announcement.user_id')->distinct()->orderBy('cnt DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }

}
