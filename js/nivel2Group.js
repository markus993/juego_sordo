
	var repetir;
	var ganaste;
	var salir;
	var positivos = 0;
	var negativos = 0;

  function recargar(){
    location.reload();
  }

  function irA(pagina){
    switch (pagina) {
      case 'menu':
      window.location.assign("/menu");
      break;
      case 'nivel1.1':
      window.location.assign("nivel1-1.php");
      break;
      case 'nivel1.2':
      window.location.assign("nivel1-2.php");
      break;
      case 'nivel1.3':
      window.location.assign("nivel1-3.php");
      break;
      default:
    }
  }

  function load_object(obj){
    fabric.Image.fromURL(obj.url, function(image) {
      image = new_image(image,obj);
      canvas.add(image).calcOffset();
      evaluar = obj.nombre+"= image ;";
      eval(evaluar);
    });
  }

	function new_rect (obj){
		var rect = new fabric.Rect({
		  name: obj.nombre,
		  left: viewport.width*obj.left,
		  top: viewport.height*obj.top,
		  fill: obj.fill,
		  opacity: obj.opacity,
			selectable: false,
		  width: viewport.width*obj.width,
		  height: viewport.height*obj.height
		});
		canvas.add(rect).calcOffset();
		evaluar = obj.nombre+"= rect ;";
		eval(evaluar);
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
			if(obj.name == 'rect1'||obj.name == 'rect2'||obj.name == 'rect3'){
				console.log(obj.name);
				console.log('colision:'+e.intersectsWithObject(obj));
				if(e.intersectsWithObject(obj)){
					colision = true;
				}
			}
    });
		if(!colision){
			console.log(intentos);
			switch (intentos) {
				case 1:
					load_object(punto_negativo_5);
					mostrar_menu();
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
			e.left = last_posP.left;
			e.top = last_posP.top;
			e.setCoords();
		}
  }

	function selected(e, dir) {
		console.log(e.target);
		if(e.target == null) return;
    switch(e.target.name) {
      case 'Salir':
      irA('menu');
      break;
      case 'Repetir':
      recargar();
      break;
      case 'Siguiente':
      console.log('nivel1.'+(nivel+1));
      irA('nivel1.'+(nivel+1));
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
            if(e.target.intersectsWithObject(obj)){
              if( obj.conjunto == e.target.conjunto ) {
                if(obj.name == 'cesta' || obj.name == 'maletin'){
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
                  e.target.remove();
									canvas.renderAll.bind(canvas);
                }
              }else{
								negativos++;
                if(obj.name == 'cesta' || obj.name == 'maletin'){
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
                  e.target.left = last_pos.left;
                  e.target.top = last_pos.top;
                  e.target.setCoords();
									canvas.renderAll.bind(canvas);
                }
              }
            }
          });
					if(intentos==0){
						mostrar_menu();
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
			width: viewport.width,
			height: viewport.height,
		});
		canvas.add(rect)
		mensaje_caja(repetir_txt);
		mensaje_caja(salir_txt);
		if(positivos>negativos){
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

  function personaje_trace(){
    fabric.Image.fromURL(personaje.url, function(image) {
      image.set({
        left: personaje.left,
        top: personaje.top,
        shadow: 'rgba(0,0,0,0.3) 5px 5px 5px',
        hasControls: false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name:personaje.nombre,
        objeto:personaje.objeto,
        selectable: personaje.selectable
      }).scale(personaje.scale);

			var rect = new fabric.Rect({
				name: rueda_personaje.nombre,
				left: rueda_personaje.left,
				top: rueda_personaje.top,
				fill: rueda_personaje.fill,
				opacity: rueda_personaje.opacity,
				width: rueda_personaje.width,
				height:rueda_personaje.height
			});

      caja = new fabric.Group([ image, rect], {
				left: viewport.width * personaje_tracer.left,
				top: viewport.height * personaje_tracer.top,
        hasControls: false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name:personaje_tracer.nombre,
        selectable: personaje_tracer.selectable
      });
      canvas.add(caja);
			evaluar = personaje_tracer.nombre+"= caja ;";
			eval(evaluar);
    });
  }


	function changePosition(pos){
    last_posP.left = personaje_tracer.getLeft();
    last_posP.top = personaje_tracer.getTop();
		switch (pos) {
			case 'up':
	    	personaje_tracer.set({top:last_posP.top-10});
				break;
			case 'down':
	    	personaje_tracer.set({top:last_posP.top+10});
				break;
			case 'left':
	    	personaje_tracer.set({left:last_posP.left-10});
				break;
			case 'right':
	    	personaje_tracer.set({left:last_posP.left+10});
				break;
			default:
		}
    canvas.renderAll();
		personaje_tracer.setCoords();
		calificar(rueda_personaje);
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

    //canvas.on('mouse:down', function(e){selected(e, 1);});
    //canvas.on('mouse:up', function(e){selected(e, 0);});
    //canvas.on('mouse:out', function(e){estado=null;});

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

    window.addEventListener("keydown", doKeyDown, false);
    function doKeyDown(e) {
        document.onkeydown = function(e) {
            switch (e.keyCode) {
                case 38:  /* Up arrow was pressed */
										 changePosition('up');
                  break;
                case 40:  /* Down arrow was pressed */
										 changePosition('down');
                  break;
                case 37:  /* Left arrow was pressed */
										 changePosition('left');
                  break;
                case 39:  /* Right arrow was pressed */
										changePosition('right');
                  break;
              }
        }
    }
    objetos.forEach(load_object);
    rects.forEach(new_rect);
		personaje_trace(personaje_tracer);
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
