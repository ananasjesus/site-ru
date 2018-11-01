<?php

namespace app\models;

use Yii;

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
            [['viewed', 'user_id'], 'integer'],
            [['viewed'], 'default', 'value' => 0],
            [['expired'], 'date', 'format' => 'php:Y-m-d'],
            [['expired'], 'default', 'value' => date('Y-m-d', time() + 30 * 24 * 60 * 60)], //+30 days
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

}
