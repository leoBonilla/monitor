<div class="col-md-12" >

<div class="monitor-default-detalle">
	<?php 
	$modelo = $imp->getModelo0()->one(); 
	$marca = $modelo->getMarca0()->one();
	?>
  <a class="btn btn-warning btn-sm" href="<?php echo 'index.php?r=monitoreo/' ?>"><i class="fa fa-angle-left "></i> Volver</a>
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#yModal" onClick="toggle('#add_history');"><i class="fa fa-plus" ></i> Nuevo registro</button>
<!--   <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#odalLocation" onClick="toggle('#add_location');">Actualizar ubicacion</button> -->
	<h4>Historial para <?php echo $marca->marca.' '.$modelo->modelo. '  ('. $imp->serie.')' ; ?></h4>

<div class="monitor-default-detalle">

  <div id="add_history" class="row div-toggeable" style="display: none;" >

       <div class="col-md-12">
        <h3>Agregando registro de eventos</h3>
                <form action="<?php echo 'index.php?r=monitoreo/default/addhistory' ?>" class="ajaxform" method="post">
          <div class="row">
                <div class="form-group col-md-2">
          <label for="fecha">Fecha</label>
          <input type="text" value="" name="fecha" class="form-control datetimepicker" required="required">
               </div>
                       <div class="form-group col-md-2">
          <label for="estado">Tipo</label>
          <select name="tipo" id="tipo" class="form-control selectpicker" data-title="SELECCIONE TIPO REGISTRO"  data-live-search="true" required="required">
            <option value="1">INSTALACION Y CAPACITACION</option>
            <option value="2">SERVICIO TECNICO</option>
          </select>
               </div>


                      <div class="form-group col-md-2">
          <label for="estado">Operacion </label>
          <select name="incidente" id="incidente" class="form-control selectpicker" data-title="SELECCIONE"  data-live-search="true" required="required">
         
            <?php foreach ($incidentes as $row) :?>
              <option value="<?php echo $row->id ?>"><?php  echo $row->nombre; ?></option>
            <?php endforeach; ?>
          </select>
               </div>

                 <div class="form-group col-md-2">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control selectpicker" data-title="SELECCIONE ESTADO"  data-live-search="true" required="required">
         
            <?php foreach ($estados as $row) :?>
              <option value="<?php echo $row->id ?>"><?php  echo $row->estado; ?></option>
            <?php endforeach; ?>
          </select>
               </div>

               <div class="form-group col-md-2">
                 <label for="registro">Nº Registro</label>
          <input type="text" value="" name="registro" class="form-control numeric" id="registro" required="required">
               </div>
          </div>
          <div class="row hidden" id="location_hidden" >
            <div class="col-md-3 form-group">
              <label for="ubicacion">Nueva ubicación</label>
              <input type="text" name="ubicacion" class="form-control" id="ubicacion">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Oficina</label>
              <input type="text" name="oficina" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Piso</label>
              <input type="text" name="piso" class="form-control">
            </div>
    
          </div>

          <div class="row">
            <div class="col-md-12">
              <label for="file">Archivo</label>
              <input type="file" class="form-control" name="file" id="input-file" accept="application/pdf,image/jpeg" required="required">
            </div>
          </div>
           <br>
      
          <div class="row">

            <div class="form-group col-md-12">
              <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>


          <input type="hidden" name="id_impresora" value="<?php echo $imp->id; ?>">

          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
          </form>
           <hr>
       </div>

  </div>

<!--   <div class="row div-toggeable hidden" id="add_location" >
       <div class="col-md-12">
        <h3>Actualizando ubicacion</h3>
        <form method="post" class="ajaxform">
           <div class="row">
            <div class="col-md-3 form-group">
              <label for="ubicacion">Ubicacion</label>
              <input type="text" name="ubicacion" class="form-control" required="required">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Oficina</label>
              <input type="text" name="oficina" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Piso</label>
              <input type="text" name="piso" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-success btn-sm">Guardar</button>
            </div>
          </div>
          </form>
          <hr>
       </div>
  </div> -->



<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">General</a></li>
  <li><a data-toggle="tab" href="#menu1">Ubicaciones</a></li>

