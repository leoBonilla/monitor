<?php 
use yii\helpers\Html; 
use yii\helpers\Url;

?>

<div class="col-md-12" >

  <a href="index.php?r=monitoreo/default" class="btn btn-default btn-sm" ><i class="fa fa-tasks"></i>&nbsp;Volver al listado</a>
      <div class="btn-group btn-group-sm pull-right">
  <a  href="index.php?r=monitoreo/modelo" class="btn btn-default">Administrar modelos</a>
  <a href="index.php?r=monitoreo/marca" class="btn btn-default">Administrar marcas</a>
  <a href="index.php?r=monitoreo/estado" class="btn btn-default">Administrar estados</a>
</div>


<hr>

<div class="monitor-default-index">

  <h3>Agregar nueva impresora</h3>

<form action="<?php echo 'index.php?r=monitoreo/default/printeradd' ?>" class="ajaxform" role="form" method="post">
    
         <div class="row">
                    
                      <div class="form-group col-md-3">
                        <label class="control-label">Serie:</label>
                        <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie" ng-model="serie" required="required">
                       </div>
                      
                      <div class="form-group col-md-3">
                         <label class="control-label" >Codigo:</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo" value="">
                      </div>

                      <div class="form-group col-md-6">
                        <label class=" control-label">Modelo</label>
                        <select type="text" class="form-control selectpicker" name="impresora" id="impresora" data-live-search="true" data-title="SELECCIONE IMPRESORA" required="required">
                          <?php foreach ($modelo as $c): ?>
                                <option value="<?= Html::encode("{$c->id}") ?>"><?= Html::encode("{$c->modelo}") ?></option>
                              <?php endforeach; ?>
                        </select>
                     


                       </div>
                         
                  <!--     <div class="form-group col-md-3">
                        <label class="control-label">Modelo</label>
                        <select type="text" class="form-control selectpicker" name="modelo" id="modelo" onblur=";" data-live-search="true" data-title="SELECCIONE UN MODELO">
                       
                        </select>
                  
                       </div> -->
                      
         </div >
                        <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">Centro de costo</label>
                            <select name="centrocosto" id="centrocosto" class="form-control selectpicker" data-live-search="true" data-title="SELECCIONE UN CENTRO DE COSTO" required="required">
                              <?php foreach ($ccostos as $c): ?>
                                <option value="<?= Html::encode("{$c->cod_cc}") ?>"><?= Html::encode("{$c->nom_cc}") ?></option>
                              <?php endforeach; ?>
                      
                            ?>
                </select>
                   
                       </div>

                       <div class="form-group col-md-3">
                        <label class="control-label">Contacto</label>
                        <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Contacto" onblur="" value="">
                       </div>
                       <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" >
                         
                      <div class="form-group col-md-3">
                        <label class="control-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"  value="" >
                       </div>

                        <div class="form-group col-md-3">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" >
                       </div>      
                </div > 

                <div class="row">
                   <div class="form-group col-md-3">
                     <label class="control-label">Ubicación</label>
                        <input type="text" class="form-control" name="ubicacion" id="ubicacion" required="required">
                   </div>
                     <div class="form-group col-md-3">
                     <label class="control-label">Oficina</label>
                        <input type="text" class="form-control" name="oficina" id="oficina" >
                   </div>
                     <div class="form-group col-md-3">
                     <label class="control-label">Piso</label>
                        <input type="text" class="form-control" name="piso" id="piso" >
                   </div>
                  
                </div>

                <div class="row">
        <br>
                    
                      <div class="form-group col-md-12">
                        <label class="control-label">Observaciones</label>
                      <textarea class="form-control" rows="2" name="observacion" id="observacion" placeholder="Observaciones" onblur="" ></textarea>
                    </div>
                        </div>

              <div class="row">
  
         <div class="col-md-3">
        <button type="submit" class="btn btn-success"  >Guardar</button>
        </div>
        <div class="col-md-3">
        
        </div>
        <div class="col-md-3">

        </div>
        
        </div>  
</form>

</div>

</div>