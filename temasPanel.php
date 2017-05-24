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
			<div class="row" style="position:absolute; bottom:0;width:100%;padding:0 0 0 15px;">
				<div id="clasificacion-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass">
					<a href="#" onclick="showModalOpen('clasificacion')" data-toggle="tab">
						<img class="img-responsive tab" src="images/tab1.png" alt="inicio">
						<img class="img-responsive" src="images/clasificacion_icono2.png" alt="inicio">
					</a>
				</div>
				<div id="orientacion-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass">
					<a href="#" onclick="showModalOpen('orientacion')" data-toggle="tab">
						<img class="img-responsive tab" src="images/tab2.png" alt="inicio">
						<img class="img-responsive" src="images/orientacion_icono2.png" alt="inicio">
					</a>
				</div>
					<a href="#" onclick="showModalOpen('cantidades')" data-toggle="tab"  id="cantidades-glass" class="col-md-4 col-sm-4 col-xs-4 text-center hover-glass" style="text-align:center;">
						<img class="img-responsive tab" src="images/tab3.png" alt="inicio">
						<img class="img-responsive" src="images/cantidades_icono2.png" alt="inicio">
					</a>
			</div>
		</div>
		<!--/Step 1 -->
	</div>
</body>
</html>
<div id="clasificacion_window" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Acerca de Phonak-Matic.com </h4>
			</div>
			<div class="modal-body" style="height: 150px;">
				<div class="col-md-12 col-xs-12	col-sm-12">
					Esta aplicación web es una ayuda didáctica para el aprendizaje de los estudiantes sobre aspectos de las matemáticas.<br>
					Se espera que sea monitoreada por los docentes y/o padres de los estudiantes.
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-10 col-xs-10	col-sm-10">
				</div>
				<div class="col-md-2 col-xs-2	col-sm-2">
						<img class="img-responsive" src="images/personaje.png" alt="personaje">
				</div>
			</div>
		</div>
	</div>
</div>
<div id="orientacion_window" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Acerca de Phonak-Matic.com </h4>
			</div>
			<div class="modal-body" style="height: 150px;">
				<div class="col-md-12 col-xs-12	col-sm-12">
					Esta aplicación web es una ayuda didáctica para el aprendizaje de los estudiantes sobre aspectos de las matemáticas.<br>
					Se espera que sea monitoreada por los docentes y/o padres de los estudiantes.
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-10 col-xs-10	col-sm-10">
				</div>
				<div class="col-md-2 col-xs-2	col-sm-2">
						<img class="img-responsive" src="images/personaje.png" alt="personaje">
				</div>
			</div>
		</div>
	</div>
</div>
<div id="cantidades_window" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Acerca de Phonak-Matic.com </h4>
			</div>
			<div class="modal-body" style="height: 150px;">
				<div class="col-md-12 col-xs-12	col-sm-12">
					Esta aplicación web es una ayuda didáctica para el aprendizaje de los estudiantes sobre aspectos de las matemáticas.<br>
					Se espera que sea monitoreada por los docentes y/o padres de los estudiantes.
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-10 col-xs-10	col-sm-10">
				</div>
				<div class="col-md-2 col-xs-2	col-sm-2">
						<img class="img-responsive" src="images/personaje.png" alt="personaje">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function showModalOpen(juego) {
		$("#"+juego+"_window").modal('show');
	}

	function showInfoModalClose() {
		 $("#clasificacion_window").modal('hide');
	}
</script>
<style media="screen">
	@import url(http://fonts.googleapis.com/css?family=Roboto);
	img{
		margin: 0 auto;
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
