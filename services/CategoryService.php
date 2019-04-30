<?php


namespace app\services;


use app\models\forms\category\CategoryForm;

class CategoryService
{

    public function create(CategoryForm $form)
    {
        return $form->save();
    }

    public function update(CategoryForm $form)
    {
        return $form->save();
    }
}