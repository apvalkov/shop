<?php

namespace app\modules\admin\models\forms;


use app\models\Good;
use yii\web\UploadedFile;

class GoodForm extends Good
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @return array
     */
    public function rules()
    {
        return array_merge([
            ['imageFile', 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => 'image/*']
        ], parent::rules());
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array_merge([
            'imageFile' => 'Изображение',
        ], parent::attributeLabels());
    }
}