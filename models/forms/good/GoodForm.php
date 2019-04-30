<?php

namespace app\models\forms\good;

use app\models\Good;
use yii\web\UploadedFile;

class GoodForm extends Good
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return array_merge([
            ['imageFile', 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => 'image/*']
        ], parent::rules());
    }

    public function attributeLabels()
    {
        return array_merge([
            'imageFile' => 'Изображение',
        ], parent::attributeLabels());
    }
}