<?php

namespace app\modules\asunto\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\asunto\models\Tipo;

/**
 * TipoSearch represents the model behind the search form of `app\modules\asunto\models\Tipo`.
 */
class TipoSearch extends Tipo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'grupo'], 'integer'],
            [['tipo'], 'safe'],
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
        $query = Tipo::find();

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
            'grupo' => $this->grupo,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
