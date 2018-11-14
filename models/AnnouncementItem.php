<?php

namespace app\models;

use app\models\CategoryAnnouncement;
use yii\data\ActiveDataProvider;

class AnnouncementItem extends Announcement
{

    public static function findByCategory($id)
    {
        $now = date('Y-m-d', time());
        $query = self::find()
            ->join('LEFT JOIN', 'category_announcement', 'announcement.id = category_announcement.announcement_id')
            ->join('LEFT JOIN', 'user', 'announcement.user_id = user.id')
            ->select(['announcement.id AS id', 'announcement.title AS title', 'announcement.content AS content',
                'announcement.viewed AS viewed', 'announcement.created AS created', 'announcement.expired AS expired',
                'announcement.user_id AS user_id', 'announcement.image AS image', 'user.name AS name'])
            ->orderBy('created DESC')
            ->where("announcement.expired > $now")
            ->distinct();

        if ($id != 0)
            $query = $query->andWhere(['category_announcement.category_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }

}