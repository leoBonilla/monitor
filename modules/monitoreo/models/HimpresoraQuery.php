<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[HImpresora]].
 *
 * @see HImpresora
 */
class HImpresoraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HImpresora[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HImpresora|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
