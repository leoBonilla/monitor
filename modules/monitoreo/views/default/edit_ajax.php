<?php 
use yii\helpers\Html; 
use yii\helpers\Url;

?>
<div class="monitor-default-index">

<form action="<?php echo 'index.php?r=monitoreo/default/printer-edit' ?>" class="ajaxform" role="form" method="post">
    
         <div class="row">
                    
                      <div class="form-group col-md-3">
                        <label class="control-label">Serie:</label>
                        <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie" ng-model="serie" required="required" value="<?php echo $imp->serie; ?>">
                       </div>
                      
                      <div class="form-group col-md-3">
                         <label class="control-label" >Codigo:</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo" value="<?php echo $imp->codigo; ?>">
                      </div>

                      <div class="form-group col-md-6">
                        <label class=" control-label">Modelo</label>
                        <select type="text" class="form-control selectpicker" name="impresora" id="impresora" data-live-search="true" data-title="SELECCIONE IMPRESORA" required="required">
                          <?php foreach ($modelo as $c): ?>
                                <option value="<?= Html::encode("{$c->id}") ?>" <?php echo ($c->id == $imp->modelo) ? 'selected' : ''; ?>><?= Html::encode("{$c->modelo}") ?></option>
                              <?php endforeach; ?>
                        </select>
                     
                        <input type="hidden" name="id" value="<?php echo  $imp->id; ?>">

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
                                <option value="<?= Html::encode("{$c->cod_cc}") ?>" <?php echo ($c->cod_cc == $imp->centro_costo) ? 'selected' : ''; ?>><?= Html::encode("{$c->nom_cc}") ?></option>
                              <?php endforeach; ?>
                            </select>
                   
                       </div>

                       <div class="form-group col-md-3">
                        <label class="control-label">Contacto</label>
                        <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Contacto" onblur="" value="<?php  echo $imp->contacto; ?>">
                       </div>
                       <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" >
                         
                      <div class="form-group col-md-3">
                        <label class="control-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"  value="<?php echo $imp->telefono; ?>" >
                       </div>

                        <div class="form-group col-md-3">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $imp->email; ?>">
                       </div>     
                </div > 

         <!--        <div class="row">
                   <div class="form-group col-md-3">
                     <label class="control-label">Ubicación</label>
                        <input type="text" class="form-control" name="ubicacion" id="ubicacion"   value="<?php echo $imp->ubicacion; ?>">
                   </div>
                     <div class="form-group col-md-3">
                     <label class="control-label">Oficina</label>
                        <input type="text" class="form-control" name="oficina" id="oficina"  value="<?php echo $imp->oficina; ?>">
                   </div>
                     <div class="form-group col-md-3">
                     <label class="control-label">Piso</label>
                        <input type="text" class="form-control" name="piso" id="piso"  value="<?php echo $imp->piso; ?>">
                   </div> 
                </div> -->

                <div class="row">
        <br>
                    
                      <div class="form-group col-md-12">
                        <label class="control-label">Observaciones</label>
                      <textarea class="form-control" rows="2" name="observacion" id="observacion" placeholder="Observaciones" onblur="" ><?php echo $imp->observaciones; ?></textarea>
                    </div>
                        </div>

              <div class="row">
  
         <div class="col-md-3">
        <button type="submit" class="btn btn-success"  >Actualizar</button>
        </div>
        <div class="col-md-3">
        
        </div>
        <div class="col-md-3">

        </div>
        
        </div>  
</form>

</div>

