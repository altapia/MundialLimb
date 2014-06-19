<?

include "../pages/conexion_bd.php";

		$fecha= $_POST["fecha"];
		$equipoLocal= $_POST["equipoLocal"];
		$equipoVisit= $_POST["equipoVisit"];
		$apostador= $_POST["apostador"];		
		$hora=$_POST["hora"];
		$id=$_POST["id"];
		
		
		if(!mysql_query("UPDATE partidos SET fecha='$fecha', local=$equipoLocal, visitante=$equipoVisit, hora='$hora' WHERE id=$id")){
  			die('Error: ' . mysql_error());
 	 	}
		if(!mysql_query("DELETE FROM partido_apostante WHERE idpartido=$id")){
  			die('Error: ' . mysql_error());
 	 	}
		for($i=0;8>=$i;$i++){
		echo 'apos_'.$i.': '.$_POST["apos_".$i];
			if($_POST["apos_".$i]!=null && $_POST["apos_".$i]!=''){				
				echo "INSERT INTO partido_apostante (idpartido, idapostante)  VALUES (".$id.",".$_POST["apos_".$i].");";
				if(!mysql_query("INSERT INTO partido_apostante (idpartido, idapostante)  VALUES (".$id.",".$_POST["apos_".$i].");")){
	  				die('Error: ' . mysql_error());
	 	 		}
			}
		}
		
		
		/*echo '"UPDATE partidos SET fecha='.$fecha.', local='.$equipoLocal.', visitante='.$equipoVisit.', apostante='.$apostador.', hora=\''.$hora.'\' WHERE id='.$id.'"';
		
		if(!mysql_query("UPDATE partidos SET fecha='$fecha', local=$equipoLocal, visitante=$equipoVisit, apostante=$apostador, hora='$hora' WHERE id=$id")){
  			die('Error: ' . mysql_error());
 	 	}else{
			echo 'Actualización correcta: '+$id;
		}
		*/
			
?>