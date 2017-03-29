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
	  url: '/tesis/backend/web/app_dev.php/login_user',
	  data: {
			user : user,
			pass : password,
		},
	  success: function(data){
			if(data.response){
        createCookie('token', data.response, 1);
        carga_pagina('/tesis/inicio.php');
			}else{
        $('#loading').hide();
        alertify.error('Usuario o Contraseña incorrecta');
			}
		}
	});
}

function envia_punto(juego,tipo_juego, nivel, intento, punto){
	$.ajax({
	  type: "POST",
	  url: '/tesis/backend/web/app_dev.php/user_point',
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
	  url: '/tesis/backend/web/app_dev.php/user_result',
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
    url: '/tesis/backend/web/app_dev.php/user_new_game',
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
  carga_pagina('index.php');
}

function salir_menu() {
  alertify.confirm('Salir al Menu', 'Deseas salir al Menu?',
    function(){
      eraseCookie('juego');
      carga_pagina('temas.php');
    },
    function(){}
    ).set('labels', {ok:'Si', cancel:'No'});
}
