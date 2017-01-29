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
		
				
		$buscar="SELECT * FROM soc_eco_padre WHERE ced_padre='$ced_padre_ant'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		if($total>0){
			/* ced de padre registrada en BD */
			if($ced_padre_ant!=$ced_padre){
				/*ced de padre modificada */
				
				$buscar="SELECT * FROM soc_eco_padre WHERE ced_padre='$ced_padre'";
				$buscar2=mysql_query($buscar,$conexion);
				$total=mysql_num_rows($buscar2);
				
				if($total>0){
					/* ced modificada aparece en BD */
					echo"<script>
						alert('Numero de cédula registrado, cambio de cedula no guardado');
					</script>";
					
					$up="UPDATE soc_eco_padre SET apellidos='$apellidos', nombres='$nombres', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_padre='$telf_padre' WHERE ced_padre='$ced_padre_ant'";
				
					mysql_query($up,$conexion);
					}
				else{
					/* ced modificada no aparece en BD */
					
					$up="UPDATE soc_eco_padre SET apellidos='$apellidos', nombres='$nombres', ced_padre='$ced_padre', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_padre='$telf_padre' WHERE ced_padre='$ced_padre_ant'";
				
					mysql_query($up,$conexion);					
					setcookie("ced_padre",$ced_padre);
					}
				}
			else{
				/* ced de padre no modificada*/
				$up="UPDATE soc_eco_padre SET apellidos='$apellidos', nombres='$nombres', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_padre='$telf_padre' WHERE ced_padre='$ced_padre_ant'";
				
				mysql_query($up,$conexion);				
				}			
			}
		else{
			/* ced de padre no registrada en la BD */
			
			$ins="INSERT INTO soc_eco_padre (apellidos, nombres, ced_padre, nacionalidad, lugar_nac, dia_nac, mes_nac, ano_nac, edad, estado_civil, instruccion, oficio, trabajo, ingreso, religion, convive, direccion, telf_padre) VALUE ('$apellidos', '$nombres', '$ced_padre', '$nacionalidad', '$lugar_nac', '$dia_nac', '$mes_nac', '$ano_nac', '$edad', '$estado_civil', '$instruccion', '$oficio', '$trabajo', '$ingreso', '$religion', '$convive', '$direccion', '$telf_padre')";
				
			mysql_query($ins,$conexion);					
			setcookie("ced_padre",$ced_padre);
			}
			
		?>    	
    
<!-- FIN DEL GUARDADO EN LA BD !-->
    
    <?php
$buscar="SELECT * FROM grupo_fam WHERE ced_esc='$ced_esc'";
$buscar2=mysql_query($buscar);
$total=mysql_num_rows($buscar2);

if($total==0){
	/*  Estudiante no tiene registrado grupo familiar */
	?>
	<form name="form" method="post" id="formulario" action="inscribir9a.php">
		<fieldset>
		<legend>Inscripción de estudiantes - Paso 5 (Datos Socio-Económicos del Grupo Familiar) </legend>
		<table cellspacing="5">
			<tr><td colspan="2">Datos Socio-Económicos de Otro</td></tr>
			<tr>
				<td><label for="ced_otro">Cedula: </label></td>
				<td><input type="text" name="ced"/>
                <input type="text" value="<?php echo $ced_esc ?>" hidden="true" name="ced_esc"/>
                <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
			</tr>
			<tr>
				<td colspan="2" id="ced_error" class="error"></td>
			</tr>
									
		<tr>
		<td colspan="2" align="center">
		<br />
		<input type="button" accesskey="enter" onclick="submit()" value="Buscar" align="center"/>
		</td>
		</tr>
		</table>
		</fieldset>   
	</form> 
	
<?php
	/*  FIN Estudiante no tiene registrado grupo familiar */
	}
