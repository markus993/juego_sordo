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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
	<div class="container-full" style="" style="">
		<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-md-10 col-sm-10 col-xs-10">
				<div onclick="//carga_pagina('temas.php');" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
					<h1>Juego 1</h1>
				</div>
				<div onclick="//carga_pagina('temas.php');" class="col-md-7 col-sm-7 col-xs-7 text-center button-div">
					<h1>Nombre Usuario</h1>
				</div>
				<div onclick="//carga_pagina('temas.php');" class="col-md-1 col-sm-1 col-xs-1 text-center button-div">
					<a href="#" onclick="salir_login();" >
						<img class="img-responsive" src="images/salir.png" alt="inicio">
					</a>
				</div>
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
		</div>
	</div>
	<div class="container-full" style="he">
		<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-md-10 col-sm-10 col-xs-10">
				<canvas id="myChart" width="600" height="400"></canvas>
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
		</div>
	</div>
</body>
</html>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ["Nivel 1", "Nivel 2", "Nivel 3"],
		datasets: [
			{
				label: 'Puntos Positivos',
				data: [3, 1, 13 ],
				backgroundColor: [
					'rgba(54, 162, 235, 0.2)', //AZUL
					'rgba(54, 162, 235, 0.2)', //AZUL
					'rgba(54, 162, 235, 0.2)' //AZUL
				],
				borderColor: [
					'rgba(54, 162, 235, 1)', //AZUL
					'rgba(54, 162, 235, 1)', //AZUL
					'rgba(54, 162, 235, 1)' //AZUL
				],
				borderWidth: 1
			},
			{
				label: 'Puntos Negativos',
				data: [12, 19, 3 ],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)', //ROJO
					'rgba(255, 99, 132, 0.2)', //ROJO
					'rgba(255, 99, 132, 0.2)' //ROJO
				],
				borderColor: [
					'rgba(255,99,132,1)', //ROJO
					'rgba(255,99,132,1)', //ROJO
					'rgba(255,99,132,1)' //ROJO
				],
				borderWidth: 1
			}
		]
	},
	options: {
		scales: {
			xAxes: [{
							 stacked: true
					 }],
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		},
		responsive: false,
		layout:{
			padding:10
		}
	}
});
</script>
<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);
canvas {
	background-color: rgba(200, 200, 200, 0.8);
	width: 100%;
	height: auto;
}
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
	overflow:hidden;
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
