<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
			function NoRep(){
			var r=confirm("El estudiante se encuentra registrado por otro Representante.\n ¿Desea Continuar?");
			if (r==true)
			  {
			  return false;
			  }
			else
			  {
			  top.location.href='inscribir.php'
			  }
			}
</script>
</head>
<body>

<form name="form" action="prueba2.php" method="post">
dia: <input type="text" name="dia" /><br />
mes: <input type="text" name="mes" /><br />
año: <input type="text" name="ano" /><br />

<input type="submit" />
</form>


<?php
$valor="";
foreach($_COOKIE as $nombre_campo =>$value){ 
		   $asignacion = "setcookie(\"".$nombre_campo."\",'".$valor."');"; 
		   eval($asignacion); 
		   echo "eliminada cookie ".$nombre_campo."<br>";   
		}

setcookie("nombre",'');
echo "<br> Cookie final <br>";

print_r($_COOKIE);

?>
        
</body>
</html>