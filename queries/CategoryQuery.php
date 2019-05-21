<?php

namespace app\queries;

use app\models\Category;
use yii\db\ActiveQuery;

/**
 * Class CategoryQuery
 * @package app\queries
 */
class CategoryQuery extends ActiveQuery
{
    /**
     * @return CategoryQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => Category::STATUS_ACTIVE]);
    }

    public function root()
    {
        return $this->andWhere(['is', 'parent_id', null]);
    }
}