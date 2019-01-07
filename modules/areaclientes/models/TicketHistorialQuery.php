<?php

namespace app\modules\areaclientes\models;

/**
 * This is the ActiveQuery class for [[TicketHistorial]].
 *
 * @see TicketHistorial
 */
class TicketHistorialQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketHistorial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketHistorial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
