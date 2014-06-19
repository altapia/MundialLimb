<!DOCTYPE html>
<html lang="es">
<head>
	<? include "../pages/getProperty.php"; ?>
	
	<meta charset="ISO-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" href="../favicon.png" type="image/png"/>
	<link rel="shortcut icon" href="../favicon.png" type="image/png"/>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<title><? echo getPropiedad("titulo_head"); ?></title>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
	<!--Menu-->
	<?php 
		$page="fase_".$_GET["id"]; 
		include "../pages/menu.php"; 
	?>
    <script language="javascript">
			
		var totalAct=0;
		
		function submitForm(){
			var sele = $("#selectLocal :selected").val();
			//alert(sele);
			var sele2 = $("#selectVisit :selected").val();
			var sele3 = $("#selectFase :selected").val();

			//alert(sele2);
			$("#local").val(sele);
			$("#visitante").val(sele2);
			$("#fase").val(sele3);
			$("#formulario").submit();
		};
		
		function borrar(i){
			window.location="./mantenimientoPartidos.php?query=borrar&grupo=<? echo $_GET["grupo"] ?>&idborrar="+i;
			
		}
		
		function borrarAP(i){
			window.location="./mantenimientoPartidos.php?query=deleteAP&id="+i;			
		}
		
		function actualizar(formulario){
			if (confirm('�Est� seguro de que desea actualzar este partidos? Se perder�n todas las apuestas relacionadas.')) { 
				$('#form_' + formulario).submit();
			}
		}
		
		function actualizarTodos(){		
		if (confirm('�Est� seguro de que desea actualzar todos los partidos? Se perder�n todas las apuestas de estos partidos.')) { 
 

			/*$('#form_29 :input').each(function(){
					alert($(this).val());
			});*/
			totalAct=0;
			var wid_padre = $("#prog_bar_padre").css('width');
			var value_padre= parseInt(wid_padre, 10);
			
			var total= $('form[name|="form_actualizar"]').length;
			
			var incremento=value_padre/total;
			
			$('form[name|="form_actualizar"]').each(function(){
			
			
			if(!$(this).find('input[name|="apos_1"]').is(':checked')){
				$(this).find('input[name|="apos_1"]').val('');
			}
			if(!$(this).find('input[name|="apos_2"]').is(':checked')){
				$(this).find('input[name|="apos_2"]').val('');
			}
			if(!$(this).find('input[name|="apos_3"]').is(':checked')){
				$(this).find('input[name|="apos_3"]').val('');
			}
			if(!$(this).find('input[name|="apos_4"]').is(':checked')){
				$(this).find('input[name|="apos_4"]').val('');
			}
			if(!$(this).find('input[name|="apos_5"]').is(':checked')){
				$(this).find('input[name|="apos_5"]').val('');
			}
			if(!$(this).find('input[name|="apos_6"]').is(':checked')){
				$(this).find('input[name|="apos_6"]').val('');
			}
			if(!$(this).find('input[name|="apos_7"]').is(':checked')){
				$(this).find('input[name|="apos_7"]').val('');
			}
			if(!$(this).find('input[name|="apos_8"]').is(':checked')){
				$(this).find('input[name|="apos_8"]').val('');
			}
			
			
				//	 alert($(this).children('select[name|="equipoVisit"]').val());
				 var id= $(this).children('input[name|="id"]').val();
				 var parametros = {
					"fecha" : $(this).children('input[name|="fecha"]').val(),
					"equipoLocal" : $(this).children('select[name|="equipoLocal"]').val(),
					"equipoVisit" : $(this).children('select[name|="equipoVisit"]').val(),
					"apostador" : $(this).children('select[name|="apostador"]').val(),
					"hora" : $(this).children('input[name|="hora"]').val(),
					"id" : $(this).children('input[name|="id"]').val(),
					"apos_1" : $(this).find('input[name|="apos_1"]').val(),
					"apos_2" : $(this).find('input[name|="apos_2"]').val(),
					"apos_3" : $(this).find('input[name|="apos_3"]').val(),
					"apos_4" : $(this).find('input[name|="apos_4"]').val(),
					"apos_5" : $(this).find('input[name|="apos_5"]').val(),
					"apos_6" : $(this).find('input[name|="apos_6"]').val(),
					"apos_7" : $(this).find('input[name|="apos_7"]').val(),
					"apos_8" : $(this).find('input[name|="apos_8"]').val()
				};
								
				
				$.ajax({
					data:  parametros,
					url:   'actualizarPartidos.php',
					type:  'post',
					async: 'false',
					beforeSend: function () {
							$('#modal_ajax').modal('show');
					},
					success:  function (response) {
					
						$("#resultado").html($("#resultado").html()+'<br>'+response);
							
					},
					complete: function(){
						//alert('actualizado id: '+ id);
						
						var wid = $("#prog_bar").css('width');
						var value= parseInt(wid, 10);
						//var value = wid.substring(0,wid.indexof('px'));
						//alert(value+'--'+(value+(100/total)));
						
						var aux = value + incremento;
						$("#prog_bar").css('width',aux);
						//$("#resultado").html($("#resultado").html()+'<br>'+wid+'--'+total+'--'+aux);
						//$("#prog_bar").attr('style','width: '+(value+(100/total))+'%');
						
						totalAct=totalAct+1;
						if(totalAct==total){
							window.location.reload();
						}
					}
        		});
				
			});
			}
			//window.location.reload();
		}
		
		
		function actualizarTodosApuestas(id){
			/*$('#form_29 :input').each(function(){
					alert($(this).val());
			});*/
			
			
			totalAct=0;
			var wid_padre = $("#prog_bar_padre").css('width');
			var value_padre= parseInt(wid_padre, 10);
			
			var nomform = "formapuespart" + id;
			var total= $('form[name|="'+nomform+'"]').length;

			var incremento=value_padre/total;
			
			$('form[name|="'+nomform+'"]').each(function(){
				 // var id= $(this).children('input[name|="id"]').val();
				 var parametros = {
					"apuesta" : $(this).children('input[name|="apuesta"]').val(),
					"cotizacion" : $(this).children('input[name|="cotizacion"]').val(),
					"apostado" : $(this).children('input[name|="apostado"]').val(),
					"acertada" : $(this).children('select[name|="acertada"]').val(),
					"id" : $(this).children('input[name|="id"]').val()
				};
				// alert("cotizacion:" + $(this).children('input[name|="cotizacion"]').val());
				$.ajax({
					data:  parametros,
					url:   'actualizarApuesta.php',
					type:  'get',
					async: 'false',
					contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
					beforeSend: function () {
							$('#modal_ajax').modal('show');
					},
					success:  function (response) {
						$("#resultado").html($("#resultado").html()+'<br>'+response);
							
					},
					complete: function(){
						//alert('actualizado id: '+ id);
						
						var wid = $("#prog_bar").css('width');
						var value= parseInt(wid, 10);
						//var value = wid.substring(0,wid.indexof('px'));
						//alert(value+'--'+(value+(100/total)));
						
						var aux = value + incremento;
						$("#prog_bar").css('width',aux);
						//$("#resultado").html($("#resultado").html()+'<br>'+wid+'--'+total+'--'+aux);
						//$("#prog_bar").attr('style','width: '+(value+(100/total))+'%');
						
						totalAct=totalAct+1;
						if(totalAct==total){
							// alert(document.URL);
							var url=document.URL + "";
							//Quitamos el par�metro query
							if(url.indexOf('&query')>0 || url.indexOf('?query')>0){
								var ini = url.indexOf('query=') + 6;
								var fin = url.indexOf('&',ini);
								if(fin>0){
									url=url.substr(0,ini)+url.substr(fin,url.length);
								}else{
									url=url.substr(0,ini);
								}
							}
							if(url.indexOf('&partido')<0 && url.indexOf('?partido')<0){
								document.location.href=url + '&partido='+id;
							}else{
								var ini = url.indexOf('partido=') + 8;
								var fin = url.indexOf('&',ini);
								if(fin>0){
									var newurl = url.substr('0',ini) + id + url.substr(fin);
									// alert(newurl);
								}else{
									var newurl = url.substr('0',ini) + id;
									// alert(newurl);
								}
								document.location.href=newurl;
							}
							// window.location.reload();
						}
					}
        		});
				
			});
	
			//window.location.reload();
			
		}
	</script>
