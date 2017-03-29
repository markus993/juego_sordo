<title>Phonak-Matik</title>
<link rel="icon" href="favicon.ico">
<script src="js/alertify.min.js"></script>
<link href="css/alertify.min.css" rel="stylesheet">
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/fabric.min.js"></script>
<script src="js/nivel2.js"></script>
<script src="js/funciones.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var juego = readCookie('juego');
	var nivel = 3;
	var intentos = 5;
	var objetos = [];
	var rects = [];
	var teclado = [];
	var first_pos = { left:0 , top: 0};
	var last_posP = { left:0 , top: 0};
	var last_posR = { left:0 , top: 0};
	var rueda_personaje_pos = { left:5, top: 74};
	var first_personaje_pos = { left: (2/20), top: (32/40)};

	var personaje = { nombre: 'personaje', url: 'images/personaje.png', objeto: false, left: first_personaje_pos.left, top: first_personaje_pos.top, selectable: false, scale: 0.5 };
	var rueda_personaje = { nombre:'rueda_personaje', left: (5), top: (74), fill:'blue',  width:(10), height:(20), opacity:0.5 , resize:false };

	var tablero = { nombre: 'tablero', url: 'images/tablero2.png', objeto: false, left: (1/2), top: (1/2), selectable: false, scale: 2 };
	var puntajes = { nombre: 'puntajes', url: 'images/tablero2.png', objeto: false, left: (14/18), top: (1/8), selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var label 	= { nombre: 'label', url: 'images/label2-3.png', objeto: false, left: (4/20), top: (3/20), selectable: false, scale: 1 };
	var meta 	= { nombre: 'meta', url: 'images/meta.png', objeto: false,  left:(34/50), top:(25/40), selectable: false, scale: 0.7 };
	var menu = { nombre: 'Menu', url: 'images/menu.png', objeto: false, left: (23/50), top: (7/50), conjunto: false, selectable: false, scale: 0.4};

	var teclado_pos 	= { nombre: 'teclado', left:(14/50), top:(22/40) };
	var up 	= { nombre: 'up', url: 'images/up.png', objeto: false,  left:(50), top:(0), selectable: false, scale: 0.5 };
	var down 	= { nombre: 'down', url: 'images/down.png', objeto: false,  left:(50), top:(50), selectable: false, scale: 0.5 };
	var left 	= { nombre: 'left', url: 'images/left.png', objeto: false,  left:(0), top:(50), selectable: false, scale: 0.5 };
	var right 	= { nombre: 'right', url: 'images/right.png', objeto: false,  left:(100), top:(50), selectable: false, scale: 0.5 };

	var punto_negativo_1 	= { nombre: 'punto_negativo_1', url: 'images/sad.png', objeto: false,  left: (12/18), top: (1/8), selectable: false, scale: 1 };
	var punto_negativo_2 	= { nombre: 'punto_negativo_2', url: 'images/sad.png', objeto: false,  left: (13/18), top: (1/8), selectable: false, scale: 1 };
	var punto_negativo_3 	= { nombre: 'punto_negativo_3', url: 'images/sad.png', objeto: false,  left: (14/18), top: (1/8), selectable: false, scale: 1 };
	var punto_negativo_4 	= { nombre: 'punto_negativo_4', url: 'images/sad.png', objeto: false,  left: (15/18), top: (1/8), selectable: false, scale: 1 };
	var punto_negativo_5 	= { nombre: 'punto_negativo_5', url: 'images/sad.png', objeto: false,  left: (16/18), top: (1/8), selectable: false, scale: 1 };

	var punto_positivo_1 	= { nombre: 'punto_positivo_1', url: 'images/happy.png', objeto: false,  left: (12/18), top: (1/8), selectable: false, scale: 1 };
	var punto_positivo_2 	= { nombre: 'punto_positivo_2', url: 'images/happy.png', objeto: false,  left: (13/18), top: (1/8), selectable: false, scale: 1 };
	var punto_positivo_3 	= { nombre: 'punto_positivo_3', url: 'images/happy.png', objeto: false,  left: (14/18), top: (1/8), selectable: false, scale: 1 };
	var punto_positivo_4 	= { nombre: 'punto_positivo_4', url: 'images/happy.png', objeto: false,  left: (15/18), top: (1/8), selectable: false, scale: 1 };
	var punto_positivo_5 	= { nombre: 'punto_positivo_5', url: 'images/happy.png', objeto: false,  left: (16/18), top: (1/8), selectable: false, scale: 1 };

	var siguiente_txt = { nombre:'Siguiente', left:(7/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var salir_txt= { nombre:'Salir', left:(1/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var ganaste_txt = { nombre:'Ganaste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var perdiste_txt = { nombre:'Perdiste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var repetir_txt = { nombre:'Repetir', left:(4/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };

	var rect1 = { nombre:'rect1', left:(18/40), top:(37/40), fill:'grey', width:(37/40), height:(4/30), opacity:0.1 };
	var rect2 = { nombre:'rect2', left:(53/60), top:(25/40), fill:'grey', width:(4/60), height:(15/30), opacity:0.1 };
	var rect3 = { nombre:'rect3', left:(20/30), top:(20/60), fill:'grey', width:(10/20), height:(3/30), opacity:0.1 };
	var rect4 = { nombre:'rect4', left:(31/70), top:(20/40), fill:'grey', width:(4/60), height:(9/30), opacity:0.1 };
	var rect5 = { nombre:'rect5', left:(28/50), top:(25/40), fill:'grey', width:(6/20), height:(3/30), opacity:0.1 };

	var fondo = 'images/fondo2-3.png';

	objetos.push(label);
	objetos.push(menu);
	objetos.push(puntajes);
	objetos.push(meta);
	objetos.push(personaje);

	teclado.push(up);
	teclado.push(down);
	teclado.push(left);
	teclado.push(right);

	rects.push(rueda_personaje);
	rects.push(rect1);
	rects.push(rect2);
	rects.push(rect3);
	rects.push(rect4);
	rects.push(rect5);

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;
</script>
