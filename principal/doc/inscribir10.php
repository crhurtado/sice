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
		
				
		$buscar="SELECT * FROM soc_eco_otro WHERE ced_otro='$ced_otro_ant'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		if($total>0){
			/* ced de otro registrada en BD */
			if($ced_otro_ant!=$ced_otro){
				/*ced de otro modificada */
				
				$buscar="SELECT * FROM soc_eco_otro WHERE ced_otro='$ced_otro'";
				$buscar2=mysql_query($buscar,$conexion);
				$total=mysql_num_rows($buscar2);
				
				if($total>0){
					/* ced modificada aparece en BD */
					echo"<script>
						alert('Numero de cédula registrado, cambio de cedula no guardado');
					</script>";
					
					$up="UPDATE soc_eco_otro SET apellidos='$apellidos', nombres='$nombres', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_otro='$telf_otro' WHERE ced_otro='$ced_otro_ant'";
				
					mysql_query($up,$conexion);
					}
				else{
					/* ced modificada no aparece en BD */
					
					$up="UPDATE soc_eco_otro SET apellidos='$apellidos', nombres='$nombres', ced_otro='$ced_otro', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_otro='$telf_otro' WHERE ced_otro='$ced_otro_ant'";
				
					mysql_query($up,$conexion);					
					setcookie("ced_otro",$ced_otro);
					}
				}
			else{
				/* ced de otro no modificada*/
				$up="UPDATE soc_eco_otro SET apellidos='$apellidos', nombres='$nombres', nacionalidad='$nacionalidad', lugar_nac='$lugar_nac', dia_nac='$dia_nac', mes_nac='$mes_nac', ano_nac='$ano_nac', edad='$edad', estado_civil='$estado_civil', instruccion='$instruccion', oficio='$oficio', trabajo='$trabajo', ingreso='$ingreso', religion='$religion', convive='$convive', direccion='$direccion', telf_otro='$telf_otro' WHERE ced_otro='$ced_otro'";
				
				mysql_query($up,$conexion);				
				}			
			}
		else{
			/* ced de otro no registrada en la BD */
			
			$ins="INSERT INTO soc_eco_otro (apellidos, nombres, ced_otro, nacionalidad, lugar_nac, dia_nac, mes_nac, ano_nac, edad, estado_civil, instruccion, oficio, trabajo, ingreso, religion, convive, direccion, telf_otro) VALUE ('$apellidos', '$nombres', '$ced_otro', '$nacionalidad', '$lugar_nac', '$dia_nac', '$mes_nac', '$ano_nac', '$edad', '$estado_civil', '$instruccion', '$oficio', '$trabajo', '$ingreso', '$religion', '$convive', '$direccion', '$telf_otro')";
				
			mysql_query($ins,$conexion);					
			setcookie("ced_otro",$ced_otro);
			}
			
		?>    	
    
<!-- FIN DEL GUARDADO EN LA BD !-->
    
    
    
	<?php
	
	$ced_doc=$_SESSION['cedula'];
	
	
	?>
    
	<form name="form" method="post" id="formulario" action="inscribir11.php">
			<fieldset>
			<legend>Inscripción de estudiantes - Paso 6 (Datos del estudiante) </legend>
			<table cellspacing="5">
				<tr>
					<td><label for="ced_esc">Cedula Escolar: </label></td>
					<td><input type="text" name="ced_esc" maxlength="11" value="<?php echo $ced_esc?>" disabled="disabled"/>
                    <input type="text" name="ced_esc" maxlength="11" value="<?php echo $ced_esc?>" hidden="true"/>
                    <input type="text" name="grado_act" maxlength="11" value="<?php echo $grado_act?>" hidden="true"/></td>
				</tr>
				<tr>
					<td colspan="2" id="ced_error" class="error"></td>
				</tr>
						  
				<tr>
					<td><label for="ano_esc">Año Escolar: </label></td>
					<td><input type="text" name="ano_esc" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="ano_esc_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="talla">Talla: </label></td>
					<td><input type="text" name="talla" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="talla_error" class="error"></td>
				</tr>
				
			   <tr>
					<td><label for="peso">Peso: </label></td>
					<td><input type="text" name="peso" maxlength="15"/></td>
				</tr>
				<tr>
					<td colspan="2" id="peso_error" class="error"></td>
				</tr> 
				
				<tr>
					<td><label for="talla_c">Talla de Camisa: </label></td>
					<td><input type="text" name="talla_c" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="talla_c_error" class="error"></td>
				</tr>
                
                <tr>
					<td><label for="talla_p">Talla de Pantalon: </label></td>
					<td><input type="text" name="talla_p" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="talla_p_error" class="error"></td>
				</tr>
                
                <tr>
					<td><label for="talla_z">Talla de Zapato: </label></td>
					<td><input type="text" name="talla_z" maxlength="10"/></td>
				</tr>
				<tr>
					<td colspan="2" id="talla_z_error" class="error"></td>
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