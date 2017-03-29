<title>Phonak-Matik</title>
<link rel="icon" href="favicon.ico">
<script src="js/alertify.min.js"></script>
<link href="css/alertify.min.css" rel="stylesheet">
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/base64.js"></script>
<script src="js/fabric.min.js"></script>
<script src="js/nivel3.js"></script>
<script src="js/funciones.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var juego = readCookie('juego');
	var nivel = 3;
	var intentos = 5;
	var escala = 1;
	var objetos = [];
	var rects = [];
	var teclado = [];
	var first_pos = { left:0 , top: 0};
	var last_posP = { left:0 , top: 0};
	var last_posR = { left:0 , top: 0};
	var rueda_personaje_pos = { left:5, top: 74};
	var first_personaje_pos = { left: (1/2), top: (3/4)};

	var personaje = { nombre: 'personaje', url: 'images/personaje.png', objeto: false, left: first_personaje_pos.left, top: first_personaje_pos.top, selectable: false, scale: 0.8 };
	var rueda_personaje = { nombre:'rueda_personaje', left: (5), top: (74), fill:'blue',  width:(10), height:(20), opacity:0.5 , resize:false };

	var tablero = { nombre: 'tablero', url: 'images/tablero3.png', objeto: false, left: (1/2), top: (1/2), selectable: false, scale: 2 };
	var puntajes = { nombre: 'puntajes', url: 'images/tablero3.png', objeto: false, left: (14/18), top: (1/8), selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var label = { nombre: 'label', url: 'images/label3-3.png', objeto: false, left: (4/20), top: (3/20), selectable: false, scale: 1 };
	var repetir = { nombre: 'arbol', url: 'images/arbol.png', objeto: false, left: (4/20), top: (3/20), selectable: false, scale: 1 };
	var mas = { nombre: 'mas', url: 'images/mas.png', objeto: false, left: (12/20), top: (9/20), selectable: false, scale: 1 };
	var menos = { nombre: 'menos', url: 'images/menos.png', objeto: false, left: (12/20), top: (9/20), selectable: false, scale: 1 };
	var menu = { nombre: 'Menu', url: 'images/menu.png', objeto: false, left: (23/50), top: (7/50), conjunto: false, selectable: false, scale: 0.4};

	var negativo	= { nombre: 'negativo', url: 'images/sad.png', objeto: false,  left: (9/18), top: (4/8), selectable: false, scale: 3 };
	var positivo 	= { nombre: 'positivo', url: 'images/happy.png', objeto: false,  left: (9/18), top: (4/8), selectable: false, scale: 3 };

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

	var fondo = 'images/fondo3-3.png';

	objetos.push(label);
	objetos.push(menu);
	objetos.push(puntajes);
	objetos.push(personaje);

	var rect1 = { nombre:'rect1', left:(4/20), top:(14/20), fill:'grey', width:(8/20), height:(12/20), opacity:0.1, conjunto:1 };
	var rect2 = { nombre:'rect2', left:(16/20), top:(14/20), fill:'grey', width:(8/20), height:(12/20), opacity:0.1, conjunto:2 };

	rects.push(rect1);
	rects.push(rect2);

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;

	var tabla_pos1 = [];

	tabla_pos1.push([(viewport.width * (2/20)), (viewport.height * (9/20))]);
	tabla_pos1.push([(viewport.width * (4/20)), (viewport.height * (9/20))]);
	tabla_pos1.push([(viewport.width * (6/20)), (viewport.height * (9/20))]);

	tabla_pos1.push([(viewport.width * (1/20)), (viewport.height * (12/20))]);
	tabla_pos1.push([(viewport.width * (3/20)), (viewport.height * (12/20))]);
	tabla_pos1.push([(viewport.width * (5/20)), (viewport.height * (12/20))]);
	tabla_pos1.push([(viewport.width * (7/20)), (viewport.height * (12/20))]);

	tabla_pos1.push([(viewport.width * (2/20)), (viewport.height * (15/20))]);
	tabla_pos1.push([(viewport.width * (4/20)), (viewport.height * (15/20))]);
	tabla_pos1.push([(viewport.width * (6/20)), (viewport.height * (15/20))]);

	var tabla_pos2 = [];

	tabla_pos2.push([(viewport.width * (14/20)), (viewport.height * (9/20))]);
	tabla_pos2.push([(viewport.width * (16/20)), (viewport.height * (9/20))]);
	tabla_pos2.push([(viewport.width * (18/20)), (viewport.height * (9/20))]);

	tabla_pos2.push([(viewport.width * (13/20)), (viewport.height * (12/20))]);
	tabla_pos2.push([(viewport.width * (15/20)), (viewport.height * (12/20))]);
	tabla_pos2.push([(viewport.width * (17/20)), (viewport.height * (12/20))]);
	tabla_pos2.push([(viewport.width * (19/20)), (viewport.height * (12/20))]);

	tabla_pos2.push([(viewport.width * (14/20)), (viewport.height * (15/20))]);
	tabla_pos2.push([(viewport.width * (16/20)), (viewport.height * (15/20))]);
	tabla_pos2.push([(viewport.width * (18/20)), (viewport.height * (15/20))]);

</script>
