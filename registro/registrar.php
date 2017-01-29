<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="estilos2.css" >
<title>Sistema Automatizado de Inscripción</title>
<script type="text/javascript" src="../validaciones.js"></script>
<script language="javascript" type="text/javascript">
	function focus_load(){
		var f=document.form;
		f.nick.focus();
		}
</script>


</head>


<body  onload="focus_load()">

<?php 
require_once"../conexion/conexion.php";

$ced_personal=trim($_POST['ced']);

$personal="select ced_personal from datos_personal where ced_personal='$ced_personal'";
$consulta_p=mysql_query($personal,$conexion);
$res_p=mysql_num_rows($consulta_p);

if ($res_p==0){
	echo"<script>
		alert('Cédula no registrada, dirigase al area administrativa para incluir sus datos.');
		top.location.href='../index.html';
	</script>"; exit;
	}
else {
	
	$usuario="select * from usuarios where cedula='$ced_personal'";
	$consulta_u=mysql_query($usuario,$conexion);
	$res_u=mysql_num_rows($consulta_u);
	
	if ($res_u==1){
		echo"<script>
			alert('Este número de cédula ya está asociado a un usuario');
			top.location.href='../index.html';
		</script>"; exit;
		}
	else{
		
		
		$datos="select * from datos_personal where ced_personal='$ced_personal'";
		$consulta_d=mysql_query($datos,$conexion);
		$vector=mysql_fetch_array($consulta_d);
		$nomb_personal=$vector['nomb_personal'];
		$apell_personal=$vector['apell_personal'];
		$tipo=$vector['tipo'];
		$activo=$vector['activo'];
		
		if($activo==1){  ?>
			
			
<div id="header"></div>

<div id="div_principal">
	<div id="menu"></div>
    <div id="cuerpo">
    
    <form name="form" method="post" id="formulario" action="registrar2.php">
    	<fieldset>
        <legend>Registro de Nuevo Usuario</legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_personal">Cedula: </label></td>
                <td><?php echo $ced_personal?><input type="text" name="ced_personal" value="<?php echo $ced_personal?>" hidden="true"/></td>
            </tr>
            <tr>
        		<td><label for="cod_carrera">Nombres: </label></td>
                <td><?php echo $nomb_personal?></td>
            </tr>
            <tr>
        		<td><label for="cod_carrera">Apellidos: </label></td>
                <td><?php echo $apell_personal?></td>
            </tr>
            <tr>
        		<td><label for="cod_carrera">Tipo: </label></td>
                <td><?php 
					if($tipo==1){ echo "Administrador";}
					if($tipo==2){ echo "Personal Administrativo";}
					if($tipo==3){ echo "Docente";}?></td>
            </tr>
            
            <tr>
        		<td><label for="nick">Nombre de usuario: </label></td>
         		<td><input type="text" name="nick" maxlength="30"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="nick_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="pass">Contraseña: </label></td>
         		<td><input type="password" name="pass" maxlength="20"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="pass_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="pass2">Repita su contraseña: </label></td>
         		<td><input type="password" name="pass2" maxlength="20"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="pass2_error" class="error"></td>
            </tr>
			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="validar_registro_usuario()" value="Registrar" align="center"/>
        </td>
        </tr>
        </table>
        </fieldset>   
    </form>
    
    </div>
</div>
	

<div id="footer"></div>	
			

			
						
		<?php	
		}
		else{
			echo"<script>
			alert('Personal invalidado para ingresar al sistema');
			top.location.href='../index.html';
			</script>"; exit;
		}
	}
}
?>

</body>
</html>