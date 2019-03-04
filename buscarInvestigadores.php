<?php
include("consultas.php");
$expediente = $_POST['expediente'];
//CALCULAMOS EL PERIODO
$today = date("y.m.d");
	   $todays = explode(".",$today);  
	   $periodo = $todays[0];
	   
	   if($todays[1]==01 || $todays[1]==02 || $todays[1]==03 || $todays[1]==04 || $todays[1]==05 || $todays[1]==06 ){  $periodo .= 10;   }
	   
	   if($todays[1]==08 || $todays[1]==09 || $todays[1]==10 || $todays[1]==11 || $todays[1]==12 ){  $periodo .= 60;    }
	   
	 
	
	 
	 $consulta = new cConsultas;
     $user = $consulta->ObtenerUsuarios($expediente);
	 
	 if($user){
	 echo '<table width="100%" style="border:1px solid #960;">';
		echo '<tr><td style="border-right:1px solid #960; background:#CCC;">&nbsp</td><td style="border-right:1px solid #960; background:#CCC;"><strong>Expediente</strong></td><td style="border-right:1px solid #960; background:#CCC;"><strong>Nombre</strong></td><td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Paterno</strong></td><td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Materno</strong></td><td style="border-right:1px solid #960; background:#CCC;"><strong>Horas Inv.</strong></td>';
			        echo '</tr>';
					
					
					
		 echo '<tr >';
			 echo '<td style="border-right:1px solid #960;"><input type="radio" name="radio" onclick="IDSeleccionado(this.id);" id="'.$user[0].'" value="'.$user[0].'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$user[0].'<input type="hidden" name="hiddenField" id="expediente'.$user[0].'" value="'.$user[0].'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$user[2].'<input type="hidden" name="hiddenField" id="name'.$user[0].'" value="'.htmlentities($user[2]).'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.$user[3].'
			 <input type="hidden" name="hiddenField" id="apaterno'.$user[0].'" value="'.htmlentities($user[3]).'" />
			 </td>';
             echo '<td style="border-right:1px solid #960;">'.$user[4].'
			 <input type="hidden" name="hiddenField" id="amaterno'.$user[0].'" value="'.htmlentities($user[4]).'" />
			  <input type="hidden" name="tipo" id="tipo" value="anahuac" />
			  <input type="hidden" name="hiddenField" id="correo'.$user[0].'" value="'.$user[5].'" />
			 </td>';
	  echo '<td style="border-right:1px solid #960;">';
	
	   echo '<input type="hidden" name="hiddenField" id="horas'.$user[0].'" value="0" />';
			  echo '<input type="hidden" name="hiddenField" id="minutos'.$user[0].'" value="0" />';
			  echo '<input type="hidden" name="hiddenField" id="facultad'.$user[0].'" value="'.$user[11].'" />';
			  echo '<input type="hidden" name="hiddenField" id="contrato'.$user[0].'" value="'.$user[12].'" />';
			 echo '<input type="hidden" name="hiddenField" id="categoria'.$user[0].'" value="'.$user[13].'" />';
			  echo '<input type="hidden" name="hiddenField" id="grado'.$user[0].'" value="'.$user[9].'" />';
			   echo '</td>';
			   echo '</tr>';
			    echo '</table>';
	 
	 }
	 
	 
	 
	 

