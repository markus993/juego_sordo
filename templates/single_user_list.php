{{#response}}
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 well radius">
    <div onclick="load('{{id}}');" class="col-md-1 col-sm-1 col-xs-1 text-center button-div">
      <img class="img-responsive" style="height:50px" src="images/{{sexo}}.png" alt="inicio">
    </div>
    <div onclick="load('{{id}}');" class="col-md-5 col-sm-5 col-xs-5 text-center button-div" style="font-size:2em;">
      {{nombres}} {{apellidos}}
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 pull-right">
      <div onclick="load('{{id}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/estadisticas.png" alt="inicio">
      </div>
      <div onclick="load('{{id}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/safe.png" alt="inicio">
      </div>
      <div onclick="editUserModalOpen('{{id}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/usuario.png" alt="inicio">
      </div>
      <div onclick="load('{{id}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/calendario.png" alt="inicio">
      </div>
      <div onclick="load('{{id}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/sendmail.png" alt="inicio">
      </div>
      <div onclick="eliminaUsuario({{id}},'{{nombres}} {{apellidos}}');" class="col-md-2 col-sm-1 col-xs-1 text-center">
        <img class="img-responsive button button-div img-rounded" src="images/minus.png" alt="inicio">
      </div>
    </div>
  </div>
</div>
{{/response}}
