<?php


include("consultas.php"); 
              $fac = $_GET['val']; 
              $consulta = new cConsultas;
              $result = $consulta->ObtenerCentros($fac);
              echo "<option>Selecciona..</option>";
              while ($row = mysql_fetch_array($result)) {
              echo "<option value=\"".$row['id_centro']."\">".$row['desc_centro']."</option>";
              }

?>

