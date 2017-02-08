<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<a href="#step-2" data-toggle="tab">
						<img class="responsive" src="images/inicio_boton.png" alt="inicio">
					</a>
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
