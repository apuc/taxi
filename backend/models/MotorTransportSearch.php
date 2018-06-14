<?php

namespace backend\models;

use backend\models\MotorTransport;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * MotorTransportSearch represents the model behind the search form of `app\models\MotorTransport`.
 */
class MotorTransportSearch extends MotorTransport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'year', 'status', 'dt_add'], 'integer'],
            [['brand', 'model', 'photo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MotorTransport::find();

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
            'year' => $this->year,
            'status' => $this->status,
            'dt_add' => $this->dt_add,
        ]);

        $query->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
