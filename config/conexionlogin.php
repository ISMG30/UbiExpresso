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
        $usuario = $_POST['usuario'];
        $password =$_POST['contraseña'];
        $query = $this->cnx->query("SELECT  * FROM  usuario WHERE user = '$usuario' AND password='$password' ");
        while ($con = $query->fetch(PDO::FETCH_NUM))
        {
            $arraylogin [] = array(
                'user' => $con[2],
                'password' => $con[3],
                'token' => $con[4],
            );
        }
        return $arraylogin;
        //echo json_encode($arraylogin);
    }
   function unidades()
   {
      $query = $this -> cnx ->query("SELECT * FROM unidad " );
      while($con = $query->fetch(PDO::FETCH_NUM))
      {
        $arrayUnidad [] = array(
            'id' => $con[0],
            'nombre' => $con[1],
        );
      }
   }
}  
 /* $ver= new conexionlogin();
  $ver2 = $ver -> conexion();
   echo json_encode($ver2);*/
?>
