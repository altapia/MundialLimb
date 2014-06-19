<html lang="es"><head>
		<meta charset="ISO-8859-1">
		<title>Sorteo MundialLimb</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<?php
	include_once('conexion_bd.php');
	require('SingletonDataSorteoLive.php');
	$instancia = SingletonDataSorteoLive::getInstance();

	
	if ($_GET['operacion']=='inicio'){
		
		$instancia->start();


	}

	if ($_GET['operacion']=='sortea'){
		
		$instancia->sortea();
	}

	
	//echo("Resultado de " . $_GET['operacion'] . ":" . $instancia->getData());
	

?>
</head>
<body>
	<button type="button" class="btn btn-default" onclick="$.ajax( {'url':'sorteo_live.php?operacion=inicio','type': 'GET'});">Inicia Sorteo</button>
	<button type="button" class="btn btn-default" onclick="$.ajax( {'url':'sorteo_live.php?operacion=sortea','type': 'GET'});">Sortea!</button>
		<?	require('sectionSorteo.php'); ?>

	<div>

	</div>
</body>

