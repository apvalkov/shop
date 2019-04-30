<?php

namespace app\controllers;

use app\models\Category;
use app\models\forms\category\CategoryForm;
use app\models\Good;
use app\services\CategoryService;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use app\models\search\CategorySearch;
use yii\web\NotFoundHttpException;

/**
 * Class CategoryController
 * @package app\controllers
 */
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param string $slug
     *
     * @return string
     */
    public function actionView($slug)
    {
        $category = Category::findOne(['slug' => $slug]);
        $dataProvider = new ActiveDataProvider([
            'query' => $category->getActiveGoods(),
            'pagination' => [
                'pageSize' => 21,
                'pageSizeParam' => false,
            ]
        ]);

        return $this->render('view', [
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($this->service->create($model)) {
                \Yii::$app->session->setFlash('success', 'Категория ' . $model->title . ' успешно создана');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($this->service->update($model)) {
                \Yii::$app->session->setFlash('success', 'Категория ' . $model->title . ' успешно обновлена');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}