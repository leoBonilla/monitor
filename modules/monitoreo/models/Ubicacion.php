<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "ubicacion".
 *
 * @property int $id
 * @property string $ubicacion
 * @property string $oficina
 * @property string $piso
 * @property int $impresora
 * @property string $fecha
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ubicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubicacion', 'impresora'], 'required'],
            [['impresora'], 'integer'],
            [['fecha'], 'safe'],
            [['ubicacion'], 'string', 'max' => 300],
            [['oficina'], 'string', 'max' => 100],
            [['piso'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ubicacion' => 'Ubicacion',
            'oficina' => 'Oficina',
            'piso' => 'Piso',
            'impresora' => 'Impresora',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UbicacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UbicacionQuery(get_called_class());
    }
}
