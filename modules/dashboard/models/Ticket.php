<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $impresora_id
 * @property string $fecha
 * @property string $mensaje
 * @property int $prioridad
 * @property string $correo
 * @property string $numero
 * @property string $nombre
 *
 * @property Impresoras $impresora
 * @property TicketHistorial[] $ticketHistorials
 * @property TicketMensaje[] $ticketMensajes
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['impresora_id', 'fecha'], 'required'],
            [['impresora_id', 'prioridad'], 'integer'],
            [['fecha'], 'safe'],
            [['mensaje'], 'string'],
            [['correo', 'numero'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 200],
            [['impresora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Impresoras::className(), 'targetAttribute' => ['impresora_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'impresora_id' => 'Impresora ID',
            'fecha' => 'Fecha',
            'mensaje' => 'Mensaje',
            'prioridad' => 'Prioridad',
            'correo' => 'Correo',
            'numero' => 'Numero',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpresora()
    {
        return $this->hasOne(Impresoras::className(), ['id' => 'impresora_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketHistorials()
    {
        return $this->hasMany(TicketHistorial::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketMensajes()
    {
        return $this->hasMany(TicketMensaje::className(), ['ticket_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }
}
