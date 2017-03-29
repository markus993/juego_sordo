
	var repetir;
	var ganaste;
	var salir;
	var positivos = 0;
	var positivos_1 = 0;
	var positivos_2 = 0;
	var negativos = 0;
	var negativos_1 = 0;
	var negativos_2 = 0;

  function load_object(obj){
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

  function calificar (e){
    e.target.setCoords();
    canvas.forEachObject(function(obj) {
      if(obj === undefined)return;
      if(obj === e.target)return;
      if((obj.name == 'cesta' || obj.name == 'maletin') && e.target.intersectsWithObject(obj)){
        if(obj.conjunto == e.target.conjunto){
          load_object(bien_icono);
          estado=true	;
        }else{
          load_object(mal_icono);
          estado=false;
        }
      }
    });
  }

  function selected(e, dir) {
		if(e.target == null) return;
    switch(e.target.name) {
      case 'Menu':
				salir_menu();
      	break;
      case 'Salir':
	      eraseCookie('juego');
				carga_pagina('temas.php');
      	break;
      case 'Repetir':
      	recargar();
      	break;
      case 'Siguiente':
				carga_pagina('nivel1-'+(nivel+1)+'.php');
      	break;
      default:
      if (e.target && e.target.objeto == true) {
        if(dir == 1){
          last_pos.left = e.target.left;
          last_pos.top = e.target.top;
        }else{
          e.target.setCoords();
          contador_objetos = 0;
          canvas.forEachObject(function(obj) {
            if(obj === undefined) return;
            if(obj === e.target) return;
            if(obj.objeto == true && obj.conjunto == 1){
              contador_objetos++;
            }
            if(e.target.intersectsWithObject(obj)){
              if( obj.conjunto == e.target.conjunto ) {
                if(obj.name == 'cesta' || obj.name == 'maletin'){
									if(nivel!=3){
										positivos++;
										switch (intentos) {
											case 1:
												load_object(punto_positivo_5);
												break;
											case 2:
												load_object(punto_positivo_4);
												break;
											case 3:
												load_object(punto_positivo_3);
												break;
											case 4:
												load_object(punto_positivo_2);
												break;
											case 5:
												load_object(punto_positivo_1);
												break;
											default:
										}
										intentos--;
									}else{
										if(obj.name == 'cesta'){
											positivos_1++;
											switch (intentos_1) {
												case 1:
													load_object(punto_positivo_1_5);
													break;
												case 2:
													load_object(punto_positivo_1_4);
													break;
												case 3:
													load_object(punto_positivo_1_3);
													break;
												case 4:
													load_object(punto_positivo_1_2);
													break;
												case 5:
													load_object(punto_positivo_1_1);
													break;
												default:
											}
											intentos_1--;
										}else{
											positivos_2++;
											switch (intentos_2) {
												case 1:
													load_object(punto_positivo_2_5);
													break;
												case 2:
													load_object(punto_positivo_2_4);
													break;
												case 3:
													load_object(punto_positivo_2_3);
													break;
												case 4:
													load_object(punto_positivo_2_2);
													break;
												case 5:
													load_object(punto_positivo_2_1);
													break;
												default:
											}
											intentos_2--;
										}
									}
									if (nivel != 3) {
										envia_punto(juego,1, nivel, 5-intentos, 'true');
									}else {
										envia_punto(juego,1, nivel, (10-intentos_1-intentos_2), 'true');
									}
                  e.target.remove();
									canvas.renderAll.bind(canvas);
                }
              }else{
                if(obj.name == 'cesta' || obj.name == 'maletin'){
									if(nivel!=3){
										negativos++;
										switch (intentos) {
											case 1:
												load_object(punto_negativo_5);
												break;
											case 2:
												load_object(punto_negativo_4);
												break;
											case 3:
												load_object(punto_negativo_3);
												break;
											case 4:
												load_object(punto_negativo_2);
												break;
											case 5:
												load_object(punto_negativo_1);
												break;
											default:
										}
										intentos--;
									}else{
										if (obj.name == 'cesta') {
											negativos_1++;
											switch (intentos_1) {
												case 1:
													load_object(punto_negativo_1_5);
													break;
												case 2:
													load_object(punto_negativo_1_4);
													break;
												case 3:
													load_object(punto_negativo_1_3);
													break;
												case 4:
													load_object(punto_negativo_1_2);
													break;
												case 5:
													load_object(punto_negativo_1_1);
													break;
												default:
											}
											intentos_1--;
										}else {
											negativos_2++;
											switch (intentos_2) {
												case 1:
													load_object(punto_negativo_2_5);
													break;
												case 2:
													load_object(punto_negativo_2_4);
													break;
												case 3:
													load_object(punto_negativo_2_3);
													break;
												case 4:
													load_object(punto_negativo_2_2);
													break;
												case 5:
													load_object(punto_negativo_2_1);
													break;
												default:
											}
											intentos_2--;
										}
									}
									if (nivel != 3) {
										envia_punto(juego,1, nivel, 5-intentos, 'false');
									}else {
										envia_punto(juego,1, nivel, (10-intentos_1-intentos_2), 'false');
									}
                  e.target.left = last_pos.left;
                  e.target.top = last_pos.top;
                  e.target.setCoords();
									canvas.renderAll.bind(canvas);
                }
              }
            }
          });
					if(nivel != 3){
						if(intentos==0){
							mostrar_menu();
						}
					}else{
						console.log('intentos_1: '+intentos_1);
						console.log('intentos_2: '+intentos_2);
						if(intentos_1<=0 && intentos_2<=0){
							console.log('mostrar_menu');
							mostrar_menu();
						}
					}
        }
      }
    }
  }

	function mostrar_menu(){
		var rect = new fabric.Rect({
			fill: 'black',
			opacity: 0.4,
			originX: 'left',
			originY: 'top',
			left: 0,
			top: 0,
			selectable : false,
			width: viewport.width,
			height: viewport.height,
		});
		canvas.add(rect)
		mensaje_caja(repetir_txt);
		mensaje_caja(salir_txt);
		if (nivel!=3) {
			if(positivos>negativos){
				envia_resultado(juego,1,nivel);
				mensaje_caja(ganaste_txt);
			}else {
				envia_resultado(juego,0,nivel);
				mensaje_caja(perdiste_txt);
			}
		}else {
			if(positivos_1>negativos_1 && positivos_2>negativos_2){
				envia_resultado(juego,1,nivel);
				mensaje_caja(ganaste_txt);
			}else {
				envia_resultado(juego,0,nivel);
				mensaje_caja(perdiste_txt);
			}
		}

		if(nivel !=3)
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

  function draw(){
    fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';
    fabric.Object.prototype.transparentCorners = false;
    fabric.Canvas.prototype.getItem = function(id) {
      var count = canvas.getObjects().length - 1;
      var object = null,
      objects = this.getObjects();
      console.log(count);
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

    canvas.on('mouse:down', function(e){selected(e, 1);});
    canvas.on('mouse:up', function(e){selected(e, 0);});
    canvas.on('mouse:out', function(e){estado=null;});

    //canvas.on('object:moving', function(event){calificar(event);});
    /*canvas.on('after:render', function() {
      if (typeof(mal) !== 'undefined'){
        mal.remove();
      }
      if (typeof(bien) !== 'undefined'){
        bien.remove();
      }
    });*/

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

  function init(){
    draw();
  }
