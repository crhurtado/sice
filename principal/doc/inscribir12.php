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
							
		$id_insc=$ced_esc."-".$ano_esc."-".$grado;
		
		$ins="INSERT INTO inscripcion (id_insc, ced_esc, ano_esc, grado, seccion) VALUES ('$id_insc', '$ced_esc', '$ano_esc', '$grado', '$seccion')";
		
		mysql_query($ins,$conexion);
		
		
		
		
		echo"<script>
			alert('Inscripción Completada exitosamente');
			top.location.href='inscribir.php';
		</script>";
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