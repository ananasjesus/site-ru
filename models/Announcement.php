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
            [['content'], 'string'],
            [['viewed', 'user_id'], 'integer'],
            [['expired'], 'safe'],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAnnouncements()
    {
        return $this->hasMany(CategoryAnnouncement::className(), ['announcement_id' => 'id']);
    }
}
