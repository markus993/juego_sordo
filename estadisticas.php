<?php
  include 'includes/mpdf/mpdf.php';
  $mpdf=new mPDF('utf-8','legal-L');

  if (isset($_GET['pdf'])) {
    $pdf = $_GET['pdf'];
    $col_texto = 9;
  }else {
    $pdf = false;
    $col_texto = 6;
  }
  ob_start();
  $params = array(
     "id_user" => $_GET['id_user'],
     "token" => $_GET['token']
  );

  $web_dir = $_SERVER['PHP_SELF'];
  $web_dir = explode('/',$web_dir);
  array_pop($web_dir );
  $web_dir = implode('/', $web_dir);
  $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$web_dir;
  $http = $actual_link."/backend/web/app_dev.php/user_games_win";
  $output = httpPost($http,$params);
  $response = json_decode($output)->response;
  //echo '<pre>';
  //var_dump($response);
  $resultados = array();
  foreach ($response as $key => $value) {
    //var_dump($value);
    if ($value->resultado == 1) {
      $resultados["$value->niveles"] = '<img src="images/happy.png">';
    }else {
      $resultados["$value->niveles"] = '<img src="images/sad.png">';
    }
  }

  //var_dump($resultados);
  //echo '</pre>';

  function httpPost($url,$params){
    $postData = '';
    //create name value pairs seperated by &
    foreach($params as $k => $v) {
      $postData .= $k . '='.$v.'&';
    }
    $postData = rtrim($postData, '&');
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $output = curl_exec($ch);
    if(!curl_exec($ch)){
      die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
    }
    curl_close($ch);

    return $output;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Estadisticas de Usuario</title>
    <style>
      html,body{
        margin: 0px;
        padding: 0px;
      }
      .img1 {
          width: 100%;
          height: auto;
          margin-bottom: -5px;
      }
      table .tabla2-1 {
      	background-image: url(images/fondo-estadisticas-2-1.png);
      	background-size:cover
      }
      table .tabla2-2 {
      	background-image: url(images/fondo-estadisticas-2-2.png);
      	background-size:cover
      }
      table .tabla2-3 {
      	background-image: url(images/fondo-estadisticas-2-3.png);
      	background-size:cover
      }
      table .tabla3-1 {
        padding: 15px;
      	background-image: url(images/fondo-comentarios.png);
      	background-size:cover
      }
      table .tabla3-2 {
      	background-image: url(images/fondo-guardar.png);
      	background-size:cover
      }
      table {
        border-spacing: 0px;
        border: 0px solid black;
      }
      .texto {
        padding: 15px;
        font-size: 1.2em;
      }
      .botones{
        width: 130px;
        padding: 10px;
        margin: 10px;
      }
      .hover-glass:hover{
      	background-color: rgba(255, 255, 255, 0.3);
      	border: 5px solid rgba(0, 0, 0, 0.3);
      }
      .hover-glass{
      	background-color: rgba(255, 255, 255, 0);
      	-moz-border-radius: 10px;
      	-webkit-border-radius: 10px;
      	border-radius: 10px;
        -moz-border-radius: 10%;
        -webkit-border-radius: 10%;
        border-radius: 10%;
      	border: 5px solid rgba(0, 0, 0, 0);
      }
      .colspan9{
        padding: 0px;
        margin: 0px;
      }
      [contenteditable="true"]:active, [contenteditable="true"]:focus{
        background: #fff;
      }
      [contenteditable="true"]:focus > style::before{
        content:"styles";
        font-size: 1.5em;
        font-weight: 700;
      }
      [contenteditable="true"]:focus > style{
        display:block;
        font-size: .75em;
        color: blue;
        font-family: courier, sans-serif;
        background: #fff;
        Padding: .5em;
        box-shadow: 1px 1px 2px #777;
        border: 1px solid #999;
        line-height: 1.5;
        position:relative;
        right: -36em;
        top:-2em;
        border-radius: 5px;
      }

    </style>
  </head>
  <body>
    <table cellspacing="0" border="0" width="100%">
    	<tbody>
    		<tr  class="colspan9">
    			<td colspan="9" class="colspan9" ><img class="img1" src="images/fondo-estadisticas-1.png"></td>
    		</tr>
    		<tr>
    			<td colspan="3" width="33%" class="tabla2-1" >
            <center>
              <img src="images/clasificacion_icono3.png">
            </center>
          </td>
    			<td colspan="3" width="33%" class="tabla2-2">
            <center>
              <img src="images/orientacion_icono3.png">
            </center>
          </td>
    			<td colspan="3" width="33%" class="tabla2-3">
            <center>
              <img src="images/cantidades_icono3.png">
            </center>
          </td>
    		</tr>
    		<tr>
          <td width="11.1%">
            <center>
              <?= $resultados['1,1'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['1,2'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['1,3'] ?>
            </center>
          </td>
          <td width="11.1%">
            <center>
              <?= $resultados['2,1'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['2,2'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['2,3'] ?>
            </center>
          </td>
          <td width="11.1%">
            <center>
              <?= $resultados['3,1'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['3,2'] ?>
            </center>
          </td>
            <td width="11.1%">
            <center>
              <?= $resultados['3,3'] ?>
            </center>
          </td>
    		</tr>
    		<tr>
    			<td colspan="<?= $col_texto ?>" class="tabla3-1">
            <img src="images/comentarios.png" style="width:200px;">
            <div contenteditable="true" class="texto">
              Lorem ipsum dolor sit amet, viverra felis tellus congue donec. In ac euismod justo nec, convallis dictum praesent facilisis turpis vivamus dolor, diam eros conubia fermentum turpis. Nibh ut, massa imperdiet, donec adipisicing eget arcu eleifend. Aenean aenean, at tempor parturient consequat.
            </div>
          </td>
          <?php if ($pdf == false) {
          ?>
    			<td colspan="3" class="tabla3-2">
            <div class="div-boton">
                <img class="botones hover-glass" onclick="open_pdf();" src="images/guardar.png">

                <img class="botones hover-glass" onclick="//send_mail();" src="images/correo.png">
            </div>
          </td>
          <?php }  ?>
    		</tr>
    	</tbody>
    </table>
  </body>
</html>
<?php
  $html = ob_get_clean();
  if ($pdf == true) {
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }else {
    echo $html;
  }
?>
<script type="text/javascript">
  function open_pdf() {
    var url = window.location;
    var win = window.open(url+'&pdf=true', '_blank');
    win.focus();
  }
</script>
