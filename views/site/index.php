<?php

/* @var $this yii\web\View */

use webvimark\modules\UserManagement\models\User;



$this->title = 'Kropsys admin';
?>
<div class="col-md-12" style="margin-top: 70px;">
<div class="site-index">


 

<div class="row" >
     <?php if(User::hasPermission('monitoreoImpresoras')) :?> 
  <div class="col-xs-6 col-md-3 col-lg-2">
    <div href="" class="thumbnail">
     <a href="<?php echo 'index.php?r=monitoreo/default' ?>"> <img src="assets/images/impresora.jpg" alt="impresoras"></a>
      <div class="caption">
          <h4>Administrar impresoras</h4>
          <p><a href="<?php echo 'index.php?r=monitoreo/default' ?>" class="btn btn-success" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div>
  </div>
  <?php endif; ?>
   <?php if(User::hasPermission('adminUsers')) :?> 
    <div class="col-xs-6 col-md-3 col-lg-2">
    <div href="#" class="thumbnail">
      <a href="<?php echo 'index.php?r=user-management/user' ?>"><img src="assets/images/users.png" alt="usuarios" ></a>
      <div class="caption">
          <h4>Usuarios</h4>
          <p><a href="<?php echo 'index.php?r=user-management/user' ?>" class="btn btn-primary" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div>
  </div>
  <?php endif; ?>
     <?php if(User::hasPermission('adminUsers')) :?> 
    <div class="col-xs-6 col-md-3 col-lg-2">
    <div href="#" class="thumbnail">
      <a href="<?php echo 'index.php?r=monitoreo/centro' ?>"><img src="assets/images/centro-costo.png" alt="usuarios" ></a>
      <div class="caption">
          <h4>Centros de costos</h4>
          <p><a href="<?php echo 'index.php?r=monitoreo/centro' ?>" class="btn btn-warning" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
</div>


<!--  <?php
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

echo GhostMenu::widget([
    'encodeLabels'=>false,
    'activateParents'=>true,
    'items' => [
        [
            'label' => 'Backend routes',
            'items'=>UserManagementModule::menuItems()
        ],
        [
            'label' => 'Frontend routes',
            'items'=>[
                ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
            ],
        ],
    ],
]);
?> -->


</div>