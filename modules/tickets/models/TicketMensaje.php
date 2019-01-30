<?php

namespace app\modules\tickets\models;

use Yii;
use app\modules\areaclientes\models\Ticket;
/**
 * This is the model class for table "ticket_mensaje".
 *
 * @property int $id
 * @property string $mensaje
 * @property int $ticket_id
 * @property string $fecha
 * @property int $user_id
 *
 * @property Ticket $ticket
 */
class TicketMensaje extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_mensaje';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensaje'], 'string'],
            [['ticket_id', 'fecha'], 'required'],
            [['ticket_id', 'user_id'], 'integer'],
            [['fecha'], 'safe'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mensaje' => 'Mensaje',
            'ticket_id' => 'Ticket ID',
            'fecha' => 'Fecha',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }
}
