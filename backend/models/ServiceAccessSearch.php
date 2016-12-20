<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServiceAccess;

/**
 * ServiceAccessSearch represents the model behind the search form about `backend\models\ServiceAccess`.
 */
class ServiceAccessSearch extends ServiceAccess
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'id1', 'id2', 'id3'], 'integer'],
            [['pw1', 'pw2', 'pw3'], 'safe'],
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
        $query = ServiceAccess::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'id1' => $this->id1,
            'id2' => $this->id2,
            'id3' => $this->id3,
        ]);

        $query->andFilterWhere(['like', 'pw1', $this->pw1])
            ->andFilterWhere(['like', 'pw2', $this->pw2])
            ->andFilterWhere(['like', 'pw3', $this->pw3]);

        return $dataProvider;
    }
}
