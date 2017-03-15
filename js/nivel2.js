
	var repetir;
	var ganaste;
	var salir;
	var positivos = 0;
	var negativos = 0;
	var pausado = false;
	var menu = false;
	var salto = 70;

  function irA(pagina){
    switch (pagina) {
      case 'menu' :
      window.location.assign("/menu");
      break;
      case 'nivel2.1' :
      window.location.assign("nivel2-1.php");
      break;
      case 'nivel2.2' :
      window.location.assign("nivel2-2.php");
      break;
      case 'nivel2.3' :
      window.location.assign("nivel2-3.php");
      break;
      default :
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

  function load_key(key){
    fabric.Image.fromURL(key.url, function(image) {
      image = new_key(image,key);
      canvas.add(image).calcOffset();
      evaluar = key.nombre+"= image ;";
      eval(evaluar);
    });
  }

	function new_rect (obj){
		if (obj.nombre == 'rueda_personaje'){
			leftS =  (viewport.width*personaje.left)+obj.left;
			topS = (viewport.height*personaje.top)+obj.top;
			widthS = obj.width;
			heightS = obj.height;
		}else {
			leftS =  viewport.width*obj.left;
			topS = viewport.height*obj.top;
			widthS = viewport.width*obj.width;
			heightS = viewport.height*obj.height;
		}
		var rect = new fabric.Rect({
		  name : obj.nombre,
      left : leftS,
      top : topS,
		  fill : obj.fill,
		  opacity : obj.opacity,
			selectable : false,
		  width : widthS,
		  height : heightS
		});
		canvas.add(rect).calcOffset();
		evaluar = obj.nombre+"= rect ;";
		eval(evaluar);
	}

  function new_key(image,param){
    image.set({
      id : param.nombre,
		  left : (viewport.width*teclado_pos.left)+param.left,
		  top : (viewport.height*teclado_pos.top)+param.top,
      hasControls : false,
      hasBorders : false,
      hoverCursor : 'pointer',
			selectable : false,
      name : param.nombre,
      objeto : param.objeto
    }).scale( param.scale);
    return image;
  }

  function new_image(image,param){
		if (typeof(param.scaleX) !== 'undefined'){
			x = param.scaleX;
			y = param.scaleY;
		}else {
			x = y = param.scale;
		}
    image.set({
      id : param.nombre,
		  left : viewport.width*param.left,
		  top : viewport.height*param.top,
      hasControls : false,
      hasBorders : false,
      hoverCursor : 'pointer',
      name : param.nombre,
      objeto : param.objeto,
      selectable : param.selectable,
      conjunto : param.conjunto,
			scaleX : x,
			scaleY : y
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
				//console.log('colision : '+e.intersectsWithObject(obj));
				if(e.intersectsWithObject(obj)){
					colision = true;
					if(obj.name == 'meta'){
						console.log(data);
						envia_punto(juego,2, nivel, 5-intentos, true);
						envia_resultado(juego,1,nivel)
						mostrar_menu('meta');
						pausado = true;
						menu = true;
					}
				}
			}
    });
		if(!colision){
			console.log(intentos);
			switch (intentos) {
				case 1 :
					load_object(punto_negativo_5);
					mostrar_menu();
					envia_resultado(juego,0,nivel)
					pausado = true;
					menu = true;
					break;
				case 2 :
					load_object(punto_negativo_4);
					break;
				case 3 :
					load_object(punto_negativo_3);
					break;
				case 4 :
					load_object(punto_negativo_2);
					break;
				case 5 :
					load_object(punto_negativo_1);
					break;
				default :
			}
			intentos--;

			envia_punto(juego,2, nivel, 5-intentos, false);
			e.left = (viewport.width * first_personaje_pos.left)+ rueda_personaje_pos.left;
			e.top = (viewport.height * first_personaje_pos.top)+ rueda_personaje_pos.top;
			personaje.left = (viewport.width * first_personaje_pos.left);
			personaje.top = (viewport.height * first_personaje_pos.top);
			e.setCoords();
			personaje.setCoords();
		}
  }

	function selected(e, dir) {
		if(e.target == null) return;
    switch(e.target.name) {
			case 'Menu' :
				salir_menu();
				break;
			case 'Salir' :
				carga_pagina('temas.php');
				break;
			case 'Repetir' :
				recargar();
				break;
			case 'Siguiente' :
				carga_pagina('nivel2-'+(nivel+1)+'.php');
				break;
      case 'left' :
	      changePosition('left');
	      break;
      case 'right' :
	      changePosition('right');
	      break;
      case 'up' :
	      changePosition('up');
	      break;
      case 'down' :
	      changePosition('down');
	      break;
    }
  }

	function mostrar_teclado(){
		load_key(up);
		load_key(down);
		load_key(left);
		load_key(right);
	}

	function mostrar_menu(evento){
		var rect = new fabric.Rect({
			fill : 'black',
			opacity : 0.4,
			originX : 'left',
			originY : 'top',
			left : 0,
			top : 0,
			selectable : false,
			width : viewport.width,
			height : viewport.height,
		});
		canvas.add(rect)
		mensaje_caja(repetir_txt);
		mensaje_caja(salir_txt);
		if(evento == 'meta'){
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
        left : 100,
        top : 50,
        shadow : 'rgba(0,0,0,0.3) 5px 5px 5px',
        hasControls : false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name : tablero.nombre,
        objeto : tablero.objeto,
        selectable : tablero.selectable,
        conjunto : tablero.conjunto
      }).scale(1);
      texto_mensaje = null;
      var texto_mensaje = new fabric.Text(txt.nombre, {
        left : 100,
        top : 50,
        fontSize : txt.fontSize,
        fill : 'white',
        fontWeight : txt.fontWeight,
        fontStyle : txt.fontStyle,
        shadow : txt.shadow,
        hasControls : false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name : txt.nombre+'_txt',
        objeto : false,
        selectable : false,
        conjunto : false
      });
      caja = new fabric.Group([ image, texto_mensaje ], {
        left : viewport.width * txt.left,
        top : viewport.height * txt.top,
        hasControls : false,
        hasBorders : false,
        hoverCursor : 'pointer',
        name : txt.nombre,
        objeto : tablero.objeto,
        selectable : tablero.selectable,
        conjunto : tablero.conjunto
      });
      canvas.add(caja);
      //return caja;
    });
  }

	function changePosition(pos){
		if(pausado)return;
    last_posP.left = personaje.getLeft();
    last_posP.top = personaje.getTop();
    last_posR.left = rueda_personaje.getLeft();
    last_posR.top = rueda_personaje.getTop();
		switch (pos) {
			case 'up' :
	    	personaje.set({top : last_posP.top-salto});
	    	rueda_personaje.set({top : last_posR.top-salto});
				break;
			case 'down' :
	    	personaje.set({top : last_posP.top+salto});
	    	rueda_personaje.set({top : last_posR.top+salto});
				break;
			case 'left' :
	    	personaje.set({left : last_posP.left-salto});
	    	rueda_personaje.set({left : last_posR.left-salto});
				break;
			case 'right' :
	    	personaje.set({left : last_posP.left+salto});
	    	rueda_personaje.set({left : last_posR.left+salto});
				break;
		}
    canvas.renderAll();
		rueda_personaje.setCoords();
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

    canvas.on('mouse:down', function(e){
			//console.log(e.target);
			if(e.target)
				selected(e, 1);
		});

    canvas.setBackgroundImage(fondo, canvas.renderAll.bind(canvas), {
      name : 'fondo',
      originX : 'left',
      originY : 'top',
      left : 0,
      top : 0,
      width : viewport.width,
      height : viewport.height,
      name : 'background',
      objeto : false
    });

    window.addEventListener("keydown", doKeyDown, false);
    function doKeyDown(e) {
        document.onkeydown = function(e) {
            switch (e.keyCode) {
              case 38 : /* Up arrow was pressed */
									 changePosition('up');
                break;
              case 40 : /* Down arrow was pressed */
									 changePosition('down');
                break;
              case 37 : /* Left arrow was pressed */
									changePosition('left');
                break;
              case 39 : /* Right arrow was pressed */
									changePosition('right');
                break;
            }
        }
    }
		mostrar_teclado();
    objetos.forEach(load_object);
    rects.forEach(new_rect);
  }

	function check_position(){
		console.log('check_position');
		rueda_personaje.set({
			top : personaje.top+rueda_personaje_pos.top,
			left : personaje.left+rueda_personaje_pos.left,
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

  function init(){
    draw();
  }
