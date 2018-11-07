<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

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
    public $cnt;
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
            'cnt' => 'Count'
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

    public static function getPopularCategory()
    {
        $query = self::find()->join('RIGHT JOIN', 'category_announcement', 'category_announcement.category_id = category.id')->select(['category.id AS id', 'category.title AS title', 'COUNT(*) AS cnt'])->groupBy('category.id')->distinct()->orderBy('cnt DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }
}
