<?php 
use yii\helpers\Html; 
// here comes your Yii2 asset's class! 
use app\modules\mistickets\assets\MisTicketsAsset; 
// now Yii puts your css and javascript files into your view's html. 
MisTicketsAsset::register($this); 
use kartik\helpers\Enum;
$imp= $ticket->getImpresora()->one(); 
//var_dump($impresora);
 $historial = $ticket->getTicketHistorials()->where(['ticket_id' => $ticket->id ])->orderBy(['fecha'=>SORT_ASC])->all();
 $ultimo_historial= $ticket->getTicketHistorials()->orderBy('fecha DESC')->one();
 $asignado = '';
 $tecnico = '';
 if($ultimo_historial->user_id != null){
 	$tecnico = $ultimo_historial->getUser()->one()->username;
 }
 $ultimo_estado = $ultimo_historial->getEstado()->one();
 $cc = $imp->getCentroCosto()->one();
 $model = $imp->getModelo0()->one();
 $marca = $model->getMarca0()->one();
 $accion = '';
 $estado = strtoupper($ultimo_estado->estado);
 //var_dump($estado);
 if($estado == 'SIN ASIGNAR'){
 	$accion = "ASIGNAR";
 }else{
 	$accion = 'REASIGNAR';
 }
 $edisponibles = array();

  switch ($ultimo_estado->id) {
  	case '2':
  		$edisponibles = array(
  			'4' => 'EN PROCESO',
        '5' => 'PENDIENTE'
  		);
  		break;
  	case '3' :
  		$edisponibles = array(
  			'4' => 'EN PROCESO',
  		);
  	    break;
  	case '4' :
  		$edisponibles = array(
  			'5' => 'PENDIENTE',
  			'6' => 'COMPLETADO',
  		);
  	    break;
  	case '5' :
  		$edisponibles = array(
        '4' => 'EN PROCESO',
  			'6' => 'COMPLETADO',
  		);
  	    break;
  	default:
  		# code...
  		break;
  }
?>
<style>
	.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
   /* overflow-y: scroll;
    height: 250px; */
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
<div class="col-md-12 col-sm-12" >
<input type="hidden" name="fecha_ticket" id="fecha_ticket" value="<?php echo $ticket->fecha; ?>">
<!-- <div class="page-header">
  <h1>[<?php echo $ticket->ot; ?>]&nbsp;<small><?php echo $ticket->asunto; ?></small></h1>
</div>




 -->
<div class="row">
	<div class="col-md-3 ">
		<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">INFORMACIÓN DEL TICKET</h3>
		</div>
		<div class="panel-body">
				<ul class="list-group">
			  <li class="list-group-item">ESTADO ACTUAL: <span class="label label-default"><?php echo strtoupper($ultimo_estado->estado); ?></span></li>
			  <li class="list-group-item">ASIGNADO A: <span class="span-asignado"><span class="label label-primary"><?php echo strtoupper($tecnico); ?></span></span></li>
			  <li class="list-group-item">FECHA DE APERTURA: <?php echo $ticket->fecha .'  ( hace ' .Enum::timeElapsed($ticket->fecha, true,null,''). ' )';	?> </li>
			  <li class="list-group-item">CENTRO DE COSTOS: <?php echo $cc->nom_cc; ?></li>
			  <li class="list-group-item">EQUIPO:  <?php echo $marca->marca .' '.$model->modelo;  ?></li>
			  <li class="list-group-item">NUMERO DE SERIE: <?php echo $imp->serie; ?></li>
			  <li class="list-group-item">SOLICITANTE: <?php echo $ticket->nombre; ?></li>
			  <li class="list-group-item">EMAIL: <?php echo $ticket->correo; ?></li>
			  <li class="list-group-item">TELEFONO: <?php echo $ticket->numero; ?></li>
		</ul>
		</div>
	</div>
	
	</div>
	<div class="col-md-6">
		
		<div class="panel panel-default" style="min-height: 425px;">
  <div class="panel-heading">
    <h3 class="panel-title">DETALLES</h3>
  </div>
  <div class="panel-body">
  	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home_mensaje">DESCRIPCION</a></li>
  <li><a data-toggle="tab" href="#adjuntos">INFORMACIÓN ADICIONAL</a></li>

