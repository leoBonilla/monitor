<form action="index.php?r=monitoreo/default/edit-register" class="ajaxform" method="post">
	<div class="row">
                    <?php 
                    $fecha = strtotime($h->fecha); 
                    //var_dump($h);
                    ?>
                      <div class="form-group col-md-3">
                        <label class="control-label" for="fecha">Fecha:</label>
                        <input type="text" class="form-control datetimepicker" data-datefield="<?php echo $fecha; ?>" name="fecha" id="fecha" placeholder="fecha" required="required" value="">
                       </div>
                       <div class="form-group col-md-3">
                        <label class="control-label" for="numero">Nº Atención:</label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="000001" required="required" value="<?php echo $h->n_registro; ?>">
                       </div>
                       <div class="form-group col-md-3">
                        <label class="control-label">Operacion:</label>
                         <select name="operacion" id="operacion" class="selectpicker form-control" data-live-search="true">
                        	<?php foreach ($incidentes as $row): ?>

                        		<option value="<?php echo $row->id; ?>" <?php echo ($h->id_incidente == $row->id ) ? 'selected="selected"' : ""; ?>><?php echo $row->nombre; ?></option>
                        	<?php endforeach ?>
                        </select>
                       </div>
                        <div class="form-group col-md-3">
                        <label class="control-label">Estado :</label>
                        <select name="estado" id="estado" class="selectpicker form-control" data-live-search="true">
                        	<?php foreach ($estados as $row): ?>
                        		<option value="<?php echo $row->id; ?>"  <?php echo ($h->estado == $row->id ) ? 'selected="selected"' : ""; ?>><?php echo $row->estado; ?></option>
                        	<?php endforeach ?>
                        </select>
                       </div>

                       <input name="printer_id" value="<?php echo $h->id_impresora; ?>" type="hidden">
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<label for="detalle">Detalle</label>
    		<textarea class="form-control" name="detalle" id="detalle" cols="30" rows="10"><?php echo $h->detalle; ?></textarea>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<input type="file" name="file" class="form-control">
    	</div>
    </div>
    <hr>

    <div class="row">
    	<div class="col-md-12">
    		<button class="btn btn-success">Actualizar <i class="fa fa-edit"></i></button>
    		<button class="btn btn-warning">Cancelar</button>
    	</div>
    </div>
</form>