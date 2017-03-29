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
	<div class="container-full" style="" style="">
		<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-md-10 col-sm-10 col-xs-10">
			<div onclick="carga_pagina('temas.php');" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
					<img class="img-responsive button vcenter" src="images/add.png" alt="inicio">
			</div>
			<div onclick="carga_pagina('temas.php');" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
					<img class="img-responsive button vcenter" src="images/rest.png" alt="inicio">
			</div>
			<div onclick="carga_pagina('temas.php');" class="col-md-6 col-sm-6 col-xs-6 pull-right text-right button-div">
					<img class="img-responsive button vcenter" src="images/ajustes_icono.png" alt="inicio">
			</div>
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1"></div>
	</div>
</div>
	<div class="container-full" style="he">
		<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-md-10 col-sm-10 col-xs-10 well radius">
					<div onclick="carga_pagina('temas.php');" class="col-md-1 col-sm-1 col-xs-1 text-center button-div">
							<img class="img-responsive button" src="images/female.png" alt="inicio">
					</div>
					<div onclick="carga_pagina('temas.php');" class="col-md-4 col-sm-4 col-xs-4 text-center button-div">
							<img class="img-responsive button" src="images/inicio_boton.png" alt="inicio">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 pull-right">
						<div onclick="carga_pagina('temas.php');" class="col-md-3 col-sm-1 col-xs-1 text-center">
								<img class="img-responsive button button-div img-rounded" src="images/estadisticas.png" alt="inicio">
						</div>
						<div onclick="carga_pagina('temas.php');" class="col-md-3 col-sm-1 col-xs-1 text-center">
								<img class="img-responsive button button-div img-rounded" src="images/usuario.png" alt="inicio">
						</div>
						<div onclick="carga_pagina('temas.php');" class="col-md-3 col-sm-1 col-xs-1 text-center">
								<img class="img-responsive button button-div img-rounded" src="images/check.png" alt="inicio">
						</div>
						<div onclick="carga_pagina('temas.php');" class="col-md-3 col-sm-1 col-xs-1 text-center">
								<img class="img-responsive button button-div img-rounded" src="images/calendario.png" alt="inicio">
						</div>
					</div>
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
		</div>
	</div>
</body>
</html>

<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);
.well_mod{
	background-color: transparent;
	border: 0px solid transparent;
	padding: 0px;
}
.radius {
	border-radius:20px;
	padding: 0px;
}
.vcenter {
  display: inline-block;
  vertical-align: middle;
  float: none;
}
.wizard{
	min-height:90%;
	padding:auto;
}
.down{
	vertical-align: bottom;
}
.button:hover{
	border-color: #fff;
	outline: 0;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
.button-div{
    margin: 15px;
}
body, html {
	height: 100%;
	background-repeat: no-repeat;
	background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
	background: url(images/fondo-panel.png);
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
