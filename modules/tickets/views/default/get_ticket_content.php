<?php 
use kartik\helpers\Enum;
$imp= $ticket->getImpresora()->one(); 
$asunto= $ticket->getAsunto()->one()->tipo; 
//var_dump($impresora);
 $historial = $ticket->getTicketHistorials()->where(['ticket_id' => $ticket->id ])->orderBy(['fecha'=>SORT_ASC])->all();
 $ultimo_historial= $ticket->getTicketHistorials()->orderBy('fecha DESC')->one();
 $asignado = '';
 $tecnico = '';
 if($ultimo_historial->user_id != null){
 	$tecnico = $ultimo_historial->getUser()->one()->username;
 }
 $ultimo_estado = $ultimo_historial->getEstado()->one();
 $cc = $imp->getCentroCosto()->one();
 $model = $imp->getModelo0()->one();
 $marca = $model->getMarca0()->one();

$detalle = app\modules\monitoreo\models\Himpresora::find()->where(['id_impresora' => $ticket->impresora_id])->limit(3)->orderBy(['id' => SORT_DESC])->all();
 $accion = '';
 $estado = strtoupper($ultimo_estado->estado);
 //var_dump($estado);
 if($estado == 'SIN ASIGNAR'){
 	$accion = "ASIGNAR";
 }else{
 	$accion = 'REASIGNAR';
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
<input type="hidden" name="fecha_ticket" id="fecha_ticket" value="<?php echo $ticket->fecha; ?>">
<!-- <div class="page-header">
 
</div>

 -->
 <h2>Ticket #<?php echo $ticket->ot; ?>&nbsp;<small><?php echo $asunto; ?></small></h2>

<hr>
<div class="row">
	<div class="col-md-3 ">
		<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">INFORMACIÓN DEL TICKET</h3>
		</div>
		<div class="panel-body">
				<ul class="list-group">
			  <li class="list-group-item">ESTADO ACTUAL: <span class="label label-default"><?php echo strtoupper($ultimo_estado->estado); ?></span></li>
			  <li class="list-group-item">ASIGNADO A: <span class="span-asignado"><span class="label label-primary"><?php echo strtoupper($tecnico); ?></span></span></li>
			  <li class="list-group-item">FECHA DE APERTURA: <strong><?php echo $ticket->fecha; ?></strong> </li>
			  <?php if ($ultimo_estado->id >= 7): ?>
			  <li class="list-group-item">FECHA DE CIERRE: <strong><?php echo $ultimo_historial->fecha; ?></strong> </li>
			  <?php endif ?>
			  <li class="list-group-item">CENTRO DE COSTOS: <strong><?php echo $cc->nom_cc; ?></strong></li>
			  <li class="list-group-item">EQUIPO:  <strong><?php echo $marca->marca .' '.$model->modelo;  ?></strong></li>
			  <li class="list-group-item">NUMERO DE SERIE: <strong><?php echo $imp->serie; ?></strong></li>
			  <li class="list-group-item">SOLICITANTE: <strong><?php echo strtoupper($ticket->nombre); ?></strong></li>
			  <li class="list-group-item">EMAIL: <strong><?php echo strtoupper($ticket->correo); ?></strong></li>
			  <li class="list-group-item">TELEFONO: <strong><?php echo $ticket->numero; ?></strong></li>
		</ul>
		</div>
	</div>
	
	</div>
	<div class="col-md-6">
		
		<div class="panel panel-default" style="min-height: 425px;">
  <div class="panel-heading">
    <h3 class="panel-title">DETALLES</h3>
  </div>
  <div class="panel-body">
  	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home_mensaje">DESCRIPCION</a></li>
  <li><a data-toggle="tab" href="#adjuntos">INFORMACIÓN ADICIONAL</a></li>

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
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
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
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo Enum::timeElapsed($value->fecha, true,null,''); ?></small>
                                    <strong class="pull-right primary-font"><?php echo \Yii::$app->user->identity->username; ?></strong>
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
   
  </div>
</div>

  </div>
</div>
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
       				<form action="index.php?r=tickets/default/asignar-a-tecnico" class="ajaxform" method="post">
	<label for="asignar"><span class="accion"><?php echo $accion; ?></span> TICKET :</label>
	<input type="hidden" name="ticket-id" value="<?php echo $ticket->id; ?>">
     <input type="hidden" name="action" value="<?php echo $accion; ?>">
	<select name="asignar" id="asignar" class="form-control">

		<option value=""></option>
		<?php foreach ($users as $key => $value): ?>
			<option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->name .' '.$value->lastname); ?></option>
		<?php endforeach ?>
	</select>
	<button type="submit" class="btn btn-info" style="margin-top:5px;"><span class="accion"></span><?php echo $accion; ?></button>
</form>

    <form action="index.php?r=tickets/default/cambiar-estado" class="ajaxform" method="post">
	<label for="asignar">CAMBIAR ESTADO A :</label>
	<input type="hidden" name="ticket-id" value="<?php echo $ticket->id; ?>">
	<input type="hidden" name="ot" value="<?php echo $ticket->ot; ?>">
	<select name="estado" id="estado" class="form-control">

		<option value=""></option>
		<option value="4">EN PROCESO</option>
		<option value="5">PENDIENTE</option>
		<option value="6">COMPLETADO</option>

	</select>
	<button type="submit" class="btn btn-success" style="margin-top:5px;"><span class="accion"></span>CAMBIAR ESTADO</button>
    </form>

    <hr>
	<a href="<?php echo 'index.php?r=tickets/ticket/finalizar&ot='.$ticket->ot; ?>" class="btn btn-danger" style="margin-top:5px;"><span class="accion"></span>FINALIZAR</a>


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
<!--        	      	<hr>
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
  <li class="active"><a data-toggle="tab" href="#home">HISTORIAL DEL TICKET</a></li>
  <li><a data-toggle="tab" href="#menu1">HISTORIAL DEL DISPOSITIVO</a></li>

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
				$tecnico = $value->getUser()->one();
				$temp = '';
				if($i < $total){
					$temp = $historial[$i + 1]->fecha;

				}
				?>
				<tr>
					<td><?php echo $estado->estado; ?></td>
					<td><?php echo $value->fecha; ?></td>
					<td><?php 	echo $temp; ?></td>
					<td><?php 
                       if($i == $total){
                       	echo Enum::timeElapsed($value->fecha, false,null,'');	
                       }else{
                       	echo Enum::timeElapsed($value->fecha,false,$temp,'');	
                       }

					// if($i  == count($historial) ){
					// 	$temp = null;
					// 	echo Enum::timeElapsed($value->fecha, false,null,'');	
					// }else{
					//     $temp = $historial[$i - 1];
					// 	echo Enum::timeElapsed($value->fecha, false,$temp->fecha,'');	
					// }	
					//echo count($historial);	
					//echo Enum::timeElapsed($ticket->fecha, false,null,''); ?></td>
					<td>
						<?php 	echo is_null($tecnico) ? '' : $tecnico->username;  ?>
					</td>
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
      <td><?php echo $es->estado; ?></td>
      <td><?php echo $in->nombre; ?></td>
      <td><?php echo $res->username; ?></td>
      <td><?php echo $row->fecha; ?></td>
       </tr>
       <?php endforeach ?>
   
  </tbody>
 </table>
      </div>
    </div>
  </div>
  <div id="menu2" class="tab-pane fade">

  </div>
</div>

