<?php

namespace app\modules\asunto\models;

use Yii;

/**
 * This is the model class for table "tipo".
 *
 * @property int $id
 * @property int $grupo
 * @property string $tipo
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grupo'], 'integer'],
            [['tipo'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grupo' => 'Grupo',
            'tipo' => 'Tipo',
        ];
    }
}
