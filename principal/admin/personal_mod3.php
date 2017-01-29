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
    <?php include ("menu.html"); ?>
    </div>
    <div id="cuerpo">
	
    <?php
	
	require_once"../../conexion/conexion.php";

$ced_personal=trim($_POST['ced_personal']);

if ($ced_personal!=$_POST['ced_ant']){
	
	$ced_ant=$_POST['ced_ant'];
	$personal="select ced_personal from datos_personal where ced_personal='$ced_personal'";
	$consulta_p=mysql_query($personal,$conexion);
	$res_p=mysql_num_rows($consulta_p);
	
	if ($res_p!=0){
		echo"<script>
		alert('Cédula ya registrada.');
		top.location.href='personal_mod.php';
	</script>"; exit;
		}
		
	else{
		
		$ced_personal=trim($_POST['ced_personal']);
		$nomb_personal=$_POST['nomb_personal'];
		$apell_personal=$_POST['apell_personal'];
		$tipo=$_POST['tipo'];
		
		$up="UPDATE datos_personal SET ced_personal='$ced_personal', nomb_personal='$nomb_personal', apell_personal='$apell_personal', tipo='$tipo' WHERE ced_personal='$ced_ant'";
		
		mysql_query($up,$conexion);
		
		echo"<script>
			alert('Modificación Exitosa.');
			top.location.href='personal_mod.php';
		</script>"; exit;
	
		}
	
	}
	
else{
	$ced_personal=trim($_POST['ced_personal']);
	$nomb_personal=$_POST['nomb_personal'];
	$apell_personal=$_POST['apell_personal'];
	$tipo=$_POST['tipo'];
	
	$up="UPDATE datos_personal SET nomb_personal='$nomb_personal', apell_personal='$apell_personal', tipo='$tipo' WHERE ced_personal='$ced_personal'";
	
	mysql_query($up,$conexion);
	
	echo"<script>
		alert('Modificación Exitosa...');
		top.location.href='personal_mod.php';
	</script>"; exit;
}
		
 ?>
	
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