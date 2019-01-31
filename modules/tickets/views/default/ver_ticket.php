<?php 
use yii\helpers\Html; 
// here comes your Yii2 asset's class! 
use app\modules\tickets\assets\TicketsAsset; 
use app\modules\areaclientes\models\Tipo;
// now Yii puts your css and javascript files into your view's html. 
TicketsAsset::register($this); 
use kartik\helpers\Enum;
$imp= $ticket->getImpresora()->one(); 
$asunto = $ticket->getAsunto()->one()->tipo;
//var_dump($impresora);
 $historial = $ticket->getTicketHistorials()->where(['ticket_id' => $ticket->id ])->orderBy(['fecha'=>SORT_ASC])->all();
 $ultimo_historial= $ticket->getTicketHistorials()->orderBy('fecha DESC')->one();
 $ultima_asignacion= $ticket->getTicketHistorials()->where(['between','estado_id', 2,3])->orderBy('fecha DESC')->one();
 $asignador = null;
 if($ultima_asignacion != null){
   $asignador = $ultima_asignacion->getAdmin()->one();
 }



 $asignado = '';
 $tecnico = 'SIN ASIGNAR';
 if($ultimo_historial->user_id != null){
 	$tecnico = strtoupper($ultimo_historial->getUser()->one()->name. ' '. $ultimo_historial->getUser()->one()->lastname) ;
 }
 $ultimo_estado = $ultimo_historial->getEstado()->one();

 $cc = $imp->getCentroCosto()->one();
 $model = $imp->getModelo0()->one();
 $marca = $model->getMarca0()->one();
 $accion = '';
 $estado = strtoupper($ultimo_estado->estado);
 $count_files = count($files);
 $count_notas = count($notas);
 $count_files = ($count_files > 0 ) ? '<span class="badge">'.$count_files.'</span>' : '';
 $count_notas = ($count_notas > 0 ) ? '<span class="badge">'.$count_notas.'</span>' : '';

 //var_dump($estado);
 if($estado == 'SIN ASIGNAR'){
 	$accion = "ASIGNAR";
 }else{
 	$accion = 'REASIGNAR';
 }
 $edisponibles = array();

  switch ($ultimo_estado->id) {
  	case '2':
  		$edisponibles = array(
  			'4' => 'EN PROCESO',
        '5' => 'PENDIENTE'
  		);
  		break;
  	case '3' :
  		$edisponibles = array(
  			'4' => 'EN PROCESO',
        '5' => 'PENDIENTE',
  		);
  	    break;
  	case '4' :
  		$edisponibles = array(
  			'5' => 'PENDIENTE',
  			'6' => 'COMPLETADO',
  		);
  	    break;
  	case '5' :
  		$edisponibles = array(
        '4' => 'EN PROCESO',
  			'6' => 'COMPLETADO',
  		);
  	    break;
  	default:
  		# code...
  		break;
  }
?>
<style>
	.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
   /* overflow-y: scroll;
    height: 250px; */
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <input type="hidden" name="fecha_ticket" id="fecha_ticket" value="<?php echo $ticket->fecha; ?>">
<!-- <div class="page-header">
 
</div>

 -->
 <a href="index.php?r=tickets" class="btn btn-warning">Volver</a href="index.php?r=tickets">
 <h2>Ticket #<?php echo $ticket->ot; ?>&nbsp;<small><?php echo $asunto; ?></small> <span class="label label-info pull-right"><?php echo $ultimo_estado->estado; ?></span></h2>

<hr>
<div class="row">
  <div class="col-md-3 ">
    <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">INFORMACIÓN DEL TICKET</h3>
    </div>
    <div class="panel-body">
          <ul class="list-group">
        <li class="list-group-item">ESTADO ACTUAL: <span class="label label-default"><strong><?php echo strtoupper($ultimo_estado->estado); ?></strong></span></li>
        <li class="list-group-item">ASIGNADO A: <span class="span-asignado"><span class="label label-default"><strong><?php echo strtoupper($tecnico); ?></strong></span></span></li>
        <li class="list-group-item">ASIGNADO POR: <span class="span-asignado-por"><span class="label label-default"><strong><?php echo (is_null($asignador)) ? 'SIN ASIGNAR' : strtoupper($asignador->name.' '.$asignador->lastname); ?></strong></span></span></li>
        <li class="list-group-item">FECHA DE APERTURA: <strong><?php echo $ticket->fecha; ?></strong> </li>
        <?php if ($ultimo_estado->id >= 7): ?>
        <li class="list-group-item">FECHA DE CIERRE: <strong><?php echo $ultimo_historial->fecha; ?></strong> </li>
        <?php endif ?>
        <li class="list-group-item">CENTRO DE COSTOS: <strong><?php echo $cc->nom_cc; ?></strong></li>
        <li class="list-group-item">UBICACIÓN: <strong><?php echo $imp->ubicacion; ?></strong></li>
        <li class="list-group-item">EQUIPO:  <strong><?php echo strtoupper($marca->marca .' '.$model->modelo);  ?></strong></li>
        <li class="list-group-item">NUMERO DE SERIE: <strong><?php echo $imp->serie; ?></strong></li>
        <li class="list-group-item">SOLICITANTE: <strong><?php echo strtoupper($ticket->nombre); ?></strong></li>
        <li class="list-group-item">EMAIL: <strong><?php echo strtoupper($ticket->correo); ?></strong></li>
        <li class="list-group-item">TELEFONO: <strong><?php echo $ticket->numero; ?></strong></li>
      </ul>
    </div>
  </div>
  
  </div>
  <div class="col-md-6">
    
  <!--   <div class="panel panel-default" style="min-height: 425px;"> -->
