<?php

namespace app\modules\admin\models\search;

use app\models\Category;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['title', 'status', 'slug'], 'string', 'max' => 255],
            ['id', 'safe']
        ];
    }

    public function behaviors()
    {
        return [];
    }

    public function search(array $params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'and',
            ['id' => $this->id],
            ['status' => $this->status],
            ['like', 'title', $this->title],
            ['like', 'slug', $this->slug],
        ]);

        return $dataProvider;
    }
}