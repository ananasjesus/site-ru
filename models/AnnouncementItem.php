<?php

namespace app\models;

use app\models\CategoryAnnouncement;
use yii\data\ActiveDataProvider;

class AnnouncementItem extends CategoryAnnouncement
{
    public $id, $title, $content, $viewed, $created, $expired, $user_id, $username, $image;

    public static function findByCategory($id)
    {
        $query = self::find()
            ->join('LEFT JOIN', 'announcement', 'category_announcement.announcement_id = announcement.id')
            ->join('LEFT JOIN', 'user', 'announcement.user_id = user.id')
            ->select(['announcement.id AS id', 'announcement.title AS title', 'announcement.content AS content',
                'announcement.viewed AS viewed', 'announcement.created AS created', 'announcement.expired AS expired',
                'announcement.user_id AS user_id', 'announcement.image AS image', 'user.name AS username'])
            ->orderBy('created DESC')
        ->distinct();

        if ($id !== null)
            $query = $query->where(['category_announcement.category_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }

    public function getImage()
    {
        if(is_file($this->image))
            return $this->image;
        else
            return 'no_image.png';
    }
}