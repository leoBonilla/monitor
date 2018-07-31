<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Centro]].
 *
 * @see Centro
 */
class CentroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Centro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Centro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
