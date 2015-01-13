<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\form\PostForm;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class PostsSearch extends PostForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'string'],
            [['content', 'file', 'file_x', 'file_y', 'file_w', 'file_h'], 'string'],

            [['file_x', 'file_y', 'file_w', 'file_h'], 'integer'],

            [['language_id', 'user_id', 'updated_at', 'created_at'], 'integer'],
            [['slug', 'meta_keys', 'meta_desc', 'meta_title'], 'string', 'max' => 255],
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
        $query = PostForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
                'id' => $this->id,
                'language_id' => $this->language_id,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'file' => $this->file,
            ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'content', $this->content])
              ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
