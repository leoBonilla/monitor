<?php use app\modules\monitoreo\models\Himpresora; ?>
<?php use app\modules\monitoreo\models\Incidente; ?>
<div class="col-md-12 col-sm-12" >

<div class="row">
  <div class="col-md-12">
      <a href="index.php?r=monitoreo/default/agregar" class="btn btn-success btn-xs" ><i class="fa fa-plus-square"></i>&nbsp;Impresora</a>
                <div class="btn-group btn-group-xs pull-right">
  <a  href="index.php?r=monitoreo/modelo" class="btn btn-default">Modelos</a>
  <a href="index.php?r=monitoreo/marca" class="btn btn-default">Marcas</a>
  <a href="index.php?r=monitoreo/estado" class="btn btn-default">Estados</a>
</div>
  </div>

</div>

<hr>

<div class="monitor-default-index">
    <h4>Listado de impresoras</h4>

<table id="table_impresoras" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead>
            <tr>
               <th>Serie</th>
                
                <th>Modelo</th>
                <th>Ubicacion</th>
                <th>Ultima operacion</th>
                <th>Ultimo estado</th>
                <th>Realizado por</th>
                <th>Centro de costo</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($imp as $row) :?>

            <?php 
                //var_dump($row->id);
                $cc = $row->getCentroCosto()->one(); 
                //$in = $row->getIncidente()->one(); 
                $modelo = $row->getModelo0()->one();
                $marca = $modelo->getMarca0()->one();
                $ultimo = Himpresora::find()->where(['id_impresora' => $row->id])->orderBy('fecha DESC')->one();
               
                if(!is_null($ultimo)){
                   $tecnico = $ultimo->getTecnico()->one()->username;
                   $in = $ultimo->getIncidente()->one()->nombre;

                   //$in = $in->nombre;
                   $ultimo = $ultimo->getEstado0()->one()->estado;
                   //$tec = $in->getTecnico();
                   //var_dump($in);
                }else{
                     $tecnico = '';
                    $ultimo = '';
                    $in = '';
                }

                //var_dump();


            ?>
                   

                 <tr>
               
               
                <td><?php echo $row->serie; ?></td>
                
                <td><?php echo $marca->marca.'  '.$modelo->modelo; ?></td>
                <td><?php echo $row->ubicacion; ?></td>
                <td><?php echo $in; ?></td>
                <td><?php echo $ultimo ; ?></td>
                <td><?php  echo strtoupper($tecnico); ?></td>
                <td><?php echo $cc->nom_cc; ?></td>
                <td><a href="#" class="btn btn-xs btn-warning btn-popup" data-toggle="tooltip" data-placement="top" title="VISTA RAPIDA" data-url="<?php echo 'index.php?r=monitoreo/default/detalle-printer-ajax' ?>"  data-id="<?php    echo $row->id; ?>"><i class="fa fa-eye" ></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="REGISTROS DEL EQUIPO" href="<?php echo 'index.php?r=monitoreo/default/detalleprinter'.'&id='.$row->id; ?>" class="btn btn-xs btn-primary" data-id="<?php     echo $row->id; ?>"><i class="fa fa-history"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="EDITAR DETALLES" href="#" class="btn btn-xs btn-warning btn-popup"  data-url="<?php echo 'index.php?r=monitoreo/default/printer-edit-ajax' ?>" data-id="<?php     echo $row->id; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="DESACTIVAR IMPRESORA" href="<?php echo 'index.php?r=monitoreo/default/deleteprinter'.'&id='.$row->id; ?>" class="btn btn-xs btn-danger btn-delete" data-id="<?php     echo $row->id; ?>"><i class="fa fa-trash-o"></i></a>
                
                
                
                </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Serie</th>
                
                <th>Modelo</th>
                <th>Ubicacion</th>
                <th>Ultima operacion</th>
                <th>Ultimo estado</th>
                <th>Realizado por</th>
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