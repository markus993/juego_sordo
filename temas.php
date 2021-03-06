<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Phonak-Matik</title>
	<link rel="icon" href="favicon.ico">
	<script src="js/jquery-1.12.4.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funciones.js"></script>
</head>
<body>
	<div class="wizard tab-content container-full" style="position:relative;">
		<!--Step 1 -->
		<div id="step-1" class="tab-pane fade in active">
			<div class="row">
				<div class="col-md-12">&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-1 col-sm-1 col-xs-1"></div>
					<div class="col-md-2 col-sm-2 col-xs-2 well">
						<div class="col-md-12 col-sm-12 col-xs-12 hover-glass">
							<a href="#" onclick="salir_login();" >
								<img class="img-responsive" src="images/salir.png" alt="inicio">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="position:absolute; bottom:0;width:100%;padding:0 0 0 15px;">
				<div id="clasificacion-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass" style="position:relative;">
					<a href="#" onclick="carga_pagina('nivel1-1.php');" data-toggle="tab">
						<img class="img-responsive tab" src="images/tab1.png" style="width: 70%;" alt="inicio">
						<img class="img-responsive face" id="juego1nivel3" style="height:70px;position:absolute;top:25px;right:27%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego1nivel2" style="height:70px;position:absolute;top:25px;right:45%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego1nivel1" style="height:70px;position:absolute;top:25px;right:62%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive" src="images/clasificacion_icono2.png" alt="inicio">
					</a>
				</div>
				<div id="orientacion-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass">
					<a href="#" onclick="carga_pagina('nivel2-1.php');" data-toggle="tab">
						<img class="img-responsive tab" src="images/tab2.png" style="width: 70%;" alt="inicio">
						<img class="img-responsive face" id="juego2nivel3" style="height:70px;position:absolute;top:25px;right:27%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego2nivel2" style="height:70px;position:absolute;top:25px;right:45%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego2nivel1" style="height:70px;position:absolute;top:25px;right:62%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive" src="images/orientacion_icono2.png" alt="inicio">
					</a>
				</div>
				<div id="cantidades-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass">
					<a href="#" onclick="carga_pagina('nivel3-1.php');" data-toggle="tab">
						<img class="img-responsive tab" src="images/tab3.png" style="width: 70%;" alt="inicio">
						<img class="img-responsive face" id="juego3nivel3" style="height:70px;position:absolute;top:25px;right:27%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego3nivel2" style="height:70px;position:absolute;top:25px;right:45%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive face" id="juego3nivel1" style="height:70px;position:absolute;top:25px;right:62%;opacity:0;" src="images/sad.png" alt="inicio">
						<img class="img-responsive" src="images/cantidades_icono2.png" alt="inicio">
					</a>
				</div>
			</div>
		</div>
		<!--/Step 1 -->
	</div>
</body>
</html>
<script type="text/javascript">

	$.ajax({
		type: "POST",
		url: 'backend/web/app_dev.php/user_games_win',
		data: {
			id_user : readCookie('id_user'),
			token : readCookie('token'),
		},
		success: function(data){
			for (var i = 0; i < data.response.length; i++) {
				datos = data.response[i];
				//console.log(datos);
				cursos = "#juego"+datos.juego+"nivel"+datos.nivel;
				//console.log(cursos);
				if(datos.resultado==1){
					$(cursos).attr("src","images/happy.png");
				}
				$(cursos).fadeTo( 100, 1 );
			}
		}
	});

</script>
<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);
img{
	margin: 0 auto;
}
.hover-glass:hover{
	background-color: rgba(255, 255, 255, 0.3);
	border: 5px solid rgba(0, 0, 0, 0.3);
}
.hover-glass{
	background-color: rgba(255, 255, 255, 0);
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
  -moz-border-radius: 10%;
  -webkit-border-radius: 10%;
  border-radius: 10%;
	border: 5px solid rgba(0, 0, 0, 0);
}
.wizard{
	min-height:95%;
}.tab{
	margin-bottom: -10px;
	right: 8px;
	position: relative;
}
col-md-4{
	vertical-align: bottom;
}
body, html {
	height: 100%;
	background-repeat: no-repeat;
	background: url(images/temas.png);
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-position: center center;
	background-attachment: fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
</style>
