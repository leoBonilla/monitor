<?php use app\modules\monitoreo\models\Himpresora; ?>
<div class="col-md-12" >

  <a href="index.php?r=monitoreo/default/agregar" class="btn btn-success btn-sm" >Agregar impresora</a>
      <div class="btn-group btn-group-sm pull-right">
  <a  href="index.php?r=monitoreo/modelo" class="btn btn-default">Administrar modelos</a>
  <a href="index.php?r=monitoreo/marca" class="btn btn-default">Administrar marcas</a>
  <a href="index.php?r=monitoreo/estado" class="btn btn-default">Administrar estados</a>
</div>


<hr>

<div class="monitor-default-index">
    <h4>Listado de impresoras</h4>

<table id="table_impresoras" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Serie</th>
                
                <th>Modelo</th>
                <th>Ubicacion</th>
                <th>Ultimo historial</th>
                <th>Centro de costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($imp as $row) :?>

            <?php 
                //var_dump($row->id);
                $cc = $row->getCentroCosto()->one(); 
                $modelo = $row->getModelo0()->one();
                $marca = $modelo->getMarca0()->one();
                $ultimo = Himpresora::find()->where(['id_impresora' => $row->id])->orderBy('fecha DESC')->one();
                if(!is_null($ultimo)){
                   $ultimo = $ultimo->getEstado0()->one()->estado;
                }else{
                    $ultimo = '';
                }

                //var_dump();


            ?>
                   

                 <tr>
               
               
                <td><?php echo $row->serie; ?></td>
                
                <td><?php echo $marca->marca.'  '.$modelo->modelo; ?></td>
                <td><?php echo $row->ubicacion; ?></td>
                <td><?php echo $ultimo; ?></td>
                <td><?php echo $cc->nom_cc; ?></td>
                <td><a href="#" class="btn btn-xs btn-warning btn-popup"  data-url="<?php echo 'index.php?r=monitoreo/default/detalle-printer-ajax' ?>" data-id="<?php    echo $row->id; ?>"><i class="fa fa-eye" ></i></a>&nbsp;<a href="<?php echo 'index.php?r=monitoreo/default/detalleprinter'.'&id='.$row->id; ?>" class="btn btn-xs btn-primary" data-id="<?php     echo $row->id; ?>"><i class="fa fa-history"></i></a>&nbsp;<a href="#" class="btn btn-xs btn-warning btn-popup"  data-url="<?php echo 'index.php?r=monitoreo/default/printer-edit-ajax' ?>" data-id="<?php     echo $row->id; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="<?php echo 'index.php?r=monitoreo/default/deleteprinter'.'&id='.$row->id; ?>" class="btn btn-xs btn-danger btn-delete" data-id="<?php     echo $row->id; ?>"><i class="fa fa-trash-o"></i></a>
                
                
                
                </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Serie</th>
                
                <th>Modelo</th>
                <th>Ubicacion</th>
                <th>Ultimo historial</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>

</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DETALLE DE IMPRESORA</h4>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
</div>