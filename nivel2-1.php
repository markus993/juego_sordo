<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.1/fabric.min.js"></script>
<script src="js/nivel2.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var nivel = 1;
	var intentos = 5;
	var audio;
	var objetos = [];
	var rects = [];
	var first_pos = { left:0 , top: 0};
	var last_pos = { left:0 , top: 0};

	var personaje_tracer = { nombre: 'personaje_tracer', url: 'images/personaje.png', left: (2/20), top: (15/40), selectable: true, scale: 0.5 };
	var personaje = { nombre: 'personaje', url: 'images/personaje.png', objeto: false, left: (0), top: (0), selectable: false, scale: 0.5 };
	var rueda_personaje = { nombre:'rueda_personaje', left:(5), top:(73), fill:'red', width:(25), height:(35), opacity:0.5 };

	var tablero = { nombre: 'tablero', url: 'images/tablero2.png', objeto: false, left: (1/2), top: (1/2), selectable: false, scale: 2 };
	var puntajes = { nombre: 'puntajes', url: 'images/tablero2.png', objeto: false, left: (14/18), top: (1/8), selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};
	var label 	= { nombre: 'label', url: 'images/label2-1.png', objeto: false, left: (4/20), top: (3/20), selectable: false, scale: 1 };

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

	var rect1 = { nombre:'rect1', left:(0), top:(21/40), fill:'red', width:(28/20), height:(4/30), opacity:0.5 };
	var rect2 = { nombre:'rect2', left:(33/50), top:(29/40), fill:'red', width:(3/40), height:(9/30), opacity:0.5 };
	var rect3 = { nombre:'rect1', left:(41/50), top:(37/40), fill:'red', width:(8/20), height:(4/30), opacity:0.5 };

	var fondo = 'images/fondo2-1.png';

	objetos.push(label);
	objetos.push(puntajes);
	//objetos.push(personaje);

	rects.push(rect1);
	rects.push(rect2);
	rects.push(rect3);

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;
</script>
