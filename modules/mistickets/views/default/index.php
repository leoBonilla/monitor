<?php 
use yii\helpers\Html; 
// here comes your Yii2 asset's class! 
use app\modules\mistickets\assets\MisTicketsAsset; 
// now Yii puts your css and javascript files into your view's html. 
MisTicketsAsset::register($this); 
?> 
<style>
    .modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  overflow: hidden;
}

.modal-dialog {
  position: fixed;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
}

.modal-content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  border: 2px solid #3c7dcf;
  border-radius: 0;
  box-shadow: none;
}

.modal-header {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  height: 50px;
  padding: 10px;
  background: #6598d9;
  border: 0;
}

.modal-title {
  font-weight: 300;
  font-size: 2em;
  color: #fff;
  line-height: 30px;
}

.modal-body {
  position: absolute;
  top: 50px;
  bottom: 60px;
  width: 100%;
  font-weight: 300;
  overflow: auto;
}

.modal-footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 60px;
  padding: 10px;
  background: #f1f3f5;
}

</style>


<div class="tickets-default-index">

<div class="col-md-12 col-sm-12" >
    <div class="row">
        <div class="col-md-6">
            <h3>Gestion de tickets</h3>
        </div>
        <div class="col-md-6">
          <button class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#modal-ticket"><i class="fa fa-plus"></i>&nbsp;Crear un ticket</button>
        </div>
    </div>
<table id="table_tickets" class="table table-striped table-bordered table-condensed" style="width:100%">
     <thead>
            <tr>
                
                <th>Ot</th>
                <th>Fecha</th>
                <th>Serie</th>
                <th>Tipo</th>
                <th>Centro de costo</th>
                <th>Asunto</th>
                <th>Estado</th>
                <th>Solicitante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($tickets as $key => $value): ?>

                <?php 
                 switch ($value->tipo) {
                   case '1':
                      $tipo = 'SOPORTE IMPRESORA';
                     break;
                     case '2':
                      $tipo = 'INSUMO';
                     break;
                     case '3':
                      $tipo = 'EQUIPOS';
                     break;
                   
                   default:
                     # code...
                     break;
                 }
                $device = $value->getImpresora()->one(); 
                $centro = $device->getCentroCosto()->one();
                $uhistorial = $value->getTicketHistorials()->orderBy('fecha DESC')->one();
                //var_dump($uhistorial);
                $uestado = $uhistorial->getEstado()->one()->estado;
                 $uestado = $uhistorial->getEstado()->one()->estado;
                $asunto  = $value->getAsunto()->one()->tipo;
                
                
                ?>
                <tr>
                    <td><?php echo $value->ot; ?></td>
                    <td><?php echo $value->fecha; ?></td>
                    <td><?php echo $device->serie; ?></td>
                    <td><?php   echo $tipo; ?></td>
                    <td><?php echo $centro->nom_cc; ?></td>
                    <td><?php echo $asunto; ?></td>
                    <td><?php echo $uestado; ?></td>
                    <td><?php echo $value->nombre; ?></td>
                    <td><!-- <button class="btn btn-info btn-xs btn-eye" data-id="<?php echo $value->id; ?>" ><i class="fa fa-eye"></i></button> -->
                      <a href="index.php?r=mistickets/default/ver&ot=<?php echo $value->ot; ?>" class="btn btn-info btn-xs "><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            <?php  endforeach ?>
        </tbody>

</table>


</div>
</div>




<div id="modal-detail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>

      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>


<div id="modal-full" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>

      </div>
      <div class="modal-body .modal-full-screen">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-ticket" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generar ticket</h4>

      </div>
      <div class="modal-body">
          <form action="index.php?r=mistickets/default/crear-ticket" id="ticket-form" method="post" enctype="multipart/form-data" class="ajaxform">
                        <div class="form-row">
                <div class="col-md-4">
                    <label for="contacto">SOLICITANTE (*)</label>
                    <input type="text" name="contacto" class="form-control" placeholder="Su nombre" required="required">
                </div>
                <div class="col-md-4">
                    <label for="contacto">EMAIL (*)</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su email" required="required">
                </div>
                <div class="col-md-4">
                    <label for="telefono">NUMERO DE CONTACTO  (*)</label>
                    <input type="text" name="telefono" class="form-control" placeholder="numero telefonico"  required="required">
                </div>
            </div>
                                <div class="form_row">
                <div class="col-md-3">
                    <label for="tipo">TIPO</label>
                    <select name="tipo" id="tipo" class="form-control" required="required">
                        <option value="">SELECCIONE UNA OPCION</option>
                        <option value="1">PROBLEMAS DE IMPRESION</option>
                        <option value="2">INSUMOS</option>
                        <option value="3">PROBLEMAS CON PC TABLET</option>
                    </select>
                </div>
                <div class="col-md-3">
                  <label class="control-label">Asunto</label>
                        <select type="text" class="form-control " name="asunto" id="asunto" data-live-search="true" data-title="SELECCIONE ASUNTO" required="required">
                            <option value="">SELECCIONE UNA OPCION</option>
                        </select>
                </div>
                 <div class="col-md-3">
                  <label class="control-label">CENTRO</label>
                        <select type="text" class="form-control" name="centro" id="centro" data-live-search="true" data-title="SELECCIONE CENTRO" required="required">
                            <option value="">SELECCIONE UNA OPCION</option>
                      <?php foreach ($centros as $value): ?>
                              <option value="<?php echo $value->cod_cc; ?>"><?php echo $value->nom_cc; ?></option>
                            
                            <?php endforeach ?> 
                        </select>
                </div>
                                 <div class="col-md-3">
                  <label class="control-label">EQUIPO</label>
                        <select type="text" class="form-control" name="equipo" id="equipo" data-live-search="true" data-title="SELECCIONE EQUIPO" required="required">
                            <option value="">SELECCIONE UNA OPCION</option>
                        </select>
                </div>
            </div>
            <div class="form_row">
              <div class="col-md-3">
                <label class="control-label">FUENTE</label>
               <select type="text" class="form-control " name="fuente" id="fuente" data-live-search="true" data-title="SELECCIONE FUENTE" required="required">
                            <option value="">SELECCIONE UNA OPCION</option>
                            <option value="WEB">WEB</option>
                            <option value="TELEFONO">TELEFONO</option>
                            <option value="CORREO">CORREO</option>
                            <option value="PERSONALMENTE">PERSONALMENTE</option>


                        </select>
              </div>
            </div>
             <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <div class="form_row">
                <div class="col-md-12">
                    <label for="detalle">DESCRIPCION</label>
                    <textarea class="form-control" name="detalle" id="detalle" ></textarea>
                </div>
            </div>
            <input type="hidden" value="<?php //echo $dispositivo->id;  ?>" name="printer_id" >

            <div class="form-row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Crear ticket</button>
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
    $('#tipo').on('change', function(){
           $.post('index.php?r=areaclientes/default/dropdown-tipo',{tipo:$(this).val()}, function(res){
                 $('#asunto')
                 .empty()
                 .append(res);
           });
        });
     $('#centro').on('change', function(){
           $.post('index.php?r=areaclientes/default/dropdown-equipos',{centro:$(this).val()}, function(res){
                 $('#equipo')
                 .empty()
                 .append(res);
           });
        });

  });
</script>