<!--?php    
 /*class eje {
    
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
 }*/
 $ver = new conexionlogin();
 $metodo = $ver -> conexion();
 $jsone = json_encode($metodo);
 $jsond = json_decode($jsone, true);
 foreach($jsond as $rowes){

       $arrayToken =  $rowes['token'];
       
 }
 //echo json_encode($arrayToken);
?>
<script>
     const miVariableEnJavaScript = alert($arrayToken);
    console.log("El contenido de la variable es: " + miVariableEnJavaScript)
   
</script-->
<html>
<head>
    <title>PHP Test</title>
</head>

<body>
<div id="txt_km_traveled" class="col-auto text-center">

</div>
<?php
 include '../config/conexionlogin.php';
$ver = new conexionlogin();
 $metodo = $ver -> conexion();
 $jsone = json_encode($metodo);
 $jsond = json_decode($jsone, true);
 foreach($jsond as $rowes){

       $arrayToken =  $rowes['token'];
       
 }
 echo json_encode($arrayToken)
?>

<script type="text/javascript">

    
    var div_txt_km_traveled = $('#txt_km_traveled').empty();
    const miVariableEnJavaScript = "<?php echo $arrayToken ?>";
    const miPrueba ="<?php echo $prueba?>";
    // Justo aquí estamos pasando la variable ----^
    // Y ya la tenemos desde JavaScript. Podemos hacer cualquier cosa con ella
    // console.log("El contenido de la variable es: " + miVariableEnJavaScript);
    div_txt_km_traveled.append(`<label class="form-label text-uppercase fw-nomal fs-2">${miVariableEnJavaScript}`);
    div_txt_km_traveled.append(`<label class="form-label text-uppercase fw-normal fs-2">${Prueba}`)
</script>

</body>

</html>
