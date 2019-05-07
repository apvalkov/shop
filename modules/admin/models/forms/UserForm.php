<?php

namespace app\modules\admin\models\forms;

use app\models\User;
use yii\db\ActiveQuery;

class UserForm extends User
{
    public $password;

    public function rules()
    {
        return [
            [['email', 'name', 'password_hash'], 'required'],
            ['password', 'required',
                'when' => function () {
                    return $this->isNewRecord;
                },
                'whenClient' => $this->isNewRecord],
            ['email', 'email'],
            [['email'], 'unique', 'filter' => function (ActiveQuery $query) {
                return $this->isNewRecord ? $query : $query->andWhere(['<>', 'id', $this->id]);
            }],
            [['password'], 'string', 'min' => 6],
            [['email', 'name'], 'string', 'max' => 255]
        ];
    }
}