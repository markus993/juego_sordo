<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Phonak-Matik</title>
	<link rel="icon" href="favicon.ico">
	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/alertify.min.js"></script>
	<link href="css/alertify.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funciones.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js"></script>
</head>
<body>
	<div class="container-full" style="" style="">
		<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-1"></div>
			<div class="col-md-10 col-sm-10 col-xs-10">
  			<div onclick="salir_login();" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
  					<img class="img-responsive img-rounded button vcenter" src="images/salir.png" alt="inicio">
  			</div>
  			<div onclick="createUserModalOpen();" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
  					<img class="img-responsive img-rounded button vcenter" src="images/add.png" alt="inicio">
  			</div>
  			<div onclick="showGeneralStatsModalOpen();" class="col-md-2 col-sm-2 col-xs-2 text-center button-div">
  					<img class="img-responsive img-rounded button vcenter" src="images/estadisticas_icono.png" alt="inicio">
  			</div>
  			<div onclick="load('temas.php');" class="col-md-6 col-sm-6 col-xs-6 pull-right text-right button-div">
  					<img class="img-responsive vcenter" src="images/ajustes_icono.png" alt="inicio">
  			</div>
  		</div>
  		<div class="col-md-1 col-sm-1 col-xs-1"></div>
  	</div>
  </div>
	<div class="container" id="lista_usuarios"></div>
	<div id="editUser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Editar Usuario</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputName">Nombres</label>
              <div class="col-sm-10">
                  <input type="hidden" id="idEdit" value=""/>
                  <input type="text" class="form-control" id="nameEdit" placeholder="Nombre"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputLast">Apellidos</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastEdit" placeholder="Apellidos"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Usuario</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="userEdit" placeholder="Usuario"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Email</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="mailEdit" placeholder="Email"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Sexo</label>
              <div class="col-sm-10">
                  <select class="" id="sexoEdit">
                  	<option value="female">Femenino</option>
                  	<option value="male">Masculino</option>
                  </select>
              </div>
            </div>
          </form>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" onclick="guardaUsuarioEditado();">Guardar</button>
					<button type="button" class="btn btn-primary" onclick="sendmailUser();">Enviar Mail</button>
					<div class="col-sm-2">
						<img id="loadingEdit" src="images/loading.gif" class="img-responsive invisible" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="addUser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear Usuario</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputName">Nombres</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" placeholder="Nombre"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputLast">Apellidos</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="last" placeholder="Apellidos"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Usuario</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="user" placeholder="Usuario"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Email</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="mail" placeholder="Email"/>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label" for="inputUser">Sexo</label>
              <div class="col-sm-10">
                  <select class="" id="sexo">
                  	<option value="female">Femenino</option>
                  	<option value="male">Masculino</option>
                  </select>
              </div>
            </div>
          </form>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" onclick="guardaUsuario();">Guardar</button>
					<div class="col-sm-2">
						<img id="loading" src="images/loading.gif" class="img-responsive invisible" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="wait_window" class="modal fade" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Enviando Correo</h4>
				</div>
				<div class="modal-body" style="height: 150px;">
					<div class="col-sm-12">
						<center>
							<img id="loading" src="images/loading.gif" class="img-responsive visible" alt="">
						</center>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-2">...
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="showGamesStats" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Estadisticas por Juego</h4>
	      </div>
	      <div id="stats" class="modal-body">
	        Escoje un juego
	      </div>
	      <div class="modal-footer">
	        <button type="button" onclick="loadStatsGame(1)" class="btn btn-primary">Juego 1</button>
	        <button type="button" onclick="loadStatsGame(2)" class="btn btn-primary">Juego 2</button>
	        <button type="button" onclick="loadStatsGame(3)" class="btn btn-primary">Juego 3</button>
		      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="showUserGraphicStats" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Estadisticas del usuario</h4>
	      </div>
	      <div id="Graphicstats" class="modal-body"></div>
	      <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="showTopics" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Topicos de cada juego</h4>
	      </div>
	      <div id="topicsStats" class="modal-body"></div>
	      <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="general_stats_window" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Estadisticas Generales </h4>
				</div>
				<div class="modal-body" style="height: 150px;">
					<div class="col-sm-12">
						Funcion sin implementar
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-10">
					</div>
					<div class="col-sm-2">
							<img class="img-responsive" src="images/personaje.png" alt="personaje">
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<style media="screen">
	@import url(http://fonts.googleapis.com/css?family=Roboto);
	#Graphicstats,#Graphicstats .modal-dialog {
		padding: 0px !important;
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}
	#Graphicstats .modal-content {
	  height:  auto;
	  min-height: 100%;
	  border-radius: 0;
	}
	#showTopics,#showTopics .modal-dialog {
		padding: 0px !important;
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}
	#showTopics .modal-content {
	  height:  auto;
	  min-height: 100%;
	  border-radius: 0;
	}
	#showUserGraphicStats,#showUserGraphicStats .modal-dialog {
		padding: 0px !important;
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}
	#showUserGraphicStats .modal-content {
	  height:  auto;
	  min-height: 100%;
	  border-radius: 0;
	}
	#showGamesStats,#showGamesStats .modal-dialog {
		padding: 0px !important;
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}
	#showGamesStats .modal-content {
	  height:  auto;
	  min-height: 100%;
	  border-radius: 0;
	}
	.modal-footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    /* height: 60px; */
    background-color: #f5f5f5;
	}
	.visible{
		opacity: 1;
	}
	.visible1{
		opacity: 1;
	}
	.visible0{
		opacity: 0;
	}
	.invisible{
		opacity: 0;
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
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.5),0 0 8px rgb(104, 145, 162);
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.5),0 0 8px rgb(104, 145, 162);
	  cursor: pointer;
	}
	.button-div{
	  padding: 10px;
	}
	iframe,#stats,#topicsStats,#Graphicstats {
		height: 100%;
		width: 100%;
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
	.well{
		margin-bottom: 10px;
		max-height: 110px;
	}
