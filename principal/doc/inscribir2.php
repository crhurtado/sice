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
	$ced_rep=$_POST['ced'];
	
	$buscar="select * from datos_rep where ced_rep='$ced_rep'";
	$buscar2=mysql_query($buscar, $conexion);
	$total=mysql_num_rows($buscar2);
	
	if ($total==1){
		$vector=mysql_fetch_array($buscar2);
		?>
		<form name="form" method="post" id="formulario" action="inscribir3.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 1 (Datos Representante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_rep">Cedula: </label></td>
                <td><input type="text" name="ced_rep" value="<?php echo $ced_rep?>"/>
                <input type="text" name="ced_ant" value="<?php echo $ced_rep?>" hidden="true" /></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nombres">Nombres: </label></td>
                <td><input type="text" name="nombres" value="<?php echo $vector['nombres']?>" maxlength="40"/>
              	</td>
            </tr>
            <tr>
            	<td colspan="2" id="nombres_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="apellidos">Apellidos: </label></td>
                <td><input type="text" name="apellidos" value="<?php echo $vector['apellidos']?>" maxlength="40"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="apellidos_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="telf_rep">Telefono: </label></td>
                <td><input type="text" name="telf_rep" value="<?php echo $vector['telf_rep']?>" maxlength="14"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="telf_rep_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="direccion_rep">Dirección: </label></td>
                <td><input type="text" name="direccion_rep" value="<?php echo $vector['direccion_rep']?>" size="75" maxlength="100"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="direccion_rep_error" class="error"></td>
            </tr>
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="validar_datos_rep()" value="Registrar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form> 
        <?php
		}	
	else{
		?>
        <form name="form" method="post" id="formulario" action="inscribir3.php">
    	<fieldset>
        <legend>Inscripción de estudiantes - Paso 1 (Datos Representante) </legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_rep">Cedula: </label></td>
                <td><input type="text" name="ced_rep" value="<?php echo $ced_rep?>" maxlength="10"/>
                <input type="text" name="ced_ant" value="<?php echo $ced_rep?>" hidden="true" />
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nombres">Nombres: </label></td>
                <td><input type="text" name="nombres" value="" maxlength="40"/>
              	</td>
            </tr>
            <tr>
            	<td colspan="2" id="nombres_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="apellidos">Apellidos: </label></td>
                <td><input type="text" name="apellidos" value="" maxlength="40"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="apellidos_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="telf_rep">Telefono: </label></td>
                <td><input type="text" name="telf_rep" value="" maxlength="14"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="telf_rep_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="direccion_rep">Dirección: </label></td>
                <td><input type="text" name="direccion_rep" value="" maxlength="100" size="75"/>
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="direccion_rep_error" class="error"></td>
            </tr>
                        			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="validar_datos_rep()" value="Registrar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    	</form>
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