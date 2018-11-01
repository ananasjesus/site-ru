<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model {

    const IMAGE_PATH = 'uploads/';

    public $image;

    public function uploadFile(UploadedFile $file)
    {
        $this->image = $file;

        $fullPath = Yii::getAlias('@web') . self::IMAGE_PATH;

        do {
            $filename = $fullPath . uniqid($file->name, true) . '.' . $file->extension;
        } while(file_exists($filename));

        $file->saveAs($filename);
        return $filename;
    }

}