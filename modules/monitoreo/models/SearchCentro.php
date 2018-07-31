<?php

namespace app\modules\monitoreo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\monitoreo\models\Centro;

/**
 * SearchCentro represents the model behind the search form of `app\modules\monitoreo\models\Centro`.
 */
class SearchCentro extends Centro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_cc', 'estado_cc'], 'integer'],
            [['nom_cc'], 'safe'],
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
        $query = Centro::find();

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
            'cod_cc' => $this->cod_cc,
            'estado_cc' => $this->estado_cc,
        ]);

        $query->andFilterWhere(['like', 'nom_cc', $this->nom_cc]);

        return $dataProvider;
    }
}