else{
	/*  Estudiante tiene registrado grupo familiar */
	
	$vector=mysql_fetch_array($buscar2,MYSQL_ASSOC);
	
	foreach($vector as $nombre_campo => $valor){ 
	   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
	   eval($asignacion);    
	}
	
	setcookie("ced_otro",$ced_otro);

	
	if($ced_otro==0){
	/*  Cedula de otro no aparece en grupo familiar  */
	?>
	<form name="form" method="post" id="formulario" action="inscribir9a.php">
		<fieldset>
		<legend>Inscripción de estudiantes - Paso 5 (Datos Socio-Económicos del Grupo Familiar) </legend>
		<table cellspacing="5">
			<tr><td colspan="2">Datos Socio-Económicos de Otro</td></tr>
			<tr>
				<td><label for="ced_otro">Cedula: </label></td>
				<td><input type="text" name="ced"/>
                <input type="text" value="<?php echo $ced_esc ?>" hidden="true" name="ced_esc"/>
                <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
			</tr>
			<tr>
				<td colspan="2" id="ced_error" class="error"></td>
			</tr>
									
		<tr>
		<td colspan="2" align="center">
		<br />
		<input type="button" accesskey="enter" onclick="submit()" value="Buscar" align="center"/>
		</td>
		</tr>
		</table>
		</fieldset>   
	</form> 	
	<?php
	/*  FIN Cedula de otro no aparece en grupo familiar  */
	}
else{
	/* Cedula de otro aparece en grupo familiar */
	
	$buscar="SELECT * FROM soc_eco_otro WHERE ced_otro='$ced_otro'";
	$buscar2=mysql_query($buscar, $conexion);
	$total=mysql_num_rows($buscar2);
	
	if($total==0){
		
		?>
		<form name="form" method="post" id="formulario" action="inscribir10.php">
			<fieldset>
			<legend>Inscripción de estudiantes - Paso 5 (Datos Socio-Económicos del Grupo Familiar) </legend>
			<table cellspacing="5">
				<tr><td colspan="2">Datos Socio-Económicos de Otro</td></tr>
				<tr>
					<td><label for="ced_otro">Cedula: </label></td>
					<td><input type="text" name="ced_otro" maxlength="11" value="<?php echo $ced_otro?>"/>
                    <input type="text" name="ced_otro_ant" maxlength="11" value="<?php echo $ced_otro?>" hidden="true"/>
                    <input type="text" value="<?php echo $ced_esc ?>" hidden="true" name="ced_esc"/>
                    <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
				</tr>
				<tr>
					<td colspan="2" id="ced_error" class="error"></td>
				</tr>
						  
				<tr>
					<td><label for="nombres">Nombres: </label></td>
					<td><input type="text" name="nombres" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="nombres_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="oapellidos">Apellidos: </label></td>
					<td><input type="text" name="apellidos" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="apellidos_error" class="error"></td>
				</tr>
				
			   <tr>
					<td><label for="nacionalidad">Nacionalidad: </label></td>
					<td><input type="text" name="nacionalidad" maxlength="20" value="Venezolana"/></td>
				</tr>
				<tr>
					<td colspan="2" id="nacionalidad_error" class="error"></td>
				</tr> 
				
				<tr>
					<td><label for="lugar_nac">Lugar de Nacimiento: </label></td>
					<td><input type="text" name="lugar_nac" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="lugar_nac_error" class="error"></td>
				</tr>
							
				<tr>
					<td>Fecha de Nacimiento <br />(DD/MM/AAAA):</td>
					<td><input type="text" name="dia_nac" maxlength="2" size="3"/> /
					<input type="text" name="mes_nac" maxlength="2" size="3"/> /
					<input type="text" name="ano_nac" maxlength="4" size="5"/></td>
				</tr>
				<tr>
					<td colspan="2" id="fecha_nac_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="edad">Edad: </label></td>
					<td><input type="text" name="edad" maxlength="3" size="5"/></td>
				</tr>
				<tr>
					<td colspan="2" id="edad_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="estado_civil">Estado Civil: </label></td>
					<td><input type="text" name="estado_civil" maxlength="20"/></td>
				</tr>
				<tr>
					<td colspan="2" id="estado_civil_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="instruccion">Grado de Instruccion / Profesión: </label></td>
					<td><input type="text" name="instruccion" maxlength="60"/></td>
				</tr>
				<tr>
					<td colspan="2" id="instruccion_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="oficio">Oficio u Ocupación: </label></td>
					<td><input type="text" name="oficio" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="oficio_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="trabajo">Lugar de trabajo: </label></td>
					<td><input type="text" name="trabajo" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="trabajo_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="ingreso">Ingreso Mensual: </label></td>
					<td><input type="text" name="ingreso" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="ingreso_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="religion">Religión que practica: </label></td>
					<td><input type="text" name="religion" maxlength="30"/></td>
				</tr>
				<tr>
					<td colspan="2" id="religion_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="convive">Convive con el estudiante: </label></td>
					<td>
					<select name="convive">
					<option value="1">SI</option>
					<option value="0">NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" id="religion_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="direccion">Dirección de habitación: </label></td>
					<td><input type="text" name="direccion" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="direccion_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="telf_otro">Telefono: </label></td>
					<td><input type="text" name="telf_otro" maxlength="80"/></td>
				</tr>
				<tr>
					<td colspan="2" id="telf_otro_error" class="error"></td>
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
	$vector=mysql_fetch_array($buscar2,MYSQL_ASSOC);
	
	foreach($vector as $nombre_campo => $valor){ 
	   $asignacion = "\$".$nombre_campo."='".$valor."';"; 
	   eval($asignacion);    
	}
	
	?>
	<form name="form" method="post" id="formulario" action="inscribir10.php">
	<fieldset>
	<legend>Inscripción de estudiantes - Paso 5 (Datos Socio-Económicos del Grupo Familiar) </legend>
	<table cellspacing="5">
		<tr><td colspan="2">Datos Socio-Económicos de Otro</td></tr>
		<tr>
			<td><label for="ced_otro">Cedula: </label></td>
			<td><input type="text" name="ced_otro" maxlength="11" value="<?php echo $ced_otro?>"/>
            <input type="text" name="ced_otro_ant" maxlength="11" value="<?php echo $ced_otro?>" hidden="true"/>
            <input type="text" value="<?php echo $ced_esc ?>" hidden="true" name="ced_esc"/>
            <input type="text" name="grado_act" maxlength="15" value="<?php echo $grado_act?>" hidden="true"/></td>
		</tr>
		<tr>
			<td colspan="2" id="ced_error" class="error"></td>
		</tr>
				  
		<tr>
			<td><label for="nombres">Nombres: </label></td>
			<td><input type="text" name="nombres" maxlength="80" value="<?php echo $nombres?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="nombres_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="oapellidos">Apellidos: </label></td>
			<td><input type="text" name="apellidos" maxlength="80" value="<?php echo $apellidos?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="apellidos_error" class="error"></td>
		</tr>
		
	   <tr>
			<td><label for="nacionalidad">Nacionalidad: </label></td>
			<td><input type="text" name="nacionalidad" maxlength="20" value="Venezolana" value="<?php echo $nacionalidad?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="nacionalidad_error" class="error"></td>
		</tr> 
		
		<tr>
			<td><label for="lugar_nac">Lugar de Nacimiento: </label></td>
			<td><input type="text" name="lugar_nac" maxlength="80" value="<?php echo $lugar_nac?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="lugar_nac_error" class="error"></td>
		</tr>
					
		<tr>
			<td>Fecha de Nacimiento <br />(DD/MM/AAAA):</td>
			<td><input type="text" name="dia_nac" maxlength="2" size="3" value="<?php echo $dia_nac?>"/> /
			<input type="text" name="mes_nac" maxlength="2" size="3" value="<?php echo $mes_nac?>"/> /
			<input type="text" name="ano_nac" maxlength="4" size="5" value="<?php echo $ano_nac?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="fecha_nac_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="edad">Edad: </label></td>
			<td><input type="text" name="edad" maxlength="3" size="5" value="<?php echo $edad?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="edad_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="estado_civil">Estado Civil: </label></td>
			<td><input type="text" name="estado_civil" maxlength="20" value="<?php echo $estado_civil?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="estado_civil_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="instruccion">Grado de Instruccion / Profesión: </label></td>
			<td><input type="text" name="instruccion" maxlength="60" value="<?php echo $instruccion?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="instruccion_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="oficio">Oficio u Ocupación: </label></td>
			<td><input type="text" name="oficio" maxlength="80" value="<?php echo $oficio?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="oficio_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="trabajo">Lugar de trabajo: </label></td>
			<td><input type="text" name="trabajo" maxlength="80" value="<?php echo $trabajo?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="trabajo_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="ingreso">Ingreso Mensual: </label></td>
			<td><input type="text" name="ingreso" maxlength="10" value="<?php echo $ingreso?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="ingreso_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="religion">Religión que practica: </label></td>
			<td><input type="text" name="religion" maxlength="30" value="<?php echo $religion?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="religion_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="convive">Convive con el estudiante: </label></td>
			<td>
			<?php if($convive==1){ ?>
			<select name="convive">
			<option value="1" selected="selected">SI</option>
			<option value="0">NO</option>
			</select>
			<?php }
			 if($convive==0){ ?>
			<select name="convive">
			<option value="1">SI</option>
			<option value="0" selected="selected">NO</option>
			</select>
			<?php }
			 ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" id="convive_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="direccion">Dirección de habitación: </label></td>
			<td><input type="text" name="direccion" maxlength="80" value="<?php echo $direccion?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="direccion_error" class="error"></td>
		</tr>
		
		<tr>
			<td><label for="telf_otro">Telefono: </label></td>
			<td><input type="text" name="telf_otro" maxlength="80" value="<?php echo $telf_otro?>"/></td>
		</tr>
		<tr>
			<td colspan="2" id="telf_otro_error" class="error"></td>
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
	/* FIN Cedula de Otro aparece en grupo familiar */
	}
			
/*  FIN Estudiante tiene registrado grupo familiar */
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