<?php

namespace app\modules\tareas\models;

use Yii;

/**
 * This is the model class for table "gmail_message".
 *
 * @property int $id
 * @property string $email_id
 * @property string $subject
 * @property string $from_
 * @property string $snippet
 * @property string $body
 * @property int $asignada
 *
 * @property User $asignada0
 */
class GmailMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gmail_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_id', 'subject', 'from_'], 'required'],
            [['body'], 'string'],
            [['asignada'], 'integer'],
            [['email_id'], 'string', 'max' => 20],
            [['subject', 'from_'], 'string', 'max' => 300],
            [['snippet'], 'string', 'max' => 5000],
            [['asignada'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['asignada' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_id' => 'Email ID',
            'subject' => 'Subject',
            'from_' => 'From',
            'snippet' => 'Snippet',
            'body' => 'Body',
            'asignada' => 'Asignada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignada0()
    {
        return $this->hasOne(User::className(), ['id' => 'asignada']);
    }

    /**
     * {@inheritdoc}
     * @return GmailMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GmailMessageQuery(get_called_class());
    }
}
