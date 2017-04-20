function carga_pagina(url){
  $(location).attr('href', url+'?token='+ readCookie('token'));
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function recargar(){
  location.reload();
}

function shuffle(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function login(){
  var user = $('#inputUser').val();
	var password = Base64.encode($('#inputPassword').val());
  $('#loading').show();
	$.ajax({
	  type: "POST",
	  url: 'backend/web/app_dev.php/login_user',
	  data: {
			user : user,
			pass : password,
		},
	  success: function(data){
			if(data.response){
        console.log(data);
        createCookie('token', data.response.token, 1);
        if(data.response.admin == 1){
          createCookie('admin', 1, 1);
          carga_pagina('panel.php');
        }else {
          carga_pagina('inicio.php');
        }
			}else{
        $('#loading').hide();
        alertify.error('Usuario o Contraseña incorrecta');
			}
		}
	});
}

function eliminaUsuario(id,nombre) {
  alertify.confirm('Confirmacion', 'Desea eliminar el usuario '+nombre+' ?',
    function(){
      if (eliminarUsuario(id)) {
        alertify.success('Usuario eliminado');
        consultaListaUsuarios();
      }else {
        alertify.warning('Error');
      }
    },
    function(){}
  ).set('labels', {ok:'Si', cancel:'No'});
}

function guardaUsuario() {
  name = $('#name').val();
  last = $('#last').val();
  user = $('#user').val();
  mail = $('#mail').val();
  sexo = $('#sexo').val();
  if (name == '' ||last == '' ||user == '' ||mail == '') {
    alertify.warning('Faltan datos');
    return false;
  }
  if(!validateEmail(mail)) {
    alertify.warning('Email no valido');
    return false;
  }
  $("#loading").addClass('visible');
  $("#loading").removeClass('invisible');
  if (crearUsuario(name,last,mail,sexo,user)) {
    $("#loading").addClass('invisible');
    $("#loading").removeClass('visible');
    createUserModalClose();
    consultaListaUsuarios();
    alertify.success('Usuario creado');
  }
}

function guardaUsuarioEditado() {
  id = $('#idEdit').val();
  name = $('#nameEdit').val();
  last = $('#lastEdit').val();
  user = $('#userEdit').val();
  mail = $('#mailEdit').val();
  sexo = $('#sexoEdit').val();
  if (name == '' ||last == '' ||user == '' ||mail == '') {
    alertify.warning('Faltan datos');
    return false;
  }
  if(!validateEmail(mail)) {
    alertify.warning('Email no valido');
    return false;
  }
  $("#loadingEdit").addClass('visible');
  $("#loadingEdit").removeClass('invisible');
  if (editarUsuario(id,name,last,mail,sexo,user)) {
    $("#loadingEdit").addClass('invisible');
    $("#loadingEdit").removeClass('visible');
    editUserModalClose();
    consultaListaUsuarios();
    alertify.success('Usuario guardado');
  }
}

function sendmail(id) {
  $.ajax({
    type: "POST",
    url: 'backend/web/app_dev.php/mail_user_password',
    dataType: "json" ,
    data: {
      id : id,
			token : readCookie('token'),
    },
    beforeSend: function(data){
      waitModalOpen();
    },
    success: function(data){
      waitModalClose();
      if (data.response == true) {
        alertify.success('Correo Enviado');
        return true;
      }else {
        alertify.error('Correo no pudo ser enviado');
        return false;
      }
    }
  });
}

function editarUsuario() {
  return $.ajax({
    type: "POST",
    async: false,
    url: 'backend/web/app_dev.php/update_user',
    data: {
      id : id,
      name : name,
      last : last,
      mail : mail,
      sexo : sexo,
      user : user,
			token : readCookie('token'),
    },
    success: function(data){
      return true;
    }
  }).responseText;
}

function crearUsuario() {
  return $.ajax({
    type: "POST",
    async: false,
    url: 'backend/web/app_dev.php/create_user',
    data: {
      name : name,
      last : last,
      mail : mail,
      sexo : sexo,
      user : user,
			token : readCookie('token'),
    },
    success: function(data){
      return true;
    }
  }).responseText;
}

function infoUsuario(id) {
  return $.ajax({
    type: "POST",
    async: false,
    url: 'backend/web/app_dev.php/info_user',
    data: {
      id : id,
			token : readCookie('token'),
    },
    success: function(data){
      return data.response;
    }
  }).responseJSON.response;
}

function eliminarUsuario(id) {
  return $.ajax({
    type: "POST",
    async: false,
    url: 'backend/web/app_dev.php/delete_user',
    data: {
      id : id,
			token : readCookie('token'),
    },
    success: function(data){
      return data.response;
    }
  }).responseText;
}

function envia_punto(juego,tipo_juego, nivel, intento, punto){
	$.ajax({
	  type: "POST",
	  url: 'backend/web/app_dev.php/user_point',
	  data: {
			juego : juego,
			tipo_juego : tipo_juego,
			nivel : nivel,
			intento : intento,
			punto : punto,
			token : readCookie('token'),
		},
	  success: function(data){
		}
	});
}

function envia_resultado(juego,resultado,nivel){
	$.ajax({
	  type: "POST",
	  url: 'backend/web/app_dev.php/user_result',
	  data: {
			juego : juego,
			nivel : nivel,
			resultado : resultado,
			token : readCookie('token'),
		},
	  success: function(data){
		}
	});
}

function nuevo_juego(juego){
  return $.ajax({
    type: "POST",
    url: 'backend/web/app_dev.php/user_new_game',
    async: false,
    data: {
      juego : juego,
      token : readCookie('token'),
    },
    success: function(data){
      return data.response;
    }
  }).responseJSON.response;
}

function salir_login(){
  eraseCookie('token');
  eraseCookie('juego');
  eraseCookie('admin');
  carga_pagina('index.php');
}

function salir_menu() {
      eraseCookie('juego');
      carga_pagina('temas.php');
  // alertify.confirm('Salir al Menu', 'Deseas salir al Menu?',
  //   function(){
  //     eraseCookie('juego');
  //     carga_pagina('temas.php');
  //   },
  //   function(){}
  // ).set('labels', {ok:'Si', cancel:'No'});
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function load(id) {
  alertify.success('Usuario: '+id);
}
