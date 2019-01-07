<?php

namespace app\modules\areaclientes\models;

/**
 * This is the ActiveQuery class for [[TicketEstado]].
 *
 * @see TicketEstado
 */
class TicketEstadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketEstado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketEstado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
