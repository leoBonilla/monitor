<?php

namespace app\modules\areaclientes\models;

use Yii;

/**
 * This is the model class for table "ticket_estado".
 *
 * @property int $id
 * @property string $estado
 *
 * @property TicketHistorial[] $ticketHistorials
 */
class TicketEstado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'string', 'max' => 100],
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
    public function getTicketHistorials()
    {
        return $this->hasMany(TicketHistorial::className(), ['estado_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketEstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketEstadoQuery(get_called_class());
    }
}
