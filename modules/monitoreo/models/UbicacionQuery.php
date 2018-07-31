<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Ubicacion]].
 *
 * @see Ubicacion
 */
class UbicacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ubicacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ubicacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
