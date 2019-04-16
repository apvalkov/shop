<?php

namespace app\models\search;

use app\models\User;
use yii\data\ActiveDataProvider;

/**
 * Class UserSearch
 */
class UserSearch extends User
{
    public function rules()
    {
        return [
            [['name', 'email', 'id'], 'safe'],
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
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 2,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}