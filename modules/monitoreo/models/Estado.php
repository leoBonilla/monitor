<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $id
 * @property string $estado
 *
 * @property HistorialImpresora[] $historialImpresoras
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialImpresoras()
    {
        return $this->hasMany(HistorialImpresora::className(), ['estado' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoQuery(get_called_class());
    }
}