</head>
<body> 
	

			
                        
<? include "../pages/conexion_bd.php"; ?>

<?
	function selectApostadores($i){
		$select = '<select name="apostador" style="width: 100px;"><option value="0"></option>';
		$query='SELECT id, nombre  FROM apostantes ORDER BY nombre asc';
		$result=mysql_query($query);
		while ($row=mysql_fetch_array($result)) {
			if($row[id]==$i){
				$select=$select.'<option selected="selected" value="'.$row[id].'">'.$row[nombre].'</option>';
			}else{
				$select=$select.'<option value="'.$row[id].'">'.$row[nombre].'</option>';
			}
		}mysql_free_result($result);
		$select=$select.'</select>';
		return $select;
	}
	
	function selectEquipos($i,$local){
		if($local==1){
			$select ='<select class="span2" name="equipoLocal"><option></option>';
		}else{
			$select ='<select class="span2" name="equipoVisit"><option></option>';
		}
		if($_GET["grupo"]==''){
			$query='select id, nombre from equipos order by nombre asc;';
		}else{
			$query='select id, nombre from equipos where grupo=\''.$_GET["grupo"].'\' order by nombre asc;';
		}
		$result=mysql_query($query);
		while ($row=mysql_fetch_array($result)) {
			if($i==$row["id"]){
				$select=$select.'<option value="'.$row["id"].'" selected="selected">'.$row["nombre"].'</option>';
			}else{
				$select=$select.'<option value="'.$row["id"].'">'.$row["nombre"].'</option>';
			}
		}mysql_free_result($result);
		
		$select=$select.'</select>';
		return $select;
	}
