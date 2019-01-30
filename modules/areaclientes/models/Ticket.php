<?php

namespace app\modules\areaclientes\models;
use app\modules\monitoreo\models\Impresoras;
use app\modules\monitoreo\models\User;
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
 * @property string $ot
 * @property string $asunto
 * @property int $tipo
 * @property int $tecnico
 * @property string $fuente
 *
 * @property Impresoras $impresora
 * @property User $tecnico0
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
    public function behaviors()
{
    return [
        [
            'class' => 'mdm\autonumber\Behavior',
            'attribute' => 'ot', // required
            'value' => 'K'.'?' , // format auto number. '?' will be replaced with generated number
            'digit' => 6 // optional, default to null. 
        ],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['impresora_id', 'fecha'], 'required'],
            [['impresora_id', 'prioridad', 'tipo', 'tecnico'], 'integer'],
            [['fecha'], 'safe'],
            [['mensaje','fuente'], 'string'],
            [['correo', 'numero'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 200],
             [['files'], 'string', 'max' => 2000],
            [['ot','fuente'], 'string', 'max' => 30],
            [['asunto'], 'string', 'max' => 100],
            [['impresora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Impresoras::className(), 'targetAttribute' => ['impresora_id' => 'id']],
            [['tecnico'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['tecnico' => 'id']],
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
            'ot' => 'Ot',
            'asunto' => 'Asunto',
            'tipo' => 'Tipo',
            'tecnico' => 'Tecnico',
            'fuente' => 'Fuente',
            'files' => 'Files',
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
    public function getTecnico0()
    {
        return $this->hasOne(User::className(), ['id' => 'tecnico']);
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
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsunto()
    {
        return $this->hasOne(Tipo::className(), ['id' => 'asunto']);
    }
}