<?php

namespace app\modules\admin\models\search;


use app\models\Good;
use yii\data\ActiveDataProvider;

class GoodSearch extends  Good
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'price', 'amount'], 'number'],
            [['title', 'status', 'slug', 'description', 'category_id'], 'string', 'max' => 255],
            ['id', 'safe']
        ];
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
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
            ['category_id' => $this->category_id],
            ['status' => $this->status],
            ['like', 'title', $this->title],
            ['like', 'slug', $this->slug],
            ['like', 'description', $this->description],
            ['like', 'price', $this->price],
            ['like', 'amount', $this->amount]
        ]);

        return $dataProvider;
    }
}