/*

       $db = "(description=(address=(protocol=tcp)(host=172.19.13.8)(port=1521))(connect_data=(service_name=RUA.anahuac.mx)(server=dedicated)))";
       $userbanner = "SITIOCTE_UAN";
       if($c = ocilogon($userbanner,"cte6132",$db))
	   {
		
		//verificamos si el usuario y contraseña estan correctos
		$query = " SELECT SPRIDEN_PIDM,SPRIDEN_ID, SPRIDEN_FIRST_NAME, SPRIDEN_LAST_NAME,GOREMAL_EMAIL_ADDRESS, "
		."SIBINST_FCTG_CODE, SIBINST_FSTP_CODE "
        ."FROM SPRIDEN,SIBINST,GOREMAL,STVFSTP "
        ."WHERE SIBINST_PIDM = SPRIDEN_PIDM AND "
       // ."GOREMAL_PIDM = SPRIDEN_PIDM AND "
        //."GOREMAL_EMAL_CODE = 'PERS' AND "
        ."STVFSTP_CODE = SIBINST_FSTP_CODE  AND "
		."GOREMAL_STATUS_IND ='A' AND "
        ."SPRIDEN_CHANGE_IND IS NULL AND " 
        ."SPRIDEN_ID='".$expediente."' AND "
      //  ."GOBTPAC_PIN = '".$pwd."' AND "
        ."rownum <= 1 ";
		
		//echo $query;
		
		
	$stmt = ociparse($c,$query);
	ociexecute($stmt,OCI_DEFAULT);
			
	 $nrows = OCIFetchStatement($stmt,$result);
		
	 
	 
		 if ($nrows<>0){
		
		echo '<table width="100%" style="border:1px solid #960;">';
		echo '<tr>';
			 echo '<td style="border-right:1px solid #960; background:#CCC;">&nbsp</td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Expediente</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Nombre</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Paterno</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Materno</strong></td>';
			 echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Horas Inv.</strong></td>';
			 //echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Categoría.</strong></td>';
       echo '</tr>';
			 	
		ociexecute($stmt,OCI_DEFAULT);
			while (ocifetch($stmt))
			 { 
			 

			 $arrapellidos = explode("*", ociresult($stmt,"SPRIDEN_LAST_NAME"));
		     $apaterno = $arrapellidos[0];
		     $amaterno = $arrapellidos[1];
			
			 echo '<tr >';
			 echo '<td style="border-right:1px solid #960;"><input type="radio" name="radio" onclick="IDSeleccionado(this.id);" id="'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SPRIDEN_ID").'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.ociresult($stmt,"SPRIDEN_ID").'<input type="hidden" name="hiddenField" id="expediente'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SPRIDEN_ID").'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.ociresult($stmt,"SPRIDEN_FIRST_NAME").'<input type="hidden" name="hiddenField" id="name'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SPRIDEN_FIRST_NAME").'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.htmlentities($apaterno).'
			 <input type="hidden" name="hiddenField" id="apaterno'.ociresult($stmt,"SPRIDEN_ID").'" value="'.htmlentities($apaterno).'" />
			 </td>';
             echo '<td style="border-right:1px solid #960;">'.htmlentities($amaterno).'
			 <input type="hidden" name="hiddenField" id="amaterno'.ociresult($stmt,"SPRIDEN_ID").'" value="'.htmlentities($amaterno).'" />
			  <input type="hidden" name="tipo" id="tipo" value="anahuac" />
			  <input type="hidden" name="hiddenField" id="correo'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"GOREMAL_EMAIL_ADDRESS").'" />
			 </td>';
			 
			 
		
			 echo '<td style="border-right:1px solid #960;">';
			 //CONSULTAMOS LAS HORAS DE EL INVESTIGADOR Y LA FACULTAD
			 $query2 = "SELECT SIRNIST_COLL_CODE, SUM(SIRNIST_NIST_WORKLOAD) AS HORAS "
			 ."FROM SIRNIST " 
			 ."WHERE SIRNIST_PIDM = '".ociresult($stmt,"SPRIDEN_PIDM")."' AND " 
			 ."SIRNIST_TERM_CODE='".$periodo."' AND "
			 ."SIRNIST_NIST_CODE IN('IDIF','INVE','INVO') "
			 ."GROUP BY SIRNIST_COLL_CODE";
			 
			 
			 $stmt2 = ociparse($c,$query2);
			 ociexecute($stmt2,OCI_DEFAULT);
			 
			 $nrows2 = OCIFetchStatement($stmt2,$results);
			 ociexecute($stmt2,OCI_DEFAULT);
			 
			 if($nrows2<>0){
			 
			 while (ocifetch($stmt2)){
	      	 echo ociresult($stmt2,"HORAS");
			 $horas = explode(".",ociresult($stmt2,"HORAS"));
			 if(sizeof($horas)==2){
			 $hora = $horas[0];
			 $min = $horas[1];
			 }else{
				 $hora = $horas[0];
			 $min = 0;
			 }
			 
			  echo '<input type="hidden" name="hiddenField" id="horas'.ociresult($stmt,"SPRIDEN_ID").'" value="'.$hora.'" />';
			  echo '<input type="hidden" name="hiddenField" id="minutos'.ociresult($stmt,"SPRIDEN_ID").'" value="'.$min.'" />';
			  echo '<input type="hidden" name="hiddenField" id="facultad'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt2,"SIRNIST_COLL_CODE").'" />';
			 
			 
	   	     }
			 }else{//NO TIENE HORAS
				echo "SIN HORAS"; 
				echo '<input type="hidden" name="hiddenField" id="horas'.ociresult($stmt,"SPRIDEN_ID").'" value="0" />';
			    echo '<input type="hidden" name="hiddenField" id="minutos'.ociresult($stmt,"SPRIDEN_ID").'" value="0" />';
			  
			  //COMO NO TIENE HORAS ASIGANADAS REVISAMOS DE QUE FACULTAD ES
			  
			   $query5 = "SELECT SIRNIST_COLL_CODE "
			 ."FROM SIRNIST " 
			 ."WHERE SIRNIST_PIDM = '".ociresult($stmt,"SPRIDEN_PIDM")."' AND " 
			 ."SIRNIST_TERM_CODE='".$periodo."' "
			 //."SIRNIST_NIST_CODE IN('IDIF','INVE','INVO') "
			 ."GROUP BY SIRNIST_COLL_CODE";
			// echo $query5;
			 
			 $stmt5 = ociparse($c,$query5);
			 ociexecute($stmt5,OCI_DEFAULT);
			 
			 $nrows5 = OCIFetchStatement($stmt2,$results);
			 ociexecute($stmt2,OCI_DEFAULT);
			 
			 if($nrows5<>0){
			 
			 while (ocifetch($stmt5)){
				 
			 echo '<input type="hidden" name="hiddenField" id="facultad'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt5,"SIRNIST_COLL_CODE").'" />';
			 }
			 }else{
			echo '<input type="hidden" name="hiddenField" id="facultad'.ociresult($stmt,"SPRIDEN_ID").'" value="SS" />';
			 }
			 
			  
			  
			 echo '<input type="hidden" name="hiddenField" id="facultad'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt2,"SIRNIST_COLL_CODE").'" />';
			  
			 }
			 echo '</td>';
			 
			 echo '<input type="hidden" name="hiddenField" id="contrato'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SIBINST_FSTP_CODE").'" />';
			 echo '<input type="hidden" name="hiddenField" id="categoria'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SIBINST_FCTG_CODE").'" />';
			
			
			//OBTENEMOS EL GRADO DE EL INVESTIGADOR
		$query3 = "SELECT * FROM "
		."(SELECT SORDEGR_DEGC_CODE,SORDEGR_DEGC_DATE FROM SORDEGR WHERE SORDEGR_PIDM='".ociresult($stmt,"SPRIDEN_PIDM")."' ORDER BY SORDEGR_DEGC_DATE DESC) " 
		."WHERE ROWNUM <= 1"; 
			 
			
			 $stmt3 = ociparse($c,$query3);
			 ociexecute($stmt3,OCI_DEFAULT);
			 
			 while (ocifetch($stmt3)){
	      	
			 echo '<input type="hidden" name="hiddenField" id="grado'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt3,"SORDEGR_DEGC_CODE").'" />';
			 }
			 
			 
             echo '</tr>';
			 
		
			 
			 }
			 echo '</table>';
		 }
		 else{
		   
		   

			  
		//SI NO ESTAN EN EN LA TABLA DE PROFESOREES ENTONCES LOS BUSCAMOS COMO ALUMNOS
		
		   //verificamos si el usuario y contraseña estan correctos
		$query = " SELECT SPRIDEN_PIDM,SPRIDEN_ID, SPRIDEN_FIRST_NAME, SPRIDEN_LAST_NAME,GOREMAL_EMAIL_ADDRESS "
		//."SIBINST_FCTG_CODE, SIBINST_FSTP_CODE "
        ."FROM SPRIDEN,GOREMAL "
        ."WHERE "
        ."GOREMAL_PIDM = SPRIDEN_PIDM AND "
        //."GOREMAL_EMAL_CODE = 'PERS' AND "
        //."STVFSTP_CODE = SIBINST_FSTP_CODE  AND "
		."GOREMAL_STATUS_IND ='A' AND "
        ."SPRIDEN_CHANGE_IND IS NULL AND " 
        ."SPRIDEN_ID='".$expediente."' AND "
      //  ."GOBTPAC_PIN = '".$pwd."' AND "
        ."rownum <= 1 ";
		
		
		
	$stmt = ociparse($c,$query);
	ociexecute($stmt,OCI_DEFAULT);
			
	 $nrows = OCIFetchStatement($stmt,$result);
	
	 
	 
		 if ($nrows<>0){
			 
			 
			 echo '<table width="100%" style="border:1px solid #960;">';
		echo '<tr>';
			 echo '<td style="border-right:1px solid #960; background:#CCC;">&nbsp</td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Expediente</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Nombre</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Paterno</strong></td>';
             echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Apellido Materno</strong></td>';
			 echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Horas Inv.</strong></td>';
			 //echo '<td style="border-right:1px solid #960; background:#CCC;"><strong>Categoría.</strong></td>';
       echo '</tr>';
			 	
		ociexecute($stmt,OCI_DEFAULT);
			while (ocifetch($stmt))
			 { 
			 

			 $arrapellidos = explode("*", ociresult($stmt,"SPRIDEN_LAST_NAME"));
		     $apaterno = $arrapellidos[0];
		     $amaterno = $arrapellidos[1];
			
			 echo '<tr >';
			 echo '<td style="border-right:1px solid #960;"><input type="radio" name="radio" onclick="IDSeleccionado(this.id);" id="'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SPRIDEN_ID").'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.ociresult($stmt,"SPRIDEN_ID").'<input type="hidden" name="hiddenField" id="expediente'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"SPRIDEN_ID").'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.htmlentities(ociresult($stmt,"SPRIDEN_FIRST_NAME")).'<input type="hidden" name="hiddenField" id="name'.ociresult($stmt,"SPRIDEN_ID").'" value="'.htmlentities(ociresult($stmt,"SPRIDEN_FIRST_NAME")).'" /></td>';
             echo '<td style="border-right:1px solid #960;">'.htmlentities($apaterno).'
			 <input type="hidden" name="hiddenField" id="apaterno'.ociresult($stmt,"SPRIDEN_ID").'" value="'.htmlentities($apaterno).'" />
			 </td>';
             echo '<td style="border-right:1px solid #960;">'.htmlentities($amaterno).'
			 <input type="hidden" name="hiddenField" id="amaterno'.ociresult($stmt,"SPRIDEN_ID").'" value="'.htmlentities($amaterno).'" />
			  <input type="hidden" name="tipo" id="tipo" value="anahuac" />
			   <input type="hidden" name="hiddenField" id="correo'.ociresult($stmt,"SPRIDEN_ID").'" value="'.ociresult($stmt,"GOREMAL_EMAIL_ADDRESS").'" />
			 </td>';
			 
			 echo '<input type="hidden" name="hiddenField" id="horas'.ociresult($stmt,"SPRIDEN_ID").'" value="0" />';
			    echo '<input type="hidden" name="hiddenField" id="minutos'.ociresult($stmt,"SPRIDEN_ID").'" value="0" />';
			 
			 echo '<input type="hidden" name="hiddenField" id="facultad'.ociresult($stmt,"SPRIDEN_ID").'" value="SS" />';
echo '<input type="hidden" name="hiddenField" id="contrato'.ociresult($stmt,"SPRIDEN_ID").'" value="TES" />';
 echo '<input type="hidden" name="hiddenField" id="categoria'.ociresult($stmt,"SPRIDEN_ID").'" value="EST" />';
echo '<input type="hidden" name="hiddenField" id="grado'.ociresult($stmt,"SPRIDEN_ID").'" value="ELC" />';
 echo '</tr>';
			 
			 }
			 
			 
		 }//END IF
		   
	
		   
	   }
	   }
*/
?>