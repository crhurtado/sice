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
				
		$ano_esc=trim($ano_esc);		
		$buscar="SELECT * FROM fisico_est WHERE ced_esc='$ced_esc'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		
		if($total>0){
			/* datos fisicos del estudiante registrados */
			
			$up="UPDATE fisico_est SET talla='$talla', peso='$peso', talla_c='$talla_c', talla_p='$talla_p', talla_z='$talla_z' WHERE ced_esc='$ced_esc'";
			
			mysql_query($up,$conexion);
			
			/* FIN datos fisicos del estudiante registrados */
			}
		else{
			/* datos fisicos del estudiante NO registrados */
			
			$ins="INSERT INTO fisico_est (ced_esc, talla, peso, talla_c, talla_p, talla_z) VALUES ('$ced_esc', '$talla', '$peso', '$talla_c', '$talla_p', '$talla_z')";
			
			mysql_query($ins, $conexion);
			
			/* FIN datos fisicos del estudiante no registrados */			
			}
		
		/* FIN GUARDADO DE TALLAS */
		
		
		$buscar="SELECT * FROM inscripcion WHERE ced_esc='$ced_esc' and ano_esc='$ano_esc'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		
		if($total>0){
			/*  Estudiante Inscrito para este año escolar */
			echo"<script>
				alert(Este estudiante ya se ha inscrito para el año escolar indicado');
				top.location.href='inscribir.php';
			</script>";
			/* FIN Estudiante Inscrito para este año escolar */
			}
		else{
			/*  Estudiante NO Inscrito para este año escolar */
			
			$buscar="SELECT * FROM inscripcion WHERE grado='$grado_act' and ano_esc='$ano_esc' and seccion='a'";
			$buscar2=mysql_query($buscar,$conexion);
			$total_a=mysql_num_rows($buscar2);
			
			$buscar="SELECT * FROM inscripcion WHERE grado='$grado_act' and ano_esc='$ano_esc' and seccion='b'";
			$buscar2=mysql_query($buscar,$conexion);
			$total_b=mysql_num_rows($buscar2);
			
			$buscar="SELECT * FROM inscripcion WHERE grado='$grado_act' and ano_esc='$ano_esc' and seccion='c'";
			$buscar2=mysql_query($buscar,$conexion);
			$total_c=mysql_num_rows($buscar2);
			
			?>
			
            <form name="form" method="post" id="formulario" action="inscribir12.php">
			<fieldset>
			<legend>Inscripción de estudiantes - Paso 7 (Seleccion de Sección) </legend>
			<table cellspacing="5">
				<tr>
					<td><label for="ced_esc">Cedula Escolar: </label></td>
					<td><input type="text" maxlength="11" value="<?php echo $ced_esc?>" disabled="disabled"/>
                    <input type="text" name="ced_esc" maxlength="11" value="<?php echo $ced_esc?>" hidden="true"/>
                    </td>
				</tr>
				<tr>
					<td colspan="2" id="ced_error" class="error"></td>
				</tr>
						  
				<tr>
					<td><label for="ano_esc">Año Escolar: </label></td>
					<td><input type="text" maxlength="10" value="<?php echo $ano_esc; ?>" disabled="disabled"/>
                    <input type="text" name="ano_esc" maxlength="10" value="<?php echo $ano_esc; ?>" hidden="true"/>
                    </td>
				</tr>
				<tr>
					<td colspan="2" id="ano_esc_error" class="error"></td>
				</tr>
				
				<tr>
					<td><label for="grado">Grado: </label></td>
					<td><input type="text" maxlength="10" value="<?php echo $grado_act;?>" disabled="disabled"/>
                    <input type="text" name="grado" maxlength="11" value="<?php echo $grado_act?>" hidden="true"/></td>
				</tr>
				<tr>
					<td colspan="2" id="grado_error" class="error"></td>
				</tr>
				
			   	<tr>
					<td colspan="2"> Cantidad de inscritos por sección </td>
				</tr>
				<tr>
					<td>Sección A: </td>
                    <td><?php echo $total_a ?></td>
				</tr>
                <tr>
					<td>Sección B: </td>
                    <td><?php echo $total_b ?></td>
				</tr>
                <tr>
					<td>Sección C: </td>
                    <td><?php echo $total_c ?></td>
				</tr> 
				
				<tr>
					<td><label for="seccion">Inscribir en la Sección: </label></td>
					<td>
                    <select name="seccion">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    </select>
                    </td>
				</tr>
				<tr>
					<td colspan="2" id="seccion_error" class="error"></td>
				</tr>
        	
										
			<tr>
			<td colspan="2" align="center">
			<br />
			<input type="button" accesskey="enter" onclick="submit()" value="Inscribir" align="center"/>
			</td>
			</tr>
			</table>
			</fieldset>   
			</form>	
            
            <?php					
			/* FIN Estudiante NO Inscrito para este año escolar */
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