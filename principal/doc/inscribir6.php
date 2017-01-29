<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if ($_SESSION["usuario"])
{ 
	if($_SESSION["nivel"]==3){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../estilos2.css" >
<title>Sistema Automatizado de Inscripción - Personal Docente</title>
<script type="text/javascript" src="../../validaciones.js"></script>


</head>

<body>
<div id="header"></div>

<div id="div_principal">
	<div id="menu">
    <?php include ("menu.html"); ?>
    </div>
    <div id="cuerpo" style="overflow-y:scroll">
    
	<?php
		
	require_once"../../conexion/conexion.php";
	
	foreach($_POST as $nombre_campo => $valor){ 
		   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
		   eval($asignacion);    
		}
		
	$buscar="SELECT * FROM salud_est WHERE ced_esc='$ced_esc'";
	$buscar2=mysql_query($buscar);
	$total=mysql_num_rows($buscar2);
	
	/* total indica si el estudiante esta en la bd */
	
	if($total>0){
		/* estudiante esta en la bd */
		
		$up="UPDATE salud_est SET parto_tipo='$parto_tipo', parto_tiempo='$parto_tiempo', enf_padece='$enf_padece', enf_padecida='$enf_padecida', operaciones='$operaciones', medicamento='$medicamento', alergia='$alergia', alergias='$alergias', protesis='$protesis', visual='$visual', auditiva='$auditiva', lentes='$lentes', aparatos='$aparatos', equilibrio='$equilibrio', dif_aprend='$dif_aprend', tipo_sangre='$tipo_sangre', polio='$polio', vcg='$vcg', toxoide='$toxoide', triple='$triple', fiebre_ama='$fiebre_ama', sarampion='$sarampion', hepatitis='$hepatitis', influenza='$influenza', meningitis='$meningitis', otras_vacunas='$otras_vacunas' WHERE ced_esc='$ced_esc'";
				
				mysql_query($up,$conexion);
		/* FIN estudiante esta en la bd */
		}
	else{
		/* estudiante NO esta en la bd */
		
				
		$ins="INSERT INTO salud_est (ced_esc, parto_tipo, parto_tiempo, enf_padece, enf_padecida, operaciones, medicamento, alergia, alergias, protesis, visual, auditiva, lentes, aparatos, equilibrio, dif_aprend, tipo_sangre, polio, vcg, toxoide, triple, fiebre_ama, sarampion, hepatitis, influenza, meningitis, otras_vacunas) VALUES ('$ced_esc', '$parto_tipo', '$parto_tiempo', '$enf_padece', '$enf_padecida', '$operaciones', '$medicamento', '$alergia', '$alergias', '$protesis', '$visual', '$auditiva', '$lentes', '$aparatos', '$equilibrio', '$dif_aprend', '$tipo_sangre', '$polio', '$vcg', '$toxoide', '$triple', '$fiebre_ama', '$sarampion', '$hepatitis', '$influenza', '$meningitis', '$otras_vacunas')";
		
		mysql_query($ins,$conexion);

		/* FIN estudiante NO esta en la bd */		
		}
	
	
	$buscar="SELECT * FROM soc_eco_est WHERE ced_esc='$ced_esc'";
	$buscar2=mysql_query($buscar);
	$total=mysql_num_rows($buscar2);
	
	if ($total==0){
		/* Datos soc_eco NO estan en BD */
		?>
		<form name="form" method="post" id="formulario" action="inscribir7.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 4 (Datos Socio-Económicos del Estudiante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_est">Cedula Escolar: </label></td>
                <td><input type="text" maxlength="15" value="<?php echo $ced_esc?>" disabled="disabled"/>
                <input type="text" name="ced_esc" maxlength="15" value="<?php echo $ced_esc?>" hidden="true"/>
                <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
                      
            <tr>
        		<td><label for="conviven">Personas que Conviven con el estudiante: </label></td>
                <td><input type="text" name="conviven" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="conviven_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="orientador">Orientador en sus tareas académicas: </label></td>
                <td><input type="text" name="orientador" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="orientador_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="hermanos">Hermanos que tiene en esta escuela <br /> (en números): </label></td>
                <td><input type="text" name="hermanos" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="hermanos_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="actividades">Actividades en que participa el estudiante <br /> en su hogar y la comunidad: </label></td>
                <td><input type="text" name="actividades" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="actividades_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tipo_vivienda">Tipo de vivienda: </label></td>
                <td><select name="tipo_vivienda">
                <option value="0" selected="selected">--</option>
                <option value="1">Apartamento</option>
                <option value="2">Casa</option>
                <option value="3">Quinta</option>
                <option value="4">Rancho</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_vivienda_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tenencia">Forma de tenencia: </label></td>
                <td><select name="tenencia">
                <option value="0" selected="selected">--</option>
                <option value="1">Propia</option>
                <option value="2">Alquilada</option>
                <option value="3">De un familiar</option>
                <option value="4">Hipotecada</option>
                <option value="5">Pagándola</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_vivienda_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ingreso">Ingreso mensual en su hogar: </label></td>
                <td><input type="text" name="ingreso" maxlength="20"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ingreso_error" class="error"></td>
            </tr>
            
             <tr>
        		<td><label for="religion">Religión que practica: </label></td>
                <td><input type="text" name="religion" maxlength="50"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="orientador_error" class="error"></td>
            </tr>
                                               
            <tr>
        		<td><label for="">Servicios Públicos: </label></td>
            </tr>
            
            <tr >            
            <table style="text-align:right">
            <tr>
                <td>Agua: </td><td>
                <input type="text" name="agua" value="0" hidden=""/>
                <input type="checkbox" name="agua" value="1" />
                </td>
                
                <td>Electricidad: </td><td>
                <input type="text" name="electricidad" value="0" hidden=""/>
                <input type="checkbox" name="electricidad" value="1" />
                </td>
            </tr>
            <tr>
                <td>Internet: </td><td>
                <input type="text" name="internet" value="0" hidden=""/>
                <input type="checkbox" name="internet" value="1" />
                </td>
                
                <td>Teléfono: </td><td>
                <input type="text" name="telefono" value="0" hidden=""/>
                <input type="checkbox" name="telefono" value="1" />
                </td>
            </tr>
            
            <tr>            	
                <td>Cloacas: </td><td>
                <input type="text" name="cloacas" value="0" hidden=""/>
                <input type="checkbox" name="cloacas" value="1" />
                </td>
                
                <td>Television por Cable: </td><td>
                <input type="text" name="tv_cable" value="0" hidden=""/>
                <input type="checkbox" name="tv_cable" value="1" />
                </td>
            </tr>
                        
            </table>
            </tr>
            
             
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="submit()" value="Continuar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form>
        <?php
		/* FIN Datos soc_eco NO estan en BD */
		}
	else{
		/* Datos soc estan en BD */
		
		$vector=mysql_fetch_array($buscar2,MYSQL_ASSOC);
		
		foreach($vector as $nombre_campo => $valor){ 
		   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
		   eval($asignacion);
		}
		
		?>
		<form name="form" method="post" id="formulario" action="inscribir7.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 4 (Datos Socio-Económicos del Estudiante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_est">Cedula Escolar: </label></td>
                <td><input type="text" maxlength="15" value="<?php echo $ced_esc?>" disabled="disabled"/>
                <input type="text" name="ced_esc" maxlength="15" value="<?php echo $ced_esc?>" hidden="true"/>
                <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
                      
            <tr>
        		<td><label for="conviven">Personas que Conviven con el estudiante: </label></td>
                <td><input type="text" name="conviven" maxlength="80" value="<?php echo $conviven?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="conviven_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="orientador">Orientador en sus tareas académicas: </label></td>
                <td><input type="text" name="orientador" maxlength="80" value="<?php echo $orientador?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="orientador_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="hermanos">Hermanos que tiene en esta escuela <br /> (en números): </label></td>
                <td><input type="text" name="hermanos" maxlength="80" value="<?php echo $hermanos?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="hermanos_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="actividades">Actividades en que participa el estudiante <br /> en su hogar y la comunidad: </label></td>
                <td><input type="text" name="actividades" maxlength="80" value="<?php echo $actividades?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="actividades_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tipo_vivienda">Tipo de vivienda: </label></td>
                <td>
                <?php if ($tipo_vivienda==1) {?>
                <select name="tipo_vivienda">
                <option value="1" selected="selected">Apartamento</option>
                <option value="2">Casa</option>
                <option value="3">Quinta</option>
                <option value="4">Rancho</option>
                </select>
                <?php }
				if ($tipo_vivienda==2) {?>
                <select name="tipo_vivienda">
                <option value="1" >Apartamento</option>
                <option value="2" selected="selected">Casa</option>
                <option value="3">Quinta</option>
                <option value="4">Rancho</option>
                </select>
                <?php }
				if ($tipo_vivienda==3) {?>
                <select name="tipo_vivienda">
                <option value="1" >Apartamento</option>
                <option value="2">Casa</option>
                <option value="3" selected="selected">Quinta</option>
                <option value="4">Rancho</option>
                </select>
                <?php }
				if ($tipo_vivienda==4) {?>
                <select name="tipo_vivienda">
                <option value="1" >Apartamento</option>
                <option value="2">Casa</option>
                <option value="3">Quinta</option>
                <option value="4" selected="selected">Rancho</option>
                </select>
                <?php }
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_vivienda_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tenencia">Forma de tenencia: </label></td>
                <td>
                <?php if ($tenencia==1) {?>
                <select name="tenencia">
                <option value="1" selected="selected">Propia</option>
                <option value="2">Alquilada</option>
                <option value="3">De un familiar</option>
                <option value="4">Hipotecada</option>
                <option value="5">Pagándola</option>
                </select>
                <?php }
				if ($tenencia==2) {?>
                <select name="tenencia">
                <option value="1" >Propia</option>
                <option value="2" selected="selected">Alquilada</option>
                <option value="3">De un familiar</option>
                <option value="4">Hipotecada</option>
                <option value="5">Pagándola</option>
                </select>
                <?php }
				if ($tenencia==3) {?>
                <select name="tenencia">
                <option value="1" >Propia</option>
                <option value="2">Alquilada</option>
                <option value="3" selected="selected">De un familiar</option>
                <option value="4">Hipotecada</option>
                <option value="5">Pagándola</option>
                </select>
                <?php }
				if ($tenencia==4) {?>
                <select name="tenencia">
                <option value="1" >Propia</option>
                <option value="2">Alquilada</option>
                <option value="3">De un familiar</option>
                <option value="4" selected="selected">Hipotecada</option>
                <option value="5">Pagándola</option>
                </select>
                <?php }
				if ($tenencia==5) {?>
                <select name="tenencia">
                <option value="1" >Propia</option>
                <option value="2">Alquilada</option>
                <option value="3">De un familiar</option>
                <option value="4">Hipotecada</option>
                <option value="5" selected="selected">Pagándola</option>
                </select>
                <?php }
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_vivienda_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ingreso">Ingreso mensual en su hogar: </label></td>
                <td><input type="text" name="ingreso" maxlength="20" value="<?php echo $ingreso?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ingreso_error" class="error"></td>
            </tr>
            
             <tr>
        		<td><label for="religion">Religión que practica: </label></td>
                <td><input type="text" name="religion" maxlength="50" value="<?php echo $religion?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="orientador_error" class="error"></td>
            </tr>
                                               
            <tr>
        		<td><label for="">Servicios Públicos: </label></td>
            </tr>
            
            <tr >            
            <table style="text-align:right">
            <tr>
            	
                <td>Agua: </td>
                <td>
                <?php if($agua==0){ ?>
                <input type="text" name="agua" value="0" hidden=""/>
                <input type="checkbox" name="agua" value="1" />
                <?php }
				if($agua==1){ ?>               
                <input type="text" name="agua" value="0" hidden=""/>
                <input type="checkbox" name="agua" value="1" checked="checked"/>
                <?php }
				?>
                </td>
                
                <td>Electricidad: </td>
                <td>
                <?php if($electricidad==0){ ?>
                <input type="text" name="electricidad" value="0" hidden=""/>
                <input type="checkbox" name="electricidad" value="1" />
                <?php }
				if($electricidad==1){ ?>               
                <input type="text" name="electricidad" value="0" hidden=""/>
                <input type="checkbox" name="electricidad" value="1" checked="checked"/>
                <?php }
				?>
                </td>
                
            </tr>
            <tr>
                <td>Internet: </td>
                <td>
                <?php if($internet==0){ ?>
               <input type="text" name="internet" value="0" hidden=""/>
                <input type="checkbox" name="internet" value="1" />
                <?php }
				if($internet==1){ ?>               
                <input type="text" name="internet" value="0" hidden=""/>
                <input type="checkbox" name="internet" value="1" checked="checked"/>
                <?php }
				?>
                </td>               
                
                <td>Teléfono: </td>
                <td>
                <?php if($telefono==0){ ?>
                <input type="text" name="telefono" value="0" hidden=""/>
                <input type="checkbox" name="telefono" value="1" />
                <?php }
				if($telefono==1){ ?>               
                <input type="text" name="telefono" value="0" hidden=""/>
                <input type="checkbox" name="telefono" value="1" checked="checked"/>
                <?php }
				?>
                </td>
            </tr>
            
            <tr>            	
                <td>Cloacas: </td>
                <td>
                <?php if($cloacas==0){ ?>
                <input type="text" name="cloacas" value="0" hidden=""/>
                <input type="checkbox" name="cloacas" value="1" />
                <?php }
				if($cloacas==1){ ?>               
                <input type="text" name="cloacas" value="0" hidden=""/>
                <input type="checkbox" name="cloacas" value="1" checked="checked"/>
                <?php }
				?>
                </td>
                
                <td>Television por Cable: </td>
                <td>
                <?php if($tv_cable==0){ ?>
                <input type="text" name="tv_cable" value="0" hidden=""/>
                <input type="checkbox" name="tv_cable" value="1" />
                <?php }
				if($tv_cable==1){ ?>               
                <input type="text" name="tv_cable" value="0" hidden=""/>
                <input type="checkbox" name="tv_cable" value="1" checked="checked"/>
                <?php }
				?>
                </td>
            </tr>
                        
            </table>
            </tr>
            
             
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="submit()" value="Continuar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form>
		<?php
		/* FIN Datos soc_eco estan en BD */
		}
	?>
    
    
    </div>
</div>
<div id="footer"></div>
</body>
</html>


<?php 
}
else{
	echo"<script>
		alert('Zona protegida, reservada para personal docente');
		top.location.href='../../index.html';
	</script>";
}
}
else {
	echo"<script>
		alert('Zona protegida, inicie sesion para acceder');
		top.location.href='../../index.html';
	</script>";}
	
?>