<?php
  header('Content-Type: text/html; charset=utf-8');
  session_start();

  include_once("../config/wialon.php");
	
  $wialon_api = new Wialon();
  $usuario = $_POST['usuario'];
  $password = $_POST['contraseña'];
	
// old username and password login is deprecated, use token login
$token = '2f0a8929ad515bb67157ead976434d583BCAEAF887B0551E3F8C07590A59533902946CAA';
$result = $wialon_api->login($token);
$json = json_decode($result, true);

if($usuario && $json['user'] && $password && 'PRUEBAS12')
{
	$user= $json['user'];
	//$_SESSION[$user] = $username;
	header("Location: ../views/menu.php");
	
}else{
	echo 'El Usuario o password es incorrecto, "<a href="index.php">vuelva a intenarlo</a>.<br/>';
}

?>