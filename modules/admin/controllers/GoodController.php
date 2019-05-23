<?php

namespace app\modules\admin\controllers;

use app\models\Good;
use app\modules\admin\models\forms\GoodForm;
use app\modules\admin\models\search\GoodSearch;
use app\modules\admin\services\GoodService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Category;
use yii\helpers\ArrayHelper;

/**
 * Контроллер товар
 */
class GoodController extends Controller
{
    /**
     * @var GoodService
     */
    private $service;

    /**
     * GoodController constructor
     *
     * @param string $id
     *
     * @param Module $module
     *
     * @param GoodService $service
     *
     * @param array $config
     */
    public function __construct(string $id, Module $module, GoodService $service, array $config = [])
    {
        $this->service = $service;

        parent::__construct($id, $module, $config);
    }

    /**
     * Все товары
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GoodSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');
        $statuses = GoodSearch::getStatuses();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Создание товара
     *
     * @return string|\yii\web\Response
     *
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');
        $statuses = Good::getStatuses();
        $model = new GoodForm();

        if ($this->service->create($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success', 'Товар успешно создан');

            return $this->redirect('/admin/good');
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Обновление товара
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     *
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');
        $statuses = Good::getStatuses();
        $model = $this->findModel($id);

        if ($this->service->update($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success', 'Товар успешно обновлен');

            return $this->redirect('/admin/good');
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Просмотр товара
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
            'model' => $model,
        ]);
    }

    /**
     * Удаление товара
     *
     * @param $id
     *
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     *
     * @throws \Throwable
     *
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($this->service->delete($model)) {
            \Yii::$app->session->setFlash('success', 'Товара успешно удалён');
        }

        return $this->redirect('/admin/good');
    }

    /**
     * Поиск записи
     *
     * @param $id
     *
     * @return GoodForm|null
     *
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $model = GoodForm::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Товар не найден');
        }

        return $model;
    }
}