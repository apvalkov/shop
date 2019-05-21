<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Class AdminController
 * @package app\modules\admin\controllers
 */
class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}