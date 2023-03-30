<?php
include_once '../config/conectionDB.php';
class conexionlogin{
     
    private $cnx;

    function __construct()
    {
        $this -> cnx = Conexion::ConectarDB();
    }
    function conexion ()
    {
        $usuario = 'PROGRAMACION';//$_POST['usuario'];
        $password ='Prog23';//$_POST['contraseña'];
        $query = $this->cnx->query("SELECT  * FROM  usuario WHERE usar = '$usuario' AND password='$password' ");
        while ($con = $query->fetch(PDO::FETCH_NUM))
        {
            $arraylogin [] = array(
                'user' => $con[1],
                'password' => $con[2],
                'token' => $con[3],
            );
        }
        return $arraylogin;
        //echo json_encode($arraylogin);
    }
   
}  
 /* $ver= new conexionlogin();
  $ver2 = $ver -> conexion();
   echo json_encode($ver2);*/
?>
