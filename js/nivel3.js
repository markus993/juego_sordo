
	var repetir;
	var ganaste;
	var salir;
	var positivos = 0;
	var negativos = 0;
	var pausado = false;
	var menu = false;
	var data = {
			punto1 : '',
			punto2 : '',
			punto3 : '',
			punto4 : '',
			punto5 : ''
		}

	var $_GET = {};

	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
		function decode(s) {
			return decodeURIComponent(s.split("+").join(" "));
		}
		$_GET[decode(arguments[1])] = decode(arguments[2]);
	});

	if (typeof($_GET['data']) !== 'undefined'){
		dataDec = Base64.decode($_GET['data']);
		console.log(dataDec);
		var dataDec = decodeURIComponent( dataDec );
		dataDec = dataDec.split("&");
		$.each(dataDec, function( index, value ) {
			value = value.split("=");
			console.log(value);
			switch (value[0]) {
				case 'punto1':
					data.punto1=value[1];
					break;
				case 'punto2':
					data.punto2=value[1];
					break;
				case 'punto3':
					data.punto3=value[1];
					break;
				case 'punto4':
					data.punto4=value[1];
					break;
				case 'punto5':
					data.punto5=value[1];
					break;
			}
		});
	}

	function recargar(){
		$(location).attr('href', document.location.pathname+'?token='+ readCookie('token'));
	}

	function recargar_juego(data){
		console.log(data);
		dataEnc = Base64.encode($.param( data, true ));
	  $(location).attr('href', document.location.pathname+'?token='+ readCookie('token')+'&data='+dataEnc);
	}

  function irA(pagina){
    switch (pagina) {
      case 'menu':
	      window.location.assign("/menu");
	      break;
      case 'nivel3.1':
	      window.location.assign("nivel3-1.php");
	      break;
      case 'nivel3.2':
      window.location.assign("nivel3-2.php");
	      break;
	      case 'nivel3.3':
      window.location.assign("nivel3-3.php");
	      break;
	      default:
    }
  }

  function load_object(obj){
		//console.log(obj);
    fabric.Image.fromURL(obj.url, function(image) {
      image = new_image(image,obj);
      canvas.add(image).calcOffset();
      evaluar = obj.nombre+"= image ;";
      eval(evaluar);
    });
  }

  function new_image(image,param){
		if (typeof(param.scaleX) !== 'undefined'){
			x = param.scaleX;
			y = param.scaleY;
		}else {
			x = y = param.scale;
		}
    image.set({
      id:param.nombre,
		  left: viewport.width*param.left,
		  top: viewport.height*param.top,
      hasControls: false,
      hasBorders : false,
      hoverCursor : 'pointer',
      name:param.nombre,
      objeto:param.objeto,
      selectable: param.selectable,
      conjunto:param.conjunto,
			scaleX:x,
			scaleY:y
    });
    return image;
  }

	function selected(e, dir) {
		//console.log(e.target.name);
		if(e.target == null) return;

		switch(e.target.name) {
			case 'Menu':
				salir_menu();
				return;
				break;
			case 'Salir':
				carga_pagina('temas.php');
				return;
				break;
			case 'Repetir':
				recargar();
				return;
				break;
			case 'Siguiente':
				carga_pagina('nivel3-'+(juego+1)+'.php');
				return;
				break;
		}

		switch (operacion) {
			case 'mas':
				if(e.target.conjunto == 1){
					if(numero1 > numero2){
						console.log('positivo1+');
						positivos++;
						data_process(1,data);
					}else{
						console.log('negativo1+');
						negativos++;
						data_process(0,data);
					}
				}
				if(e.target.conjunto == 2){
					if(numero1 < numero2){
						console.log('positivo2+');
						positivos++;
						data_process(1,data);
					}else{
						console.log('negativo2+');
						negativos++;
						data_process(0,data);
					}
				}
				break;
			case 'menos':
				if(e.target.conjunto == 1){
					if(numero1 < numero2){
						console.log('positivo1-');
						positivos++;
						data_process(1,data);
					}else{
						console.log('negativo1-');
						negativos++;
						data_process(0,data);
					}
				}
				if(e.target.conjunto == 2){
					if(numero1 > numero2){
						console.log('positivo2-');
						positivos++;
						data_process(1,data);
					}else{
						console.log('negativo2-');
						negativos++;
						data_process(0,data);
					}
				}
				break;
		}
  }

	function data_process(punto,data) {
		asignado = false;
		var pos = 0;
		var neg = 0;
		$.each(data, function( index, value ) {
			if(data[index]=='' && asignado == false){
				data[index] = punto;
				asignado = true;
				envia_punto(3, juego, index, punto);
				if(punto == 1){
					pos++;
				}else {
					neg++;
				}
			}else{
				switch (value) {
					case '1':
						pos++;
						break;
					case '0':
						neg++;
						break;
				}
			}
		});
		console.log('positivos: '+pos);
		console.log('negativos: '+neg);
		if(pos+neg == 5){
			mostrar_menu();
		}else{
			recargar_juego(data);
		}
	}

	function mostrar_menu(evento){
		var rect = new fabric.Rect({
			fill: 'black',
			opacity: 0.4,
			originX: 'left',
			originY: 'top',
			left: 0,
			top: 0,
			selectable:false,
			width: viewport.width,
			height: viewport.height,
		});
		canvas.add(rect)
		mensaje_caja(repetir_txt);
		mensaje_caja(salir_txt);
		if(positivos > negativos){
			envia_resultado(juego,1);
			mensaje_caja(ganaste_txt);
		}else {
			envia_resultado(juego,0);
			mensaje_caja(perdiste_txt);
		}
		if(juego !=3)
			mensaje_caja(siguiente_txt);
	}

  function mensaje_caja(txt){
    fabric.Image.fromURL(tablero.url, function(image) {
      image.set({
        left: 100,
        top: 50,
        shadow: 'rgba(0,0,0,0.3) 5px 5px 5px',
        hasControls: false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name:tablero.nombre,
        objeto:tablero.objeto,
        selectable: tablero.selectable,
        conjunto:tablero.conjunto
      }).scale(1);
      texto_mensaje = null;
      var texto_mensaje = new fabric.Text(txt.nombre, {
        left: 100,
        top: 50,
        fontSize: txt.fontSize,
        fill: 'white',
        fontWeight: txt.fontWeight,
        fontStyle: txt.fontStyle,
        shadow: txt.shadow,
        hasControls: false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name:txt.nombre+'_txt',
        objeto:false,
        selectable: false,
        conjunto: false
      });
      caja = new fabric.Group([ image, texto_mensaje ], {
        left: viewport.width * txt.left,
        top: viewport.height * txt.top,
        hasControls: false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name:txt.nombre,
        objeto:tablero.objeto,
        selectable: tablero.selectable,
        conjunto:tablero.conjunto
      });
      canvas.add(caja);
      //return caja;
    });
  }

	function new_rect (obj){
		leftS =  viewport.width*obj.left;
		topS = viewport.height*obj.top;
		widthS = viewport.width*obj.width;
		heightS = viewport.height*obj.height;
		var rect = new fabric.Rect({
			name: obj.nombre,
			left: leftS,
			top: topS,
			fill: obj.fill,
			opacity: obj.opacity,
			selectable: false,
			conjunto:obj.conjunto,
			width: widthS,
			height: heightS
		});
		canvas.add(rect).renderAll();
		evaluar = obj.nombre+"= rect ;";
		eval(evaluar);
	}

  function draw(){
    fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';
    fabric.Object.prototype.transparentCorners = false;
    fabric.Canvas.prototype.getItem = function(id) {
      var count = canvas.getObjects().length - 1;
      var object = null,
      objects = this.getObjects();
      //console.log(count);
      for (var i = 0, len = this.size(); i < len; i++) {
        if (objects[i].id && objects[i].id === id) {
          object = objects[i];
          break;
        }
      }
      return object;
    };

    canvas = new fabric.Canvas('canvas');
    canvas.setHeight(viewport.height);
    canvas.setWidth(viewport.width);

    canvas.hoverCursor = 'pointer';
    canvas.hasBorders = true;
    canvas.hasControls = false;
    canvas.selection = false;

    canvas.on('mouse:down', function(e){
			//console.log(e.target);
			if(e.target)
				selected(e, 1);
		});

    canvas.on('mouse:over', function(e){
			//console.log(e.target);
			if ( e.target){
				if(e.target.conjunto == 1){
					rect1.set({
						opacity:0.5,
						fill:'red',
				    stroke: '#000',
				    strokeWidth: 10,
					});
					canvas.renderAll();
				}
				if(e.target.conjunto == 2){
					rect2.set({
						opacity:0.5,
						fill:'red',
				    stroke: '#000',
				    strokeWidth: 10,
					});
					canvas.renderAll();
				}
			}
		});
    canvas.on('mouse:out', function(e){
			rect1.set({
				opacity:0.1,
				fill:'gray',
				stroke: '#000',
				strokeWidth: 0,
			});
			rect2.set({
				opacity:0.1,
				fill:'gray',
				stroke: '#000',
				strokeWidth: 0,
			});
			canvas.renderAll();
		});

    canvas.setBackgroundImage(fondo, canvas.renderAll.bind(canvas), {
      name:'fondo',
      originX: 'left',
      originY: 'top',
      left: 0,
      top: 0,
      width: viewport.width,
      height: viewport.height,
      name: 'background',
      objeto: false
    });
    objetos.forEach(load_object);

		switch (juego) {
			case 1:
				max = 10;
				break;
			case 2:
				max = 9;
				break;
			case 3:
				max = 10;
				break;
		}
		//numero = tabla_pos1.length;
		numero1 = getRandomInt(1, max);
		count = 0;

		while (numero1 > count ) {
			pos = tabla_pos1[count];
			fabric.Image.fromURL(repetir.url, function(img) {
                                canvas.add(img).renderAll();
                              }, {
																left:pos[0],
																top:pos[1],
																conjunto:1,
																selectable:false,
																scaleX: escala,
																scaleY: escala,
                              });
			count++;
		}

		//numero = tabla_pos2.length;
		numero2 = getRandomInt(1, max);
		if(numero1 == numero2)
			numero2 = getRandomInt(1, max);
		count = 0;

		while (numero2 > count ) {
			pos = tabla_pos2[count];
			fabric.Image.fromURL(repetir.url, function(img) {
                                canvas.add(img).renderAll();
                              }, {
																left:pos[0],
																top:pos[1],
																conjunto:2,
																selectable:false,
																scaleX: escala,
																scaleY: escala,
                              });
			count++;
		}
		rects.forEach(new_rect);

		vineta = getRandomInt(1, 10);
		if(vineta > 5){
			load_object(mas);
			operacion = 'mas';
		}else{
			load_object(menos);
			operacion = 'menos';
		}

		$.each(data, function( index, value ) {
			console.log(index);
			console.log(value);
			switch (index) {
				case 'punto1':
					switch (value) {
						case '1':
							load_object(punto_positivo_1);
							break;
						case '0':
							load_object(punto_negativo_1);
							break;
					}
					break;
				case 'punto2':
					switch (value) {
						case '1':
							load_object(punto_positivo_2);
							break;
						case '0':
							load_object(punto_negativo_2);
							break;
					}
					break;
				case 'punto3':
					switch (value) {
						case '1':
							load_object(punto_positivo_3);
							break;
						case '0':
							load_object(punto_negativo_3);
							break;
					}
					break;
				case 'punto4':
					switch (value) {
						case '1':
							load_object(punto_positivo_4);
							break;
						case '0':
							load_object(punto_negativo_4);
							break;
					}
					break;
				case 'punto5':
					switch (value) {
						case '1':
							load_object(punto_positivo_5);
							break;
						case '0':
							load_object(punto_negativo_5);
							break;
					}
					break;
			}
		});
		console.log(data);
  }

  function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var temp = array[i];
      array[i] = array[j];
      array[j] = temp;
    }
    return array;
  }

	function getRandomInt(min, max) {
	  return Math.floor(Math.random() * (max - min)) + min;
	}

  function init(){
    draw();
  }
