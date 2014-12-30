<?php

namespace app\models\search;

use app\models\Profile;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public $company;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_id', 'role_id', 'created_at'], 'integer'],
            [['email', 'company'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();
        $query->joinWith(['profile']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['company'] = [
            'asc'  => [Profile::tableName() . '.company' => SORT_ASC],
            'desc' => [Profile::tableName() . '.company' => SORT_DESC],
        ];

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status_id'  => $this->status_id,
            'role_id'    => $this->role_id,
            'created_at' => $this->created_at,
        ]);

        $query
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', Profile::tableName() . '.company', $this->company]);

        return $dataProvider;
    }
}