</style>
<script type="text/javascript">
	function rescale(modal){
		var size = {width: $(window).width() , height: $(window).height() }
		var offset = 0
		var offsetBody = 60
		$(modal).css('height', size.height - offset );
		$('.modal-body').css('height', size.height - (offset + offsetBody ));
		$(modal).css('top', 0);
	}

	function sendmailUser() {
		sendmail($('#idEdit').val())
	}

	function showGeneralStatsModalOpen() {
 		$("#general_stats_window").modal('show');
	}

	function showTopicsModalOpen() {
 		$("#showTopics").modal('show');
		rescale('#showTopics');
		$("#topicsStats").html("<iframe width='300' id='iframeStats' height='500' frameborder='0' src='temasPanel.php' scrolling='no' marginheight='0' marginwidth='0'></iframe>");
	}

	function showUserStatsModalOpen(id) {
    $('#idEdit').val(id);
		$("#stats").html('');
		$("#showGamesStats").modal('show');
		 rescale('#showGamesStats');
	}

	function showUserGraphicStatsModalOpen(id) {
		$("#showUserGraphicStats").modal('show');
		$("#Graphicstats").html("<iframe width='300' id='iframeStats' height='500' frameborder='0' src='estadisticas.php' scrolling='no' marginheight='0' marginwidth='0'></iframe>");
		 rescale('#Graphicstats');
	}

	function showUserStatsModalClose() {
		 $("#showGamesStats").modal('hide');
	}

	function waitModalClose() {
		 $("#wait_window").modal('hide');
	}

	function waitModalOpen() {
		 $("#wait_window").modal('show');
	}

	function createUserModalOpen() {
		 $("#addUser").modal('show');
	}

	function createUserModalClose() {
		 $("#addUser").modal('hide');
	}

	function editUserModalOpen(id) {
    $('#idEdit').val(id);
    info = infoUsuario(id);
    console.log(info);
    $('#nameEdit').val(info.Nombres);
    $('#lastEdit').val(info.Apellidos);
    $('#userEdit').val(info.usuario);
    $('#mailEdit').val(info.mail);
    $('#sexoEdit').val(info.sexo);
    $("#editUser").modal('show');
	}

	function editUserModalClose() {
		 $("#editUser").modal('hide');
	}

	function loadStatsGame(juego) {
		$("#stats").html("<iframe width='300' id='iframeStats' height='500' frameborder='0' src='view_estadisticas.php' scrolling='no' marginheight='0' marginwidth='0'></iframe>");
	}

	function consultaListaUsuarios() {
		$.ajax({
			type: "POST",
			url: '/tesis/backend/web/app_dev.php/list_users',
			data: {
				token : readCookie('token'),
			},
			success: function(data){
				$.get("templates/single_user_list.php", function( template ) {
					Mustache.parse(template);   // optional, speeds up future uses
					console.log(data);
					console.log(template);
					var rendered = Mustache.render(template, data);
					$('#lista_usuarios').html(rendered);
				});
			}
		});
	}

	$( document ).ready(function() {
    consultaListaUsuarios();
	});
</script>
