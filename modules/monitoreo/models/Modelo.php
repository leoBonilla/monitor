<?php

namespace app\modules\monitoreo\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $id
 * @property string $modelo
 * @property int $marca
 *
 * @property Marca $marca0
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modelo', 'marca'], 'required'],
            [['marca'], 'integer'],
            [['modelo'], 'string', 'max' => 30],
            [['marca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['marca' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modelo' => 'Modelo',
            'marca' => 'Marca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca0()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca']);
    }

    /**
     * {@inheritdoc}
     * @return ModeloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModeloQuery(get_called_class());
    }
}
