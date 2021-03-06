<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Newsletters;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class NewslettersSearch extends Newsletters
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
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
        $query = Newsletters::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
                'id' => $this->id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
              ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
