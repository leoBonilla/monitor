<?php

namespace app\modules\tickets\models;

use Yii;

/**
 * This is the model class for table "ticket_notas".
 *
 * @property int $id
 * @property string $nota
 * @property int $user_id
 * @property string $fecha_creacion
 * @property int $ticket_id
 */
class TicketNota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nota', 'user_id', 'fecha_creacion', 'ticket_id'], 'required'],
            [['user_id', 'ticket_id'], 'integer'],
            [['fecha_creacion'], 'safe'],
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
            'nota' => 'Nota',
            'user_id' => 'User ID',
            'fecha_creacion' => 'Fecha Creacion',
            'ticket_id' => 'Ticket ID',
        ];
    }
}
