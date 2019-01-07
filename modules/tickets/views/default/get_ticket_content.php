<?php 

$imp= $ticket->getImpresora()->one(); 
//var_dump($impresora);
 $historial = $ticket->getTicketHistorials()->where(['ticket_id' => $ticket->id ])->orderBy(['fecha'=>SORT_DESC])->all();
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
  <h1>[<?php echo $ticket->ot; ?>]<small><?php echo $ticket->asunto; ?></small></h1>
</div>





<div class="row">
	<div class="col-md-3">
		<ul class="list-group">
			  <li class="list-group-item">ESTADO ACTUAL: <span class="label label-default"><?php echo strtoupper($ultimo_estado->estado); ?></span></li>
			  <li class="list-group-item">ASIGNADO A: <span class="span-asignado"><span class="label label-primary"><?php echo strtoupper($tecnico); ?></span></span></li>
			  <li class="list-group-item">FECHA DE APERTURA: <?php echo $ticket->fecha; ?></li>
			  <li class="list-group-item">CENTRO DE COSTOS: <?php echo $cc->nom_cc; ?></li>
			  <li class="list-group-item">EQUIPO:  <?php echo $marca->marca .' '.$model->modelo;  ?></li>
			  <li class="list-group-item">NUMERO DE SERIE: <?php echo $imp->serie; ?></li>
			  <li class="list-group-item">SOLICITANTE: <?php echo $ticket->nombre; ?></li>
			  <li class="list-group-item">EMAIL: <?php echo $ticket->correo; ?></li>
			  <li class="list-group-item">TELEFONO: <?php echo $ticket->numero; ?></li>
		</ul>
	</div>
	<div class="col-md-6">
		
		<div class="panel panel-default" style="min-height: 222px;">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $ticket->nombre; ?> escribió</h3>
  </div>
  <div class="panel-body">
   <?php echo $ticket->mensaje; ?>
  </div>
</div>
	</div>
	<div class="col-md-3">
		<form action="index.php?r=tickets/default/asignar-a-tecnico" class="ajaxform" method="post">
	<label for="asignar"><span class="accion"><?php echo $accion; ?></span> TICKET :</label>
	<input type="hidden" name="ticket-id" value="<?php echo $ticket->id; ?>">
	<select name="asignar" id="asignar" class="form-control">

		<option value=""></option>
		<?php foreach ($users as $key => $value): ?>
			<option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->username); ?></option>
		<?php endforeach ?>
	</select>
	<button type="submit" class="btn btn-warning" style="margin-top:5px;"><span class="accion"></span><?php echo $accion; ?></button>
</form>
<hr>
		<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div>
<div class="well">
	<i class="fa fa-clock-o fa-2x"></i> <span id="countdown-ticket" style="font-size:30px; font-weight: bold;">04:00:00</span>
</div>


	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-condensed table-responsive table-bordered">
			<thead>
				<tr>
					<th>Estado</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($historial as $key => $value): ?>
				<?php $estado = $value->getEstado()->one(); ?>
				<tr>
					<td><?php echo $estado->estado; ?></td>
					<td><?php echo $value->fecha; ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>