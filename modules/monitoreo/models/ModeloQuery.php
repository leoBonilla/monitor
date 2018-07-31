<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Modelo]].
 *
 * @see Modelo
 */
class ModeloQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Modelo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Modelo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
