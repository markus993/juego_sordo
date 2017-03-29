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
	<div class="wizard tab-content" style="position:relative;">
		<!--Step 1 -->
		<div id="step-1" class="tab-pane fade in active">
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
			<div class="row"  style="position:absolute; bottom:0;width:100%;padding:0 0 0 15px;">
				<div onclick="carga_pagina('temas.php');" class="col-md-12 col-sm-12 col-xs-12 text-center ">
						<img class="responsive button" src="images/inicio_boton.png" alt="inicio">
				</div>
			</div>
		</div>
		<!--/Step 1 -->
	</div>
</body>
</html>

<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);

.wizard{
	min-height:90%;
}
.button:hover{
	border-color: #fff;
	outline: 0;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
body, html {
	height: 100%;
	background-repeat: no-repeat;
	background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
	background: url(images/fondo-inicio.png);
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
