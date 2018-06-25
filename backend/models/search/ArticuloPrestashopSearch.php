<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ArticuloPrestashop;

/**
 * ArticuloPrestashopSearch represents the model behind the search form about `backend\models\ArticuloPrestashop`.
 */
class ArticuloPrestashopSearch extends ArticuloPrestashop
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'id_prestashop', 'marca', 'serie'], 'safe'],
            [['precio'], 'number'],
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
        $query = ArticuloPrestashop::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'precio' => $this->precio,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'id_prestashop', $this->id_prestashop])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'serie', $this->serie]);

        return $dataProvider;
    }
}
