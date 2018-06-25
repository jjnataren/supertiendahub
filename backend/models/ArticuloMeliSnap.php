<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_articulo_meli_snap".
 *
 * @property int $id
 * @property string $fecha_creacion
 * @property string $nombre
 * @property string $descripcion
 * @property string $data
 * @property int $disponible
 * @property int $actual
 * @property int $numero_registros
 */
class ArticuloMeliSnap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_articulo_meli_snap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_creacion'], 'safe'],
            [['data'], 'string'],
            [['disponible', 'actual', 'numero_registros'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_creacion' => 'Fecha Creacion',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'data' => 'Data',
            'disponible' => 'Disponible',
            'actual' => 'Actual',
            'numero_registros' => 'Numero Registros',
        ];
    }
}
