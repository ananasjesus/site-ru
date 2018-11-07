<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 *
 * @property CategoryAnnouncement[] $categoryAnnouncements
 * @property UserCategory[] $userCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAnnouncements()
    {
        return $this->hasMany(CategoryAnnouncement::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['category_id' => 'id']);
    }

    public function getAnnouncement()
    {
        return $this->hasMany(Announcement::className(), ['id' => 'announcement_id'])
            ->viaTable('category_announcement', ['category_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('user_category', ['category_id' => 'id']);
    }
}
