<?php
	include 'includes/mpdf/mpdf.php';
	$mpdf=new mPDF('c');
 	ob_start();
?>
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
	<div id="background">
    <img src="images/fondo-estadisticas.png" class="stretch" alt="" />
	</div>
	<div class="container-full banda0" >
		<div class="col-md-12">-
		</div>
	</div>
	<div class="container-full banda1">
		<div class="row">
			<div class="col-md-4 banda-interior">
				 <a href="#" class="thumbnail">
					<img class="img-responsive iconos" src="images/clasificacion_icono3.png" alt="inicio">
				</a>
			</div>
			<div class="col-md-4 banda-interior">
				 <a href="#" class="thumbnail">
					<img class="img-responsive iconos" src="images/orientacion_icono3.png" alt="inicio">
				</a>
			</div>
			<div class="col-md-4 banda-interior">
				 <a href="#" class="thumbnail">
					<img class="img-responsive iconos" src="images/cantidades_icono3.png" alt="inicio">
				</a>
			</div>
		</div>
	</div>
	<div class="container-full banda2" >
		<div class="col-md-12 ">-
		</div>
	</div>
	<div class="container-full banda3">

	</div>
</body>
</html>
<script type="text/javascript">

</script>
<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);
body, html {
	height: 100%;
}
.banda0{
	height: 10%;
	background-color: blue;
	opacity:0.2;
}.banda1{
	height: 37%;
	background-color: blue;
	opacity:0.2;
}.banda2{
	height: 15%;
	background-color: red;
	opacity:0.2;
}.banda3{
	height: 40%;
	background-color: yellow;
	opacity:0.2;
}.banda-interior{
	height: 100%
}
#background {
		position: absolute;
    width: 100%;
    height: 100%;
    left: 0px;
    top: 0px;
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
}
.stretch {
    width:100%;
    height:100%;
}
.iconos {
	height:100%;
}
.img-responsive{
	margin:0 auto;
}
</style>
<?php
	$html = ob_get_clean();
	$mpdf->WriteHTML($html);
	$mpdf->Output();
?>
