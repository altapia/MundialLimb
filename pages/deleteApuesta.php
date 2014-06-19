<?
	include "../pages/conexion_bd.php"; 
	
	$id= $_GET["id"];
	if(!mysql_query("DELETE FROM apuestas where id=$id")){
		die('Error: ' . mysql_error());
	}
	
	header("Location: misapuestas.php");
?>