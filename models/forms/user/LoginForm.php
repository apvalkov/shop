<?php

namespace app\models\forms\user;

use yii\base\Model;

class LoginForm extends Model
{
    public $email;

    public $password;

    public $rememberMe;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
            [['rememberMe'], 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }
}