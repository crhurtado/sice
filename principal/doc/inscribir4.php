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
	
	$ced_esc=$_POST['ced'];
	$ced_rep=$_COOKIE['ced_rep'];
	
	$buscar="SELECT * FROM datos_est WHERE ced_esc='$ced_esc' and ced_rep='$ced_rep'";
	$buscar2=mysql_query($buscar,$conexion);
	$total=mysql_num_rows($buscar2);
	
	if($total==1){
		/* el representante esta asociado al estudiante*/
		
		$vector=mysql_fetch_assoc($buscar2);
		
		foreach($vector as $nombre_campo => $valor){ 
		   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
		   eval($asignacion); 
		} 
		?>
		
        <form name="form" method="post" id="formulario" action="inscribir5.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 2 (Datos del Estudiante) </legend>
        <table cellspacing="5">
            <tr>
        		<td><label for="ced_esc">Cedula Escolar: </label></td>
                <td><input type="text" name="ced_esc" value="<?php echo $ced_esc?>" maxlength="15"/>
                <input type="text" name="ced_esc_ant" value="<?php echo $ced_esc?>" hidden="true"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="prim_apell">Primer Apellido: </label></td>
                <td><input type="text" name="prim_apell" value="<?php echo $prim_apell?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_apell_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="seg_apell">Segundo Apellido: </label></td>
                <td><input type="text" name="seg_apell" value="<?php echo $seg_apell?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_apell_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="prim_nomb">Primer Nombre: </label></td>
                <td><input type="text" name="prim_nomb" value="<?php echo $prim_nomb?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_nomb_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="seg_nomb">Segundo Nombre: </label></td>
                <td><input type="text" name="seg_nomb" value="<?php echo $seg_nomb?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_nomb_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ced">Cedula de Identidad: </label></td>
                <td><input type="text" name="ced" value="<?php echo $ced?>" maxlength="11"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ced_rep">Cedula del Representante: </label></td>
                <td><input type="text" name="ced_rep" value="<?php echo $ced_rep?>" maxlength="10"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_rep_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="lugar_nac">Lugar de Nacimiento: </label></td>
                <td><input type="text" name="lugar_nac" value="<?php echo $lugar_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="lugar_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="mun_nac">Municipio: </label></td>
                <td><input type="text" name="mun_nac" value="<?php echo $mun_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="mun_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_nac">Estado: </label></td>
                <td><input type="text" name="estado_nac" value="<?php echo $estado_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="pais_nac">Pais: </label></td>
                <td><input type="text" name="pais_nac" value="<?php echo $pais_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="pais_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td>Fecha de Nacimiento (DD/MM/AAAA):</td>
                <td><input type="text" name="dia_nac" value="<?php echo $dia_nac?>" maxlength="2" size="3"/> / 
                <input type="text" name="mes_nac" value="<?php echo $mes_nac?>" maxlength="2" size="3"/> / 
                <input type="text" name="ano_nac" value="<?php echo $ano_nac?>" maxlength="4" size="5"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="fecha_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="sexo">Sexo: </label></td>
                <td>
                <?php
				if($sexo=="M"){
					?>
                    <select name="sexo">
                    <option value="M" selected="selected">Masculino</option>
                    <option value="F">Femenino</option>
                    </select>
                    <?php
					}
					else {
						?>
                    <select name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F" selected="selected">Femenino</option>
                    </select>
                        <?php
						}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="sexo_error" class="error"></td>
            </tr>
                        
            <tr>
        		<td><label for="direccion_est">Dirección del Estudiante: </label></td>
                <td><input type="text" name="direccion_est" value="<?php echo $direccion_est?>" maxlength="80" size="50"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="direccion_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tlf_est">Telefono del Estudiante: </label></td>
                <td><input type="text" name="tlf_est" value="<?php echo $tlf_est?>" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="tlf_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nomb_plant">Plantel de Procedencia: </label></td>
                <td><input type="text" name="nomb_plant" value="E.B. Barinitas" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="nomb_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_plant">Estado: </label></td>
                <td><input type="text" name="estado_plant" value="Barinas" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nuevo_ing">Nuevo ingreso: </label></td>
                <td><select name="nuevo_ing">
                <option value="1">SI</option>
                <option value="0" selected="selected">NO</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="nuevo_ing_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="grado_culm">Grado Culminado: </label></td>
                <td>
                <?php
				if($grado_act==1){
					?>
                    <select name="grado_culm">
                    <option value="1" selected="selected">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==2){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" selected="selected">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==3){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3" selected="selected">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==4){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4" selected="selected">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==5){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" selected="selected">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==6){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
					
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_culm_error" class="error"></td>
            </tr>
            
            
            
            <tr>
        		<td><label for="grado_act">Grado a Cursar: </label></td>
                <td>
                <?php
				if($grado_act==1){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" selected="selected">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==2){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3" selected="selected">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==3){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4" selected="selected">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==4){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" selected="selected">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==5){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==6){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_act_error" class="error"></td>
            </tr>
                       
            <tr>
        		<td><label for="calif_ant">Expresión Literal Obtenida: </label></td>
                <td><select name="calif_ant">
                <option value="0" selected="selected">--</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="calif_ant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="beca">Posee Beca Escolar: </label></td>
                <td>
                <?php
				if($beca==1){
					?>
                    <select name="beca">
                    <option value="1" selected="selected">SI</option>
                    <option value="2">NO</option>
                    </select>
                    <?php
					}
					else {
						?>
                    <select name="beca">
                    <option value="1">SI</option>
                    <option value="0" selected="selected">NO</option>
                    </select>
                        <?php
						}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="beca_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="organismo">Organismo que la entrega: </label></td>
                <td><input type="text" name="organismo" value="<?php echo $organismo?>" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="organismo_error" class="error"></td>
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
		}
	else{
		/* representante no asociado al estudiante*/
		
		
		$buscar="SELECT * FROM datos_est WHERE ced_esc='$ced_esc'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		if($total==1){
			/*Estudiante registrado con otro representante*/
			echo"<script> 
			NoRep(); 
			</script>";
			
			$vector=mysql_fetch_assoc($buscar2);
		
		
		foreach($vector as $nombre_campo => $valor){ 
		   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
		   eval($asignacion); 
		} 
		?>
		
        <form name="form" method="post" id="formulario" action="inscribir5.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 2 (Datos del Estudiante) </legend>
        <table cellspacing="5">            
            <tr>
        		<td><label for="ced_est">Cedula Escolar: </label></td>
                <td><input type="text" name="ced_esc" value="<?php echo $ced_esc?>" maxlength="15"/>
                <input type="text" name="ced_esc_ant" value="<?php echo $ced_esc?>" hidden="true"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="prim_apell">Primer Apellido: </label></td>
                <td><input type="text" name="prim_apell" value="<?php echo $prim_apell?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_apell_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="seg_apell">Segundo Apellido: </label></td>
                <td><input type="text" name="seg_apell" value="<?php echo $seg_apell?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_apell_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="prim_nomb">Primer Nombre: </label></td>
                <td><input type="text" name="prim_nomb" value="<?php echo $prim_nomb?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_nomb_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="seg_nomb">Segundo Nombre: </label></td>
                <td><input type="text" name="seg_nomb" value="<?php echo $seg_nomb?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_nomb_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ced">Cedula de Identidad: </label></td>
                <td><input type="text" name="ced" value="<?php echo $ced?>" maxlength="11"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <?php 
			$ced_rep_ant=$ced_rep;
			$ced_rep=$_COOKIE['ced_rep'];			
			?>
            <tr>
        		<td><label for="ced_rep">Cedula del Representante: </label></td>
                <td><input type="text" name="ced_rep" value="<?php echo $ced_rep?>" maxlength="10"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_rep_error" class="error"></td>
            </tr>
            <tr>
            <td>Representante Actual:</td>
            <td><?php echo $ced_rep_ant; ?></td>
            </tr>
            
            <tr>
        		<td><label for="lugar_nac">Lugar de Nacimiento: </label></td>
                <td><input type="text" name="lugar_nac" value="<?php echo $lugar_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="lugar_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="mun_nac">Municipio: </label></td>
                <td><input type="text" name="mun_nac" value="<?php echo $mun_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="mun_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_nac">Estado: </label></td>
                <td><input type="text" name="estado_nac" value="<?php echo $estado_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="pais_nac">Pais: </label></td>
                <td><input type="text" name="pais_nac" value="<?php echo $pais_nac?>" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="pais_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td>Fecha de Nacimiento (DD/MM/AAAA):</td>
                <td><input type="text" name="dia_nac" value="<?php echo $dia_nac?>" maxlength="2" size="3"/> / 
                <input type="text" name="mes_nac" value="<?php echo $mes_nac?>" maxlength="2" size="3"/> / 
                <input type="text" name="ano_nac" value="<?php echo $ano_nac?>" maxlength="4" size="5"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="fecha_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="sexo">Sexo: </label></td>
                <td>
                <?php
				if($sexo=="M"){
					?>
                    <select name="sexo">
                    <option value="M" selected="selected">Masculino</option>
                    <option value="F">Femenino</option>
                    </select>
                    <?php
					}
					else {
						?>
                    <select name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F" selected="selected">Femenino</option>
                    </select>
                        <?php
						}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="sexo_error" class="error"></td>
            </tr>
                        
            <tr>
        		<td><label for="direccion_est">Dirección del Estudiante: </label></td>
                <td><input type="text" name="direccion_est" value="<?php echo $direccion_est?>" maxlength="80" size="50"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="direccion_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tlf_est">Telefono del Estudiante: </label></td>
                <td><input type="text" name="tlf_est" value="<?php echo $tlf_est?>" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="tlf_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nomb_plant">Plantel de Procedencia: </label></td>
                <td><input type="text" name="nomb_plant" value="E.B. Barinitas" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="nomb_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_plant">Estado: </label></td>
                <td><input type="text" name="estado_plant" value="Barinas" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nuevo_ing">Nuevo ingreso: </label></td>
                <td><select name="nuevo_ing">
                <option value="1">SI</option>
                <option value="0" selected="selected">NO</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="nuevo_ing_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="grado_culm">Grado Culminado: </label></td>
                <td>
                <?php
				if($grado_act==1){
					?>
                    <select name="grado_culm">
                    <option value="1" selected="selected">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==2){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" selected="selected">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==3){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3" selected="selected">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==4){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4" selected="selected">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==5){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" selected="selected">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==6){
					?>
                    <select name="grado_culm">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
					
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_culm_error" class="error"></td>
            </tr>
            
            
            
            <tr>
        		<td><label for="grado_act">Grado a Cursar: </label></td>
                <td>
                <?php
				if($grado_act==1){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" selected="selected">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==2){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3" selected="selected">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==3){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4" selected="selected">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==4){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" selected="selected">5to</option>
                    <option value="6">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==5){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
				if($grado_act==6){
					?>
                    <select name="grado_act">
                    <option value="1">1ro</option>
                    <option value="2" >2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5" >5to</option>
                    <option value="6" selected="selected">6to</option>
                    </select>
                    <?php
					}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_act_error" class="error"></td>
            </tr>
                       
            <tr>
        		<td><label for="calif_ant">Expresión Literal Obtenida: </label></td>
                <td><select name="calif_ant">
                <option value="0" selected="selected">--</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="calif_ant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="beca">Posee Beca Escolar: </label></td>
                <td>
                <?php
				if($beca==1){
					?>
                    <select name="beca">
                    <option value="1" selected="selected">SI</option>
                    <option value="2">NO</option>
                    </select>
                    <?php
					}
					else {
						?>
                    <select name="beca">
                    <option value="1">SI</option>
                    <option value="0" selected="selected">NO</option>
                    </select>
                        <?php
						}
				?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="beca_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="organismo">Organismo que la entrega: </label></td>
                <td><input type="text" name="organismo" value="<?php echo $organismo?>" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="organismo_error" class="error"></td>
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
			}
		else{
			/*estudiante no registrado*/
		?>
			<form name="form" method="post" id="formulario" action="inscribir5.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 2 (Datos del Estudiante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_est">Cedula Escolar: </label></td>
                <td><input type="text" name="ced_esc" maxlength="15"/>
                <input type="text" name="ced_esc_ant" value="0" hidden="true" /></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
                      
            <tr>
        		<td><label for="prim_apell">Primer Apellido: </label></td>
                <td><input type="text" name="prim_apell" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_apell_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="seg_apell">Segundo Apellido: </label></td>
                <td><input type="text" name="seg_apell" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_apell_error" class="error"></td>
            </tr>
            
           <tr>
        		<td><label for="prim_nomb">Primer Nombre: </label></td>
                <td><input type="text" name="prim_nomb" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="prim_nomb_error" class="error"></td>
            </tr> 
            
            <tr>
        		<td><label for="seg_nomb">Segundo Nombre: </label></td>
                <td><input type="text" name="seg_nomb" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="seg_nomb_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ced">Cedula de Identidad: </label></td>
                <td><input type="text" name="ced" maxlength="11"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="ced_rep">Cedula del Representante: </label></td>
                <td><input type="text" name="ced_rep"maxlength="10"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_rep_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="lugar_nac">Lugar de Nacimiento: </label></td>
                <td><input type="text" name="lugar_nac" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="lugar_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="mun_nac">Municipio: </label></td>
                <td><input type="text" name="mun_nac" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="mun_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_nac">Estado: </label></td>
                <td><input type="text" name="estado_nac" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="pais_nac">Pais: </label></td>
                <td><input type="text" name="pais_nac" value="Venezuela" maxlength="35"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="pais_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td>Fecha de Nacimiento (DD/MM/AAAA):</td>
                <td><input type="text" name="dia_nac" maxlength="2" size="3"/> /
                <input type="text" name="mes_nac" maxlength="2" size="3"/> /
                <input type="text" name="ano_nac" maxlength="4" size="5"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="fecha_nac_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="sexo">Sexo: </label></td>
                <td>                
                    <select name="sexo">
                    <option value="0" selected="selected">--</option>
                    <option value="M" >Masculino</option>
                    <option value="F">Femenino</option>
                    </select>                
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="sexo_error" class="error"></td>
            </tr>
                        
            <tr>
        		<td><label for="direccion_est">Dirección del Estudiante: </label></td>
                <td><input type="text" name="direccion_est" maxlength="80" size="50"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="direccion_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tlf_est">Telefono del Estudiante: </label></td>
                <td><input type="text" name="tlf_est" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="tlf_est_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nomb_plant">Plantel de Procedencia: </label></td>
                <td><input type="text" name="nomb_plant" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="nomb_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="estado_plant">Estado: </label></td>
                <td><input type="text" name="estado_plant" maxlength="60"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="estado_plant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nuevo_ing">Nuevo ingreso: </label></td>
                <td><select name="nuevo_ing">
                <option selected="selected">--</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="nuevo_ing_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="grado_culm">Grado Culminado: </label></td>
                <td>               
                    <select name="grado_culm">
                    <option value="0" selected="selected">--</option>
                    <option value="1">1ro</option>
                    <option value="2">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_culm_error" class="error"></td>
            </tr>
            
            
            
            <tr>
        		<td><label for="grado_act">Grado a Cursar: </label></td>
                <td>
                    <select name="grado_act">
                    <option value="0" selected="selected">--</option>
                    <option value="1">1ro</option>
                    <option value="2">2do</option>
                    <option value="3">3ro</option>
                    <option value="4">4to</option>
                    <option value="5">5to</option>
                    <option value="6">6to</option>
                    </select>                   
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="grado_act_error" class="error"></td>
            </tr>
                       
            <tr>
        		<td><label for="calif_ant">Expresión Literal Obtenida: </label></td>
                <td><select name="calif_ant">
                <option value="0" selected="selected">--</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" id="calif_ant_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="beca">Posee Beca Escolar: </label></td>
                <td>
                    <select name="beca">
                    <option value="0" selected="selected">--</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                    </select>                   
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="beca_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="organismo">Organismo que la entrega: </label></td>
                <td><input type="text" name="organismo" maxlength="14"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="organismo_error" class="error"></td>
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
			}
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