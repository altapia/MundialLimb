		<script>
			dojoConfig = {
				parseOnLoad: true, //enables declarative chart creation
				gfxRenderer: "svg", // svg get priority,
				isDebug: true
			};
		</script>
		<!-- load dojo and provide config via data attribute -->
		<script src="dojo-release-1.9.3/dojo/dojo.js">

		</script>
		<div style="text-align:center;">
		<table align="center">

			<div class="list-group"><a id="fecha"  href="#" class="list-group-item active" style="padding-top: 0px;padding-bottom: 0px"></a>	<a data-toggle="collapse" data-target='#comment49'  
		href='#49' class="list-group-item text-center" style="min-height:65px">
		<div class="h4 col-xs-12">
    		<div class="col-sm-5 col-xs-3">
				<span id="local" class="hidden-xs"></span>
				<img id="escudoLocal" class="image-chica" >
			</div>
			<div class="col-sm-2 col-xs-6 text-center h3" style="margin-top: 0px;margin-bottom: 0px;">
    			<strong id="hora"></strong>
    		</div>
			<div class="col-sm-5 col-xs-3">
				<img id="escudoVisitante" class="image-chica">
				<span id="visitante" class="hidden-xs"></span>
			</div>	
		</div>	
	
		
	</a>
	</div>



		</table>
		</div>
		
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="Util.js"></script>
		<script>
			// Require the dojox.gfx resource
			dojo.require("dojox.gfx");
			dojo.require("dojox.gfx.fx");
			dojo.require("dojo.parser");
			dojo.require("dijit.form.Button");
			dojo.require("dojo._base.connect");

			var group;
			var tam = 300;
			// Create a ready event
			dojo.ready(function(){
				
				// Create a GFX surface
				// Arguments:  node, width, height
				surface = dojox.gfx.createSurface("surfaceElement",tam,tam);

				// Create a group
				groupFondo = surface.createGroup();

				// Create a circle
				var circle1 = groupFondo.createCircle({ cx: tam/2, cy: tam/2, r:(tam/2)-(tam/40) }).setFill({
					type: "radial",
					cx: tam/2,
					cy: tam/2,
					colors: [
						{ offset: 0,   color: "#aaff88" },
						{ offset: 1,   color: "#229900" }
					]
				});
				group = surface.createGroup();
				
				group2 = surface.createGroup();
				//Marcador
				group2.createPolyline([{ x: (tam/2)-(tam/40), y: 1}, { x: (tam/2)+(tam/40), y: 1 }, { x: tam/2, y: 32 },{ x: (tam/2)-(tam/40), y: 1}])
					.setFill([255,255,40,1])
					// .setFill([(tam/2),30,40,1])
		            //.setStroke({ color: 'blue', width: 2})
            ;

			
			});
			var graficos=[];
			function pintaApostantes( jsonApostantes){
				
				group.clear();

				var size=jsonApostantes.length;
				var arc = 360/size;
				for(var i =0; i<size;i++){
					
					var line= group.createLine({ x1: tam/2, y1: tam/2, x2:tam/2, y2:tam/40 }).setStroke({color : "#ffff28", cap : "butt", width : 3});
					var text = group.createText({ x:tam/2, y:tam/6, text:jsonApostantes[i].nombre, align:"middle"}) 
						.setFont({ family:"Arial", size:"20pt", weight:"bold" }) //set font
    					.setFill("white");


    				graficos.push({"id":jsonApostantes[i].id,"line":line,"text":text});
					// jsonApostantes[i].nombre
					line.applyTransform(dojox.gfx.matrix.rotategAt(arc*(i+1)+arc/2,tam/2,tam/2));
					text.applyTransform(dojox.gfx.matrix.rotategAt(arc*(i+1)+arc,tam/2,tam/2));
				};
	
				//apostantesEnRosco=jsonApostantes;
			}
			var lastDegree=0;
			function sortea(indiceGanador,idGanador,numTotal,tiempo,funcionPintaResultadoEnTabla,funcionPintaApostantesRestantes,funcionPintaSiguientePartido){
				var arc = 360/numTotal;
				
				var endDegree = arc*(indiceGanador+1)+arc;
				console.log("Ganador posición " + indiceGanador + " de un total de " + numTotal + ". Grados calculados: " + endDegree);
				var animrueda=new dojox.gfx.fx.animateTransform({
				    duration: tiempo*1000,
				    shape: group,
				    transform: [{
				        name: 'rotategAt',
				        start: [lastDegree,tam/2,tam/2], // Starts at 0 degree rotation
				        end: [2*360+360-endDegree,tam/2,tam/2]  // Ends at 360 degrees
				    }]
				});
				animrueda.play();

				
				// var anim=new dojo.animateProperty({
			 //        node: graficos[indiceGanador].text,
			 //        properties: {
			 //            opacity: { start: 1, end: 0 }
			 //        },
			 //        duration: 800
			 //    });
				// anim.play();
				lastDegree=endDegree;
				setTimeout(	funcionPintaResultadoEnTabla,tiempo*1000);
				setTimeout(	funcionPintaApostantesRestantes,tiempo*1000+4000);
				setTimeout(	funcionPintaSiguientePartido,tiempo*1000+4000);
			}

		</script>

		<div id="block_container" style="text-align:center">
		<div id="surfaceElement" style="display:inline;"></div>
			<div id="divTablaSorteos" style="text-align:center;display:inline;">
				<table id="tablaSorteos" class="table" >
					<tr>
						<th> Partido </th>
						<th> Apostante </th>
					<tr>
					<!--http://hotelpene.com/championsLimb/pages/api.php?q=prox_jornada-->
			
	
				</table>
				<script>
			//Gestión de la tabla de partidos sorteados
				function pintaPartidos(partidos, apostantes){
					
					while ($('#tablaSorteos tr').length>2){
						$('#tablaSorteos tr:eq(1)').remove();
					}

					if(partidos!=null){
						var size=partidos.length;
						for(var i=0;i<size;i++){
							$('#tablaSorteos tr:first').after(generatePartidoApostanteRow(partidos[i],apostantes[i]));	
						}
					}
				}
				function annadePartido(partido, apostante){
					
					$('#tablaSorteos tr:first').after(generatePartidoApostanteRow(partido,apostante));	
					
				}

				function generatePartidoApostanteRow(partido,apostante){
					return '<tr><td valign="middle" id='+partido.id+'>'+partido.local+' <img class="image-chica" src="http://hotelpene.com/mundialLimb/images/escudos/'+partido.escLocal+'"> vs <img class="image-chica" src="http://hotelpene.com/mundialLimb/images/escudos/'+partido.escVisit+'">' + partido.visitante +'</td><td id=apostante'+apostante.id+'>'+apostante.nombre+'</td></tr>';
				}
				
			</script>
			</div>
		</div>

		<script>

			var apostantesEnRosco;
			function HTMLEncode(str){
				  var i = str.length,
				      aRet = [];

				  while (i--) {
				    var iC = str[i].charCodeAt();
				    if (iC < 65 || iC > 127 || (iC>90 && iC<97)) {
				      aRet[i] = '&#'+iC+';';
				    } else {
				      aRet[i] = str[i];
				    };
				   }
				  return aRet.join('');    
				}
			function pintaPartidoActual(partido){
				

				if (partido!=null){
					//alert("PINTA PARTIDO ACTUAL:"+partido.local+partido.visitante);
					
					$('#local').text(parseHtmlChars(partido.local));
					$('#visitante').text(parseHtmlChars(partido.visitante));

					$('#escudoLocal').attr('src','http://hotelpene.com/mundialLimb/images/escudos/' + partido.escLocal);
					$('#escudoVisitante').attr('src','http://hotelpene.com/mundialLimb/images/escudos/' + partido.escVisit);
// 					$('#escudoVisitante').attr('src','http://img.uefa.com/imgml/TP/teams/logos/32x32/' + partido.escVisit);

					$('#fecha').text(partido.fecha);
					$('#hora').text(partido.hora);
				}else{
					$('#local').text('');
					$('#visitante').text('');

					$('#escudoLocal').attr('src','whitePixel.png');
					$('#escudoVisitante').attr('src','whitePixel.png');
// 					$('#escudoVisitante').attr('src','http://img.uefa.com/imgml/TP/teams/logos/32x32/' + partido.escVisit);

					$('#fecha').text('');
					$('#hora').text('');
				}

				
				
			}
			function pintadoInicial(jsonLive){
				jsonApostantes = jsonLive.apostantes;
				jsonApostantesEnRosco = jsonLive.apostantes_en_rosco;
				jsonPartidosSorteados = jsonLive.partidos_sorteados;
				jsonApostantesSorteados = jsonLive.apostantes_sorteados;
				pintaPartidos(jsonPartidosSorteados,jsonApostantesSorteados); 
				pintaPartidoActual();
				pintaApostantes(jsonApostantesEnRosco);
				
			}
			var actual="-1";
			function pinta(jsonLive){
				if (jsonLive.partido_actual==null){
					
					pintadoInicial(jsonLive);
				}else{
					

	 				jsonApostantes = jsonLive.apostantes;
	 				try{
		 				if(jsonLive.partido_actual.id!=actual){
		 					
		 					actual=jsonLive.partido_actual.id;
							apostantesEnRosco = jsonLive.apostantes_en_rosco;
		 					
		 					pintaPartidoActual(jsonLive.partido_actual);
							var parts = new Array();
							var aposts = new Array();
							parts[0] = jsonLive.partido_actual;
							aposts[0] = jsonLive.apostante_actual;
							
		
							var index=0;
							
							for(var i=0;i<apostantesEnRosco.length;i++){
								if(apostantesEnRosco[i].id===jsonLive.apostante_actual.id){
									index=i;
									i=99999;
								}
							}
							var segundos = 4;
							sortea(index,jsonLive.apostante_actual.id,apostantesEnRosco.length,segundos, function(){annadePartido(jsonLive.partido_actual,jsonLive.apostante_actual);} ,function(){pintaApostantes(jsonApostantes);},function(){pintaPartidoActual(jsonLive.proximo);});
							//setTimeout(pintaApostantes(jsonApostantes),6000);
							
						}
	 				 }catch(err){
	 				 	//alert(err);
	 				 }
	 			}
			}	
		

			var jsonLive;
			function initAjax(){

				$.ajax( 'dataSorteo.php', {
				    "type": "GET", //or "POST"
				    //"data": "<query string>", //if POST
				    "success": function ( data, status ) {
				        jsonLive = window.JSON.parse( data );
				       	pintadoInicial(jsonLive);
				       
				    },
				    "error": function ( response, status, error ) {
				        // handle error
				    }
				} );
				setTimeout("refreshSorteo()",1000);
			}

			function refreshSorteo(){

				$.ajax( 'dataSorteo.php', {
				    "type": "GET", //or "POST"
				    //"data": "<query string>", //if POST
				    "success": function ( data, status ) {
				        jsonLive = window.JSON.parse( data );
				       	pinta(jsonLive);
				       
				    },
				    "error": function ( response, status, error ) {
				        // handle error
				    }
				} );
				setTimeout("refreshSorteo()",1000);
			}

			initAjax();
			
		</script>