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
            <td><?php echo $ma->marca; ?> </td>
        <tr>
          <th>MODELO :</th>
            <td><?php echo $mo->modelo; ?> </td>
        </tr>
        <tr>
          <th>CENTRO DE COSTOS :</th>
            <td><?php echo $cc->nom_cc; ?></td>
        </tr>
    </tbody>
</table>  </div>

  <div id="menu2" class="tab-pane fade">
    <br>
     <table class="table">
    <tbody>
    	<tr>
          <th>Nombre</th>
            <td><?php echo $imp->contacto; ?> </td>
        <tr>
        <tr>
          <th>Telefono</th>
            <td><?php echo $imp->telefono; ?> </td>
        <tr>
          <th>Email</th>
            <td><?php echo $imp->email; ?></td>
        </tr>
    </tbody>
</table> 
  </div>

</div>

<div class="row"><div class="col-md-12">
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
   
       <?php foreach ($detalle as $row): ?>
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
</div></div>