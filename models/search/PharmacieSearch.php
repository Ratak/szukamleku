<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pharmacie;

/**
 * PharmacieSearch represents the model behind the search form about `app\models\Pharmacie`.
 */
class PharmacieSearch extends Pharmacie
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'region_id', 'city_id', 'district_id'], 'integer'],
            [['code', 'name', 'phone', 'fax', 'url', 'email', 'address'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Pharmacie::find()->with('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere([
                'id'          => $this->id,
                'user_id'     => $this->user_id,
                'latitude'    => $this->latitude,
                'longitude'   => $this->longitude,
                'region_id'   => $this->region_id,
                'city_id'     => $this->city_id,
                'district_id' => $this->district_id,
            ])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
