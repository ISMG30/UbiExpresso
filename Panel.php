<?php
include_once "./controller/ControllerUbiExpressp.php";

if(!empty($_POST['opcion'])){
   $opcion = $_POST['opcion'];
   $Ubi = new ControllerUbiExpress ();
   
   switch($opcion){
    case 1: {
          $dato = $Ubi->login();
          return $dato;
         
    }
    ;
    break;
    case 2: {
        $unidad= $_POST['unidad'];
        $dato = $Ubi ->Usuarios($unidad);
        
        
    }
    ;
    break;
    case 3:{
        $unidad= $_POST['unidad'];
        $dato = $Ubi ->NUnidad($unidad);
    }
    ;
    break;
    case 4: {
        
        $dato = $Ubi -> Combustible($unidad);
    }
   }
}
?>