?>

<?
	if($_GET["query"]=="insert"){
		$local= $_GET["local"];
		$visitante= $_GET["visitante"];
		$fecha= $_GET["fecha"];
		$hora= $_GET["hora"];
		$fase= $_GET["fase"];
		//$fase= 'GRUPO'.$_GET["grupo"];
		
		if(!mysql_query("INSERT INTO partidos (LOCAL, VISITANTE, FECHA, HORA, FASE) VALUES ('$local', '$visitante', '$fecha', '$hora', '$fase') ")){
  			die('Error: ' . mysql_error());
 	 	}
	}else if($_GET["query"]=="borrar"){
		$idborrar=$_GET["idborrar"];
		if(!mysql_query("DELETE FROM partidos where id=$idborrar ")){
  			die('Error: ' . mysql_error());
 	 	}
	}else if($_GET["query"]=="update"){
		$fecha= $_GET["fecha"];
		$equipoLocal= $_GET["equipoLocal"];
		$equipoVisit= $_GET["equipoVisit"];
		$hora=$_GET["hora"];
		$id=$_GET["id"];
		if(!mysql_query("UPDATE partidos SET fecha='$fecha', local=$equipoLocal, visitante=$equipoVisit, hora='$hora' WHERE id=$id")){
  			die('Error: ' . mysql_error());
 	 	}
		if(!mysql_query("DELETE FROM partido_apostante WHERE idpartido=$id")){
  			die('Error: ' . mysql_error());
 	 	}
		for($i=0;8>=$i;$i++){
			if($_GET["apos_".$i]!=null && $_GET["apos_".$i]!=''){
				if(!mysql_query("INSERT INTO partido_apostante (idpartido, idapostante)  VALUES (".$id.",".$_GET["apos_".$i].");")){
	  				die('Error: ' . mysql_error());
	 	 		}
			}
		}
		
	}else if($_GET["query"]=="insertAP"){
		$apuesta= "'".$_GET["apuesta"]."'";
		$apostado= $_GET["apostado"];
		$cotizacion= $_GET["cotizacion"];
		$partido= $_GET["partido"];
		$apostante= $_GET["apostante"];
		
		//Se inserta la apuesta
		if(!mysql_query("INSERT INTO apuestas (apuesta, apostado, cotizacion, partido) VALUES (".$apuesta.",". $apostado."
						, ".$cotizacion.", ".$partido.");")){
  			die('Error: ' . mysql_error());
 	 	}
		$idApuesta = mysql_insert_id();
 	 	
 	 	//Obtenemos el ID de la relaci�n partido-apostante
 	 	$resultApuest=mysql_query("select id from partido_apostante where idpartido=".$partido." and idapostante=".$apostante.";");
		if(!$resultApuest){
  			die('Error: ' . mysql_error());
 	 	}
 	 	$row1=mysql_fetch_row($resultApuest);

		//Insertamos la relacion partido-apostante-partido
 	 	if(!mysql_query("INSERT INTO partido_apost_apuesta (idapuesta, idpartidoapost) VALUES (".$idApuesta.",".$row1[0]."); ")){
  			die('Error: ' . mysql_error());
 	 	}
	}else if($_GET["query"]=="updateAP"){
		$apuesta= $_GET["apuesta"];
		$apostado= $_GET["apostado"];
		$cotizacion= $_GET["cotizacion"];
		$acertada= $_GET["acertada"];
		$id= $_GET["id"];
		if($cotizacion==''){
			$queryUpdAp="UPDATE apuestas SET apuesta='$apuesta', apostado=$apostado, acertada=$acertada WHERE id=$id";
		}else{
			$queryUpdAp="UPDATE apuestas SET apuesta='$apuesta', apostado=$apostado, cotizacion=$cotizacion, acertada=$acertada WHERE id=$id";
		}
		
		if(!mysql_query($queryUpdAp)){
  			die('Error: ' . mysql_error());
 	 	}
	}else if($_GET["query"]=="deleteAP"){
		$id= $_GET["id"];
		if(!mysql_query("DELETE FROM apuestas where id=$id")){
  			die('Error: ' . mysql_error());
 	 	}
	}
