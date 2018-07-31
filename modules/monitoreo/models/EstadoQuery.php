<?php

namespace app\modules\monitoreo\models;

/**
 * This is the ActiveQuery class for [[Estado]].
 *
 * @see Estado
 */
class EstadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Estado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Estado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
