<?php

namespace app\controllers;

use app\models\forms\user\LoginForm;
use app\models\forms\user\RegistrationForm;
use app\models\search\UserSearch;
use app\services\UserService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionRegister()
    {
        $model = new RegistrationForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($this->service->register($model)) {
                \Yii::$app->session->setFlash('success', 'Пользователь ' . $model->name . ' успешно зарегистрирован');

                return $this->redirect('/');
            }
        }

        return $this->render('registration', [
            'model' => $model
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($this->service->login($model)) {
                \Yii::$app->session->setFlash('success', 'Вы успешно авторизованы');

                return $this->redirect('/');
            } else {
                \Yii::$app->session->setFlash('error','Не верный email или пароль');
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if ($this->service->logout()) {
            \Yii::$app->session->setFlash('success', 'Вы успешно вышли');

            return $this->redirect('/');
        }

        \Yii::$app->session->setFlash('error', 'Ошибка выхода');

        return $this->goBack();
    }
}