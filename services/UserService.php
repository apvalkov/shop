<?php

namespace app\services;

use app\models\forms\user\LoginForm;
use app\models\forms\user\RegistrationForm;
use app\models\forms\user\UserForm;
use app\models\User;

/**
 * Сервис работы с пользователем.
 */
class UserService
{
    /**
     * Регистрация пользователя.
     *
     *
     * @param RegistrationForm $form
     *
     * @return bool
     *
     * @throws \yii\base\Exception
     */
    public function register(RegistrationForm $form)
    {
        $user = new User();
        $user->name = $form->name;
        $user->email = $form->email;
        $user->password = \Yii::$app->security->generatePasswordHash($form->password);
        $user->auth_key = \Yii::$app->security->generateRandomString();

        return $user->save();
    }

    /**
     * Обновление пользователя.
     *
     * @param UserForm $form
     *
     * @return bool
     *
     * @throws \yii\base\Exception
     */
    public function update(UserForm $form)
    {
        if (!empty($form->newPassword)) {
            $form->password = \Yii::$app->security->generatePasswordHash($form->newPassword);
        }

        return $form->save();
    }

    /**
     * Авторизация пользователя.
     *
     * @param LoginForm $form
     *
     * @return bool
     */
    public function login(LoginForm $form)
    {
        $duration = 0;
        $user = User::find()->findByEmail($form->email)->one();

        if ($user === null || !\Yii::$app->security->validatePassword($form->password, $user->password)) {
            return false;
        }

        if ($form->rememberMe) {
            $duration = User::AUTHORIZATION_DURATION;
        }

        return \Yii::$app->user->login($user, $duration);
    }

    /**
     * Выход пользователя из системы.
     *
     * @return bool
     */
    public function logout()
    {
        return \Yii::$app->user->logout();
    }
}
