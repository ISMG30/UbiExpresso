<?php 
   
    require "controller/ControllerUbiExpressp.php";
    require "config/conectar.php";
    
class Insert {
    public $ControllerUbi;
    public $cnx;
    public $consul;
    function __construct()
    {
        $this-> ControllerUbi = new ControllerUbiExpress();
        $this-> cnx = Conexion::Conectar();
       
    }
    function Inserttoken ()
    {
        $consulta = $this-> ControllerUbi -> token();
        $dato = json_decode($consulta, true);
        $query =$this -> cnx -> query("SELECT * FROM usuario");
        while ($row = $query->fetch(PDO::FETCH_NUM))
        {
            $array [] = array(
                 'userId' => $row[1],
                 'user' => $row[2],
                 'password' => $row[3],
                 'token' => $row[4],
            );
            
        }
        $jsonto = json_encode($array);
        echo $jsonto;
        $jsondto = json_decode($jsonto, true);
       
            for($i=0; $i<count($jsondto); $i++)
            {
            
                $arraytok = $dato[0]['token1'];
                $arrayto = $dato[0]['userId'];
                $userId = $jsondto[$i]['userId'];
                $token = $jsondto[$i]['token'];
                echo json_encode($token);
                if($userId == $arrayto)
                {
                   // echo $jsondto[0]['token'];
                    if($token > '' )
                     {   echo 'Ya exite el token',  $token ;
                        foreach($dato as $datos)
                        {
                          //echo   $query = " INSERT INTO usuario(id, userId, user, password, token) VALUES ('".$datos['token1']."')";
                        } 
                     }else{
                        foreach($dato as $datos)
                        {
                           //$query = " INSERT INTO usuario(token) VALUES ('".$datos['token1']."')";
                           $query = "UPDATE usuario  SET  token = '".$datos['token1']."' WHERE userId = '".$userId."'";
                            $resu = $this-> cnx ->prepare($query);
                            $resu-> execute();                            
                        } 
                     }
                }else{
                    /*echo  'No hay registro';*/
                    echo 'Ya exite el usuario', $userId;
                }
            }
           
          //echo json_encode($arrayto);
    }
    function getUnidades()
    {
        $consulta= $this-> ControllerUbi -> Unidades();
        $dato = json_decode($consulta, true);       
        $query  = $this -> cnx->query("SELECT * FROM unidad");
        while ($row = $query->fetch(PDO::FETCH_NUM)) 
        {
            $array [] = array(
                'id' => $row[0],
                'unidad' => $row[1]
              );
        }
          $jsonu= json_encode($array);
          $jsondu = json_decode($jsonu, true);
        for($j=0; $j<count($jsondu); $j++)
        {
          for($i =0; $i<count($dato); $i++)
            {
                $arrayc  = $dato[$i]['id'];
                $ver = $jsondu[$j]['id'];
               
                if($ver == $arrayc)
                {
                    echo "YA ESTA REGISTRADO ";
                }/*else{
                   foreach($dato as $datos)
                   {
                    // $queryi="INSERT INTO unidad(id_unidad,nombre) VALUES ('".$datos['id']."','".$datos['user']."')";
                     $resu = $this -> cnx -> prepare($queryi);
                     $resu -> execute();
                     if($resu)
                     {
                        echo "Se registro ";
                     }else{
                        echo "ERROR";
                     }
                   }
                }*/
            }      
        }
    }

 function getInsert()
    {  
       
        $consulta= $this-> ControllerUbi -> CombustibleKmtotal();
        $dato = json_decode($consulta, true); 
        $queryc = $this -> cnx -> query("SELECT * FROM kilometraje");
        while ($km =  $queryc->fetch(PDO::FETCH_NUM))
        {   
            $arrayKm [] =array(
                'id_unidad' =>$km[0],
                'km' => $km[1],
                'fecha' => $km[2],
                'tipo_check' => $km[3],
            );
        }
         $jsonkm = json_encode($arrayKm);
         $jsondkm = json_decode($jsonkm, true);
        
                $kmc= $jsondkm[3]['tipo_check'];
                $kmcf = $jsondkm[2]['fecha'];
                $fecha = date('Y-m-d');
                for($i=0; $i<count($jsondkm); $i++)
                {
                    $kmcf  = $jsondkm[$i]['fecha'];
                    $kmc= $jsondkm[$i]['tipo_check'];
                }
                if($kmcf <= $fecha)
                {
                    if($kmc == 'fin')
                    {
                       foreach($dato as $datos)
                        {
                          $query ="INSERT INTO  kilometraje(id_unidad, km, fecha, tipo_check) VALUES ('".$datos['id']."','".$datos['km']."', '".date('Y-m-d')."','inicio')";
                          $result = $this -> cnx -> prepare($query);
                          $result -> execute();
                        }
                    }else{
                        foreach($dato as $datos)
                        {
                          $query ="INSERT INTO  kilometraje(id_unidad, km, fecha, tipo_check) VALUES ('".$datos['id']."','".$datos['km']."', '".date('Y-m-d')."','fin')";
                          $result = $this -> cnx -> prepare($query);
                          $result -> execute();
                          if($result)
                            {
                                echo "Se registro ";
                            }else{
                                echo "ERROR";
                            }
                        }
                    }
                }
    }
    function InsertCombustible ()
    {
        $consulta = $this -> ControllerUbi -> CombustibleKmtotal();
        $dato = json_decode($consulta, true);
        $queryc = $this -> cnx -> query("SELECT * FROM combustible");
        while ( $com = $queryc->fetch(PDO::FETCH_NUM))
        {
            $arraycom [] = array(
                'id_unidad' => $com[0],
                'litros' => $com[1],
                'fecha' => $com[2],
                'tipo_check' => $com[3]
            );
        }
         $jsoncom = json_encode($arraycom);
         $jsondcom = json_decode($jsoncom, true);
            $comc = $jsondcom[3]['tipo_check'];
            $comf =  $jsondcom[2]['fecha'];
            $fecha = date('Y-m-d');
            for($i=0; $i<count($jsondcom); $i++)
            {
                $comcf = $jsondcom[$i]['fecha'];
                $comco = $jsondcom[$i]['tipo_check'];
            }
            if($comcf <= $fecha)
            {
                if($comcf == 'fin')
                {
                    foreach($dato as $datos)
                    {
                        $query ="INSERT INTO combustible(id_unidad, litros, fecha, tipo_check) VALUES ('".$datos['id']."','".$datos['com']."','".date('Y-m-d')."','inicio')";
                        $result = $this -> cnx ->prepare($query);
                        $result -> execute();
                    }
                }else{
                    foreach($dato as $datos)
                    {
                        $query = "INSERT INTO combustible(id_unidad, litros, fecha, tipo_check) VALUES ('".$datos['id']."','".$datos['com']."','".date('Y-m-d')."','fin')";
                        $result = $this -> cnx -> prepare($query);
                        $result -> execute();
                        
                    }
                }
            }
    }
}

?>