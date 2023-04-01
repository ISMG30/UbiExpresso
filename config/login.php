<?php
  //header('Content-Type: text/html; charset=utf-8');
  //session_start();
 require_once "../config/wialon.php";
 require_once "../config/conexionlogin.php";
 //require_once "../controller/Request.php";

    $wialon_api = new Wialon();
    $conexion = new  conexionlogin();
    //$conex = new Request();
    //$logi = $conex -> login();
    $login = $conexion->conexion();
    /*if(!empty($logi))
    {
      for($i=0; $i<count($logi); $i++)
      {
        $usuario [] = array(
           'user' => $logi[$i]['usar'],
           'password' => $logi[$i]['password'],
           'token' => $logi[$i]['token'],
           
        );
      }
    }*/
    $jsonco= json_encode($login);
    $jsondco =json_decode($jsonco, true);

    //echo json_encode($jsondco);

    
    if (isset($_POST['btn_login'])) {
        
    foreach($jsondco  as $datos){
        //$usuario = $_POST['usuario'];
        //$password = $_POST['contraseña'];
        // old username and password login is deprecated, use token login
        //$token = '2f0a8929ad515bb67157ead976434d583C8363C8E81DAD3AC2ED4BFBB1241E41A1C47114';
        $token  =  $datos['token'];
        $result = $wialon_api->login($token);
        $json = json_decode($result, true);
        $params = array(
          'spec' => array(
              'itemsType' => 'avl_unit',
              'propName'=> 'sys_name',
              'propValueMask' => '*',
              'sortType' => 'sys_name'
          ),
          'force' => 1,
          'from' => 0,
          'to'=>0,
          'flags' => 0x1
        ); 
        $resunidad = $wialon_api->core_search_items(json_encode($params));
        $jsonunidad = json_decode($resunidad,true);
        for($i=0; $i<count($jsonunidad); $i++)
        {
            
        }


        //echo json_encode($json);
      /* if($json['au'] = 'null')
       {*/
             //header("Location: ../index.php");
            if ($datos['user'] == $json['au'] && $datos['password'] == $datos['password']) {
          
              session_start();
              $_SESSION['user'] = $json['au'];
              header("Location: ../views/menu.php");
          }else{
              echo '
          <script>
              toastr["error"]("Revise si el uauario y contraseña estan correctos", "Datos incorrectos");
          </script>';
          }
       /*}else{
         //echo 'Si hay Ubiexrpress';
       
      if( header("Location: ../index.php") == '')
      {echo '
      <script>
          toastr["error"]("No hay Ubiexpress", "Sin conexion");
      </script>';
      }
       }*/
        /*if ($datos['user'] == $json['au'] && $datos['password'] == $datos['password']) {
          
            session_start();
            $_SESSION['user'] = $json['au'];
            header("Location: ../views/menu.php");
        } else {
            echo '
        <script>
            toastr["error"]("Revise si el uauario y contraseña estan correctos", "Datos incorrectos");
        </script>';
        }*/
         

    }
    if(!empty($_POST['mantener_sesion']))
    {
      setcookie("COOKIE_INDEFINED_SESSION", TRUE, time()+1680084960);
      setcookie("COOKIE_DATA_INEDFINED_SESSION[nombre]",$datos['user'], time()+1680084960);
      setcookie("COOKIE_DATA_INEDFINED_SESSION[password]",$datos['password'], time()+1680084960);
      //echo "Sesion abierta indefinidamente";
    }else{
      setcookie("COOKIE_CLOSE_NAVEGADOR", TRUE,0). "<br/>";
      //echo "Sesion abierta hasta que cierre el navegador. <br/>";
    }
}


?>
