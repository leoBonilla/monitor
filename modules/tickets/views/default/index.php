<?php 
use yii\helpers\Html; 
// here comes your Yii2 asset's class! 
use app\modules\tickets\assets\TicketsAsset; 
// now Yii puts your css and javascript files into your view's html. 
TicketsAsset::register($this); 
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
        <div class="col-md-12">
            <h3>Gestion de tickets</h3>
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
            <?php foreach ($tickets as $key => $value): ?>

                <?php 

                $device = $value->getImpresora()->one(); 
                $centro = $device->getCentroCosto()->one();
                $uhistorial = $value->getTicketHistorials()->orderBy('fecha DESC')->one();
                $uestado = $uhistorial->getEstado()->one()->estado;
                
                
                ?>
                <tr>
                    <td><?php echo $value->ot; ?></td>
                    <td><?php echo $value->fecha; ?></td>
                    <td><?php echo $device->serie; ?></td>
                    <td></td>
                    <td><?php echo $centro->nom_cc; ?></td>
                    <td><?php echo $value->asunto; ?></td>
                    <td><?php echo $uestado; ?></td>
                    <td><?php echo $value->nombre; ?></td>
                    <td><button class="btn btn-info btn-xs btn-eye" data-id="<?php echo $value->id; ?>" ><i class="fa fa-eye"></i></button> <button class="btn btn-warning btn-xs"><i class="fa fa-edit" ></i></button></td>
                </tr>
            <?php endforeach ?>
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


