<?php

namespace app\controllers;

use app\models\forms\user\UserForm;
use app\services\UserService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;

class CabinetController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, UserService $service, array $config = [])
    {
        $this->service = $service;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['@']
            ],
        ];
    }

    public function actionIndex()
    {
        $model = UserForm::findOne(\Yii::$app->user->id);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdateUser()
    {
        $model = UserForm::findOne(\Yii::$app->user->id);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($this->service->update($model)) {
                \Yii::$app->session->setFlash('success', 'Данные успешно изменены');
            } else {
                \Yii::$app->session->setFlash('error', 'Ошибка сохранения');
            }
        }

        return $this->redirect(['cabinet/index']);
    }

}