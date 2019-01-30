<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<br>
<h4>Comprobante de cierre de ticket</h4>
<hr>

<?php 

$equipo = $ticket->getImpresora()->one(); 
$modelo = $equipo->getModelo0()->one();
$marca = $modelo->getMarca0()->one();
?>

<table class="table table-bordered table-condensed">
    <tbody>
    	<tr>
    		<th>Codigo de ticket</th>
    		<td><?php echo $ticket->ot; ?></td>
    	</tr>
        <tr>
          <th>Asunto</th>
            <td><?php echo strtoupper($asunto); ?></td>
        </tr>
        <tr>
          <th>Equipo</th>
            <td><?php echo strtoupper($marca->marca. ' '. $modelo->modelo); ?></td>
        </tr>
                <tr>
          <th>Numero de serie</th>
            <td><?php echo $equipo->serie; ?></td>
        </tr>
        <tr>
          <th>Ubicación</th>
            <td><?php echo strtoupper($equipo->ubicacion); ?></td>
        </tr>
        <tr>
          <th>Fecha de creacion</th>
            <td><?php  echo $ticket->fecha; ?></td>
        </tr>
                <tr>
          <th>Fecha de finalizacion</th>
            <td><?php  echo $fecha; ?></td>
        </tr>
		<tr>
          <th>Técnico responsable</th>
            <td><?php echo strtoupper($user->name.' '.$user->lastname); ?></td>
        </tr>
        <tr>
        	<th>Aceptó conforme</th>
        	<td><?php echo strtoupper($nombre); ?></td>
        </tr>

    </tbody>
</table>


<h4>Firma Digital</h4>
<img src="<?php echo $firma; ?>" class="img-thumbnail" alt="Firma de conformidad">


