<?php 
use yii\helpers\Html; 
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-12">

        <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" id="_csrf" name="_csrf">

        <div class="row">
          <div class="col-md-12">
            <h4>Para abrir un ticket por favor ingrese el numero de serie del dispositivo <i class="fa fa-info-circle"></i></h4>
          </div>
        </div>
          <div class="row">
              <div class="col-md-12">
                       <div class="form-group">
               <label for="serial">Numero de serie</label>
           <input type="text" name="serial" id="serial" class="form-control" placeholder="ej: 075PBJFH300XXXX">
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
        <p>Si la ubicación no es correcta, presione cerrar y pruebe con otro numero de serie</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" id="btn-confirm">Confirmar</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>