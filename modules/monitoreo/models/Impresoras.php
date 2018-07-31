<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "impresoras".
 *
 * @property int $id
 * @property string $serie
 * @property string $codigo
 * @property int $modelo
 * @property int $centro_costo
 * @property string $contacto
 * @property string $telefono
 * @property string $email
 * @property string $observaciones
 * @property int $estado
 * @property string $ubicacion
 * @property string $oficina
 * @property string $piso
 * @property string $fecha
 * @property int $deshabilitada
 *
 * @property HistorialImpresora[] $historialImpresoras
 * @property Centro $centroCosto
 * @property Modelo $modelo0
 */
class Impresoras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'impresoras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serie', 'codigo', 'modelo', 'centro_costo', 'fecha', 'deshabilitada'], 'required'],
            [['modelo', 'centro_costo', 'estado', 'deshabilitada'], 'integer'],
            [['observaciones'], 'string'],
            [['fecha'], 'safe'],
            [['serie', 'codigo', 'telefono', 'piso'], 'string', 'max' => 30],
            [['contacto', 'email', 'oficina'], 'string', 'max' => 100],
            [['ubicacion'], 'string', 'max' => 300],
            [['centro_costo'], 'exist', 'skipOnError' => true, 'targetClass' => Centro::className(), 'targetAttribute' => ['centro_costo' => 'cod_cc']],
            [['modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['modelo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serie' => 'Serie',
            'codigo' => 'Codigo',
            'modelo' => 'Modelo',
            'centro_costo' => 'Centro Costo',
            'contacto' => 'Contacto',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'observaciones' => 'Observaciones',
            'estado' => 'Estado',
            'ubicacion' => 'Ubicacion',
            'oficina' => 'Oficina',
            'piso' => 'Piso',
            'fecha' => 'Fecha',
            'deshabilitada' => 'Deshabilitada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialImpresoras()
    {
        return $this->hasMany(HistorialImpresora::className(), ['id_impresora' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroCosto()
    {
        return $this->hasOne(Centro::className(), ['cod_cc' => 'centro_costo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo0()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'modelo']);
    }

    /**
     * {@inheritdoc}
     * @return ImpresorasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImpresorasQuery(get_called_class());
    }
}
