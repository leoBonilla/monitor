<?php 
use kartik\helpers\Enum;
$imp= $ticket->getImpresora()->one(); 
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
 $accion = '';
 $estado = strtoupper($ultimo_estado->estado);
 //var_dump($estado);
 if($estado == 'SIN ASIGNAR'){
 	$accion = "ASIGNAR";
 }else{
 	$accion = 'REASIGNAR';
 }
 
?>
<input type="hidden" name="fecha_ticket" id="fecha_ticket" value="<?php echo $ticket->fecha; ?>">
<div class="page-header">
  <h1>[<?php echo $ticket->ot; ?>]&nbsp;<small><?php echo $ticket->asunto; ?></small></h1>
</div>





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
			  <li class="list-group-item">FECHA DE APERTURA: <?php echo $ticket->fecha .'  ( hace ' .Enum::timeElapsed($ticket->fecha, true,null,''). ' )';	?> </li>
			  <li class="list-group-item">CENTRO DE COSTOS: <?php echo $cc->nom_cc; ?></li>
			  <li class="list-group-item">EQUIPO:  <?php echo $marca->marca .' '.$model->modelo;  ?></li>
			  <li class="list-group-item">NUMERO DE SERIE: <?php echo $imp->serie; ?></li>
			  <li class="list-group-item">SOLICITANTE: <?php echo $ticket->nombre; ?></li>
			  <li class="list-group-item">EMAIL: <?php echo $ticket->correo; ?></li>
			  <li class="list-group-item">TELEFONO: <?php echo $ticket->numero; ?></li>
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

  	   <div class="detalle well" style="min-height: 250px;">
  	   	     <span><?php echo trim($ticket->asunto); ?></span>
  	   	     <hr>
  	   	     <p><?php echo trim($ticket->mensaje); ?></p>
   </div>
  </div>
    <div id="adjuntos" class="tab-pane fade in ">
  	asdfasd
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
			<option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->username); ?></option>
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
	<p><?php echo Enum::timeElapsed($ticket->fecha, false,null,''); ?></p>
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
    <h3>Menu 1</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="menu2" class="tab-pane fade">

  </div>
</div>