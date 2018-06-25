<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ArticuloMayoristaSnap;

/**
 * ArticuloMayoristaSnapSearch represents the model behind the search form about `backend\models\ArticuloMayoristaSnap`.
 */
class ArticuloMayoristaSnapSearch extends ArticuloMayoristaSnap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'disponible'], 'integer'],
            [['fecha_creacion', 'nombre', 'descripcion', 'data'], 'safe'],
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
        $query = ArticuloMayoristaSnap::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_creacion' => $this->fecha_creacion,
            'disponible' => $this->disponible,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
