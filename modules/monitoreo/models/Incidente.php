<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "incidente".
 *
 * @property int $id
 * @property string $nombre
 */
class Incidente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incidente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IncidenteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IncidenteQuery(get_called_class());
    }
}
