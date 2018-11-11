<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Incidente]].
 *
 * @see Incidente
 */
class IncidenteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Incidente[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Incidente|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
