<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "historial_impresora".
 *
 * @property int $id
 * @property int $id_tecnico
 * @property string $detalle
 * @property int $estado
 * @property string $fecha
 * @property int $id_impresora
 *
 * @property Impresoras $impresora
 * @property User $tecnico
 */
class Himpresora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historial_impresora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tecnico', 'estado', 'id_impresora'], 'required'],
            [['id_tecnico', 'estado', 'id_impresora'], 'integer'],
            [['detalle'], 'string'],
            [['fecha'], 'safe'],
            [['id_impresora'], 'exist', 'skipOnError' => true, 'targetClass' => Impresoras::className(), 'targetAttribute' => ['id_impresora' => 'id']],
            [['id_tecnico'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_tecnico' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpresora()
    {
        return $this->hasOne(Impresoras::className(), ['id' => 'id_impresora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTecnico()
    {
        return $this->hasOne(User::className(), ['id' => 'id_tecnico']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado']);
    }

    /**
     * {@inheritdoc}
     * @return HimpresoraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HimpresoraQuery(get_called_class());
    }
}
