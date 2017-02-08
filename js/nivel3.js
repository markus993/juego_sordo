
	var repetir;
	var ganaste;
	var salir;
	var positivos = 0;
	var negativos = 0;
	var pausado = false;
	var menu = false;

  function recargar(){
    location.reload();
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

  function calificar(e){
		colision = false;
    canvas.forEachObject(function(obj) {
      if(obj === undefined)return;
      if(obj == e)return;
      if(obj.name == 'personaje')return;
      if(obj.name == 'rueda_personaje')return;
			if(obj.name == 'rect1'||obj.name == 'rect2'||obj.name == 'rect3'||obj.name == 'rect4'||obj.name == 'rect5'||obj.name == 'meta'){
				//console.log(obj.name);
				//console.log('colision:'+e.intersectsWithObject(obj));
				if(e.intersectsWithObject(obj)){
					colision = true;
					if(obj.name == 'meta'){
						mostrar_menu('meta');
						pausado = true;
						menu = true;
					}
				}
			}
    });
		if(!colision){
			//console.log(intentos);
			switch (intentos) {
				case 1:
					load_object(punto_negativo_5);
					mostrar_menu();
					pausado = true;
					menu = true;
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
			e.left =  (viewport.width * first_personaje_pos.left)+ rueda_personaje_pos.left;
			e.top = (viewport.height * first_personaje_pos.top)+ rueda_personaje_pos.top;
			personaje.left = (viewport.width * first_personaje_pos.left);
			personaje.top = (viewport.height * first_personaje_pos.top);
			e.setCoords();
			personaje.setCoords();
		}
  }

	function selected(e, dir) {
		//console.log(e.target.name);
		if(e.target == null) return;

		switch (operacion) {
			case 'mas':
				if(e.target.conjunto == 1){
					if(numero1 > numero2){
						console.log('positivo1+');
						positivos++;
					}else {
						console.log('negativo1+');
						negativos++;
					}
				}
				if(e.target.conjunto == 2){
					if(numero1 < numero2){
						console.log('positivo2+');
						positivos++;
					}else {
						console.log('negativo2+');
						negativos++;
					}
				}
				mostrar_menu();
				break;
			case 'menos':
				if(e.target.conjunto == 1){
					if(numero1 < numero2){
						console.log('positivo1-');
						positivos++;
					}else {
						console.log('negativo1-');
						negativos++;
					}
				}
				if(e.target.conjunto == 2){
					if(numero1 > numero2){
						console.log('positivo2-');
						positivos++;
					}else {
						console.log('negativo2-');
						negativos++;
					}
				}
				mostrar_menu();
				break;
			default:
		}

    switch(e.target.name) {
      case 'Salir':
	      irA('menu');
	      break;
      case 'Repetir':
	      recargar();
	      break;
      case 'Siguiente':
	      //console.log('nivel3.'+(nivel+1));
	      irA('nivel3.'+(nivel+1));
	      break;
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
			mensaje_caja(ganaste_txt);
		}else {
			mensaje_caja(perdiste_txt);
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

		//numero = tabla_pos1.length;
		numero1 = getRandomInt(1, 10);
		count = 0;

		while (numero1 > count ) {
			pos = tabla_pos1[count];
			fabric.Image.fromURL(repetir.url, function(img) {
                                canvas.add(img).renderAll();
                              }, {
																left:pos[0],
																top:pos[1],
																conjunto:1,
																selectable:false
                              });
			count++;
		}

		//numero = tabla_pos2.length;
		numero2 = getRandomInt(1, 10);
		if(numero1 == numero2)
			numero2 = getRandomInt(1, 10);
		count = 0;
		while (numero2 > count ) {
			pos = tabla_pos2[count];
			fabric.Image.fromURL(repetir.url, function(img) {
                                canvas.add(img).renderAll();
                              }, {
																left:pos[0],
																top:pos[1],
																conjunto:2,
																selectable:false
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
  }

	function check_position(){
		//console.log('check_position');
		rueda_personaje.set({
			top:personaje.top+rueda_personaje_pos.top,
			left:personaje.left+rueda_personaje_pos.left,
		});
		rueda_personaje.setCoords();
		calificar(rueda_personaje);
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
