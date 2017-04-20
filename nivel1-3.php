<title>Phonak-Matik</title>
<link rel="icon" href="favicon.ico">
<script src="js/alertify.min.js"></script>
<link href="css/alertify.min.css" rel="stylesheet">
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/fabric.min.js"></script>
<script src="js/funciones.js"></script>
<script src="js/nivel1.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var juego = readCookie('juego');
	var nivel = 3;
	var intentos_1 = 5;
	var intentos_2 = 5;
	var audio;
	var objetos = [];
	var tablero = { nombre: 'tablero', url: 'images/tablero1.png', objeto: false, left: (1/2), top: (1/2), conjunto: false, selectable: false, scale: 2 };
	var calificacion = { nombre: 'calificacion', url: 'images/tablero1.png', objeto: false, left:(25/30), top: (2/20), conjunto: false, selectable: false, scale: 1 };
	var bien_icono 	= { nombre: 'bien', url: 'images/happy.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var mal_icono 	= { nombre: 'mal', url: 'images/sad.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var puntajes1 = { nombre: 'puntajes', url: 'images/tablero1.png', objeto: false, left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var puntajes2 = { nombre: 'puntajes', url: 'images/tablero1.png', objeto: false, left: (4/18), top: (7/8), conjunto: false, selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var menu = { nombre: 'Menu', url: 'images/menu.png', objeto: false, left: (2/18), top: (16/18), conjunto: false, selectable: false, scale: 0.4};

	var punto_negativo_1_1 	= { nombre: 'punto_negativo_1', url: 'images/sad.png', objeto: false,  left: (12/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_1_2 	= { nombre: 'punto_negativo_2', url: 'images/sad.png', objeto: false,  left: (13/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_1_3 	= { nombre: 'punto_negativo_3', url: 'images/sad.png', objeto: false,  left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_1_4 	= { nombre: 'punto_negativo_4', url: 'images/sad.png', objeto: false,  left: (15/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_1_5 	= { nombre: 'punto_negativo_5', url: 'images/sad.png', objeto: false,  left: (16/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };

	var punto_positivo_1_1 	= { nombre: 'punto_positivo_1', url: 'images/happy.png', objeto: false,  left: (12/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_1_2 	= { nombre: 'punto_positivo_2', url: 'images/happy.png', objeto: false,  left: (13/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_1_3 	= { nombre: 'punto_positivo_3', url: 'images/happy.png', objeto: false,  left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_1_4 	= { nombre: 'punto_positivo_4', url: 'images/happy.png', objeto: false,  left: (15/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_1_5 	= { nombre: 'punto_positivo_5', url: 'images/happy.png', objeto: false,  left: (16/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };

	var punto_negativo_2_1 	= { nombre: 'punto_negativo_1', url: 'images/sad.png', objeto: false,  left: (2/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_2_2 	= { nombre: 'punto_negativo_2', url: 'images/sad.png', objeto: false,  left: (3/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_2_3 	= { nombre: 'punto_negativo_3', url: 'images/sad.png', objeto: false,  left: (4/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_2_4 	= { nombre: 'punto_negativo_4', url: 'images/sad.png', objeto: false,  left: (5/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_2_5 	= { nombre: 'punto_negativo_5', url: 'images/sad.png', objeto: false,  left: (6/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };

	var punto_positivo_2_1 	= { nombre: 'punto_positivo_1', url: 'images/happy.png', objeto: false,  left: (2/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_2_2 	= { nombre: 'punto_positivo_2', url: 'images/happy.png', objeto: false,  left: (3/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_2_3 	= { nombre: 'punto_positivo_3', url: 'images/happy.png', objeto: false,  left: (4/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_2_4 	= { nombre: 'punto_positivo_4', url: 'images/happy.png', objeto: false,  left: (5/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_2_5 	= { nombre: 'punto_positivo_5', url: 'images/happy.png', objeto: false,  left: (6/18), top: (7/8), conjunto: false, selectable: false, scale: 1 };

	var label 	= { nombre: 'label', url: 'images/label1-3.png', objeto: false, left: (4/20), top: (3/20), conjunto: false, selectable: false, scale: 1 };

	var posiciones = {
		1:{
			left: 5/12,
			top: 2/8
		},
		2:{
			left: 2/12,
			top: 6/8
		},
		3:{
			left: 10/12,
			top: 6/8
		},
		4:{
			left: 7/12,
			top: 5/8
		},
		5:{
			left: 7/12,
			top: 3/8
		},
		6:{
			left: 4/12,
			top: 4/8
		},
		7:{
			left: 2/12,
			top: 3/8
		},
		8:{
			left: 10/12,
			top: 3/8
		},
		9:{
			left: 9/12,
			top: 2/8
		},
		10:{
			left: 5/12,
			top: 6/8
		},
		11:{
			left: 1/12,
			top: 4/8
		},
		12:{
			left: 9/12,
			top: 5/8
		},
		13:{
			left: 8/12,
			top: 6/8
		},
		14:{
			left: 1/12,
			top: 5/8
		}
	};
	pos = [1,2,3,4,5,6,7,8,9,10,11,12,13,14];
	pos = shuffle(pos);
	posXY = posiciones[pos.pop()];

	var bread 	= { nombre: 'bread', url: 'images/bread.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.5 };
	posXY = posiciones[pos.pop()];
	var kola 	= { nombre: 'kola', url: 'images/kola.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.7 };
	posXY = posiciones[pos.pop()];
	var salsa 	= { nombre: 'salsa', url: 'images/salsa.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var apple 	= { nombre: 'apple', url: 'images/apple.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var pera 	= { nombre: 'pera', url: 'images/pera.png', objeto: true,  left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];

	var vaso 	= { nombre: 'vaso', url: 'images/vaso.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var linterna 	= { nombre: 'linterna', url: 'images/linterna.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.7 };
	posXY = posiciones[pos.pop()];
	var botiquin 	= { nombre: 'botiquin', url: 'images/botiquin.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var brujula 	= { nombre: 'brujula', url: 'images/brujula.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var cinta 	= { nombre: 'cinta', url: 'images/cinta.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var lupa 	= { nombre: 'lupa', url: 'images/lupa.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.3 };
	posXY = posiciones[pos.pop()];

	var tijeras = { nombre: 'tijeras', url: 'images/tijeras.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 3, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var alicate = { nombre: 'alicate', url: 'images/alicate.png', objeto: true,  left: (posXY.left), top: (posXY.top), conjunto: 3, selectable: true, scale: 0.5 };
	posXY = posiciones[pos.pop()];
	var destornillador = { nombre: 'destornillador', url: 'images/destornillador.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 3, selectable: true, scale: 0.2 };

	var cesta 	= { nombre: 'cesta', url: 'images/cesta.png', objeto: false, left: (1/2), top: (4/12), conjunto: 1, selectable: false, scale: 0.7 };
	var maletin 	= { nombre: 'maletin', url: 'images/maletin.png', objeto: false, left: (1/2), top: (10/12), conjunto: 2, selectable: false, scale: 0.7 };

	var last_pos = { left:0 , top: 0};

	var siguiente_txt = { nombre:'Siguiente', left:(7/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var salir_txt= { nombre:'Salir', left:(1/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var ganaste_txt = { nombre:'Ganaste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var perdiste_txt = { nombre:'Perdiste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var repetir_txt = { nombre:'Repetir', left:(4/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };

	var siguiente_icono = { nombre:'Siguiente',url: 'images/next.png', objeto: false, left:(7/8), top:(6/8), fontSize:60, selectable: true, scale: 0.8 };
	var salir_icono= { nombre:'Salir',url: 'images/menu.png', objeto: false, left:(1/8), top:(6/8), fontSize:60, selectable: true, scale: 0.9 };
	var ganaste_icono = { nombre:'Ganaste',url: 'images/happy.png', objeto: false, left:(1/2), top:(1/4), fontSize:60, selectable: true, scale: 3 };
	var perdiste_icono = { nombre:'Perdiste',url: 'images/sad.png', objeto: false, left:(1/2), top:(1/4), fontSize:60, selectable: true, scale: 3 };
	var repetir_icono = { nombre:'Repetir',url: 'images/reload.png', objeto: false, left:(4/8), top:(6/8), fontSize:60, selectable: true, scale: 0.7 };

	var fondo = 'images/fondo1-3.png';

	objetos.push(label);
	objetos.push(puntajes1);
	objetos.push(puntajes2);
	objetos.push(menu);

	objetos.push(cesta);
	objetos.push(bread);
	objetos.push(pera);
	objetos.push(kola);
	objetos.push(salsa);
	objetos.push(apple);

	objetos.push(maletin);
	objetos.push(vaso);
	objetos.push(cinta);
	objetos.push(linterna);
	objetos.push(botiquin);
	objetos.push(brujula);

	objetos.push(alicate);
	objetos.push(tijeras);
	objetos.push(destornillador);
	objetos.push(lupa);

	var repetir;
	var ganaste;
	var salir;

	contador_objetos = 0;
	estado = null;

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	function init(){
		draw();
		audio1 = new Audio('sounds/click-soft-digital.mp3');
		audio2 = new Audio('sounds/click-blip.mp3');
		audio3 = new Audio('sounds/click-ring2.mp3');
		audio1.preload = audio2.preload = audio3.preload = "auto";
	}

</script>
