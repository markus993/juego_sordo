<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    protected $con = null;

    protected function conexion(){
      $hostname = 'localhost';
      $database = 'tesis';
      $username = 'root';
      $password = 'locomad1';

      if (!$con = mysql_connect($hostname, $username, $password)){
        die("Falló la conexión a MySQL: " . mysql_error());
      }else{
        mysql_select_db($database);
        return $con;
      }
    }

    protected function login_user($user,$pass) {
      $this->con = $this->conexion();
      $user = filter_var ( $user, FILTER_SANITIZE_STRING);
      $pass = filter_var ( $pass, FILTER_SANITIZE_STRING);
      $sql = "SELECT * FROM users WHERE usuario = '$user' AND password='$pass' AND activo=1 LIMIT 1";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
        $token = base64_encode(random_bytes(10));
        if(mysql_num_rows($resultado)){
          $result = mysql_fetch_array($resultado, MYSQL_ASSOC);
          //var_dump($result);
          $out['token'] = $token;
          $out['admin'] = $result['admin'];
          $out['id_user'] = $result['id'];
          return $out;
        }else{
          return false;
        }
      }
    }

    protected function sendMail($mail,$subject,$messagetxt){
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('noreply@phonatic.com')
            ->setTo($mail)
            ->setBody($messagetxt,'text/html');
        if ($this->get('mailer')->send($message)) {
        //if (true) {
          //var_dump($messagetxt);
          return true;
        }else {
          return false;
        }
    }

    protected function info_user($token='',$id='') {
      if ($token == '') {
        return false;
      }
      if ($id == '') {
        return false;
      }
      $this->con = $this->conexion();
      $sql = "SELECT * FROM users WHERE id='$id' AND activo=1";
      $resultado = mysql_query($sql);
      if (!$resultado) {
        $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
        $mensaje .= 'Consulta completa: ' . $sql;
        die($mensaje);
        return false;
      }else {
        while($result = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
          $salida[] = $result;
        }
        return $salida[0];
      }
    }

    protected function list_users($token='') {
      if ($token == '') {
        return false;
      }
      $this->con = $this->conexion();
      $sql = "SELECT id,nombres,apellidos,sexo,admin FROM users WHERE activo=1 ORDER BY nombres,apellidos,activo";
      $resultado = mysql_query($sql);
      if (!$resultado) {
        $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
        $mensaje .= 'Consulta completa: ' . $sql;
        die($mensaje);
        return false;
      }else {
        while($result = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
          $salida[] = $result;
        }
        return $salida;
      }
    }

    protected function user_games_win($id_user,$token) {
      if ($token == '') {
        return false;
      }
      $id_user = filter_var($id_user, FILTER_SANITIZE_STRING);
      $token = filter_var($token, FILTER_SANITIZE_STRING);

      $this->con = $this->conexion();
      $sql = "SELECT
                `resultado-juego`.resultado,
                `resultado-juego`.nivel,
                juego.juego
              FROM
                juego,
                `resultado-juego`
              WHERE
                juego.id_user='$id_user' AND
                juego.id=`resultado-juego`.id_juego
              GROUP BY
                juego.juego";
      $resultado = mysql_query($sql);
      if (!$resultado) {
        $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
        $mensaje .= 'Consulta completa: ' . $sql;
        die($mensaje);
        return false;
      }else {
        while($result = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
          $salida[] = $result;
        }
        return $salida;
      }
    }

    protected function user_games_result($id_user,$nivel,$token) {
      if ($token == '') {
        return false;
      }
      $id_user = filter_var($id_user, FILTER_SANITIZE_STRING);
      $nivel = filter_var($nivel, FILTER_SANITIZE_STRING);
      $token = filter_var($token, FILTER_SANITIZE_STRING);

      $this->con = $this->conexion();
      $sql = "SELECT `resultado-juego`.*,juego.juego FROM juego,`resultado-juego` WHERE juego.id_user='$id_user' AND juego.id=`resultado-juego`.id_juego";
      $resultado = mysql_query($sql);
      if (!$resultado) {
        $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
        $mensaje .= 'Consulta completa: ' . $sql;
        die($mensaje);
        return false;
      }else {
        while($result = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
          $salida[] = $result;
        }
        return $salida;
      }
    }

    protected function user_jugadas_result($id_user,$juego,$token) {
      if ($token == '') {
        return false;
      }
      $id_user = filter_var($id_user, FILTER_SANITIZE_STRING);
      $juego = filter_var($juego, FILTER_SANITIZE_STRING);
      $nivel = filter_var($nivel, FILTER_SANITIZE_STRING);
      $token = filter_var($token, FILTER_SANITIZE_STRING);

      $this->con = $this->conexion();
      $sql = "SELECT jugadas.* FROM juego,jugadas WHERE juego.id_user='$id_user' AND juego.id=jugadas.id_juego";

      $resultado = mysql_query($sql);
      if (!$resultado) {
        $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
        $mensaje .= 'Consulta completa: ' . $sql;
        die($mensaje);
        return false;
      }else {
        while($result = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
          $salida[] = $result;
        }
        return $salida;
      }
    }

    protected function create_user($name,$last,$user,$mail,$sexo){
      $this->con = $this->conexion();
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $last = filter_var($last, FILTER_SANITIZE_STRING);
      $user = filter_var($user, FILTER_SANITIZE_STRING);
      $mail = filter_var($mail, FILTER_SANITIZE_STRING);
      $sexo = filter_var($sexo, FILTER_SANITIZE_STRING);
      $pass = base64_encode (rand(1099, 9999));
      $sql = "INSERT INTO `users` (`Nombres`,`Apellidos`,`usuario`,`mail`,`sexo`) VALUES ('$name', '$last', '$user', '$mail', '$sexo')";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          return false;
          die($mensaje);
      }else {
          return mysql_insert_id();
      }
    }

    protected function user_point($juego,$tipo_juego,$nivel,$intento,$punto,$token) {
      $this->con = $this->conexion();
      $juego = filter_var ( $juego, FILTER_SANITIZE_STRING);
      $tipo_juego = filter_var ( $tipo_juego, FILTER_SANITIZE_STRING);
      $nivel = filter_var ( $nivel, FILTER_SANITIZE_STRING);
      $intento = filter_var ( $intento, FILTER_SANITIZE_STRING);
      $punto = filter_var ( $punto, FILTER_SANITIZE_STRING);

      $sql = "INSERT INTO `jugadas` (`id_juego`, `juego`, `nivel`, `punto`, `token`) VALUES ('$juego', '$tipo_juego', '$nivel', $punto, '$token')";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
          return mysql_insert_id();
      }
    }

    protected function user_result($juego,$resultado,$nivel,$token) {
      $this->con = $this->conexion();
      $juego = filter_var ( $juego, FILTER_SANITIZE_STRING);
      $resultado = filter_var ( $resultado, FILTER_SANITIZE_STRING);
      $nivel = filter_var ( $nivel, FILTER_SANITIZE_STRING);
      $token = filter_var ( $token, FILTER_SANITIZE_STRING);

      $sql = "INSERT INTO `resultado-juego` (`id_juego`, `resultado`, `nivel`) VALUES ('$juego', '$resultado', '$nivel')";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
          return mysql_insert_id();
      }
    }

    protected function update_user($id,$name,$last,$user,$mail,$sexo) {
      $this->con = $this->conexion();
      $id = filter_var ( $id, FILTER_SANITIZE_STRING);
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $last = filter_var($last, FILTER_SANITIZE_STRING);
      $user = filter_var($user, FILTER_SANITIZE_STRING);
      $mail = filter_var($mail, FILTER_SANITIZE_STRING);
      $sexo = filter_var($sexo, FILTER_SANITIZE_STRING);
      $sql = "UPDATE `users` SET `Nombres`='$name', `Apellidos`='$last', `usuario`='$user', `mail`='$mail', `sexo`='$sexo' WHERE (`id`='$id')";
      if (!$resultado = mysql_query($sql)) {
          return false;
      }else {
          return true;
      }
    }

    protected function del_user($id) {
      $this->con = $this->conexion();
      $id = filter_var ( $id, FILTER_SANITIZE_STRING);
      $sql = "UPDATE `users` SET `activo`='0' WHERE (`id`='$id')";
      if (!$resultado = mysql_query($sql)) {
          return false;
      }else {
          return true;
      }
    }

    protected function new_game($juego,$id_user,$token) {
      $this->con = $this->conexion();
      $id_user = filter_var ( $id_user, FILTER_SANITIZE_STRING);
      $juego = filter_var ( $juego, FILTER_SANITIZE_STRING);
      $token = filter_var ( $token, FILTER_SANITIZE_STRING);
      $sql = "INSERT INTO juego (juego, token, id_user) VALUES ('$juego', '$token', '$id_user')";
      if (!$resultado = mysql_query($sql)) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
          return mysql_insert_id();
      }
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request){
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/info_user", name="info")
     */
    public function infoAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->info_user($data['token'],$data['id'])));
    }

    /**
     *  @Route(
     *    path = "/mail_user_password",
     *    name ="mail_user_password",
     *    methods = { "POST" }
     *  )
     */
    public function mail_user_passwordAction(Request $request){
      $data = $request->request->all();
      $info =  $this->info_user($data['token'],$data['id']);
      $messagetxt = "
      <br>
      <div>
        <h1>
          ".htmlentities('Correo de Informacion de Usuario')."
        </h1>
        <p>
          Nombre: ".htmlentities($info['Nombres'].' '.$info['Apellidos'])."
        </p>
        <p>
          Usuario: ".htmlentities($info['usuario'])."
        </p>
        <p>
          Contraseña: ".base64_decode($info['password'])."
        </p>
      </div>
      ";
      return new JsonResponse(array('response' => $this->sendMail( $info['mail'],'Correo de Informacion de Contraseña',$messagetxt)));
    }

    /**
     *  @Route(
     *    path = "/create_user",
     *    name ="create_user",
     *    methods = { "POST" }
     *  )
     */
    public function create_userAction(Request $request){
      $data = $request->request->all();
      $out = $this->create_user($data['name'],$data['last'],$data['user'],$data['mail'],$data['sexo']);
      $this->mail_user_passwordAction($request);
      return new JsonResponse(array('response' => $out));
    }

    /**
     *  @Route(
     *    path = "/update_user",
     *    name ="update_user",
     *    methods = { "POST" }
     *  )
     */
    public function update_userAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->update_user($data['id'],$data['name'],$data['last'],$data['user'],$data['mail'],$data['sexo'])));
    }

    /**
     *  @Route(
     *    path = "/list_users",
     *    name ="list_users",
     *    methods = { "POST" }
     *  )
     */
    public function list_usersAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->list_users($data['token'])));
    }

    /**
     *  @Route(
     *    path = "/login_user",
     *    name ="login",
     *    methods = { "POST" }
     *  )
     */
    public function loginAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->login_user($data['user'],$data['pass'])));
    }

    /**
     *  @Route(
     *    path = "/delete_user",
     *    name ="del",
     *    methods = { "POST" }
     *  )
     */
    public function delAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->del_user($data['id'])));
    }

    /**
     *  @Route(
     *    path = "/user_new_game",
     *    name ="new",
     *    methods = { "POST" }
     *  )
     */
    public function newAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->new_game($data['juego'],$data['id_user'],$data['token'])));
    }

    /**
     *  @Route(
     *    path = "/user_games_win",
     *    name ="user_games_win",
     *    methods = { "POST" }
     *  )
     */
    public function user_games_winAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_games_win($data['id_user'],$data['token'])));
    }

    /**
     *  @Route(
     *    path = "/user_games_result",
     *    name ="user_games_result",
     *    methods = { "POST" }
     *  )
     */
    public function user_games_resultAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_games_result($data['id_user'],$data['nivel'],$data['token'])));
    }

    /**
     *  @Route(
     *    path = "/user_jugadas_result",
     *    name ="user_jugadas_result",
     *    methods = { "POST" }
     *  )
     */
    public function user_jugadas_resultAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_jugadas_result($data['id_user'],$data['juego'],$data['nivel'],$data['token'])));
    }

    /**
     *  @Route(
     *    path = "/user_point",
     *    name ="point",
     *    methods = { "POST" }
     *  )
     */
    public function pointAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_point($data['juego'],$data['tipo_juego'],$data['nivel'],$data['intento'],$data['punto'],$data['token'])));
    }

    /**
     *  @Route(
     *    path = "/user_result",
     *    name ="result",
     *    methods = { "POST" }
     *  )
     */
    public function resultAction(Request $request){
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_result($data['juego'],$data['resultado'],$data['nivel'],$data['token'])));
    }
}
