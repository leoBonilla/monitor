<?php

/* @var $this yii\web\View */

use webvimark\modules\UserManagement\models\User;



$this->title = 'Kropsys admin';
?>
<div class="col-md-12" >
<div class="site-index">


 

<div class="row" >
     <?php if(User::hasPermission('monitoreoImpresoras')) :?> 
  <div class="col-xs-6 col-md-3 col-lg-2">
<!--     <div href="" class="thumbnail">
     <a href="<?php echo 'index.php?r=monitoreo/default' ?>"> <img src="assets/images/impresora.jpg" alt="impresoras"></a>
      <div class="caption">
          <h4>Administrar impresoras</h4>
          <p><a href="<?php echo 'index.php?r=monitoreo/default' ?>" class="btn btn-success" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div> -->
    <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Administrador de impresoras</h3>
  </div>
  <div class="panel-body">
    <i class="fa fa-print fa-4x" style="color: orange;"></i>
    <p><a href="<?php echo 'index.php?r=monitoreo/default' ?>" class="btn btn-success pull-right" role="button"><i class="fa fa-send"></i> Ir</a></p>
  </div>
</div>
  </div>
  <?php endif; ?>
   <?php if(User::hasPermission('adminUsers')) :?> 
    <div class="col-xs-6 col-md-3 col-lg-2">
<!--     <div href="#" class="thumbnail">
      <a href="<?php echo 'index.php?r=user-management/user' ?>"><img src="assets/images/users.png" alt="usuarios" ></a>
      <div class="caption">
          <h4>Usuarios</h4>
          <p><a href="<?php echo 'index.php?r=user-management/user' ?>" class="btn btn-primary" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div> -->
       <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Administrador de usuarios</h3>
  </div>
  <div class="panel-body">
    <i class="fa fa-users fa-4x" style="color: orange;"></i>
    <p><a href="<?php echo 'index.php?r=user-management/user' ?>" class="btn btn-success pull-right" role="button"><i class="fa fa-send"></i> Ir</a></p>
  </div>
</div>
  </div>
  <?php endif; ?>
     <?php if(User::hasPermission('adminUsers')) :?> 
   <div class="col-xs-6 col-md-3 col-lg-2">
<!--     <div href="#" class="thumbnail">
      <a href="<?php echo 'index.php?r=monitoreo/centro' ?>"><img src="assets/images/centro-costo.png" alt="usuarios" ></a>
      <div class="caption">
          <h4>Centros de costos</h4>
          <p><a href="<?php echo 'index.php?r=monitoreo/centro' ?>" class="btn btn-warning" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div> -->
           <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Administrador de centros de c. </h3>
  </div>
  <div class="panel-body">
    <i class="fa fa-usd fa-4x" style="color: orange;"></i>
    <p><a href="<?php echo 'index.php?r=monitoreo/centro' ?>" class="btn btn-success pull-right" role="button"><i class="fa fa-send"></i> Ir</a></p>
  </div>
</div>
  </div>
  <?php endif; ?>



<!--    <div class="col-xs-6 col-md-3 col-lg-2">
    <div href="#" class="thumbnail">
      <a href="<?php echo 'index.php?r=dashboard/default' ?>"><img src="assets/images/centro-costo.png" alt="usuarios" ></a>
      <div class="caption">
          <h4>Centros de costos</h4>
          <p><a href="<?php echo 'index.php?r=dashboard/default' ?>" class="btn btn-warning" role="button"><i class="fa fa-send"></i> Ir</a></p>
      </div>
    </div>
           <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Tareas</h3>
  </div>
  <div class="panel-body">
    <i class="fa fa-tasks fa-4x" style="color: orange;"></i>
    <p><a href="<?php echo 'index.php?r=dashboard/default' ?>" class="btn btn-success pull-right" role="button"><i class="fa fa-send"></i> Ir</a></p>
  </div>
</div>
  </div> -->


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