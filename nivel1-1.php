<title>Phonak-Matik</title>
<link rel="icon" href="favicon.ico">
<script src="js/alertify.min.js"></script>
<link href="css/alertify.min.css" rel="stylesheet">
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/fabric.min.js"></script>
<script src="js/nivel1.js"></script>
<script src="js/funciones.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var juego = readCookie('juego');
	if (juego == null) {
		juego = nuevo_juego(1);
		createCookie('juego', juego, 1)
	}
	var nivel = 1;
	var intentos = 5;
	var objetos = [];

	var tablero = { nombre: 'tablero', url: 'images/tablero1.png', objeto: false, left: (1/2), top: (1/2), conjunto: false, selectable: false, scale: 2 };
	var calificacion = { nombre: 'calificacion', url: 'images/tablero1.png', objeto: false, left:(25/30), top: (2/20), conjunto: false, selectable: false, scale: 1 };
	var bien_icono 	= { nombre: 'bien', url: 'images/happy.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var mal_icono 	= { nombre: 'mal', url: 'images/sad.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var puntajes = { nombre: 'puntajes', url: 'images/tablero1.png', objeto: false, left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var menu = { nombre: 'Menu', url: 'images/menu.png', objeto: false, left: (2/18), top: (16/18), conjunto: false, selectable: false, scale: 0.4};

	var punto_negativo_1 	= { nombre: 'punto_negativo_1', url: 'images/sad.png', objeto: false,  left: (12/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_2 	= { nombre: 'punto_negativo_2', url: 'images/sad.png', objeto: false,  left: (13/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_3 	= { nombre: 'punto_negativo_3', url: 'images/sad.png', objeto: false,  left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_4 	= { nombre: 'punto_negativo_4', url: 'images/sad.png', objeto: false,  left: (15/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_negativo_5 	= { nombre: 'punto_negativo_5', url: 'images/sad.png', objeto: false,  left: (16/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };

	var punto_positivo_1 	= { nombre: 'punto_positivo_1', url: 'images/happy.png', objeto: false,  left: (12/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_2 	= { nombre: 'punto_positivo_2', url: 'images/happy.png', objeto: false,  left: (13/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_3 	= { nombre: 'punto_positivo_3', url: 'images/happy.png', objeto: false,  left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_4 	= { nombre: 'punto_positivo_4', url: 'images/happy.png', objeto: false,  left: (15/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };
	var punto_positivo_5 	= { nombre: 'punto_positivo_5', url: 'images/happy.png', objeto: false,  left: (16/18), top: (1/8), conjunto: false, selectable: false, scale: 1 };

	var label 	= { nombre: 'label', url: 'images/label1-1.png', objeto: false, left: (4/20), top: (3/20), conjunto: false, selectable: false, scale: 1 };

	var posiciones = {
		1:{
			left: 5/12,
			top: 2/8
		},
		2:{
			left: 3/12,
			top: 6/8
		},
		3:{
			left: 10/12,
			top: 6/8
		},
		4:{
			left: 8/12,
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
		}
	};
	pos = [1,2,3,4,5,6,7,8,9];
	pos = shuffle(pos);
	posXY = posiciones[pos.pop()];
	var salsa 	= { nombre: 'salsa', url: 'images/salsa.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var bread 	= { nombre: 'bread', url: 'images/bread.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.7 };
	posXY = posiciones[pos.pop()];
	var pera 	= { nombre: 'pera', url: 'images/pera.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var kola 	= { nombre: 'kola', url: 'images/kola.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var apple 	= { nombre: 'apple', url: 'images/apple.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 1, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];

	var lupa 	= { nombre: 'lupa', url: 'images/lupa.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.3 };
	posXY = posiciones[pos.pop()];
	var tijeras = { nombre: 'tijeras', url: 'images/tijeras.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.4 };
	posXY = posiciones[pos.pop()];
	var alicate = { nombre: 'alicate', url: 'images/alicate.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.5 };
	posXY = posiciones[pos.pop()];
	var destornillador = { nombre: 'destornillador', url: 'images/destornillador.png', objeto: true, left: (posXY.left), top: (posXY.top), conjunto: 2, selectable: true, scale: 0.2 };


	var cesta 	= { nombre: 'cesta', url: 'images/cesta.png', objeto: false, left: (1/2), top: (10/12), conjunto: 1, selectable: false, scale: 1 };

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

	var fondo = 'images/fondo1-1.png';

	objetos.push(label);
	objetos.push(puntajes);
	objetos.push(menu);
	objetos.push(cesta);
	objetos.push(salsa);
	objetos.push(apple);
	objetos.push(bread);
	objetos.push(pera);
	objetos.push(kola);
	objetos.push(alicate);
	objetos.push(tijeras);
	objetos.push(destornillador);
	objetos.push(lupa);

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;
</script>
