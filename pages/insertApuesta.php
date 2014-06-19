<?
	include "../pages/conexion_bd.php"; 

	$apuesta= "'".$_GET["apuesta"]."'";
	$apostado= $_GET["apostado"];
	$partido= $_GET["partido"];
	$apostante= $_GET["apostante"];
	
	if($_GET["apuesta"]!='' AND $apostado!=''){
		if(!is_numeric($apostado)){
			session_start();
			$_SESSION['flash_error'] = "El valor de Apostado debe ser numerico (n.nn)";
		}else{
			//Se inserta la apuesta
			if(!mysql_query("INSERT INTO apuestas (apuesta, apostado, partido) VALUES (".$apuesta.",". $apostado.", ".$partido.");")){
				die('Error: ' . mysql_error());
			}
			$idApuesta = mysql_insert_id();
			
			//Obtenemos el ID de la relación partido-apostante
			$resultApuest=mysql_query("select id from partido_apostante where idpartido=".$partido." and idapostante=".$apostante.";");
			if(!$resultApuest){
				die('Error: ' . mysql_error());
			}
			$row1=mysql_fetch_row($resultApuest);

			//Insertamos la relacion partido-apostante-partido
			if(!mysql_query("INSERT INTO partido_apost_apuesta (idapuesta, idpartidoapost) VALUES (".$idApuesta.",".$row1[0]."); ")){
				die('Error: ' . mysql_error());
			}
			
		}
	}else{
		session_start();
		$_SESSION['flash_error'] = "Faltan valores";
	}

	header("Location: misapuestas.php");
?>