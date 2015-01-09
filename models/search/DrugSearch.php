<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Drug;

/**
 * DrugSearch represents the model behind the search form about `app\models\Drug`.
 */
class DrugSearch extends Drug
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status_id', 'integer'],
            [['name', 'release_form', 'manufacturer'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = Drug::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status_id'    => $this->status_id,
            'release_form' => $this->release_form,
        ]);

        $query
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'name_international', $this->name])
            ->orFilterWhere(['like', 'name_pharmaceutical', $this->name]);

        return $dataProvider;
    }
}
