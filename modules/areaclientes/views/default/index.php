<?php 
use yii\helpers\Html; 
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-12">

        <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" id="_csrf" name="_csrf">
          <div class="row">
              <div class="col-md-12">
                       <div class="form-group">
               <label for="serial">Numero de serie</label>
           <input type="text" name="serial" id="serial" class="form-control">
           </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-12">
                  <button class="btn btn-success" id="btn-search">Ir a crear ticket</button>
              </div>
          </div>

    </div>
</div>

<div id="modal-confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Por favor confirme su ubicación</h4>

      </div>
      <div class="modal-body">
        
        <div id="confirmation-1"></div>
        <p id="confirmation-2"></p>
        <p>Si la ubicación no es correcta, presione cerrar y pruebe con otro numero de serie</p>

        <!--<p>?php echo "ubicacion".$impresora->ubicacion; ?> </p>-->
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" id="btn-confirm">Confirmar</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>