<!--   <div class="panel-heading">
    <h3 class="panel-title">DETALLES</h3>
  </div> -->
 <!--  <div class="panel-body"> -->
    <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home_mensaje"><i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i><span class="hidden-xs">CONVERSACION</span></a></li>
  <li><a data-toggle="tab" href="#adjuntos"><i class="fa fa-paperclip fa-2x" aria-hidden="true"></i> <?php echo $count_files; ?><span class="hidden-xs">ADJUNTOS</span></a></li>
   <li><a data-toggle="tab" href="#notas"><i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i> <span class="hidden-xs">NOTAS</span> <?php echo $count_notas; ?></a></li>

</ul>
<div class="tab-content">
  <div id="home_mensaje" class="tab-pane fade in active">

   <div class="well">
     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
               <!--      <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div> -->
                </div>
            <div class="panel" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                           <img src="images/user-avatar.png" alt="UserAvatar" class="img-circle" height="50px;" style="background-color:#f0f0f0;">
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $ticket->nombre; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php 
                                       echo Enum::timeElapsed($ticket->fecha, true,null,'');
                                        ?></small>
                                </div>
                               <p> <?php echo $ticket->mensaje; ?></p>
                            </div>
                        </li>
                        <?php foreach ($mensajes as $key => $value): ?>
                          <?php if(is_numeric($value->user_id)) :?>
                            <li class="right clearfix"><span class="chat-img pull-right">
                            
                            <img src="images/user-kropsys-avatar.png" alt="UserAvatar" class="img-circle" height="50px;" style="background-color:#f0f0f0;">
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo Enum::timeElapsed($value->fecha, true,null,''); ?></small>
                                    <strong class="pull-right primary-font"><?php echo strtoupper(\Yii::$app->user->identity->name.' '.\Yii::$app->user->identity->lastname); ?></strong>
                                </div>
                                <p>
                                  <?php echo $value->mensaje; ?>
                                </p>
                            </div>
                        </li>
                      <?php else : ?>
                              <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $ticket->nombre; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php echo Enum::timeElapsed($value->fecha, true,null,''); ?></small>
                                </div>
                                <p>
                                    <?php echo $value->mensaje; ?>
                                </p>
                            </div>
                        </li>
                      <?php endif; ?>
                        <?php endforeach ?>
    
                    </ul>
                </div>
                <div class="panel-footer">
                 <?php if ($ultimo_estado->id >= 7): ?>
                  <?php else : ?>
                         <form action="index.php?r=mistickets/default/response" method="post">
                      <input type="hidden" name="ot-ticket" value="<?php echo $ticket->ot; ?>">
            <input type="hidden" name="id-ticket" value="<?php echo $ticket->id; ?>">
                      <input type="hidden" name="return-url" value="<?php echo base64_encode(\Yii::$app->request->getUrl()); ?>">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <div class="form-group">
                     <!--    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Respuesta..." />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                Enviar</button>
                        </span> -->
                      <textarea name="mensaje" id="" cols="30" rows="10" class="form-control"></textarea>

                    </div>
                    <div class="form-group">
                      <button class="btn btn-success">Responder</button>
                    </div>
                  </form>
                 <?php endif ?>

                </div>
            </div>
            </div>
        </div>
    </div>

   </div>

  </div>
    <div id="adjuntos" class="tab-pane fade in ">
      <br>
      <ul class="list-group">
         <?php 
         $count = 1;
         if(!empty($files))
         foreach ($files as $key => $value): ?>
            <li class="list-group-item"><a href="<?php echo $value; ?>" target="_blank">archivo adjunto <?php echo $count; ?></a></li>
        <?php $count++; ?>
         <?php endforeach ?>
       
      </ul>
        
  </div>
    <div id="notas" class="tab-pane fade">
      <br>  
      <ul class="list-group">
         <?php foreach ($notas as $key => $value): ?>
            <li class="list-group-item">
              <?php echo $value->nota; ?>
            </li>
        <?php endforeach ?>
      </ul>
       
  </div>
