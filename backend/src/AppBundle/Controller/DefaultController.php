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
      $sql = "SELECT * FROM users WHERE usuario = '$user' AND password='$pass'";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
        $token = base64_encode(random_bytes(10));
        if(mysql_num_rows($resultado))
          return $token;
        else
          return false;
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

      $sql = "INSERT INTO `resultado-juego` (`id_juego`, `resultado`) VALUES ('$juego', '$resultado')";
      $resultado = mysql_query($sql);
      if (!$resultado) {
          $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
          $mensaje .= 'Consulta completa: ' . $sql;
          die($mensaje);
      }else {
          return mysql_insert_id();
      }
    }

    protected function new_game($juego,$token) {
      $this->con = $this->conexion();
      $juego = filter_var ( $juego, FILTER_SANITIZE_STRING);
      $token = filter_var ( $token, FILTER_SANITIZE_STRING);

      $sql = "INSERT INTO juego (juego, token) VALUES ('$juego', '$token')";

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
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     *  @Route(
     *    path = "/login_user",
     *    name ="login",
     *    methods = { "POST" }
     *  )
     */
    public function loginAction(Request $request)
    {
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->login_user($data['user'],$data['pass'])));
    }
    /**
     *  @Route(
     *    path = "/user_new_game",
     *    name ="new",
     *    methods = { "POST" }
     *  )
     */
    public function newAction(Request $request)
    {
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->new_game($data['juego'],$data['token'])));
    }
    /**
     *  @Route(
     *    path = "/user_point",
     *    name ="point",
     *    methods = { "POST" }
     *  )
     */
    public function pointAction(Request $request)
    {
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_point($data['juego'],$data['juego'],$data['nivel'],$data['intento'],$data['punto'],$data['token'])));
    }
    /**
     *  @Route(
     *    path = "/user_result",
     *    name ="result",
     *    methods = { "POST" }
     *  )
     */
    public function resultAction(Request $request)
    {
      $data = $request->request->all();
      return new JsonResponse(array('response' => $this->user_result($data['juego'],$data['resultado'],$data['nivel'],$data['token'])));
    }
}
