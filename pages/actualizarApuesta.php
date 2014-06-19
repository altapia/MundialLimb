<?

include "../pages/conexion_bd.php";

if($_GET["q"]=="estado"){	
		$acertada= $_GET["estado"];
		$id= $_GET["id"];
		
		if(!mysql_query("UPDATE apuestas SET acertada=".$acertada." WHERE id=".$id)){
  			die('Error: ' . mysql_error());
 	 	}else{
			echo 'Actualización correcta: '+$id;
		}
}else{

		$apuesta= "'".$_GET["apuesta"]."'";
		$apostado= $_GET["apostado"];
		$cotizacion= $_GET["cotizacion"];
		$acertada= $_GET["acertada"];
		$id= $_GET["id"];

		
		// if(!mysql_query("UPDATE apuestas SET apuesta=".$apuesta.", apostado=".$apostado.", cotizacion=".$cotizacion.", acertada=".$acertada." WHERE id=".$id)){
  			// die('Error: ' . mysql_error());
 	 	// }else{
			// echo 'Actualización correcta: '+$id;
		// }
		
		if(!mysql_query("UPDATE apuestas SET apostado=".$apostado.", cotizacion=".$cotizacion.", acertada=".$acertada." WHERE id=".$id)){
  			die('Error: ' . mysql_error());
 	 	}else{
			echo 'Actualización correcta: '+$id;
		}
}
?>