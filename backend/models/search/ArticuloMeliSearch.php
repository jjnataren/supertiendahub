<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ArticuloMeli;

/**
 * ArticuloMeliSearch represents the model behind the search form about `backend\models\ArticuloMeli`.
 */
class ArticuloMeliSearch extends ArticuloMeli
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'id_meli', 'marca', 'serie'], 'safe'],
            [['precio'], 'number'],
            [['cambio'], 'integer'],
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
        $query = ArticuloMeli::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'precio' => $this->precio,
            'cambio' => $this->cambio,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'id_meli', $this->id_meli])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'serie', $this->serie]);

        return $dataProvider;
    }
}
