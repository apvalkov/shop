<?php

namespace app\queries;

use app\models\Good;
use yii\db\ActiveQuery;

class GoodQuery extends ActiveQuery
{
    /**
     * @return GoodQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => Good::STATUS_ACTIVE]);
    }
}