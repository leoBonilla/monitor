<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $id
 * @property string $titulo
 * @property string $nota
 * @property int $user_id
 * @property string $fecha_creacion
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'nota', 'user_id', 'fecha_creacion'], 'required'],
            [['user_id'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['titulo'], 'string', 'max' => 256],
            [['nota'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'nota' => 'Nota',
            'user_id' => 'User ID',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NotasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotasQuery(get_called_class());
    }
}