</ul>
<div class="tab-content">
  <div id="home_mensaje" class="tab-pane fade in active">

   <div class="well">
   	 <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
               <!--      <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div> -->
                </div>
            <div class="panel" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $ticket->nombre; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                               <p> <?php echo $ticket->mensaje; ?></p>
                            </div>
                        </li>
                        <?php foreach ($mensajes as $key => $value): ?>
                          <?php if(is_numeric($value->user_id)) :?>
                            <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font"><?php echo \Yii::$app->user->identity->username; ?></strong>
                                </div>
                                <p>
                                  <?php echo $value->mensaje; ?>
                                </p>
                            </div>
                        </li>
                      <?php else : ?>
                              <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $ticket->nombre; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                      <?php endif; ?>
                        <?php endforeach ?>
           <!--              <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li> -->
           <!--              <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li> -->
<!--                         <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li> -->
                    </ul>
                </div>
                <div class="panel-footer">
                	<form action="index.php?r=mistickets/default/response" method="post">
                      <input type="hidden" name="ot-ticket" value="<?php echo $ticket->ot; ?>">
            <input type="hidden" name="id-ticket" value="<?php echo $ticket->id; ?>">
                      <input type="hidden" name="return-url" value="<?php echo base64_encode(\Yii::$app->request->getUrl()); ?>">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                		<div class="form-group">
                     <!--    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Respuesta..." />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                Enviar</button>
                        </span> -->
                      <textarea name="mensaje" id="" cols="30" rows="10" class="form-control"></textarea>

                    </div>
                    <div class="form-group">
                      <button class="btn btn-success">Responder</button>
                    </div>
                	</form>

                </div>
            </div>
            </div>
        </div>
    </div>

   </div>

  </div>
    <div id="adjuntos" class="tab-pane fade in ">
  	asdfasd
  </div>
</div>

  </div>
</div>
	</div>
	<div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
        	  	   <div class="panel panel-warning">
       	<div class="panel-heading">
       		<h3 class="panel-title">GESTIONAR TICKET</h3>
       		</div>

       		<?php if ($ultimo_estado->id < 7 ): ?>
				       	<div class="panel-body">

     <button class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-estado">CAMBIAR ESTADO</button>

  <!--    <a href="<?php echo 'index.php?r=tickets/ticket/finalizar&ot='.$ticket->ot; ?>" class="btn btn-danger btn-block" style="margin-top:5px;" disabled="disabled"><span class="accion"></span>FINALIZAR</a> -->

	       <?php if($ultimo_estado->id == 6) : ?>
                   <hr>
    <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-confirmar">FINALIZAR</button>
         <?php endif; ?>


       	</div>
       		<?php else : ?>
       			<div class="panel-body">
       				<div class="alert alert-danger">
       					<p>No se pueden realizar acciones sobre este ticket porque ha sido finalizado</p>
       				</div>
       			</div>
       		<?php endif ?>

       </div>
        </div>
      </div>

      <div class="row">
       <div class="col-md-12">
<!--        	      	<hr>
		<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div> -->
<div class="well">
	<i class="fa fa-clock-o "></i> <span> Tiempo total del ticket</span> <br>
	<p><?php echo Enum::timeElapsed($ticket->fecha, false,null,''); ?></p>
</div>
       </div>
      </div>


	</div>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">HISTORIAL DEL TICKET</a></li>
  <li><a data-toggle="tab" href="#menu1">HISTORIAL DEL DISPOSITIVO</a></li>

</ul>


<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
  	<br>
   <!-- inicio estado ticket --> 
    	<div class="row">
	<div class="col-md-12">
		<table class="datatable-kropsys table-striped table table-condensed table-responsive table-bordered">
			<thead>
				<tr>
					<th>Estado</th>
					<th>Inicio estado</th>
					<th>Fin estado</th>
					<th>Tiempo estado</th>
					<th>Tecnico</th>
          <th>Observacion</th>
				</tr>
			</thead>
			<tbody>

			<?php 
			
			$total = count($historial) - 1;
			$i = 0;
			$j = 0;

