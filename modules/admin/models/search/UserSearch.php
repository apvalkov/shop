<?php

namespace app\modules\admin\models\search;

use app\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public $createdStart;

    public $createdEnd;

    public $updatedStart;

    public $updatedEnd;

    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['createdStart', 'createdEnd', 'updatedEnd', 'updatedStart'], 'datetime', 'format' => 'php:Y-m-d'],
            [['created_at', 'updated_at'], 'safe']
        ];
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
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['between', 'created_at', $this->createdStart, $this->createdEnd])
            ->andFilterWhere(['between', 'updated_at', $this->updatedStart, $this->updatedEnd]);

        return $dataProvider;
    }

}