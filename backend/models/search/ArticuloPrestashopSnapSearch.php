<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ArticuloPrestashopSnap;

/**
 * ArticuloPrestashopSnapSearch represents the model behind the search form about `backend\models\ArticuloPrestashopSnap`.
 */
class ArticuloPrestashopSnapSearch extends ArticuloPrestashopSnap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'disponible', 'actual', 'numero_registros'], 'integer'],
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
        $query = ArticuloPrestashopSnap::find();

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
            'actual' => $this->actual,
            'numero_registros' => $this->numero_registros,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
