<?php

namespace app\services;


use app\models\forms\good\GoodForm;
use app\models\Good;
use yii\web\UploadedFile;

class GoodService
{
    /**
     * @var FileService
     */
    private $fileService;

    /**
     * GoodService constructor
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function create(GoodForm $form)
    {
        $model = new Good();

        $form->imageFile = UploadedFile::getInstance($form, 'imageFile');

        if ($form->imageFile !== null) {
            $form->image = $this->fileService->upload($form->imageFile);
        }

        $model->load($form->attributes, '');

        return $model->save();
    }

    public function update(GoodForm $model)
    {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile !== null) {
            $model->image = $this->fileService->upload($model->imageFile);

            if ($model->image) {
                $this->fileService->remove($model->image);
            }
        }

        return $model->save();
    }

    public function delete()
    {

    }
}