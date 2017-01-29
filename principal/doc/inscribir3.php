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
    <div id="cuerpo">
    
    <?php
	
	require_once"../../conexion/conexion.php";
	
	$ced_rep=$_POST['ced_rep'];
	setcookie("ced_rep",$ced_rep);
	
	if($ced_rep!=$_POST['ced_ant']){
		/*ced de rep cambia*/
		
		$buscar="SELECT * FROM datos_rep WHERE ced_rep='$ced_rep'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		if($total>0){
			/*ced cambiada aparece en bd*/
			
			echo"<script>
			alert('Cédula ya registrada.');
			top.location.href='inscribir.php';
			</script>"; exit;
			}
		else{
			/*ced cambiada no aparece en bd*/
			$ced_rep=$_POST['ced_rep'];
			$nombres=$_POST['nombres'];
			$apellidos=$_POST['apellidos'];
			$telf_rep=$_POST['telf_rep'];
			$direccion_rep=$_POST['direccion_rep'];
			$ced_ant=$_POST['ced_ant'];
			
			
			$up="UPDATE datos_rep SET ced_rep='$ced_rep', nombres='$nombres', apellidos='$apellidos', telf_rep='$telf_rep', direccion_rep='$direccion_rep' WHERE ced_rep='$ced_ant'";
			mysql_query($up,$conexion);
			
			setcookie("ced_rep",$ced_rep);
									
			}
		}
	else{
		/*ced de rep no cambia*/
		$buscar="SELECT * FROM datos_rep WHERE ced_rep='$ced_rep'";
		$buscar2=mysql_query($buscar,$conexion);
		$total=mysql_num_rows($buscar2);
		
		if($total==0){
			/*ced no aparece en bd*/
			
			$ced_rep=$_POST['ced_rep'];
			$nombres=$_POST['nombres'];
			$apellidos=$_POST['apellidos'];
			$telf_rep=$_POST['telf_rep'];
			$direccion_rep=$_POST['direccion_rep'];
			
			$ins="INSERT INTO datos_rep (ced_rep, nombres, apellidos, telf_rep, direccion_rep) VALUES ('$ced_rep', '$nombres', '$apellidos', '$telf_rep', '$direccion_rep')";
			
			mysql_query($ins,$conexion);
			
			setcookie("ced_rep",$ced_rep);
			
			}
		else{
			/*ced aparece en bd*/
			$ced_rep=$_POST['ced_rep'];
			$nombres=$_POST['nombres'];
			$apellidos=$_POST['apellidos'];
			$telf_rep=$_POST['telf_rep'];
			$direccion_rep=$_POST['direccion_rep'];
			
			
			$up="UPDATE datos_rep SET nombres='$nombres', apellidos='$apellidos', telf_rep='$telf_rep', direccion_rep='$direccion_rep' WHERE ced_rep='$ced_rep'";
			mysql_query($up,$conexion);
			
			
			setcookie("ced_rep",$ced_rep);
		}
		
	}
	$busca_est="SELECT * FROM datos_est WHERE ced_rep='$ced_rep'";
	$busca_est2=mysql_query($busca_est,$conexion);
	$total=mysql_num_rows($busca_est2);
	
	/*busca estudiantes registrados con la de del representante*/
	
	if($total==0){
		/* No hay estudiantes asociados con el representante*/
		?>
		
        <form name="form" method="post" id="formulario" action="inscribir4.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 2 (Datos del Estudiante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_est">Cedula Escolar: </label></td>
                <td><input type="text" name="ced"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="validar_cedula()" value="Continuar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form> 
        
        <?php
		}
	else{
		/* Hay estudiantes asociados con el representante*/
		?>
        <form name="formulario" method="post" id="formulario" action="inscribir4.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 2 (Datos del Estudiante)</legend>
        <table cellspacing="5">
        
        	<tr>
        		<td><label for="ced">Cedula Escolar: </label></td>
                <td><input type="text" name="ced" value=""/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="validar_cedula2()" value="Continuar" align="center"/>
        </td>
        </tr>
        
        </table>
        </fieldset>   
    	</form> 
        
    	<fieldset>
        <legend>Estudiantes Asociados </legend>
        <table cellspacing="5">
        <tr>
        	<td>Cedula Escolar</td>
            <td>Cedula</td>
            <td colspan="2">Nombres</td>
            <td colspan="2">Apellidos</td>
            <td>Inscribir</td>
        </tr>
        			
		<?php
		while($vector=mysql_fetch_array($busca_est2)){
			
			?>
			<tr>
            <form name="form" method="post" id="formulario" action="inscribir4.php">
        		<td><?php echo $vector['ced_esc']?><input type="text" name="ced" value="<?php echo $vector['ced_esc']?>" hidden="true"/></td>
                <td><?php echo $vector['ced']?></td>
                <td><?php echo $vector['prim_nomb']?></td>
                <td><?php echo $vector['seg_nomb']?></td>
                <td><?php echo $vector['prim_apell']?></td>
                <td><?php echo $vector['seg_apell']?></td>
            	<td>
                <input type="submit" accesskey="enter" value="Continuar" align="center"/>
                </td>
            </form>
            </tr>
            
            <?php
			
		}
		/*fin del while*/
		?>
        
        </table>
        </fieldset> 
        
        
    	
		<?php
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