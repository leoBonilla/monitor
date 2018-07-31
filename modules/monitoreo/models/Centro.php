<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "centro".
 *
 * @property int $cod_cc
 * @property string $nom_cc
 * @property int $estado_cc
 *
 * @property Impresoras[] $impresoras
 */
class Centro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_cc', 'nom_cc', 'estado_cc'], 'required'],
            [['cod_cc', 'estado_cc'], 'integer'],
            [['nom_cc'], 'string', 'max' => 50],
            [['cod_cc'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cod_cc' => 'Cod Cc',
            'nom_cc' => 'Nom Cc',
            'estado_cc' => 'Estado Cc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpresoras()
    {
        return $this->hasMany(Impresoras::className(), ['centro_costo' => 'cod_cc']);
    }

    /**
     * {@inheritdoc}
     * @return CentroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CentroQuery(get_called_class());
    }
}
