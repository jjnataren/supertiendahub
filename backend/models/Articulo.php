<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_articulo".
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
 * @property double $utilidad_ml
 * @property double $utilidad_ps
 * @property int $existencia_ml
 * @property int $existencia_ps
 * @property string $utilidad_monto_ml
 * @property string $utilidad_monto_ps
 * @property int $tipo_utilidad_ml
 * @property int $tipo_utilidad_ps
 * @property int $comision_ml
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku'], 'required'],
            [['precio', 'peso', 'alto', 'largo', 'ancho', 'utilidad_ml', 'utilidad_ps', 'utilidad_monto_ml', 'utilidad_monto_ps'], 'number'],
            [['almacen', 'existencia', 'disponible', 'id_usuario_modifico', 'id_snap', 'existencia_ml', 'existencia_ps', 'tipo_utilidad_ml', 'tipo_utilidad_ps', 'comision_ml'], 'integer'],
            [['ultima_modificacion'], 'safe'],
            [['sku', 'sku_fabricante', 'seccion', 'linea', 'marca', 'serie'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 300],
            [['moneda'], 'string', 'max' => 45],
            [['sku'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
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
            'utilidad_ml' => 'Utilidad Ml',
            'utilidad_ps' => 'Utilidad Ps',
            'existencia_ml' => 'Existencia Ml',
            'existencia_ps' => 'Existencia Ps',
            'utilidad_monto_ml' => 'Utilidad Monto Ml',
            'utilidad_monto_ps' => 'Utilidad Monto Ps',
            'tipo_utilidad_ml' => 'Tipo Utilidad Ml',
            'tipo_utilidad_ps' => 'Tipo Utilidad Ps',
            'comision_ml' => 'Comision',
        ];
    }
}
