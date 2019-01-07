<?php

namespace app\modules\areaclientes\models;

use Yii;

/**
 * This is the model class for table "ticket_mensaje".
 *
 * @property int $id
 * @property string $mensaje
 * @property int $ticket_id
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
            [['id', 'ticket_id'], 'required'],
            [['id', 'ticket_id'], 'integer'],
            [['mensaje'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketMensajeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketMensajeQuery(get_called_class());
    }
}
