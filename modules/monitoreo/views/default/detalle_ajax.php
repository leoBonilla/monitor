<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">DETALLE</a></li>
<!--   <li><a data-toggle="tab" href="#menu1">HISTORIAL</a></li> -->
  <li><a data-toggle="tab" href="#menu2">CONTACTO</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <br>
    <table class="table">
    <tbody>
    	<tr>
          <th>SERIE :</th>
            <td><?php echo $imp->serie; ?></td>
        <tr>
        <tr>
          <th>MARCA :</th>
            <td><?php echo $ma->marca; ?></td>
        <tr>
          <th>MODELO :</th>
            <td><?php echo $mo->modelo; ?></td>
        </tr>
        <tr>
          <th>CENTRO DE COSTOS :</th>
            <td><?php echo $cc->nom_cc; ?></td>
        </tr>
    </tbody>
</table>  </div>
<!--   <div id="menu1" class="tab-pane fade">
    <br>
   <table id="table_detalle " class="table table-striped table-bordered table-datatable" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>Detalle</th>
                <th>Estado</th>
               
            </tr>
        </thead>
        <tbody>
          <?php foreach($detalle as $row) :?>

          	<?php $res = $row->getTecnico()->one(); 
          	$es = $row->getEstado()->one(); 

          	
          	?>

         
                 <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->fecha; ?></td>
                <td><?php echo $res->username; ; ?></td>
                <td><?php echo $row->detalle; ?></td>
                <td><?php echo $es->estado; ?></td>
           
            </tr>

          <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>Detalle</th>
                <th>Estado</th>
                
            </tr>
        </tfoot>
    </table>
  </div> -->
  <div id="menu2" class="tab-pane fade">
    <br>
     <table class="table">
    <tbody>
    	<tr>
          <th>Nombre</th>
            <td><?php echo $imp->contacto; ?></td>
        <tr>
        <tr>
          <th>Telefono</th>
            <td><?php echo $imp->telefono; ?></td>
        <tr>
          <th>Modelo</th>
            <td><?php echo $imp->email; ?></td>
        </tr>
    </tbody>
</table> 
  </div>
</div>