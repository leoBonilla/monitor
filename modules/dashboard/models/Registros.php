<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "reporte_registros_v1".
 *
 * @property int $id
 * @property int $id_tecnico
 * @property string $detalle
 * @property int $estado
 * @property string $fecha
 * @property int $id_impresora
 * @property string $n_registro
 * @property int $tipo
 * @property string $adjunto
 * @property int $id_incidente
 * @property string $actualizacion
 * @property string $serie
 * @property string $modelo
 * @property string $marca
 * @property string $nom_cc
 * @property string $username
 * @property string $estado_
 * @property string $incidente
 */
class Registros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reporte_registros_v1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tecnico', 'estado', 'id_impresora', 'tipo', 'id_incidente'], 'integer'],
            [['id_tecnico', 'estado', 'id_impresora', 'n_registro', 'tipo', 'serie', 'modelo', 'marca', 'nom_cc', 'username', 'estado_', 'incidente'], 'required'],
            [['detalle'], 'string'],
            [['fecha', 'actualizacion'], 'safe'],
            [['n_registro', 'serie', 'modelo', 'marca', 'estado_'], 'string', 'max' => 30],
            [['adjunto', 'incidente'], 'string', 'max' => 100],
            [['nom_cc'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tecnico' => 'Id Tecnico',
            'detalle' => 'Detalle',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
            'id_impresora' => 'Id Impresora',
            'n_registro' => 'N Registro',
            'tipo' => 'Tipo',
            'adjunto' => 'Adjunto',
            'id_incidente' => 'Id Incidente',
            'actualizacion' => 'Actualizacion',
            'serie' => 'Serie',
            'modelo' => 'Modelo',
            'marca' => 'Marca',
            'nom_cc' => 'Nom Cc',
            'username' => 'Username',
            'estado_' => 'Estado',
            'incidente' => 'Incidente',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReporteRegistrosV1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new ReporteRegistrosV1Query(get_called_class());
    }
}
