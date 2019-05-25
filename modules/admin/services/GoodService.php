<?php


namespace app\modules\admin\services;

use app\modules\admin\models\forms\GoodForm;
use app\models\Good;
use app\services\FileService;

use yii\web\UploadedFile;


class GoodService
{
    private $fileService;

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

    public function update(GoodForm $model, array $dates)
    {

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        // $model->imageFile - объект изображения(имя, путь к /temp/...tmp , размер)


        if ($model->imageFile !== null) {
            $model->image = $this->fileService->upload($model->imageFile);


            if ($model->image) {                           // $model->image -  только путь к файлу откуда качаем
                $this->fileService->remove($model->image);
            }
        }
        $model->load($dates);  //загружаем повторно, иначе ошибка Stream
        return $model->save();
    }

    public function delete(GoodForm $model)
    {

        return $model->delete();
    }

}