<?php

namespace app\modules\admin\services;

use app\modules\admin\models\forms\CategoryForm;

class CategoryService
{

    public function create(CategoryForm $form, array $data)
    {
        if ($form->load($data) && $form->save()){
            return true;
        }

        return false;
    }

    public function update(CategoryForm $form, array $data)
    {
        if ($form->load($data) && $form->save()){
            return true;
        }

        return false;
    }
}