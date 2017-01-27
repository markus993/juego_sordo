<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.1/fabric.min.js"></script>
<script src="js/ejemplo1.js"></script>
<body onload='init()'>
	<canvas class="" id="canvas" width="640px" height="360px"></canvas>
</body>
<script>
	var nivel = 1;
	var audio;
	var objetos = [];
	var tablero = { nombre: 'tablero', url: 'images/tablero1.png', objeto: false, left: (1/2), top: (1/2), conjunto: false, selectable: false, scale: 2 };

	var label 	= { nombre: 'label', url: 'images/clasificacion.png', objeto: false, left: (4/20), top: (3/20), conjunto: false, selectable: false, scale: 1 };

	var pera 	= { nombre: 'pera', url: 'images/pera.png', objeto: false, left: (6/12), top: (7/12), conjunto: 1, selectable: false, scale: 0.4 };
	var flecha 	= { nombre: 'flecha', url: 'images/flecha.png', objeto: false, left: (7/12), top: (7/12), conjunto: 1, selectable: false, scale: 0.4 };
	var personaje 	= { nombre: 'personaje', url: 'images/personaje.png', objeto: false, left: (3/12), top: (6/12), conjunto: 1, selectable: false, scale: 1 };

	var ejemplo 	= { nombre: 'ejemplo', url: 'images/ejemplo.png', objeto: false, left: (5/8), top: (5/12), conjunto: 1, selectable: false, scale: 1 };
	var cesta 	= { nombre: 'cesta', url: 'images/cesta.png', objeto: false, left: (3/4), top: (7/12), conjunto: 1, selectable: false, scale: 1 };

	var last_pos = { left:0 , top: 0};

	var siguiente_txt = { nombre:'Iniciar', left:(4/8), top:(7/8), fontSize:60, shadow:'rgba(0,0,0,0.3) 5px 5px 5px', fontWeight:'bold', fontStyle:'italic' };

	var fondo = 'images/fondo-ejemplo1.png';

	objetos.push(label);
	objetos.push(personaje);
	objetos.push(cesta);
	objetos.push(ejemplo);
	objetos.push(pera);
	objetos.push(flecha);

	var viewport = {
		width : $(document).width()-17,
		height : $(document).height()-17
	};

	contador_objetos = 0;
	estado = null;
</script>
