<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Marca]].
 *
 * @see Marca
 */
class MarcaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Marca[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Marca|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
