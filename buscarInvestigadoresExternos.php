<?php
include("consultas.php");



$expediente = $_POST['expediente'];
//$nombre = $_POST['nombre'];
//$apellidos = $_POST['apellidos'];


             $consulta = new cConsultas;
             $result = $consulta->ObtenerUsuariosExternos($expediente);
              
			  if($result){
				  echo '<table width="100%" style="border:1px solid #960;">';
		echo '<tr>';
			 echo '<td style="border-right:1px solid #960; background:#CCC;">&nbsp</td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Expediente</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Nombre</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Paterno</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Materno</strong></td>';
			
			
       echo '</tr>';
			  
             while ($row = mysql_fetch_array($result)) {
				  echo '<tr >';
			 echo '<td style="border-right:1px solid #960;"><input type="radio" name="radio" onclick="IDSeleccionado(this.id);" id="'.$row['id'].'" value="'.$row['id'].'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$row['id'].'<input type="hidden" name="hiddenField" id="expediente'.$row['id'].'" value="'.$row['id'].'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$row['nombre'].'<input type="hidden" name="hiddenField" id="name'.$row['id'].'" value="'.$row['nombre'].'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$row['apaterno'].'
			 <input type="hidden" name="hiddenField" id="apaterno'.$row['id'].'" value="'.$row['apaterno'].'" />
			 </td>';
             echo '<td style="border-right:1px solid #960;">'.$row['amaterno'].'
			 <input type="hidden" name="hiddenField" id="amaterno'.$row['id'].'" value="'.$row['amaterno'].'" />
			 <input type="hidden" name="tipo" id="tipo" value="externo" />
			 </td>';
			 
             echo '</tr>';
				 
              
              }
			  
			  echo '</table>';
			  }

	   
?>