foreach ($historial as $key => $value): ?>

				<?php 
				$estado = $value->getEstado()->one(); 
				$tecnico = $value->getUser()->one();
				$temp = '';
				if($i < $total){
					$temp = $historial[$i + 1]->fecha;

				}
				?>
				<tr>
					<td><?php echo $estado->estado; ?></td>
					<td><?php echo $value->fecha; ?></td>
					<td><?php 	echo $temp; ?></td>
					<td><?php 
                       if($i == $total){
                       	echo Enum::timeElapsed($value->fecha, false,null,'');	
                       }else{
                       	echo Enum::timeElapsed($value->fecha,false,$temp,'');	
                       }

					// if($i  == count($historial) ){
					// 	$temp = null;
					// 	echo Enum::timeElapsed($value->fecha, false,null,'');	
					// }else{
					//     $temp = $historial[$i - 1];
					// 	echo Enum::timeElapsed($value->fecha, false,$temp->fecha,'');	
					// }	
					//echo count($historial);	
					//echo Enum::timeElapsed($ticket->fecha, false,null,''); ?></td>
					<td>
						<?php 	echo is_null($tecnico) ? '' : $tecnico->username;  ?>
					</td>
          <td><?php echo $value->observacion; ?></td>
				</tr>
				<?php 
				$i++;
				$j++;

				?>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div> 
    
<!-- fin estado ticket --> 
  </div>
  <div id="menu1" class="tab-pane fade">
    <br>
    <div class="row">
      <div class="col-md-12">
<table class="table table-bordered table-striped table-condensed">
  <thead>
    <tr>
    <th>Estado</th>
    <th>Operacion</th>
    <th>Tecnico</th>
    <th>Fecha</th>
  </tr>
  </thead>
  <tbody>
   
       <?php foreach ($hist as $row): ?>
 <tr>
            <?php 
            $res = $row->getTecnico()->one(); 
             $es = $row->getEstado0()->one(); 
             $in = $row->getIncidente()->one(); 
            
            ?>
      <td><?php echo $es->estado; ?></td>
      <td><?php echo $in->nombre; ?></td>
      <td><?php echo $res->username; ?></td>
      <td><?php echo $row->fecha; ?></td>
       </tr>
       <?php endforeach ?>
   
  </tbody>
 </table>
      </div>
    </div>
  </div>
  <div id="menu2" class="tab-pane fade">

  </div>
</div>
</div>

<div id="modal-estado" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">GESTIÓN DE ESTADO DE TICKET</h4>

      </div>
      <div class="modal-body">

      	  <form action="" method="post">
      	  	<input type="hidden" name="ot-ticket" value="<?php echo $ticket->ot; ?>">
      	  	<input type="hidden" name="id-ticket" value="<?php echo $ticket->id; ?>">
      	  	<input type="hidden" name="return-url" value="<?php echo base64_encode(\Yii::$app->request->getUrl()); ?>">
      	  	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
      	  	<div class="row">
      	  		<div class="form-group col-md-6">
      	  		<label for="Estado">ESTADO</label>
      	  		<select name="estado" id="estado" class="form-control selectpicker" required="required" data-live-search="true">
      	  			<option value="">SELECCIONE ESTADO</option>
      	  			<?php foreach ($edisponibles as $key => $value): ?>
      	  				<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
      	  			<?php endforeach ?>
      	  		</select>
      	  		</div>
              <div class="form-group col-md-3">
                <label for="check1">OBSERVACION INTERNA</label><br>
                <input type="checkbox" id="check1" name="check1" data-toggle="toggle" class="form-control" data-on="SI" data-off="NO">
              </div>
              <div class="form-group col-md-3">
                <label for="check2">ENVIAR MENSAJE A CLIENTE</label><br>
                <input type="checkbox" id="check2" name="check2" data-toggle="toggle" class="form-control" data-on="SI" data-off="NO">
              </div>
      	  	</div>

            <div id="wrapper1">

            </div>

            <div id="wrapper2">

            </div>
      	  	<div class="row">
      	  		<div class="col-md-12">
      	  			<button class="btn btn-warning ">ACTUALIZAR ESTADO</button>
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



