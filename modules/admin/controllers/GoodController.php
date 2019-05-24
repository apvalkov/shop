<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Good;
use app\models\search\GoodSearch;
use app\modules\admin\services\GoodService;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\modules\admin\models\forms\GoodForm;

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
            //объект из Good из ActiveRecord ... Model
        $searchModel = new GoodSearch();
            // инпуты  из get передаем в метод search объекта GoodSearch и получаем  в dataProvider введенные данные
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
            // получаем активные категории от id до title
        $categories = ArrayHelper::map(Category::find()->active()->all(), 'id', 'title');


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories
            ]);
    }

    public  function actionCreate()
    {
            //создаем пустой объект GoodForm()
        $model = new GoodForm();
            // получаем активные категории от id до title
        $categories = ArrayHelper::map((Category::find()->active()->all()), 'id', 'title');
            // загружаем инпуты через load и валидируем $model
        if($model->load(\Yii::$app->request->post()) && $model->validate() )
        {
            //если  в GoodService отработал create $model-и, )
            if($this->service->create($model))
            {
                    // то вызов всплывающего сообщения SetFlash
                \Yii::$app->session->SetFlash ('success', 'Товар  '. $model->title . '  успешно добавлен'   );

                return $this->redirect('/admin/good');
            }
        }

        return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
    }


    public  function actionUpdate($id)
    {
            //через Форму находим один объект по id
        $model = GoodForm::findOne($id);
            // через стат. метод Category::find() находим активные все
            //  и хелперМап  получаем активные категории от id до title
        $categories = ArrayHelper::map((Category::find()->active()->all()), 'id', 'title');
            // load в объект model-и инпуты из пост
        $inputs = \Yii::$app->request->post();
        if($model->load($inputs)  )
        {
                //если  в GoodService отработало обновление $model-и,
            if($this->service->update($model, $inputs))
            {
                    // то вызов сообщения SetFlash
                \Yii::$app->session->SetFlash ('success', 'Товар  '. $model->title . '  успешно изменен'   );

                return $this->redirect('/admin/good');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    public function actionView($id)
    {
        $good = Good::findOne($id);

        return $this->render('view', [
            'good' => $good,

        ]);
    }

    public function actionDelete($id)
    {
        $model = GoodForm::findOne($id);

        //$this->service->delete($id);

        if($this->service->delete($model))
        {
            // то вызов всплывающего сообщения SetFlash
            \Yii::$app->session->SetFlash ('success', 'Товар  '. $model->title . '  успешно удален'   );

            return $this->redirect('/admin/good');
        }
    }



}