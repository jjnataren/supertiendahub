<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_articulo_meli".
 *
 * @property string $sku
 * @property string $id_meli
 * @property string $marca
 * @property string $serie
 * @property double $precio
 * @property int $cambio
 */
class ArticuloMeli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_articulo_meli';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'id_meli', 'precio', 'cambio'], 'required'],
            [['precio'], 'number'],
            [['cambio'], 'integer'],
            [['sku', 'id_meli', 'marca', 'serie'], 'string', 'max' => 200],
            [['id_meli'], 'unique'],
            [['sku'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sku' => 'Sku',
            'id_meli' => 'Id Meli',
            'marca' => 'Marca',
            'serie' => 'Serie',
            'precio' => 'Precio',
            'cambio' => 'Cambio',
        ];
    }
}
