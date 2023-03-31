<?php
//include_once "./controller/ControllerUbiExpressp.php";
include_once '../UbiExpresso/controller/InsertUbi1.php';
if(!empty($_POST['opcion'])){
   $opcion = $_POST['opcion'];
  // $Ubi = new ControllerUbiExpress ();
    $lubi = new Insert();
   
   switch($opcion){
    /*case 1: {
     
        $dato = $Ubi -> token();
    }
    ;
    break;
    case 2: {
      
        $dato = $Ubi -> CombustibleKmtotal();
    }
    ;
    break;
    case 3:{
        $fechaI=$_POST['fechai'];
        $fechaF=$_POST['fechaf'];
        $dato =$Ubi-> KmRecorido($fechaI, $fechaF);
    }
    ;
    break;
    case 4:{
         $user = $_POST['unidad'];
         $fechaI = $_POST['fechai'];
         $fechaF = $_POST['fechaf'];
         $dato =$Ubi->Posicion1($user, $fechaI, $fechaF);
     }
     ;
     break; */
     case 5:
        {
            $date = $lubi -> Inserttoken();
        }
        break;
    case 6:
        {
            $date = $lubi -> InsertCombustible ();
        }
        break;
    case 7: 
        {
            $date = $lubi -> getUnidades();
        }
   }
}
?>