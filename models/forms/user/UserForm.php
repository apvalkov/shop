<?php

namespace app\models\forms\user;

use app\models\User;

class UserForm extends User
{
    public $newPassword;

    public $passwordConfirm;

    public function rules()
    {
        return [
            [['email', 'name'], 'required'],
            [['email'], 'email'],
            [['newPassword'], 'string', 'min' => 6],
            [
                'passwordConfirm', 'required',
                'when' => [$this, 'isNotEmptyPassword'],
                'whenClient' => "function (attribute, value) {
                    return !!$('#userform-newpassword').val();
                }"
            ],
            [
                'passwordConfirm', 'compare', 'compareAttribute' => 'newPassword',
                'when' => [$this, 'isNotEmptyPassword'],
                'whenClient' => "function (attribute, value) {
                    return !!$('#userform-newpassword').val();
                }"
            ]
        ];
    }

    public function isNotEmptyPassword()
    {
        return !empty($this->newPassword);
    }

    public function attributeLabels()
    {
        return array_merge([
            'newPassword' => 'Новый пароль',
            'passwordConfirm' => 'Подтверждение пароля'
        ], parent::attributeLabels());
    }
}