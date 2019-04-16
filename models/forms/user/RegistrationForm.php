<?php

namespace app\models\forms\user;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $name;

    public $email;

    public $password;

    public $password_confirm;

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_confirm' => 'Подтвердите пароль'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_confirm'], 'required'],
            [['email'], 'email'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password']
        ];
    }
}