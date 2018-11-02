<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_announcement".
 *
 * @property int $category_id
 * @property int $announcement_id
 *
 * @property Announcement $announcement
 * @property Category $category
 */
class CategoryAnnouncement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'announcement_id'], 'required'],
            [['category_id', 'announcement_id'], 'integer'],
            [['announcement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Announcement::className(), 'targetAttribute' => ['announcement_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'announcement_id' => 'Announcement ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncement()
    {
        return $this->hasOne(Announcement::className(), ['id' => 'announcement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
