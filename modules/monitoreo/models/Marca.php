<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property int $id
 * @property string $marca
 *
 * @property Modelo[] $modelos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca'], 'required'],
            [['marca'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marca' => 'Marca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['marca' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MarcaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MarcaQuery(get_called_class());
    }
}
