<?php

namespace app\modules\admin\services;

use app\models\User;
use app\modules\admin\models\forms\UserForm;

/**
 * Сервис для управления пользователей.
 */
class UserService
{
    /**
     * Метод для создания пользователя.
     *
     * @param UserForm $form
     * @param array $data
     *
     * @return bool
     *
     * @throws \yii\base\Exception
     */
    public function create(UserForm $form, array $data)
    {
        if ($form->load($data) && $form->validate()) {
            $form->password_hash = \Yii::$app->security->generatePasswordHash($form->password);

            return $form->save();
        }

        return false;
    }

    /**
     * Метод для обновления пользователя.
     *
     * @param UserForm $form
     * @param array $data
     *
     * @return bool
     *
     * @throws \yii\base\Exception
     */
    public function update(UserForm $form, array $data)
    {
        if ($form->load($data) && $form->validate()) {
            $passwordHash = \Yii::$app->security->generatePasswordHash($form->password);

            if (!\Yii::$app->security->compareString($passwordHash, $form->password_hash)) {
                $form->password_hash = $passwordHash;
            }

            return $form->save();
        }

        return false;
    }

    /**
     * Удаление польщователя.
     *
     * @param User $user
     *
     * @return false|int
     *
     * @throws \Throwable
     *
     * @throws \yii\db\StaleObjectException
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

}