?>

<div class="span8">
	<div class="container">
		<h2>Mantenimiento de partidos  <small><a href="./mantenimientoApuestas.php">(Mantenimineto Apuestas)</a></small></h2>
		
<div class="container">
<ul class="nav nav-tabs">
	<!-- Select fecha-->
	<li>
	  <select ONCHANGE="location = this.options[this.selectedIndex].value;" class="input-medium">
		<option value="mantenimientoPartidos.php">Fechas...</option>
		<? 
			//Ejecutamos la sentencia SQL
			$result=mysql_query("select distinct fecha from partidos order by fecha asc");
			while ($row=mysql_fetch_array($result)) {
				$date = date_create($row["fecha"]);
			   	echo '<option';
			    if($_GET["fecha"]==$row["fecha"]){echo ' selected="selected" ';} 
			   	echo ' value="mantenimientoPartidos.php?fecha='.$row["fecha"].'">'.date_format($date, 'd/m/Y').'</option>';
			}mysql_free_result($result);
		?>
		</select>
	</li>
	<li>
		<?php echo getFasesSelectMantenimientoNav($_GET["fase"]); ?>
		<!--
		<select ONCHANGE="location = this.options[this.selectedIndex].value;" class="input-medium">
			<option value="mantenimientoPartidos.php">Fase...</option>
			<option <? if($_GET["fase"]=="GRUPOS"){echo ' selected="selected" ';}?> value="mantenimientoPartidos.php?fase=GRUPOS">Grupos</option>
			<option <? if($_GET["fase"]=="SEMIFINAL"){echo ' selected="selected" ';}?>value="mantenimientoPartidos.php?fase=SEMIFINAL">Semifinal</option>
			<option <? if($_GET["fase"]=="FINAL"){echo ' selected="selected" ';}?>value="mantenimientoPartidos.php?fase=FINAL">Final</option>
		</select> -->
	</li
