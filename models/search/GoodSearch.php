<?php

namespace app\models\search;

use app\models\Good;
use yii\data\ActiveDataProvider;

class GoodSearch extends Good
{
    public function rules()
    {
        return [
            [['id', 'price', 'amount', 'category_id'], 'number'],
            [['description', 'status', 'title'], 'string', 'max' => 255]
        ];
    }

    public function search(array $params)
    {
        $query = self::find()->active()->with(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 21
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}