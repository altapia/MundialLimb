<?php

include "conexion_bd.php";
include "getProperty.php"; 

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$cabeceras .= 'From: EUROLimbo <staff@hotelpene.com>' . "\r\n";
		
$titulo 	= 'MundialLimb - Recordatorio partido';
		
$fecha_actual = date("Y-m-d");
//$fecha_actual = "2013-09-17";
$date = date_create($fecha_actual);
$date_fomato=date_format($date, 'd/m/Y');

$queryUser='SELECT username, userid, email FROM user;';
$resultUser=mysql_query($queryUser);

$horasCheck = 25;
if(isset($_GET["horas"])){
	$horasCheck=$_GET["horas"];
}

while ($rowUser=mysql_fetch_array($resultUser)) {
	$enviarMail=0;		

	/*ATENCI�N PARCHE PLACA: 
		Se le resta 1 minuto a la hora de los partidos para que funcione con la hora 24:00. 
		Se usa la hora 24:00 en vez de las 00:00 para colocar los partidos al final del dia anterior, para una mejor comprensi�n en fase.php*/
	$query='SELECT p.id, e.nombre as local, f.nombre as visitante, p.fecha, p.hora, e.escudo as escLocal, f.escudo as escVisit , p.fase
		FROM partidos p
		INNER JOIN equipos e ON e.id=p.local
		INNER JOIN equipos f ON f.id=p.visitante
		INNER JOIN partido_apostante pa ON pa.idpartido=p.id
		WHERE
			pa.idapostante='.$rowUser["userid"].' AND concat(p.fecha," ",TIMEDIFF(p.hora,1)) >= now() AND concat(p.fecha," ",TIMEDIFF(p.hora,1)) <= addtime(now(),"'.$horasCheck.':00:00") 
		ORDER BY p.fecha, p.hora,p.id asc';

		//echo $query;
	$result=mysql_query($query);
	if($result!=null){
		$num_rows = mysql_num_rows($result);
		//echo '--->'.$num_rows;
		if($num_rows>0){			
			$mensaje='<html><head><title>Recordatorio de partido</title><style>body{font-family: sans-serif,arial, verdana,helvetica;}</style></head>
					<body><h2>					
					<img align="absmiddle" style="max-height: 30px;" src="http://hotelpene.com/mundialLimb/images/logo.png">
					MundialLimb</h2><p>'.$rowUser["username"].', te recordamos que pr�ximamente se disputa el siguiente partido que te ha sido asignado:</p><dl>';
			
			while ($row=mysql_fetch_array($result)) {
				echo '<hr>';
				if(apuestasRealizadas($rowUser["userid"],$row["id"], $row["fase"])){
					echo '<br><strong>'.$rowUser["username"].'</strong>: Partido '.$row["local"].' vs '.$row["visitante"].'. Apuestas realizadas.';
				}else{
					$date_partido_fomato=date_format(date_create($row["fecha"]), 'd');
					$enviarMail=1;
					$mensaje .=
						'<dd>
							<strong>'.ucfirst(getDiaSemana(date_create($row["fecha"]))).' '.$date_partido_fomato.' ('.substr($row["hora"],0,5).'): </strong> '
							.$row["local"].
							' <img align="absmiddle" src="http://hotelpene.com/mundialLimb/images/escudos/'.$row["escLocal"].'"> 
							 vs 
							<img align="absmiddle" src="http://hotelpene.com/mundialLimb/images/escudos/'.$row["escVisit"].'"> '
							.$row["visitante"].
						'</dd>';
				}
			}mysql_free_result($result);
			
			$mensaje .='</dl><p>Realiza tus apuestas en <strong><a href="http://hotelpene.com/mundialLimb/">MundialLimb</a></strong></p></body></html>';		
			$para     = $rowUser["email"];
					
			if($enviarMail>0){
				if($_GET["test"]==1){
					echo '<code>e-mail:'.$para. '</code><br>'.$titulo. '<br>'.$mensaje. '<br><code>'.$cabeceras.'</code>';
				}else{
					mail($para,$titulo,$mensaje,$cabeceras);
				}
			}
		}else{
			echo 'Hoy ('.$date_fomato.') no se disputa ning�n partido de '.$rowUser["username"].'<br>';
		}
}else{
	echo 'Hoy ('.$date_fomato.') no se disputa ning�n partido de '.$rowUser["username"].'<br>';
}
}mysql_free_result($resultUser);



function data_uri($file, $mime) {  
	$contents = file_get_contents($file);
	$base64   = base64_encode($contents); 
	return ('data:' . $mime . ';base64,' . $base64);
}

function apuestasRealizadas($apostante, $idPartido, $fase){
	$query='SELECT ROUND(SUM(a.apostado), 2) as total
			FROM apuestas a, partido_apostante pa, partido_apost_apuesta pap
			WHERE pa.idapostante='.$apostante.' and pa.idpartido='.$idPartido.' and
				pap.idpartidoapost=pa.id and
				pap.idapuesta=a.id';
	$result=mysql_query($query);	
	$row=mysql_fetch_array($result);
	$total = $row["total"];
	mysql_free_result($result);
	$max = getMaxApostable($fase);	
	
	//echo $total.'>='.$max;
	if($total>=$max){
		return true;
	}else{
		return false;
	}
	
}

function getMaxApostable($fase){
	$query='SELECT max_apuesta
			FROM fases
			WHERE clave=\''.$fase.'\'';
			
	$result=mysql_query($query);
	
	$row=mysql_fetch_array($result);
	
	$max = $row["max_apuesta"];
	
	mysql_free_result($result);
	
	return $max;
}
	

	//<img src="echo data_uri('elephant.png','image/png');" alt="An elephant" />
?>