<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model {

    const IMAGE_PATH = 'uploads/';

    public $image;

    public function rules()
    {
        return [
            ['image', 'required'],
            ['image', 'file', 'extensions' => 'jpg,jpeg,png,gif', 'maxSize' => 1024 * 1024 * 5], //5mb
        ];
    }

    public function uploadFile(UploadedFile $file)
    {
        $this->image = $file;

        if($this->validate()) {
            do {
                $filename = self::IMAGE_PATH . uniqid($file->baseName, true) . '.' . $file->extension;
            } while (file_exists($filename));

            $file->saveAs($filename);
            return $filename;
        }
        
    }

}