</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
 <br>
      <table id="table_detalle" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Nº Atención</th>
                <th>Responsable</th>
                <th>Operacion</th>
                <th>Detalle</th>
                <th>Estado</th>
                <th>Adjunto</th>
                <th>Acciones</th>
               
            </tr>
        </thead>
        <tbody>
          <?php foreach($detalle as $row) :?>

            <?php 
            $res = $row->getTecnico()->one(); 
             $es = $row->getEstado0()->one(); 
             $in = $row->getIncidente()->one(); 


            
            ?>

         
                 <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->fecha; ?></td>
                <td><?php echo $row->n_registro; ?></td>
                <td><?php echo $res->username; ; ?></td>
                <td><?php echo $in->nombre; ?></td>
                <td><?php echo $row->detalle; ?></td>
                <td><?php echo $es->estado; ?></td>
                <td><a href="<?php echo 'index.php?r=monitoreo/default/download-file&file='.str_replace("/","", $row->adjunto); ?>" class="file-download" data-file="<?php echo $row->adjunto; ?> " target="_blank">Adjunto</a></td>
                <td><a href="#" class="btn btn-xs btn-warning btn-popup" data-action="editar" data-toggle="tooltip" data-placement="top" title="EDITAR REGISTRO" data-url="<?php echo 'index.php?r=monitoreo/default/edit-register-ajax' ?>"  data-id="<?php    echo $row->id; ?>"><i class="fa fa-edit" ></i></a></td>
           
            </tr>

          <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Nº Atención</th>
                <th>Responsable</th>
                <th>Operacion</th>
                <th>Detalle</th>
                <th>Estado</th>
                <th>Adjunto</th>
                <th>Acciones</th>
                
            </tr>
        </tfoot>
    </table>
  </div>
  <div id="menu1" class="tab-pane fade">
     <br>
      <table id="table_ubicaciones" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Ubicacion</th>
                <th>Fecha</th>
                <th>Oficina</th>
                <th>Piso</th>
               
            </tr>
        </thead>
        <tbody>
             <?php foreach($ubicaciones as $row) : ?>
              <tr>
                <td><?php echo $row->ubicacion; ?></td>
                <td><?php echo $row->fecha; ?></td>
                <td><?php echo $row->oficina; ?></td>
                <td><?php echo $row->piso; ?></td>
              </tr>
             <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Ubicacion</th>
                <th>Fecha</th>
                <th>Oficina</th>
                <th>Piso</th>
                
            </tr>
        </tfoot>
    </table>
  
  </div>

</div>


</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="title-action">Agregar</span> registro <?php echo $marca->marca.' '.$modelo->modelo. '  ('. $imp->serie.')'?></h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo 'index.php?r=monitoreo/default/addhistory' ?>" class="ajaxform" method="post">
          <div class="row">
          		  <div class="form-group col-md-4">
        	<label for="fecha">Fecha</label>
        	<input type="text" value="" name="fecha" class="form-control datetimepicker" required="required">
       				 </div>
       				   <div class="form-group col-md-4">
        	<label for="estado">Estado</label>
        	<select name="estado" id="estado" class="form-control selectpicker" data-title="SELECCIONE ESTADO"  data-live-search="true" required="required">
            <option value="1">CAMBIO DE UBICACION</option>
        		<?php foreach ($estados as $row) :?>
        			<option value="<?php echo $row->id ?>"><?php  echo $row->estado; ?></option>
        		<?php endforeach; ?>
        	</select>
       				 </div>
          </div>
          <div class="row">
          	<div class="form-group col-md-12">
          			<textarea name="observaciones" id="" cols="30" rows="10" class="form-control"></textarea>
          	</div>
          </div>

          <input type="hidden" name="id_impresora" value="<?php echo $imp->id; ?>">

          <div class="row">
          	<div class="col-md-12">
          		<button class="btn btn-success">Guardar</button>
          	</div>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
</div>



<!-- Modal -->
<div id="modalLocation" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar registro <?php echo $marca->marca.' '.$modelo->modelo. '  ('. $imp->serie.')'?></h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo 'index.php?r=monitoreo/default/addhistory' ?>" class="ajaxform" method="post">
          <div class="row">
                <div class="form-group col-md-4">
          <label for="fecha">Fecha</label>
          <input type="text" value="" name="fecha" class="form-control datetimepicker" required="required">
               </div>
                 <div class="form-group col-md-4">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control selectpicker" data-title="SELECCIONE ESTADO"  data-live-search="true" required="required">
            <option value="1">CAMBIO DE UBICACION</option>
            <?php foreach ($estados as $row) :?>
              <option value="<?php echo $row->id ?>"><?php  echo $row->estado; ?></option>
            <?php endforeach; ?>
          </select>
               </div>
          </div>
          <div class="control-hidden">
                    <div class="row">
            <div class="col-md-3 form-group">
              <label for="ubicacion">Ubicacion</label>
              <input type="text" name="ubicacion" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Oficina</label>
              <input type="text" name="oficina" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label for="ubicacion">Piso</label>
              <input type="text" name="piso" class="form-control">
            </div>
          </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
                <textarea name="observaciones" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>

          <input type="hidden" name="id_impresora" value="<?php echo $imp->id; ?>">

          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-success">Guardar</button>
            </div>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

