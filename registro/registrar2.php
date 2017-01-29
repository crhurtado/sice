<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../estilos2.css" >
<title>Sistema Automatizado de Inscripción</title>
<script type="text/javascript" src="../validaciones.js"></script>
<script language="javascript" type="text/javascript">
	function focus_load(){
		var f=document.form;
		f.nick.focus();
		}
</script>


</head>

<body>
<div id="header"></div>

<div id="div_principal">
	<div id="menu"></div>
    <div id="cuerpo">
    
    <?php
	$nick=$_POST['nick'];
	$cedula=$_POST['ced_personal'];
	
	require_once"../conexion/conexion.php";
	
	$consulta="select * from usuarios where user='$nick'";
	$consulta2=mysql_query($consulta,$conexion);
	$total=mysql_num_rows($consulta2);
	
	if($total==0){
				
		$user=$_POST['nick'];
		$pass=md5($_POST['pass']);
		$cedula=$_POST['ced_personal'];
		$activo=1;
		
		$ins="INSERT INTO usuarios (user, pass, cedula) VALUES ('$user','$pass','$cedula')"; 
		 
		mysql_query($ins,$conexion);
		
		echo"<script>alert('Registro Existoso');
		top.location.href='../index.html';</script>";
		exit;
		}
		
	else {
		echo"<script>alert('Este nombre de usuario ya se encuentra registrado';
		</script>";
		exit;
	}
	
	?>
    
    </div>
</div>
	

<div id="footer"></div>
</body>
</html>