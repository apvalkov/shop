<?php

namespace app\modules\admin\services;

use app\models\Good;
use app\modules\admin\models\forms\GoodForm;
use app\services\FileService;
use yii\web\UploadedFile;

/**
 * Сервис для управления товарами
 */
class GoodService
{

    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Метод для создания товара
     *
     * @param GoodForm $form
     *
     * @param array $data
     *
     * @return bool
     *
     */
    public function create(GoodForm $form, array $data)
    {
        $form->imageFile = UploadedFile::getInstance($form, 'imageFile');

        if ($form->imageFile !== null) {

            $form->image = $this->fileService->upload($form->imageFile);
        }

        if ($form->load($data) && $form->save()) {

            return true;
        }

        return false;
    }

    /**
     * Метод для обновления товара
     *
     * @param GoodForm $form
     *
     * @param array $data
     *
     * @return bool
     *
     * @throws \yii\base\Exception
     */
    public function update(GoodForm $form, array $data)
    {
        $form->imageFile = UploadedFile::getInstance($form, 'imageFile');

        if ($form->imageFile !== null) {

            $form->image = $this->fileService->upload($form->imageFile);

            if ($form->image) {
                $this->fileService->remove($form->image);
            }
        }

        if ($form->load($data) && $form->save()) {

            return true;
        }

        return false;
    }

    /**
     * Метод для удаления товара
     *
     * @param Good $good
     *
     * @return false|int
     *
     * @throws \Throwable
     *
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Good $good)
    {
        return $good->delete();
    }

}