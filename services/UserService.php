<?php

namespace app\services;

use app\models\forms\user\LoginForm;
use app\models\forms\user\RegistrationForm;
use app\models\forms\user\UserForm;
use app\models\User;

class UserService
{
    public function register(RegistrationForm $form)
    {
        $user = new User();
        $user->name = $form->name;
        $user->email = $form->email;
        $user->password = \Yii::$app->security->generatePasswordHash($form->password);
        $user->auth_key = \Yii::$app->security->generateRandomString();

        return $user->save();
    }

    public function update(UserForm $form)
    {
        if (!empty($form->newPassword)) {
            $form->password = \Yii::$app->security->generatePasswordHash($form->newPassword);
        }

        return $form->save();
    }

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

    public function logout()
    {
        return \Yii::$app->user->logout();
    }
}
