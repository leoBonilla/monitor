<div class="row">
	<div class="col-md-12">

		        	<div class="form-row">
        		<div class="jumbotron">
    				<dl class="row">

  <dt class="col-sm-3">Numero de serie</dt>
  <dd class="col-sm-9"><?php echo $dispositivo->serie; ?></dd>

  <dt class="col-sm-3">Modelo</dt>
  <dd class="col-sm-9">
    <?php echo $modelo->modelo; ?>
  </dd>

  <dt class="col-sm-3">Marca</dt>
  <dd class="col-sm-9"><?php echo $marca->marca; ?></dd>
  <dt class="col-sm-3">Centro de costos</dt>
  <dd class="col-sm-9"><?php echo $centro->nom_cc; ?></dd>
  <hr>
    <dt class="col-sm-3">Solicitado por</dt>
  <dd class="col-sm-9"><?php echo $ticket->nombre; ?></dd>
  <dt class="col-sm-3">Email</dt>
  <dd class="col-sm-9"><?php echo $ticket->correo; ?></dd>
  <dt class="col-sm-3">Telefono</dt>
  <dd class="col-sm-9"><?php echo $ticket->numero; ?></dd>
   <dt class="col-sm-3">OT</dt>
  <dd class="col-sm-9"><?php echo $ticket->ot; ?></dd>

</dl>
  	</div>
        	</div>

		<table class="table table-striped table-bordered table-condensed table-responsive">
			<thead>
				<tr>
					<th>Fecha</th>
			    	<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($historial as $key => $value): ?>
					<?php $estado = $value->getEstado()->one(); ?>
					<tr>
						<td><?php echo $value->fecha; ?></td>
						<td><?php echo $estado->estado; ?></td>
					</tr>
				<?php endforeach ?>
	
			</tbody>
		</table>
	</div>
</div>