</div>

  <!-- </div> -->
<!-- </div> -->
  </div>
  <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
                 <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title">GESTIONAR TICKET</h3>
          </div>

          <?php if ($ultimo_estado->id < 7 ): ?>
                <div class="panel-body">
    
    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">ASIGNAR A USUARIO</button>
    <hr> 
    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-nota">AGREGAR NOTA</button>
    <hr>

    <form action="index.php?r=tickets/default/cambiar-estado" class="ajaxform" method="post">
  <label for="asignar">CAMBIAR ESTADO A :</label>
  <input type="hidden" name="ticket-id" value="<?php echo $ticket->id; ?>">
  <input type="hidden" name="ot" value="<?php echo $ticket->ot; ?>">
  <select name="estado" id="estado" class="form-control">
    <option value=""></option>
     <?php foreach ($edisponibles as $key => $value): ?>
       <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
     <?php endforeach ?>
   </select>
  <button type="submit" class="btn btn-success" style="margin-top:5px;"><span class="accion"></span>CAMBIAR ESTADO</button>
    </form>

        <?php if ($ultimo_estado->id == 6): ?>
              <hr>
  <a href="<?php echo 'index.php?r=tickets/ticket/finalizar&ot='.$ticket->ot; ?>" class="btn btn-danger" style="margin-top:5px;"><span class="accion"></span>FINALIZAR</a>
        <?php endif ?>


        </div>
          <?php else : ?>
            <div class="panel-body">
              <div class="alert alert-danger">
                <p>No se pueden realizar acciones sobre este ticket porque ha sido finalizado</p>
              </div>
            </div>
          <?php endif ?>

       </div>
        </div>
      </div>

      <div class="row">
       <div class="col-md-12">
<!--                  <hr>
    <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div> -->
<div class="well">
  <i class="fa fa-clock-o "></i> <span> Tiempo total del ticket</span> <br>
  <?php if ($ultimo_estado->id < 7 ): ?>
  <p><?php echo Enum::timeElapsed($ticket->fecha, false,null,''); ?></p>
  <?php else : ?>
    <p><?php echo Enum::timeElapsed($ticket->fecha, false,$ultimo_historial->fecha,''); ?></p>
  <?php endif; ?>
  
</div>
       </div>
      </div>


  </div>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-ticket fa-2x" aria-hidden="true"></i><span class="hidden-xs">HISTORIAL DEL TICKET</span> </a></li>
  <li class=""><a data-toggle="tab" href="#menu2"><i class="fa fa-ticket fa-2x" aria-hidden="true"></i><span class="hidden-xs">TICKETS ANTERIORES</span> </a></li>
  <li><a data-toggle="tab" href="#menu1"><i class="fa fa-print fa-2x" aria-hidden="true"></i> <span class="hidden-xs">HISTORIAL DEL DISPOSITIVO</span></a></li>

</ul>


<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <br>
   <!-- inicio estado ticket --> 
      <div class="row">
  <div class="col-md-12">
    <table class="datatable-kropsys table-striped table table-condensed table-responsive table-bordered">
      <thead>
        <tr>
          <th>Estado</th>
          <th>Inicio estado</th>
          <th>Fin estado</th>
          <th>Tiempo estado</th>
          <th>Tecnico</th>
          <th>Observacion</th>
        </tr>
      </thead>
      <tbody>

      <?php 
      
      $total = count($historial) - 1;
      $i = 0;
      $j = 0;

foreach ($historial as $key => $value): ?>

        <?php 
        $estado = $value->getEstado()->one(); 
        $uestado =  '<span class="label label-'.$estado->label.'">'.strtoupper($estado->estado).'</span>';
        $tecnico = $value->getUser()->one();
        $temp = '';
        if($i < $total){
          $temp = $historial[$i + 1]->fecha;

        }
        ?>
        <tr>
          <td><?php echo $uestado; ?></td>
          <td><?php echo $value->fecha; ?></td>
          <td><?php  
                if($estado->id < 7){
                  echo $temp;
                }else{
                  echo '----';
                }
            ?></td>
          <td><?php 
                      if($estado->id < 7){
                         if($i == $total){
                        echo Enum::timeElapsed($value->fecha, false,null,''); 
                       }else{
                        echo Enum::timeElapsed($value->fecha,false,$temp,''); 
                       }
                      }else{
                        echo '----';
                       } ?></td>
          <td>
            <?php   echo is_null($tecnico) ? '' : strtoupper($tecnico->name.' '.$tecnico->lastname);  ?>
          </td>
           <td><?php echo $value->observacion; ?></td>
        </tr>
        <?php 
        $i++;
        $j++;

        ?>
      <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div> 
    
