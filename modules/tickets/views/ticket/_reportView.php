<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<br>
<h4>Comprobante de cierre de ticket</h4>

<table class="table table-bordered table-condensed">
    <tbody>
    	<tr>
    		<th>Codigo de ticket</th>
    		<td><?php echo $ticket->ot; ?></td>
    	</tr>
        <tr>
          <th>Asunto</th>
            <td><?php echo $ticket->asunto; ?></td>
        </tr>
        <tr>
          <th>Equipo</th>
            <td></td>
        </tr>
                <tr>
          <th>Numero de serie</th>
            <td><?php echo $ticket->asunto; ?></td>
        </tr>
        <tr>
          <th>Ubicación</th>
            <td></td>
        </tr>
        <tr>
          <th>Fecha de creacion</th>
            <td><?php  echo $ticket->fecha; ?></td>
        </tr>
                <tr>
          <th>Fecha de finalizacion</th>
            <td><?php  echo $ticket->fecha; ?></td>
        </tr>
		<tr>
          <th>Técnico responsable</th>
            <td>LUCIANO FIGUEROA</td>
        </tr>
        <tr>
        	<th>Aceptó conforme</th>
        	<td>JORGE PEREZ</td>
        </tr>
        


    </tbody>
</table>


<h4>Firma Digital</h4>
<img src="<?php echo $firma; ?>" class="img-thumbnail" alt="Cinque Terre">


