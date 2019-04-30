<?php

namespace app\services;

use yii\web\UploadedFile;

class FileService
{
    const BASE_DIR = 'uploads';

    /**
     * @param UploadedFile $file
     * @return bool|string
     */
    public function upload(UploadedFile $file)
    {
        $this->createBaseDir();

        $fileName = md5($file->getBaseName() . time()) . '.' . $file->getExtension();
        $filePath = '/' . substr($fileName, 0, 2) .
            '/' . substr($fileName, 0 , 1);

        if (!is_dir($filePath)) {
            mkdir($this->getBasePath() . $filePath, 0755, true);
        }

        $filePath .= '/' . $fileName;

        if ($file->saveAs($this->getBasePath() . $filePath)) {
            return '/' . $this->getWebDir() . $filePath;
        }

        return null;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function remove(string $path)
    {
        if (is_file($this->getBasePath() . $path)) {
            return unlink($this->getBasePath() . $path);
        }

        return false;
    }

    /**
     * @return bool
     */
    private function createBaseDir()
    {
        if (!is_dir($this->getBasePath())) {
            return mkdir($this->getBasePath(), 0755);
        }

        return true;
    }

    /**
     * @return bool|string
     */
    private function getBasePath()
    {
        return \Yii::getAlias('@app/web') . DIRECTORY_SEPARATOR . self::BASE_DIR;
    }

    private function getWebDir()
    {
        return self::BASE_DIR;
    }
}