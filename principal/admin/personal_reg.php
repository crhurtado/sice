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
	
    <form name="form" method="post" id="formulario" action="personal_reg2.php">
    	<fieldset>
        <legend>Registro de Nuevo Personal</legend>
        <table cellspacing="5">
        	<tr>
        		<td><label for="ced_personal">Cedula: </label></td>
                <td><input type="text" name="ced_personal"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="ced_personal_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="nomb_personal">Nombres: </label></td>
                <td><input type="text" name="nomb_personal"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="nomb_personal_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="apell_personal">Apellidos: </label></td>
                <td><input type="text" name="apell_personal"/></td>
            </tr>
            <tr>
            	<td colspan="2" id="apell_personal_error" class="error"></td>
            </tr>
            
            <tr>
        		<td><label for="tipo">Tipo: </label></td>
                <td>
                <select name="tipo">
                <option value="0" selected="selected">-</option>
                <option value="1">Directivo</option>
                <option value="2">Administrativo</option>
                <option value="3">Docente</option>
                </select>
                
                </td>
            </tr>
            <tr>
            	<td colspan="2" id="tipo_error" class="error"></td>
            </tr>
            			
        <tr>
        <td colspan="2" align="center">
        <br />
        <input type="button" accesskey="enter" onclick="valida_registro_personal()" value="Registrar" align="center"/>
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