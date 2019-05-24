<?php
/**
 * Created by PhpStorm.
 * User: cay
 * Date: 23.05.2019
 * Time: 20:36
 */

namespace app\modules\admin\models\forms;

use yii\web\UploadedFile;
use app\models\Good;

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