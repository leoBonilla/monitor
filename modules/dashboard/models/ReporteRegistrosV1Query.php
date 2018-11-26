<?php

namespace app\modules\dashboard\models;

/**
 * This is the ActiveQuery class for [[Registros]].
 *
 * @see Registros
 */
class ReporteRegistrosV1Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Registros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Registros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
