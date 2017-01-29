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
<script type="text/javascript">
			function NoRep(){
			var r=confirm("El estudiante se encuentra registrado por otro Representante.\n ¿Desea Continuar?");
			if (r==true)
			  {
			  return false;
			  }
			else
			  {
			  top.location.href='inscribir.php'
			  }
			}
</script>

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
		
	
		
	if($grado_culm==$grado_act){
		$repitiente=1;
		}
		else{
			$repitiente=0;
			}
	
	$buscar="SELECT * FROM datos_est WHERE ced_esc='$ced_esc_ant'";
	$buscar2=mysql_query($buscar);
	$total=mysql_num_rows($buscar2);
	
	/* total indica si el estudiante esta en la bd */
	
	if($total>0){
		/* estudiante esta en la bd */
		
		if($ced_esc!=$ced_esc_ant){
			/* Cedula escolar modificada*/
			
			$buscar="SELECT * FROM datos_est WHERE ced_esc='$ced_esc'";
			$buscar2=mysql_query($buscar,$conexion);
			$total=mysql_num_rows($buscar2);
			
			if($total>0){
				/* Cedula modificada está en la BD */
				echo"<script>
					alert('La Cedula Escolar que intenta registrar ya se encuentra registrada a nombre de otro estudiante');
					top.location.href='inscribir4.html';
				</script>";
				/* FIN Cedula modificada está en la BD */
				}
			else{
				/* Cedula modificada NO está en la BD */
				
				
				$up="UPDATE datos_est SET ced_esc='$ced_esc', prim_apell='$prim_apell', seg_apell='$seg_apell', prim_nomb='$prim_nomb', seg_nomb='$seg_nomb', ced='$ced', ced_rep='$ced_rep', lugar_nac='$lugar_nac', mun_nac='$mun_nac', estado_nac='$estado_nac', pais_nac='$pais_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', sexo='$sexo', direccion_est='$direccion_est', tlf_est='$tlf_est', nomb_plant='$nomb_plant', estado_plant='$nomb_plant', grado_culm='$grado_culm', nuevo_ing='$nuevo_ing', grado_act='$grado_act', repitiente='$repitiente', calif_ant='$calif_ant', beca='$beca', organismo='$organismo' WHERE ced_esc='$ced_esc_ant'";
				
				mysql_query($up,$conexion);
				
				setcookie("ced_esc",$ced_esc);
				setcookie("grado_act",$grado_act);
				
				/* FIN Cedula modificada NO está en la BD */
				}
					
			/* FIN cedula escolar modificada */
		}
		else{
			/* Cedula escolar NO modificada*/
			
			
			$up="UPDATE datos_est SET prim_apell='$prim_apell', seg_apell='$seg_apell', prim_nomb='$prim_nomb', seg_nomb='$seg_nomb', ced='$ced', ced_rep='$ced_rep', lugar_nac='$lugar_nac', mun_nac='$mun_nac', estado_nac='$estado_nac', pais_nac='$pais_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', sexo='$sexo', direccion_est='$direccion_est', tlf_est='$tlf_est', nomb_plant='$nomb_plant', estado_plant='$nomb_plant', grado_culm='$grado_culm', nuevo_ing='$nuevo_ing', grado_act='$grado_act', repitiente='$repitiente', calif_ant='$calif_ant', beca='$beca', organismo='$organismo' WHERE ced_esc='$ced_esc'";
				
				mysql_query($up,$conexion);
				setcookie("grado_act",$grado_act);
				setcookie("ced_esc",$ced_esc);
		
			/* FIN cedula escolar NO modificada */
			
		}
		/* FIN estudiante esta en la bd */
		}
	else{
		/* estudiante NO esta en la bd */
		
				
		$ins="INSERT INTO datos_est (ced_esc, prim_apell, seg_apell, prim_nomb, seg_nomb, ced, ced_rep, lugar_nac, mun_nac, estado_nac, pais_nac, dia_nac, mes_nac, ano_nac, sexo, direccion_est, tlf_est, nomb_plant, estado_plant, grado_culm, nuevo_ing, grado_act, repitiente, calif_ant, beca, organismo) VALUES ('$ced_esc', '$prim_apell', '$seg_apell', '$prim_nomb', '$seg_nomb', '$ced', '$ced_rep', '$lugar_nac', '$mun_nac', '$estado_nac', '$pais_nac', '$dia_nac', '$mes_nac', '$ano_nac', '$sexo', '$direccion_est', '$tlf_est', '$nomb_plant', '$estado_plant','$grado_culm', '$nuevo_ing', '$grado_act', '$repitiente', '$calif_ant', '$beca', '$organismo')";
		
		$insertar=mysql_query($ins,$conexion);
		
		setcookie("grado_act",$grado_act);
		setcookie("ced_esc",$ced_esc);
		
		/* FIN estudiante NO esta en la bd */		
		}
	
	
	$buscar="SELECT * FROM salud_est WHERE ced_esc='$ced_esc'";
	$buscar2=mysql_query($buscar);
	$total=mysql_num_rows($buscar2);
	
	if ($total==0){
		/* Datos de salud NO estan en BD */
		?>
		<form name="form" method="post" id="formulario" action="inscribir6.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 3 (Salud del Estudiante) </legend>
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
        		<td><label for="parto_tipo">El parto fue: </label></td>
                <td><select name="parto_tipo">
                <option value="0" selected="selected">--</option>
                <option value="1">Natural</option>
                <option value="2">Forceps</option>
                <option value="3">Cesarea</option>
                </select></td>
                <td><select name="parto_tiempo">
                <option value="0" selected="selected">--</option>
                <option value="1">Antes de Tiempo</option>
                <option value="2">A término</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="parto_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="enf_padece">Enfermedad que padece: </label></td>
                <td><input type="text" name="enf_padece" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="enf_padece_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="enf_padecida">Enfermedades que padecidas: </label></td>
                <td><input type="text" name="enf_padecida" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="enf_padecida_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="operaciones">Operaciones: </label></td>
                <td><input type="text" name="operaciones" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="operaciones_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="medicamento">Medicamento que se suministra: </label></td>
                <td><input type="text" name="medicamento" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="medicamento_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="alergia">Es Alergico: </label></td>
                <td><select name="alergia">
                <option value="0" selected="selected">NO</option>
                <option value="1">SI</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="alergia_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="alergias">Especifique: </label></td>
                <td><input type="text" name="alergias" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="alergias_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="">Limitaciones Físicas: </label></td>
           </tr>
            <tr>
           
            <tr>
                <td>Uso de Protesis: </td><td>
                <input type="text" name="protesis" value="0" hidden=""/>
                <input type="checkbox" name="protesis" value="1" />
                </td>
                
                <td>Visuales: </td><td>
                <input type="text" name="visual" value="0" hidden=""/>
                <input type="checkbox" name="visual" value="1" />
                </td>
            </tr>
            <tr>
                <td>Auditivas: </td><td>
                <input type="text" name="auditiva" value="0" hidden=""/>
                <input type="checkbox" name="auditiva" value="1" />
                </td>
                
                <td>Usa Lentes: </td><td>
                <input type="text" name="lentes" value="0" hidden=""/>
                <input type="checkbox" name="lentes" value="1" />
                </td>
            </tr>
            
            <tr>            	
                <td>Usa Aparatos: </td><td>
                <input type="text" name="aparatos" value="0" hidden=""/>
                <input type="checkbox" name="aparatos" value="1" />
                </td>
                
                <td>Conserva el equilibrio <br />al caminar: </td><td>
                <input type="text" name="equilibrio" value="0" hidden=""/>
                <input type="checkbox" name="equilibrio" value="1" />
                </td>
            </tr>
            
            </tr>
            
            <tr>
        		<td><br /><label for="dif_aprend">Dificultades para el aprendizaje <br />
                o necesidades especiales: </label></td>
                <td><input type="text" name="dif_aprend" maxlength="80"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="dif_aprend_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tipo_sangre">Tipo de sangre</label></td>
                <td><input type="text" name="tipo_sangre" maxlength="5" size="6"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_sangre_error" class="error"></td>
            </tr>
                        
            <tr>
        		<td><label for="">Tipo de Vacunas Recibidas: </label></td>
            </tr>
            <tr >
            
            <table style="text-align:right">
                <td>Polio: </td><td>
                <input type="text" name="polio" value="0" hidden=""/>
                <input type="checkbox" name="polio" value="1" />
                </td>
                
                <td>VCG: </td><td>
                <input type="text" name="vcg" value="0" hidden=""/>
                <input type="checkbox" name="vcg" value="1" />
                </td>
            </tr>
            <tr>
                <td>Toxoide: </td><td>
                <input type="text" name="toxoide" value="0" hidden=""/>
                <input type="checkbox" name="toxoide" value="1" />
                </td>
                
                <td>Triple: </td><td>
                <input type="text" name="triple" value="0" hidden=""/>
                <input type="checkbox" name="triple" value="1" />
                </td>
            </tr>
            
            <tr>            	
                <td>Fiebre Amarilla: </td><td>
                <input type="text" name="fiebre_ama" value="0" hidden=""/>
                <input type="checkbox" name="fiabre_ama" value="1" />
                </td>
                
                <td>Sarampion: </td><td>
                <input type="text" name="sarampion" value="0" hidden=""/>
                <input type="checkbox" name="sarampion" value="1" />
                </td>
            </tr>
            
            <tr>            	
                <td>Hepatitis: </td><td>
                <input type="text" name="hepatitis" value="0" hidden=""/>
                <input type="checkbox" name="hepatitis" value="1" />
                </td>
                
                <td>Influenza: </td><td>
                <input type="text" name="influenza" value="0" hidden=""/>
                <input type="checkbox" name="influenza" value="1" />
                </td>
            </tr>
            
            <tr>            	
                <td>Meningitis: </td><td>
                <input type="text" name="meningitis" value="0" hidden=""/>
                <input type="checkbox" name="meningitis" value="1" />
                </td>
            </tr>
            <tr> 
                <td>Otras: </td><td colspan="3">
                <input type="text" name="otras_vacunas" value="0" hidden=""/>
                <input type="text" name="otras_vacunas" maxlength="80" size="15"/>
                </td>
            </tr>
            </table>
            </tr>
            
                        			
        <tr>
        <td colspan="3" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="submit()" value="Continuar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form>
        <?php
		/* FIN Datos de salud NO estan en BD */
		}
	else{
		/* Datos de salud estan en BD */
		
		$vector=mysql_fetch_array($buscar2,MYSQL_ASSOC);
		
		foreach($vector as $nombre_campo => $valor){ 
		   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
		   eval($asignacion);
		}
		
		?>
		<form name="form" method="post" id="formulario" action="inscribir6.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 3 (Salud del Estudiante) </legend>
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
        		<td><label for="parto_tipo">El parto fue: </label></td>
                <td>
                <?php 
				if($parto_tipo==1){
				?>
                <select name="parto_tipo">
                <option value="1" selected="selected">Natural</option>
                <option value="2">Forceps</option>
                <option value="3">Cesarea</option>
                </select>
                <?php
				}
				if($parto_tipo==2){
				?>
                <select name="parto_tipo">
                <option value="1">Natural</option>
                <option value="2" selected="selected">Forceps</option>
                <option value="3">Cesarea</option>
                </select>
                <?php
				}
                if($parto_tipo==3){
				?>
                <select name="parto_tipo">
                <option value="1">Natural</option>
                <option value="2">Forceps</option>
                <option value="3" selected="selected">Cesarea</option>
                </select>
                <?php
				}
                ?>
                </td>
                <td>
                 <?php 
				if($parto_tiempo==1){
				?>
                <select name="parto_tiempo">
                <option value="1" selected="selected">Antes de Tiempo</option>
                <option value="2">A término</option>
                </select>
                <?php
				}
				if($parto_tiempo==2){
				?>
                <select name="parto_tiempo">
                <option value="1">Antes de Tiempo</option>
                <option value="2" selected="selected">A término</option>
                </select>
                <?php
				}
                ?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="parto_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="enf_padece">Enfermedad que padece: </label></td>
                <td><input type="text" name="enf_padece" maxlength="80" value="<?php echo $enf_padece?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="enf_padece_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="enf_padecida">Enfermedades que padecidas: </label></td>
                <td><input type="text" name="enf_padecida" maxlength="80" value="<?php echo $enf_padecida?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="enf_padecida_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="operaciones">Operaciones: </label></td>
                <td><input type="text" name="operaciones" maxlength="80" value="<?php echo $operaciones?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="operaciones_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="medicamento">Medicamento que se suministra: </label></td>
                <td><input type="text" name="medicamento" maxlength="80" value="<?php echo $medicamento?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="medicamento_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="alergia">Es Alergico: </label></td>
                <td>
                <?php 
				if($alergia==0){
				?>
                <select name="alergia">
                <option value="0" selected="selected">NO</option>
                <option value="1">SI</option>
                </select>
                <?php
				}
				if($alergia==1){
				?>
                <select name="alergia">
                <option value="0">NO</option>
                <option value="1" selected="selected">SI</option>
                </select>
                <?php
				}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="alergia_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="alergias">Especifique: </label></td>
                <td><input type="text" name="alergias" maxlength="80" value="<?php echo $alergias?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="alergias_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="">Limitaciones Físicas: </label></td>
           </tr>
            <tr>
           
            <tr>
                <td>Uso de Protesis: </td><td>
                <?php if ($protesis==0){?>
                <input type="text" name="protesis" value="0" hidden=""/>
                <input type="checkbox" name="protesis" value="1" />
                <?php
				}
				if ($protesis==1){?>
                <input type="text" name="protesis" value="0" hidden=""/>
                <input type="checkbox" name="protesis" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Visuales: </td><td>
                <?php if ($visual==0){?>
                <input type="text" name="visual" value="0" hidden=""/>
                <input type="checkbox" name="visual" value="1" />
                <?php
				}
				if ($visual==1){?>
                <input type="text" name="visual" value="0" hidden=""/>
                <input type="checkbox" name="visual" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            <tr>
                <td>Auditivas: </td><td>
                <?php if ($auditiva==0){?>
                <input type="text" name="auditiva" value="0" hidden=""/>
                <input type="checkbox" name="auditiva" value="1" />
                <?php
				}
				if ($auditiva==1){?>
                <input type="text" name="auditiva" value="0" hidden=""/>
                <input type="checkbox" name="auditiva" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Usa Lentes: </td><td>
                <?php if ($lentes==0){?>
                <input type="text" name="lentes" value="0" hidden=""/>
                <input type="checkbox" name="lentes" value="1" />
                <?php
				}
				if ($lentes==1){?>
                <input type="text" name="lentes" value="0" hidden=""/>
                <input type="checkbox" name="lentes" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            
            <tr>            	
                <td>Usa Aparatos: </td><td>
                <?php if ($aparatos==0){?>
                <input type="text" name="aparatos" value="0" hidden=""/>
                <input type="checkbox" name="aparatos" value="1"/>
                <?php
				}
				if ($aparatos==1){?>
                <input type="text" name="aparatos" value="0" hidden=""/>
                <input type="checkbox" name="aparatos" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Conserva el equilibrio <br />al caminar: </td><td>
                <?php if ($equilibrio==0){?>
                <input type="text" name="equilibrio" value="0" hidden=""/>
                <input type="checkbox" name="equilibrio" value="1" />
                <?php
				}
				if ($equilibrio==1){?>
                <input type="text" name="equilibrio" value="0" hidden=""/>
                <input type="checkbox" name="equilibrio" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            
            </tr>
            
            <tr>
        		<td><br /><label for="dif_aprend">Dificultades para el aprendizaje <br />
                o necesidades especiales: </label></td>
                <td><input type="text" name="dif_aprend" maxlength="80" value="<?php echo $dif_aprend?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="dif_aprend_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tipo_sangre">Tipo de sangre</label></td>
                <td><input type="text" name="tipo_sangre" maxlength="5" size="6" value="<?php echo $tipo_sangre?>"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_sangre_error" class="error"></td>
            </tr>
                        
            <tr>
        		<td><label for="">Tipo de Vacunas Recibidas: </label></td>
            </tr>
            <tr >
            
            <table style="text-align:right">
                <td>Polio: </td><td>
                 <?php if ($polio==0){?>
                <input type="text" name="polio" value="0" hidden=""/>
                <input type="checkbox" name="polio" value="1" />
                <?php
				}
				if ($polio==1){?>
                <input type="text" name="polio" value="0" hidden=""/>
                <input type="checkbox" name="polio" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>VCG: </td><td>
                 <?php if ($vcg==0){?>
                <input type="text" name="vcg" value="0" hidden=""/>
                <input type="checkbox" name="vcg" value="1" />
                <?php
				}
				if ($vcg==1){?>
                <input type="text" name="vcg" value="0" hidden=""/>
                <input type="checkbox" name="vcg" value="1" checked="checked"/>
                <?php
				}
				?>               
                </td>
            </tr>
            <tr>
                <td>Toxoide: </td><td>
                 <?php if ($toxoide==0){?>
                 <input type="text" name="toxoide" value="0" hidden=""/>
                <input type="checkbox" name="toxoide" value="1" />
                <?php
				}
				if ($toxoide==1){?>
                <input type="text" name="toxoide" value="0" hidden=""/>
                <input type="checkbox" name="toxoide" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Triple: </td><td>
                 <?php if ($triple==0){?>
               <input type="text" name="triple" value="0" hidden=""/>
                <input type="checkbox" name="triple" value="1" />
                <?php
				}
				if ($triple==1){?>
                <input type="text" name="triple" value="0" hidden=""/>
                <input type="checkbox" name="triple" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            
            <tr>            	
                <td>Fiebre Amarilla: </td><td>
                 <?php if ($fiebre_ama==0){?>
                <input type="text" name="fiebre_ama" value="0" hidden=""/>
                <input type="checkbox" name="fiebre_ama" value="1" />
                <?php
				}
				if ($fiebre_ama==1){?>
                 <input type="text" name="fiebre_ama" value="0" hidden=""/>
                <input type="checkbox" name="fiebre_ama" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Sarampion: </td><td>
                 <?php if ($sarampion==0){?>
                <input type="text" name="sarampion" value="0" hidden=""/>
                <input type="checkbox" name="sarampion" value="1" />
                <?php
				}
				if ($sarampion==1){?>
                <input type="text" name="sarampion" value="0" hidden=""/>
                <input type="checkbox" name="sarampion" value="1" checked="checked"/>
                <?php
				}
				?>                
                </td>
            </tr>
            
            <tr>            	
                <td>Hepatitis: </td><td>
                 <?php if ($hepatitis==0){?>
                <input type="text" name="hepatitis" value="0" hidden=""/>
                <input type="checkbox" name="hepatitis" value="1" />
                <?php
				}
				if ($hepatitis==1){?>
                <input type="text" name="hepatitis" value="0" hidden=""/>
                <input type="checkbox" name="hepatitis" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
                
                <td>Influenza: </td><td>
                 <?php if ($influenza==0){?>
                <input type="text" name="influenza" value="0" hidden=""/>
                <input type="checkbox" name="influenza" value="1" />
                <?php
				}
				if ($influenza==1){?>
               <input type="text" name="influenza" value="0" hidden=""/>
                <input type="checkbox" name="influenza" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            
            <tr>            	
                <td>Meningitis: </td><td>
                 <?php if ($meningitis==0){?>
                <input type="text" name="meningitis" value="0" hidden=""/>
                <input type="checkbox" name="meningitis" value="1"/>
                <?php
				}
				if ($meningitis==1){?>
                <input type="text" name="meningitis" value="0" hidden=""/>
                <input type="checkbox" name="meningitis" value="1" checked="checked"/>
                <?php
				}
				?>
                </td>
            </tr>
            <tr> 
                <td>Otras: </td><td colspan="3">
                 <?php if ($otras_vacunas==0){?>
                <input type="text" name="otras_vacunas" value="0" hidden=""/>
                <input type="text" name="otras_vacunas" maxlength="80" size="15"/>
                <?php
				}
				else{?>
                <input type="text" name="otras" maxlength="80" size="15" value="<?php echo $otras_vacunas?>"/>
                <?php
				}
				?>                
                </td>
            </tr>
            </table>
            </tr>
            
                        			
        <tr>
        <td colspan="3" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="submit()" value="Continuar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form>
		<?php
		/* FIN Datos de salud estan en BD */
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