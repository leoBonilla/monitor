<?php

namespace app\modules\areaclientes\models;
use app\modules\monitoreo\models\User;
use Yii;

/**
 * This is the model class for table "ticket_historial".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $estado_id
 * @property int $user_id
 * @property string $fecha
 *
 * @property Ticket $ticket
 * @property TicketEstado $estado
 * @property User $user
 */
class TicketHistorial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_historial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'estado_id', 'fecha'], 'required'],
            [['ticket_id', 'estado_id', 'user_id'], 'integer'],
            [['fecha'], 'safe'],
            [['observacion'], 'string'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketEstado::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'estado_id' => 'Estado ID',
            'user_id' => 'User ID',
            'fecha' => 'Fecha',
            'observacion' => 'Observacion'
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
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(TicketEstado::className(), ['id' => 'estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketHistorialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketHistorialQuery(get_called_class());
    }
}
