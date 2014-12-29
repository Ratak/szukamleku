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
            [['id', 'status'], 'integer'],
            [['name', 'name_international', 'name_pharmaceutical', 'chemical_components', 'release_form', 'dosage', 'quantity_in_package', 'manufacturer'], 'safe'],
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
        $query = Drug::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_international', $this->name_international])
            ->andFilterWhere(['like', 'name_pharmaceutical', $this->name_pharmaceutical])
            ->andFilterWhere(['like', 'chemical_components', $this->chemical_components])
            ->andFilterWhere(['like', 'release_form', $this->release_form])
            ->andFilterWhere(['like', 'dosage', $this->dosage])
            ->andFilterWhere(['like', 'quantity_in_package', $this->quantity_in_package])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer]);

        return $dataProvider;
    }
}