<!-- fin estado ticket --> 
  </div>
    <div id="menu1" class="tab-pane fade">
    <br>
    <div class="row">
      <div class="col-md-12">
<table class="table table-bordered table-striped table-condensed">
  <thead>
    <tr>
    <th>Estado</th>
    <th>Operacion</th>
    <th>Tecnico</th>
    <th>Fecha</th>
  </tr>
  </thead>
  <tbody>
   
       <?php foreach ($detalle as $row): ?>
 <tr>
            <?php 
            $res = $row->getTecnico()->one(); 
             $es = $row->getEstado0()->one(); 
             $in = $row->getIncidente()->one(); 
            
            ?>
      <td><?php echo strtoupper($es->estado); ?></td>
      <td><?php echo strtoupper($in->nombre); ?></td>
      <td><?php echo strtoupper($res->name.' '.$res->lastname); ?></td>
      <td><?php echo strtoupper($row->fecha); ?></td>
       </tr>
       <?php endforeach ?>
   
  </tbody>
 </table>
      </div>
    </div>
  </div>
   
   <div id="menu2" class="tab-pane fade">
    <br>  
     <div class="row">
       <div class="col-md-12">
         <table class="table  table-bordered table-striped table-condensed">
  <thead>
    <tr>
   
    <th>Estado</th>
    <th>Fecha</th>
    <th>Ticket</th>
    <th>Asunto</th>
   
  </tr>
  </thead>
  <tbody>
    <?php foreach ($anteriores as $key => $value): ?>
      <tr>
         <?php   
         $u= $value->getTicketHistorials()->orderBy('fecha DESC')->one(); 
         $e = $u->getEstado()->one();
         ?>
          <td><?php   echo '<span class="label label-'.$e->label.'">'.$e->estado.'</span>'; ?></td>
        <td><?php   echo $value->fecha; ?></td>
                <td><?php   echo $value->ot; ?></td>
         <td><?php   echo $value->getAsunto()->one()->tipo; ?></td>
        
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
       </div>
     </div> 
   </div>
</div>
    </div>
  </div>
</div>





<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ASIGNAR TICKET</h4>
      </div>
      <div class="modal-body">
                    <form action="index.php?r=tickets/default/asignar-a-tecnico" class="ajaxform" method="post">
                      <input type="hidden" name="ticket-id" value="<?php echo $ticket->id; ?>">
                       <input type="hidden" name="action" value="<?php echo $accion; ?>">
       <div class="row">
         <div class="from-group col-md-12">
             <label for="asignar"><span class="accion"><?php echo $accion; ?></span> TICKET :</label> 
  <select name="asignar" id="asignar" class="form-control" required="required">
        <option value=""></option>
    <?php foreach ($users as $key => $value): ?>
      <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->name .' '.$value->lastname); ?></option>
    <?php endforeach ?>
  </select>
         </div>
       </div>


    <div class="row">
      <div class="form-group col-md-12">
        <label for="observacion">OBSERVACION</label>
         <textarea name="observacion" class="form-control" id="" cols="30" rows="10"></textarea>
      </div>
    </div>
  <button type="submit" class="btn btn-info" style="margin-top:5px;"><span class="accion"></span><?php echo $accion; ?></button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-nota" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">AGREGAR NOTA AL TICKET</h4>

      </div>
      <div class="modal-body">

          <form action="index.php?r=mistickets/default/save-nota" class="ajaxform" method="POST">
            <input type="hidden" name="ot-ticket" value="<?php echo $ticket->ot; ?>">
            <input type="hidden" name="id-ticket" value="<?php echo $ticket->id; ?>">
            <input type="hidden" name="return-url" value="<?php echo base64_encode(\Yii::$app->request->getUrl()); ?>">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="row">
                  <textarea class="form-control" id="nota" name="nota" ></textarea>
      
            </div>

         
            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-warning btn-send">Agregar nota</button>
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<script>
  $(document).ready(function(){
       $('.datatable-kropsys').DataTable({
         "order": [[ 1, "desc" ]],
          responsive: true
         //"ordering": false
      });
  });
</script>