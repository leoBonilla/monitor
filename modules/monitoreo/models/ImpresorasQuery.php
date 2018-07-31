<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Impresoras]].
 *
 * @see Impresoras
 */
class ImpresorasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Impresoras[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Impresoras|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
