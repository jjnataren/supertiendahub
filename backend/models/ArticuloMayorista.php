<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_articulo_mayorista".
 *
 * @property string $sku
 * @property string $descripcion
 * @property string $sku_fabricante
 * @property string $seccion
 * @property string $linea
 * @property string $marca
 * @property string $serie
 * @property string $precio
 * @property double $peso
 * @property double $alto
 * @property double $largo
 * @property double $ancho
 * @property string $moneda
 * @property int $almacen
 * @property int $existencia
 * @property int $disponible
 * @property string $ultima_modificacion
 * @property int $id_usuario_modifico
 * @property int $id_snap
 */
class ArticuloMayorista extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_articulo_mayorista';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku'], 'required'],
            [['precio', 'peso', 'alto', 'largo', 'ancho'], 'number'],
            [['almacen', 'existencia', 'disponible', 'id_usuario_modifico', 'id_snap'], 'integer'],
            [['ultima_modificacion'], 'safe'],
            [['sku', 'sku_fabricante', 'seccion', 'linea', 'marca', 'serie'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 300],
            [['moneda'], 'string', 'max' => 45],
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
            'descripcion' => 'Descripcion',
            'sku_fabricante' => 'Sku Fabricante',
            'seccion' => 'Seccion',
            'linea' => 'Linea',
            'marca' => 'Marca',
            'serie' => 'Serie',
            'precio' => 'Precio',
            'peso' => 'Peso',
            'alto' => 'Alto',
            'largo' => 'Largo',
            'ancho' => 'Ancho',
            'moneda' => 'Moneda',
            'almacen' => 'Almacen',
            'existencia' => 'Existencia',
            'disponible' => 'Disponible',
            'ultima_modificacion' => 'Ultima Modificacion',
            'id_usuario_modifico' => 'Id Usuario Modifico',
            'id_snap' => 'Id Snap',
        ];
    }
}
