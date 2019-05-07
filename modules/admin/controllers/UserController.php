<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\forms\UserForm;
use app\modules\admin\models\search\UserSearch;
use app\modules\admin\services\UserService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер пользователь.
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param UserService $service
     * @param array $config
     */
    public function __construct(string $id, Module $module, UserService $service, array $config = [])
    {
        $this->service = $service;

        parent::__construct($id, $module, $config);
    }

    /**
     * Все товары.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Создание пользователя.
     *
     * @return string|\yii\web\Response
     *
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($this->service->create($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success', 'Пользователь успешно создан');

            return $this->redirect('/admin/user');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Обновление пользователей.
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     *
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->service->update($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success', 'Пользователь успешно обновлен');

            return $this->redirect('/admin/user');
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Просмотр пользователя.
     *
     * @param $id
     *
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Удаление пользователя.
     *
     * @param $id
     *
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($this->service->delete($model)) {
            \Yii::$app->session->setFlash('success', 'Пользователь успешно удалён');
        }

        return $this->redirect('/admin/user');
    }

    /**
     * Поиск записи.
     *
     * @param $id
     *
     * @return UserForm|null
     *
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $model = UserForm::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Пользователь не найден');
        }

        return $model;
    }
}