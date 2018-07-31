<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Himpresora]].
 *
 * @see Himpresora
 */
class HimpresoraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Himpresora[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Himpresora|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
