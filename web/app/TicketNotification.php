<?php

namespace app\notificaciones;

use Yii;
use webzop\notifications\Notification;

class TicketNotification extends Notification
{
 const KEY_NEW_TICKET = 'new_ticket';

  //const KEY_RESET_PASSWORD = 'reset_password';

/**
 * @var \yii\web\User the user object
 */
 public $user;

/**
 * @inheritdoc
 */
 public function getTitle(){
 switch($this->key){
       case self::KEY_NEW_TICKET:
 			return Yii::t('app', 'Nuevo ticket asignado', ['users' => '#'.$this->user->id]);
 // case self::KEY_RESET_PASSWORD:
 // return Yii::t('app', 'Instructions to reset the password');
 }
 }

/**
 * @inheritdoc
 */
 public function getRoute(){
 return ['/users/edit', 'id' => $this->user->id];
 }
}
?>