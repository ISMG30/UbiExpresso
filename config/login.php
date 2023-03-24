<?php
  header('Content-Type: text/html; charset=utf-8');
  session_start();

  include_once("../config/wialon.php");
	
  $wialon_api = new Wialon();
  $usuario = $_POST['usuario'];
  $password = $_POST['contraseña'];
	
// old username and password login is deprecated, use token login
$token = '2f0a8929ad515bb67157ead976434d583C8363C8E81DAD3AC2ED4BFBB1241E41A1C47114';
$result = $wialon_api->login($token);
$json = json_decode($result, true);

if($usuario == $json['au'] && $password == 'Prog23')
{
	$_SESSION['user'] = $json['au'];
	header("Location: ../views/menu.php");
	
}else{

	echo '
    <script>
        toastr["error"]("Revise si el uauario y contraseña estan correctos", "Datos incorrectos");
    </script>';
}

?>