</ul>
</div>
<? 
if($_GET["grupo"]!="" || $_GET["fecha"]!="" || $_GET["fase"]!=""){ 
	if($_GET["grupo"]!=""){
		if($_GET["grupo"]=="Todos"){
			echo '<h3>Todos los partidos</h3>';
			$query='select p.id, e.escudo as escudoLocal,f.escudo as escudoVisit, e.nombre as local,e.id as localid, f.nombre as visitante, f.id as visitid, p.fecha, p.hora , p.apostante, p.resultado
					FROM partidos p, equipos e, equipos f 
					WHERE p.local=e.id and p.visitante=f.id
					ORDER BY p.fecha, p.id asc';
		}else{
			echo '<h3>GRUPO '.$_GET["grupo"].'</h3>';
			$query='select p.id, e.escudo as escudoLocal,f.escudo as escudoVisit, e.nombre as local,e.id as localid, f.nombre as visitante, f.id as visitid, p.fecha, p.hora 
					FROM partidos p, equipos e, equipos f 
					WHERE p.local=e.id and p.visitante=f.id and e.grupo =\''.$_GET["grupo"].'\' 
					ORDER BY p.fecha, p.id asc';
		}
		$result=mysql_query($query);
	}else if($_GET["fecha"]!="") {
		if($_GET["jornada"]!=""){
		echo '<h3>Partidos de la jornada '.$_GET["jornada"].' </h3>';
			$query='select p.id, e.escudo as escudoLocal,f.escudo as escudoVisit, e.nombre as local,e.id as localid, f.nombre as visitante, f.id as visitid, p.fecha, p.hora 
					FROM partidos p, equipos e, equipos f 
					WHERE p.local=e.id and p.visitante=f.id and (p.fecha=\''.$_GET["fecha"].'\' or p.fecha=ADDDATE(\''.$_GET["fecha"].'\',1)) 
					ORDER BY p.fecha, p.id asc';
		}else{
			$date = date_create($_GET["fecha"]);
			echo '<h3>Encuentros del '.date_format($date, 'd/m/Y').' </h3>';
			$query='select p.id, e.escudo as escudoLocal,f.escudo as escudoVisit, e.nombre as local,e.id as localid, f.nombre as visitante, f.id as visitid, p.fecha, p.hora
					FROM partidos p, equipos e, equipos f 
					WHERE p.local=e.id and p.visitante=f.id and p.fecha=\''.$_GET["fecha"].'\'  
					ORDER BY p.fecha, p.id asc';
		}
	}else{
		echo '<h3>Encuentros de '.$_GET["fase"].' </h3>';
			$query='select p.id, e.escudo as escudoLocal,f.escudo as escudoVisit, e.nombre as local,e.id as localid, f.nombre as visitante, f.id as visitid, p.fecha, p.hora 
					FROM partidos p, equipos e, equipos f 
					WHERE p.local=e.id and p.visitante=f.id and p.fase=\''.$_GET["fase"].'\'  
					ORDER BY p.fecha, p.id asc';
	}
	
	//Ejecutamos la sentencia SQL
	$result=mysql_query($query);


?>	
		
<table class="table table-bordered">
    <thead>
     
    </thead> 
    <tbody>

<?
while ($row=mysql_fetch_array($result)) {
		
		
		echo '<tr><td colspan="6" style="vertical-align: middle;">';
		echo '<form class="form form-inline"id="form_'.$row["id"].'" name="form_actualizar" style="margin: 0px;">';
		echo'<a class="btn btn-mini btn-danger" href="javascript:borrar('.$row["id"].');"><i class="icon-remove icon-white"></i> Borrar</a> ';
			echo '<a class="btn btn-mini btn-success" href="javascript:actualizar('.$row["id"].');">
				<i class="icon-upload icon-white"></i> Actualizar</a> ';
		$date = date_create($row["fecha"]);
		echo '<input class="input-small" id="dp2" type="text" name ="fecha" value="'.date_format($date, 'Y-m-d').'"/> ';
		echo '<input class="input-small" type="text" name ="hora" value="'.$row["hora"].'"/> ';
		echo selectEquipos($row["localid"],1);
		echo ' <img src="../images/escudos/'.$row["escudoLocal"].'"> ';
		echo '<img src="../images/escudos/'.$row["escudoVisit"].'"> ';
		echo selectEquipos($row["visitid"],2);
		echo ' <a class="btn btn-mini btn-info" href="#myModal'.$row["id"].'" role="button" data-toggle="modal">
			<i class="icon-star icon-white"></i> Apuestas</a> <br>';
		echo getApostadoresMantenimiento($row["id"]);
		echo '<input type="hidden" name="query" value="update"/> ';
		echo '<input type="hidden" name="id" value="'.$row["id"].'"/> ';
		echo '</form>';
		echo '</td></tr>';
		

}mysql_free_result($result);
?>
	<tr><td colspan="6" style="background-color:#CCC;text-align: center;vertical-align: middle;">
    		<a class="btn btn-mini btn-success" href="javascript:actualizarTodos();">
				<i class="icon-upload icon-white"></i> 
                Actualizar Todos
            </a>
		</td>
	</tr>
	<tr>
		<td colspan="6">
			<form class="form-inline" id="formulario">
				<input class="input-small" id="dp1"name="fecha" type="text"  value="2013-09-18"/>
				<input class="input-small" name="hora" type="text" placeholder="hh:mm:ss" value="20:45:00"/>
				<span id="selectLocal"><? echo selectEquipos(0,1); ?></span>
				<span id="selectVisit"><? echo selectEquipos(0,2); ?></span>
				<span id="selectFase">
					<select name="grupo">
						<option value="GRUPOS">Grupos</option>
						<option value="SEMIFINAL">Semifinal</option>
						<option value="FINAL">Final</option>
					</select></span> <br>
				<? echo getApostadoresMantenimiento(-1); ?>
				<button type="button" class="btn btn-success" onClick="submitForm();">Insertar</button>
						
				
				<input type="hidden" name="local" id="local"/>
				<input type="hidden" name="visitante" id="visitante"/>
				<input type="hidden" name="fase" id="fase"/>
				<input type="hidden" name="grupo" value="<? echo $_GET["grupo"]; ?>"/>            
				<input type="hidden" name="query" value="insert"/>
			</form>
		</td>
	</tr>
	
    </tbody> 
</table>    
<? }else{ ?>
	<form class="form-inline" id="formulario">
		<input class="input-small" id="dp1"name="fecha" type="text"  value="2013-09-18"/>
       	<input class="input-small" name="hora" type="text" placeholder="hh:mm:ss" value="20:45:00"/>
		<span id="selectLocal"><? echo selectEquipos(0,1); ?></span>
		<span id="selectVisit"><? echo selectEquipos(0,2); ?></span>
		<span id="selectFase">
			<?php echo getFasesSelectMantenimiento(); ?>
		</span>
		<br>
		<? echo getApostadoresMantenimiento(-1); ?>
		<button type="button" class="btn btn-success" onClick="submitForm();">Insertar</button>
				
		
		<input type="hidden" name="local" id="local"/>
        <input type="hidden" name="visitante" id="visitante"/>
        <input type="hidden" name="fase" id="fase"/>
        <input type="hidden" name="grupo" value="<? echo $_GET["grupo"]; ?>"/>            
		<input type="hidden" name="query" value="insert"/>
	</form>
 
<? }?> 



  
		</div> 
		</div> 
	</div>


<!-- divs modales -->
<?
if($query!=''){
$result=mysql_query($query);
while ($row=mysql_fetch_array($result)) {
$resultAP=mysql_query('SELECT a.id, a.apuesta, a.cotizacion, a.apostado, a.acertada, ap.nombre as apostante 
						FROM apuestas a, partido_apostante pa,  partido_apost_apuesta pap, apostantes ap
						WHERE a.partido ='.$row["id"].' and
						a.id=pap.idapuesta and
						pap.idpartidoapost=pa.id and
						ap.id=pa.idapostante
						order by id');
		
?>
<div class="modal hiden fade in" id="myModal<? echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true" style="display: none;width:90%; left: 0; margin-left:5%">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Apuestas para el partido </h3>
  </div>
  <div class="modal-body">
        <table class="table table-condensed"> 
    		<thead> 
                <tr>
                		<th></th>
                        <th>Apuesta</th>
                        <th>Cotizaci�n</th>
                        <th>Apostado</th>
                        <th>Apostante</th>
                        <th>Estado</th>
                        <th></th>
                </tr>
                </thead> 
                <tbody>
                <?
	                while ($rowAP=mysql_fetch_array($resultAP)) {		                	
	                		echo '<tr><td colspan="6">';
	                			echo '<form class="form-inline" id="apues'.$rowAP["id"].'" name="formapuespart'.$row["id"].'" action="" style="margin: 0px;">';
	                			echo '<a class="btn btn-mini btn-danger" href="javascript:borrarAP('.$rowAP["id"].');">
	                						<i class="icon-remove icon-white"></i></a> ';
		                		echo '<input type="text" class="input-xxlarge" name="apuesta" value="'.$rowAP["apuesta"].'"> ';
		                		echo '<input type="text" class="input-mini" name="cotizacion" value="'.$rowAP["cotizacion"].'"> ';
		                		echo '<input type="text" class="input-mini" name="apostado" value="'.$rowAP["apostado"].'"> ';	
								echo '<input type="text" class="input-mini" disabled="disabled" value="'.$rowAP["apostante"].'"> ';		                		
		                		echo '<select class="input-small" name="acertada">
		                						<option value="0"'; 
		                						if($rowAP["acertada"]==0){echo 'selected="selected"';}
		                						echo'>Pendiente</option>';
		                						echo '<option value="1"'; 
		                						if($rowAP["acertada"]==1){echo 'selected="selected"';}
		                						echo'>Acertada</option>';
		                						echo '<option value="2"'; 
		                						if($rowAP["acertada"]==2){echo 'selected="selected"';}
		                						echo'>Fallada</option>		                						
		                					</select> ';
                				echo '<button type="submit" class="btn btn-mini btn-success" ><i class="icon-upload icon-white"></i></button> ';
		                		echo '<input type="hidden" name="id" value="'.$rowAP["id"].'"/>';		
		                		echo '<input type="hidden" name="query" value="updateAP"/>';	
								echo '<input type="hidden" name="fecha" value="'.$_GET["fecha"].'"/> ';
								echo '<input type="hidden" name="fase" value="'.$_GET["fase"].'"/> ';
								echo '<input type="hidden" name="partido" value="'.$row["id"].'"/> ';	
		                		echo '</form>';
	                		echo '</td></tr>';
							
	                }mysql_free_result($resultAP);
					
                ?>
                <tr>
                	<td colspan="6" style="background-color:#CCC;text-align: center;vertical-align: middle;">
    					<a class="btn btn-mini btn-success" href="javascript:actualizarTodosApuestas(<?echo $row["id"]; ?>);">
							<i class="icon-upload icon-white"></i> 
                			Actualizar Todos
            			</a>
					</td>
               </tr>
			</tbody>
        </table>
	
		<form class="form-inline" action="">
        	<input type="text" class="input" name="apuesta" placeholder="Apuesta"/>
        	<input type="text" class="input-small" name="cotizacion" placeholder="Cotizaci�n"/>
        	<input type="text" class="input-small" name="apostado" placeholder="Apostado"/>
        	<?echo getApostantesSelectMantenimiento($row["id"]); ?>
        	<button type="submit" class="btn">Insertar Apuesta</button>
        	<input type="hidden" name="partido" value="<? echo $row["id"]; ?>"/>
        	<input type="hidden" name="query" value="insertAP"/>
            <input type="hidden" name="fecha" value="<? echo $_GET["fecha"]; ?>"/>
            <input type="hidden" name="fase" value="<? echo $_GET["fase"]; ?>"/>
        </form>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>    
  </div>
  
</div>
<?
}mysql_free_result($result);
}
?>
<!--FIN divs modales -->
  
   <!-- MODAL de carga ajax-->

    <div class="modal hiden fade" id="modal_ajax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="javascript:window.location.reload();">x</button>
            <h3 id="myModalLabel">Actualizando partidos ...</h3>
          </div>
          <div class="modal-body">
            <p id="resultado"></p>
            <div id="prog_bar_padre" class="progress progress-striped active">
 				 <div id="prog_bar" class="bar" style="width: 0%;"></div>
			</div>
          </div>
          <div class="modal-footer">
          </div>
    </div>
<!--container -->

<?  if($_GET["partido"]!=""){ ?>
<script language="javascript">
 	$('#myModal<? echo $_GET["partido"]; ?>').modal('toggle')
</script>
<? } ?>
 <script src="https://code.jquery.com/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


