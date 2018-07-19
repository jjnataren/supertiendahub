<?php

namespace backend\models;

/**
 * This is the model class for table "tbl_articulo_prestashop".
 *
 * @property string $sku
 * @property string $id_prestashop
 * @property string $marca
 * @property string $serie
 * @property double $precio
 * @property int $cambio
 * @property double $precio_original
 * @property int $tipo_cambio
 */
class ArticuloPrestashop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_articulo_prestashop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'id_prestashop', 'precio', 'cambio', 'precio_original'], 'required'],
            [['precio', 'cambio', 'tipo_cambio'], 'number'],
            [['sku', 'id_prestashop', 'marca', 'serie'], 'string', 'max' => 200],
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
            'id_prestashop' => 'Id Prestashop',
            'marca' => 'Marca',
            'serie' => 'Serie',
            'precio' => 'Precio',
            'cambio' => 'Cambio',
            'precio_original' => 'Precio Original',
            'tipo_cambio' => 'Tipo de Cambio',
        ];
    }
}
