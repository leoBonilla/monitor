<?php

namespace app\modules\areaclientes\models;

/**
 * This is the ActiveQuery class for [[TicketMensaje]].
 *
 * @see TicketMensaje
 */
class TicketMensajeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketMensaje[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketMensaje|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
