<?php

namespace app\controllers;

use app\models\Category;
use app\models\forms\good\GoodForm;
use app\models\Good;
use app\models\search\GoodSearch;
use app\services\GoodService;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class GoodController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, GoodService $service, array $config = [])
    {
        $this->service = $service;

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = new GoodSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');

        return $this->render('index', [
            'categories' => $categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new GoodForm();
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($this->service->create($model)) {
                \Yii::$app->session->setFlash('success', 'Товар ' . $model->title . ' успешно зарегистрирован');

                return $this->redirect('/');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionUpdate($id)
    {
        $model = GoodForm::findOne($id);
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($this->service->update($model)) {
                \Yii::$app->session->setFlash('success', 'Товар ' . $model->title . ' успешно обновлён');

                return $this->redirect('/');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionView(string $category, string $good)
    {
        $good = Good::find()->active()->where(['slug' => $good])->one();

        return $this->render('view', [
            'good' => $good
        ]);

    }

    public function actionDelete()
    {

    }
}