<div id="modal-confirmar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title">RECEPCION DE FIRMA DIGITAL</h4>

      </div>
      <div class="modal-body">
         
<form action="index.php?r=tickets/ticket/finalizar-ticket-ajax" id="firma-form" method="post">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                 <h2>Formulario de cierre de ticket</h2>
            </div>
        </div>
    <div class="row">
            <div class="form-group col-md-6">
        <label for="nombre">NOMBRE CONTACTO</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $ticket->nombre; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="email">EMAIL CONTACTO</label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $ticket->correo; ?>">
    </div>

    </div>
    <div class="row">
        <div class="col-md-12">
        <label for="signatureparent">FIRMA CONFORME</label>
                      <!--WHERE The canvas is displayed-->
    <div id="signatureparent">
        <div id="signature"></div>
        <button type="reset" class="btn btn-info" id="btnClear">LIMPIAR</button>
        <button type="submit" class="btn btn-success" id="btnSave">GUARDAR Y FINALIZAR</button>
    </div>
        </div>
    </div>
    <!--End Canvas Display-->
    <!--This is where the data value is captured to--> 
    <input type="hidden" id="hiddenSigData" name="hiddenSigData"/>
    <!--For testing only-->
  <!--   <textarea  rows="2" cols="150" id="textSigData" name="textSigData"></textarea> -->
    <!--The image display--> 
<!--     <img id="imgSigData" name="imgSigData"  src=""  /> -->
    
    <!--JavaScript Code change to your liking.-->
    </div>

  
<?= \jberall\signaturedraw\SignatureDraw::widget(); ?>
<input type="hidden" name="ot" value="<?php echo $ticket->ot; ?>" id="ot">
</form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>
      </div>
    </div>

  </div>
</div>


<script>
      $('#check1').change(function() {
      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
      if($(this).prop('checked')){
              $('#wrapper1').append('<div class="row"><div class="form-group col-md-12" ><label for="observacion">OBSERVACION COMO REGISTRO INTERNO</label><textarea name="observacion" id="" cols="30" rows="10" class="form-control" ></textarea></div></div>').find('textarea').summernote({placeholder: 'Este mensaje será guardado para uso interno'
});

                }else{
                $('#wrapper1').empty();
            }

    })

    $('#check2').change(function() {

      if($(this).prop('checked')){
        $('#wrapper2').append('<div class="row"><div class="form-group col-md-12 wrapper2"><label for="mensaje_usuario">ENVIAR ESTE MENSAJE AL CLIENTE</label><textarea name="mensaje_usuario" id="mensaje_usuario" cols="30" rows="10" class="form-control"  readonly="readonly"></textarea></div></div>').find('textarea').summernote({placeholder: 'Escriba aqui su mensaje, esté sera enviado al cliente '
});
      }else{
        $('#wrapper2').empty();
      }

    })
</script>

<script>
    $(document).ready(function() {
        var $sigdiv = $("#signature").jSignature({'UndoButton':false});
        $('#btnClear').click(function(){
            $('#signature').jSignature('clear');
            $('#hiddenSigData').val('');
            // $('#textSigData').val('');
            // $("#imgSigData").attr('src','');
        });
        var emptySig = '';



        $('#firma-form').ajaxForm({
            beforeSubmit : function(arr, $form, options){
                
                var sigData = $('#signature').jSignature('getData','default');
                if($('#signature').jSignature('getData', 'native').length == 0) {
                    toastr.warning('TODOS LOS CAMPOS SON OBLIGATORIOS', 'HUBO UN PROBLEMA AL INTENTAR GUARDAR');
                        return false
                }

                arr.push({name:'hiddenSigData', value: sigData })
                            return true;
             },
             success: function(res){
                if(res.ok == true){
                     toastr.success('Ticket cerrado con exito', '');
                }

             }
        });
       

    })
    
    
</script>