<?php 

    include '../config/conexionlogin.php';
    
 class eje {
    
    function token ()
    {
      $ver = new conexionlogin();
      $metodo = $ver -> conexion();
      $jsone = json_encode($metodo);
      $jsond = json_decode($jsone, true);
      foreach($jsond as $rowes){
  
        $arrayToken []=array('token1'=> $rowes['token']);
      }
      echo json_encode($arrayToken);
      return $arrayToken; 
      
      
    }
 }
 $ver = new conexionlogin();
 $metodo = $ver -> conexion();
 $jsone = json_encode($metodo);
 $jsond = json_decode($jsone, true);
 foreach($jsond as $rowes){

       $arrayToken []=array('user'=> $rowes['user'],'password'=>$rowes['password'],'token1'=> $rowes['token']);
       
 }
 echo json_encode($arrayToken);
?>