<?php
  //header('Content-Type: text/html; charset=utf-8');
  //session_start();

 /* include_once("../config/wialon.php");
  include_once "../config/conectionDB.php";
  class login {
       
      private $cnx;

      function __construct()
      {
        $this -> cnx = Conexion::ConectarDB();
        
      }

      function conexion ()
      {
         $usuario = $_POST['usuario'];
         $password = $_POST['contraseña'];
         $query = $this -> cnx -> query("SELECT  * FROM  usuario WHERE usar ='$usuario' AND password = '$password' ");
         while ($con = $query->fetch(PDO::FETCH_NUM))
         {
           $arraycon [] = array(
              'user' => $con[1],
              'password'=> $con[2],
              'token'=>$con[3],
           );
         }
         return $arraycon;
      }
  }
	
  $wialon_api = new Wialon();
  $conexion = new  login();
  $login = $conexion->conexion();
  $jsonco= json_encode($login);
  $jsondco =json_decode($jsonco, true);

 // $usuario = $_POST['usuario'];
  //$password = $_POST['contraseña'];
	
// old username and password login is deprecated, use token login
  for($i= 0; $i<count($jsondco); $i++)
  {

  }
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
}*/
//include_once("config/wialon.php");
//include_once "config/conectionDB.php";
 require_once "../config/wialon.php";
 require_once "../config/conexionlogin.php";
 /*require_once "../config/conectionDB.php";
    class index {
         
        private $cnx;
  
        function __construct()
        {
          $this -> cnx = Conexion::ConectarDB();
        }

        function conexion ()
        {
           $usuario = $_POST['usuario'];
          $password = $_POST['contraseña'];
           $query = $this -> cnx -> query("SELECT  * FROM  usuario WHERE usar = '$usuario' AND password='$password' ");
           while ($con = $query->fetch(PDO::FETCH_NUM))
           {    
             $arraycnx [] = array(
                'user' => $con[1],
                'password'=> $con[2],
                'token'=>$con[3],
             );
           }
           return $arraycnx;
          
        }
    }*/

    $wialon_api = new Wialon();
    $conexion = new  conexionlogin();
    $login = $conexion->conexion();
    $jsonco= json_encode($login);
    $jsondco =json_decode($jsonco, true);
    //echo json_encode($jsondco);

    foreach($jsondco  as $datos){
    if (isset($_POST['btn_login'])) {
        
        //$usuario = $_POST['usuario'];
        //$password = $_POST['contraseña'];
        // old username and password login is deprecated, use token login
        //$token = '2f0a8929ad515bb67157ead976434d583C8363C8E81DAD3AC2ED4BFBB1241E41A1C47114';
        $token = $datos['token'];
        $result = $wialon_api->login($token);
        $json = json_decode($result, true);

        if ($datos['user'] == $json['au'] && $datos['password'] == $datos['password']) {
            session_start();
            $_SESSION['user'] = $json['au'];
            header("Location: ../views/menu.php");
        } else {
            echo '
        <script>
            toastr["error"]("Revise si el uauario y contraseña estan correctos", "Datos incorrectos");
        </script>';
        }
    }
}


?>