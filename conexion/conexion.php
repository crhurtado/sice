<?php
	 $host="localhost";
	 $user="seprocon_sice";
	 $pass="051090.";
	 $base="seprocon_sice";
	 $conexion=mysql_connect("$host","$user","$pass");
	 mysql_select_db("$base",$conexion);
	mysql_query("SET NAMES 'utf8'");


	//$host="localhost";
	//$user="root";
	//$pass="";
	//$base="sice";
	//$conexion=mysql_connect("$host","$user","$pass");
	//mysql_query("SET NAMES 'utf8'");
	//$seleccion=mysql_select_db("$base",$conexion);

?>
