<?php

namespace app\modules\monitoreo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\monitoreo\models\Modelo;

/**
 * SearchModelo represents the model behind the search form of `app\modules\monitoreo\models\Modelo`.
 */
class SearchModelo extends Modelo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'marca'], 'integer'],
            [['modelo'], 'safe'],
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
        $query = Modelo::find();

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
            'marca' => $this->marca,
        ]);

        $query->andFilterWhere(['like', 'modelo', $this->modelo]);

        return $dataProvider;
    }
}
