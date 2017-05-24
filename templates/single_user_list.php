{{#response}}
  <div class="row col-md-12 col-sm-12 col-xs-12 well radius">
    <div onclick="load('{{id}}');" class="col-md-1 col-sm-1 col-xs-1 text-center button-div">
      <img class="img-responsive" src="images/{{sexo}}.png" alt="inicio">
    </div>
    <div onclick="load('{{id}}');" class="col-md-4 col-sm-4 col-xs-4 text-center button-div h2">
      {{nombres}} {{apellidos}}
    </div>
    <div class="col-md-7 col-sm-7 col-xs-7 pull-right" style="height:50px;">
      <div class="col-md-2 col-sm-2 col-xs-2 text-center">
        <img class="img-responsive button-div img-rounded visible{{admin}}" src="images/safe.png" alt="inicio" data-toggle="tooltip" title="Administrador">
      </div>
      <div onclick="showUserStatsModalOpen('{{id}}','{{nombres}} {{apellidos}}');" class="col-md-2 col-sm-2 col-xs-2 text-center" data-toggle="tooltip" title="Estadisticas Usuario">
        <img class="img-responsive button button-div img-rounded" src="images/estadisticas.png" alt="inicio">
      </div>
      <div onclick="editUserModalOpen('{{id}}');" class="col-md-2 col-sm-2 col-xs-2 text-center" data-toggle="tooltip" title="Editar Usuario">
        <img class="img-responsive button button-div img-rounded" src="images/usuario.png" alt="inicio">
      </div>
      <div onclick="showTopicsModalOpen();" class="col-md-2 col-sm-2 col-xs-2 text-center" data-toggle="tooltip" title="Topicos">
        <img class="img-responsive button button-div img-rounded" src="images/calendario.png" alt="inicio">
      </div>
      <div onclick="showUserGraphicStatsModalOpen('{{id}}','{{nombres}} {{apellidos}}');" class="col-md-2 col-sm-2 col-xs-2 text-center" data-toggle="tooltip" title="Enviar Estadisticas al Correo">
        <img class="img-responsive button button-div img-rounded" src="images/sendmail.png" alt="inicio">
      </div>
      <div onclick="eliminaUsuario({{id}},'{{nombres}} {{apellidos}}');" class="col-md-2 col-sm-2 col-xs-2 text-center" data-toggle="tooltip" title="Eliminar usuario">
        <img class="img-responsive button button-div img-rounded" src="images/minus.png" alt="inicio">
      </div>
    </div>
  </div>
{{/response}}
