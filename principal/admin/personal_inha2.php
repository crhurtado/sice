<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if ($_SESSION["usuario"])
{ 
	if($_SESSION["nivel"]==1){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Sistema Automatizado de Inscripción - Personal Directivo - Registro de Personal</title>

<link rel="stylesheet" type="text/css" href="../estilos2.css" >
<script type="text/javascript" src="../../validaciones.js"></script>
<script language="javascript" type="text/javascript">
	function focus_load(){
		var f=document.form;
		f.ced.focus();
		}
</script>

</head>

<body>
<div id="header"></div>

<div id="div_principal">
	<div id="menu">
    <?php include ("menu.html"); 
	
	require_once"../../conexion/conexion.php";
	$ced_ant=$_POST['ced'];
	
	$buscar="select * from datos_personal where ced_personal='$ced_ant'";
	$buscar2=mysql_query($buscar, $conexion);
	$total=mysql_num_rows($buscar2);	
	
	if($total==0){
		echo"<script>
		alert('Cédula no registrada.');
		top.location.href='personal_reg.php';
	</script>"; exit;
		}
	
	else{
		
		$vector=mysql_fetch_array($buscar2);
	
	?>
    </div>
    <div id="cuerpo">
	
    <form name="form" method="post" id="formulario" action="personal_inha3.php">
    	<fieldset>
        <legend>Inhabilitar/Habilitar Personal</legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_personal">Cedula: </label></td>
                <td><input type="text" name="ced_personal" value="<?php echo $ced_ant?>" hidden="true" /><?php echo $ced_ant?></td>
            </tr>
            <tr>
        		<td><label for="nomb_personal">Nombres: </label></td>
                <td><?php echo $vector['nomb_personal']?></td>
            </tr>
            <tr>
        		<td><label for="apell_personal">Apellidos: </label></td>
                <td><?php echo $vector['apell_personal']?></td>
            </tr>
            <tr>
        		<td><label for="tipo">Tipo: </label></td>
                <td>
                
                <?php if($vector['tipo']==1){ ?>
                Directivo
                <?php }
				 if ($vector['tipo']==2){
				?>                
                Administrativo
                <?php }
				 if ($vector['tipo']==3){
				?>
                Docente
                <?php }
				?>
                </td>
            </tr>
           
           <tr>
           <td>Estatus: </td>
           <td>
           <?php if($vector['activo']==1){ ?>
                <select name="activo">
                <option value="0" >Inhabilitado</option>
                <option value="1" selected="selected">Habilitado</option>
                </select>
                <?php }
				 else{
				?>
                <select name="activo">
                <option value="0" selected="selected">Inhabilitado</option>
                <option value="1" >Habilitado</option>
                </select>
                <?php }
			?>
            </td>
            </tr>
            			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="submit()" value="Modificar" align="center"/>
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
	}
else{
	echo"<script>
		alert('Zona protegida, reservada para personal directivo');
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