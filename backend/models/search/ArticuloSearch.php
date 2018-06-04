<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Articulo;

/**
 * ArticuloSearch represents the model behind the search form about `backend\models\Articulo`.
 */
class ArticuloSearch extends Articulo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'descripcion', 'sku_fabricante', 'seccion', 'linea', 'marca', 'serie', 'moneda', 'ultima_modificacion'], 'safe'],
            [['precio', 'peso', 'alto', 'largo', 'ancho'], 'number'],
            [['almacen', 'existencia', 'disponible', 'id_usuario_modifico', 'id_snap'], 'integer'],
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
        $query = Articulo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'precio' => $this->precio,
            'peso' => $this->peso,
            'alto' => $this->alto,
            'largo' => $this->largo,
            'ancho' => $this->ancho,
            'almacen' => $this->almacen,
            'existencia' => $this->existencia,
            'disponible' => $this->disponible,
            'ultima_modificacion' => $this->ultima_modificacion,
            'id_usuario_modifico' => $this->id_usuario_modifico,
            'id_snap' => $this->id_snap,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'sku_fabricante', $this->sku_fabricante])
            ->andFilterWhere(['like', 'seccion', $this->seccion])
            ->andFilterWhere(['like', 'linea', $this->linea])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'moneda', $this->moneda]);

        return $dataProvider;
    }
}
