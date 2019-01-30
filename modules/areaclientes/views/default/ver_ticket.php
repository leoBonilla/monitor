<?php 
use kartik\helpers\Enum; 
 $ultimo_historial= $ticket->getTicketHistorials()->orderBy('fecha DESC')->one();
 $ultimo_estado = $ultimo_historial->getEstado()->one();
 $cerrado = ($ultimo_estado->id >= 7) ? true : false;
 //$user_name = strtoupper(\Yii::$app->user->identity->name. ' '.\Yii::$app->user->identity->lastname);
 $asunto = $ticket->getAsunto()->one()->tipo;
?>
<div class="row">
	<div class="col-md-12">
    <?php if (Yii::$app->session->hasFlash('correo_enviado')): ?>
    <div class="alert alert-info alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <?= Yii::$app->session->getFlash('correo_enviado') ?>
    </div>
<?php endif; ?>

		        	<div class="form-row">
        		<div class="jumbotron">
    				<dl class="row">

  <dt class="col-sm-3">Numero de serie</dt>
  <dd class="col-sm-9"><?php echo $dispositivo->serie; ?></dd>

  <dt class="col-sm-3">Equipo</dt>
  <dd class="col-sm-9">
    <?php echo $modelo->modelo.' '.$marca->marca;  ?>
  </dd>
  <dt class="col-sm-3">Ubicacion</dt>
  <dd class="col-sm-9"><?php echo $dispositivo->ubicacion; ?></dd>
  <hr>
    <dt class="col-sm-3">Solicitado por</dt>
  <dd class="col-sm-9"><?php echo $ticket->nombre; ?></dd>
  <dt class="col-sm-3">Email</dt>
  <dd class="col-sm-9"><?php echo $ticket->correo; ?></dd>
  <dt class="col-sm-3">Telefono</dt>
  <dd class="col-sm-9"><?php echo $ticket->numero; ?></dd>
  <dt class="col-sm-3">Nº de Ticket</dt>
  <dd class="col-sm-9"><?php echo $ticket->ot; ?></dd>
  <dt class="col-sm-3">Asunto</dt>
  <dd class="col-sm-9"><?php echo $asunto; ?></dd>
</dl>
  	</div>
        	</div>

  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Historial del ticket</a></li>
  <li><a data-toggle="pill" href="#menu1">Mensajes</a></li>
  <li><a data-toggle="pill" href="#menu2">Archivos</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
          <div class="row">
      <div class="col-md-12">
        <br>
               <table class="table table-striped table-bordered table-condensed table-responsive">
      <thead>
        <tr>
          <th>Fecha</th>
            <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($historial as $key => $value): ?>
          <?php $estado = $value->getEstado()->one(); ?>
          <tr>
            <td><?php echo $value->fecha; ?></td>
            <td><?php echo '<span class="label label-'.$estado->label.'">'.$estado->estado.'</span>'; ?></td>
          </tr>
        <?php endforeach ?>
  
      </tbody>
    </table>
      </div>
    </div>

  </div>
  <div id="menu1" class="tab-pane fade">
         <div class="row">
        <div class="col-md-12">
          <br>
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> MENSAJES
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div>
                </div>
            <div class="panel" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="images/user-avatar.png" alt="UserAvatar" class="img-circle" height="50px;" style="background-color:#f0f0f0;" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo strtoupper($ticket->nombre); ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php 
                                       echo Enum::timeElapsed($ticket->fecha, true,null,'');
                                        ?></small>
                                </div>
                               <p> <?php echo $ticket->mensaje; ?></p>
                            </div>
                        </li>
                        <?php foreach ($mensajes as $key => $value): ?>
                          <?php if(is_numeric($value->user_id)) :?>
                            <li class="right clearfix"><span class="chat-img pull-right">
                             <img src="images/user-kropsys-avatar.png" alt="Tecnico Avatar" class="img-circle" height="50px;" style="background-color:#f0f0f0;" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo Enum::timeElapsed($value->fecha, true,null,''); ?></small>
                                    <strong class="pull-right primary-font"></strong>
                                </div>
                                <p>
                                  <?php echo $value->mensaje; ?>
                                </p>
                            </div>
                        </li>
                      <?php else : ?>
                              <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="images/user-avatar.png" alt="UserAvatar" class="img-circle" height="50px;" style="background-color:#f0f0f0;" />

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo strtoupper($ticket->nombre); ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span><?php echo Enum::timeElapsed($value->fecha, true,null,''); ?></small>
                                </div>
                                <p>
                                   <?php echo $value->mensaje; ?>
                                </p>
                            </div>
                        </li>
                      <?php endif; ?>
                        <?php endforeach ?>

                    </ul>
                </div>
                <div class="panel-footer">
                   <?php if ($cerrado): ?>
                 
        
                    <div class="form-group">
                     <!--    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Respuesta..." />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                Enviar</button>
                        </span> -->
                      <textarea name="mensaje" id="" cols="30" rows="10" class="form-control"></textarea>

                    </div>
                    <div class="form-group">
                      <button class="btn btn-success" disabled="disabled">Responder</button>
                    </div>

                    <?php else: ?>
                                  <form action="index.php?r=areaclientes/default/response" method="post">
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
                      <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control"></textarea>

                    </div>
                    <div class="form-group">
                      <button class="btn btn-success">Responder</button>
                    </div>
                  </form>
                   <?php endif ?>

                </div>
            </div>
            </div>
        </div>
    </div>
  </div>
  <div id="menu2" class="tab-pane fade">
    <br>  
      <ul class="list-group">
        <?php 
        $count = 1;
        foreach ($files as $key => $value): ?>
          <li class="list-group-item"><a target="_blank" href="<?php   echo $value; ?>">Archivo <?php  echo $count; ?></a></li>
          <?php   $count++; ?>
        <?php endforeach ?>
        
      </ul>
  </div>
</div>



	</div>
</div>