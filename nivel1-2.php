<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.1/fabric.min.js"></script>
<script src="js/nivel1.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var nivel = 2;
	var intentos = 5;
	var audio;
	var objetos = [];
	var tablero = { nombre: 'tablero', url: 'images/tablero1.png', objeto: false, left: (1/2), top: (1/2), conjunto: false, selectable: false, scale: 2 };
	var calificacion = { nombre: 'calificacion', url: 'images/tablero1.png', objeto: false, left:(25/30), top: (2/20), conjunto: false, selectable: false, scale: 1 };
	var bien_icono 	= { nombre: 'bien', url: 'images/happy.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var mal_icono 	= { nombre: 'mal', url: 'images/sad.png', objeto: false, left:(26/30), top: (3/20), conjunto: false, selectable: false, scale: 1.5 };
	var puntajes = { nombre: 'puntajes', url: 'images/tablero1.png', objeto: false, left: (14/18), top: (1/8), conjunto: false, selectable: false, scale: 2, scaleX: 1.5,scaleY: 1};

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

	var label 	= { nombre: 'label', url: 'images/label1-2.png', objeto: false, left: (4/20), top: (3/20), conjunto: false, selectable: false, scale: 1 };

	var vaso 	= { nombre: 'vaso', url: 'images/vaso.png', objeto: true, left: (5/12), top: (2/8), conjunto: 1, selectable: true, scale: 0.4 };
	var linterna 	= { nombre: 'linterna', url: 'images/linterna.png', objeto: true, left: (3/12), top: (6/8), conjunto: 1, selectable: true, scale: 0.7 };
	var botiquin 	= { nombre: 'botiquin', url: 'images/botiquin.png', objeto: true, left: (10/12), top: (6/8), conjunto: 1, selectable: true, scale: 0.4 };
	var brujula 	= { nombre: 'brujula', url: 'images/brujula.png', objeto: true, left: (8/12), top: (5/8), conjunto: 1, selectable: true, scale: 0.4 };
	var cinta 	= { nombre: 'cinta', url: 'images/cinta.png', objeto: true, left: (7/12), top: (3/8), conjunto: 1, selectable: true, scale: 0.4 };
	var lupa 	= { nombre: 'lupa', url: 'images/lupa.png', objeto: true, left: (4/12), top: (4/8), conjunto: 1, selectable: true, scale: 0.3 };

	var tijeras = { nombre: 'tijeras', url: 'images/tijeras.png', objeto: true, left: (2/12), top: (3/8), conjunto: 2, selectable: true, scale: 0.4 };
	var alicate = { nombre: 'alicate', url: 'images/alicate.png', objeto: true, left: (10/12), top: (3/8), conjunto: 2, selectable: true, scale: 0.5 };
	var destornillador = { nombre: 'destornillador', url: 'images/destornillador.png', objeto: true, left: (9/12), top: (2/8), conjunto: 2, selectable: true, scale: 0.2 };

	var maletin 	= { nombre: 'maletin', url: 'images/maletin.png', objeto: false, left: (1/2), top: (10/12), conjunto: 1, selectable: false, scale: 1 };

	var last_pos = { left:0 , top: 0};

	var siguiente_txt = { nombre:'Siguiente', left:(7/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var salir_txt= { nombre:'Salir', left:(1/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var ganaste_txt = { nombre:'Ganaste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var perdiste_txt = { nombre:'Perdiste', left:(1/2), top:(1/4), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };
	var repetir_txt = { nombre:'Repetir', left:(4/8), top:(6/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };

	var fondo = 'images/fondo1-2.png';

	objetos.push(label);
	objetos.push(puntajes);
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

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;
</script>
