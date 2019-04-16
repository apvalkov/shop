<?php

namespace app\queries;

use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    /**
     * Поиск пользователя по токену.
     *
     * @param string $token
     *
     * @return UserQuery
     */
    public function findByAccessToken(string $token)
    {
        return $this->where(['access_token' => $token]);
    }

    public function findByEmail(string $email)
    {
        return $this->where(['email' => $email]);
    }
}