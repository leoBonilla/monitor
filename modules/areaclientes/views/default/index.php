<?php 
use yii\helpers\Html; 
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-12">

      <h3>Creación de ticket de soporte Kropsys</h3>

        <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" id="_csrf" name="_csrf">
          <div class="row">
              <div class="col-md-4">
                       <div class="form-group">
               <label for="serial">Numero de serie <i class="fa fa-question-circle" id="icono-help" ></i></label>
           <input type="text" name="serial" id="serial" class="form-control" placeholder="Ej: 075PBJFH30003XX">
           </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-12">
                  <button class="btn btn-info" id="btn-search">Ir a crear ticket</button>
               
         
              </div>

          </div>


      



    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">

      <h3>Revisar el estado de su ticket</h3>

        
        <form action="index.php?r=areaclientes/default/revisar-ticket" id="form-check-state"  method="post">
          <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" id="_csrf" name="_csrf">
          <div class="row" >
              <div class="col-md-4">
                       <div class="form-group">

               <label for="email">Correo electronico</label>
           <input type="email" name="email" id="email" class="form-control" placeholder="email@ejemplo.cl" required="required">
           </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                       <div class="form-group">
               <label for="ticket">Numero de ticket</label>
           <input type="text" name="ticket" id="ticket" class="form-control" placeholder="K0000XX" required="required">

           </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-12">

                  <button type="submit" class="btn btn-warning" >Revisar</button>

              </div>

          </div>
        </form>


      




      



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
        <p>Si la ubicación no es correcta presione cerrar y pruebe con otro numero de serie</p>

        <!--<p>?php echo "ubicacion".$impresora->ubicacion; ?> </p>-->
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" id="btn-confirm">Confirmar</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<div id="modal-info" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Donde se encuentra el numero de serie?</h4>

      </div>
      <div class="modal-body"> 
                   <div class="">
              <div class="row">
                 <div class="col-md-12">
                    <div class="alert alert-info">
                       El numero de serie normalmente se encuentra en la etiqueta adherida al equipo en la parte delantera.

                    </div>
                 </div>

              </div>
              <div class="row">
                <div class="col-md-6" style="text-align: center;">
                   <img src="images/ejemplo.jpg" class="img-responsive" alt="Etiqueta kropsys" >
                 </div>
              </div>
          </div>       
      </div>
      <div class="modal-footer">
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