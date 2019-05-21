<?php

namespace app\modules\admin\controllers;

use app\helpers\CategoryHelper;
use app\models\Category;
use app\modules\admin\models\forms\CategoryForm;
use app\modules\admin\models\search\CategorySearch;
use app\modules\admin\services\CategoryService;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class CategoryController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, CategoryService $service, array $config = [])
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $statuses = CategorySearch::getStatuses();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statuses' => $statuses,
        ]);

    }

    public function actionCreate()
    {
        $model = new CategoryForm();
        $parents = Category::find()->root()->with(['children'])->all();
        $parents = CategoryHelper::getTree($parents);
        $statuses = Category::getStatuses();

        if ($this->service->create($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success', 'Категория успешно добавлена');

            return $this->redirect('/admin/category/index');
        }

        return $this->render('create', [
            'model' => $model,
            'parents' => $parents,
            'statuses' => $statuses
        ]);
    }

    public function actionUpdate($id)
    {
        $model = CategoryForm::findModel($id);
        $parents = Category::find()->root()->with(['children'])->all();
        $parents = CategoryHelper::getTree($parents);
        $statuses = Category::getStatuses();

        if($this->service->update($model, \Yii::$app->request->post())) {
            \Yii::$app->session->setFlash('success','Категория успешно обновлена');

            return $this->redirect('/admin/category/index');
        }

        return $this->render('update',[
            'model' => $model,
            'parents' => $parents,
            'statuses' => $statuses
        ]);
    }

    public function actionView()
    {

    }

    public function actionDelete()
    {

    }

    /**
     * Поиск записи.
     *
     * @param $id
     *
     * @return CategoryForm|null
     *
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $model = CategoryForm::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Пользователь не найден');
        }

        return $model;
    }
}