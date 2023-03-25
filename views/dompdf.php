<?php 
$html= ob_start();
?>
<?php
    
     include_once '../config/conectionDB.php';
     $fechain2=$_GET['startDate']; 
     $fechafi1=$_GET['endDate'];
     $idP = $_GET['id'];
     $costoTotal =$_GET['costo'];   
    
    class dompdfs {
    private $cn;
    
    function __construct(){
        $this->cn = Conexion::ConectarDB();
    }
    
    function unidad()
    {
        $idP= $_GET['id'];
        $query = "SELECT * FROM unidad WHERE id_unidad = $idP";
        $result = $this->cn->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }else{
                return $datos = [];
            }       
        }else{
            
            return $datos = [];
        }
    }
    function recargagas()
    {
        $id = $_GET['id'];
        $fechain2=$_GET['startDate']; 
        $fechafi1=$_GET['endDate'];
        $query ="SELECT TC.nombre as combustible, E.litros, E.totalCosto as costo, round((E.totalCosto / E.litros),2) as costol, E.fecha FROM entradas_combustible as E INNER JOIN tipo_combustible as TC ON E.tipo_combustible = TC.id_tipo_com WHERE E.id_unidad = $id 
        AND E.fecha BETWEEN   '$fechain2'  AND '$fechafi1' ORDER BY E.fecha ASC";
        $result = $this->cn->prepare($query);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }else{
                return $datos = [];
            }       
        }else{
            return $datos = [];
        }
    }
    function recargagas2()
    {
        $id = $_GET['id'];
        $fechain2=$_GET['startDate']; 
        $fechafi1=$_GET['endDate'];
        $query =$this -> cn -> query("SELECT TC.nombre as combustible, E.litros, E.totalCosto as costo, round((E.totalCosto / E.litros),2) as costol, E.fecha FROM entradas_combustible as E INNER JOIN tipo_combustible as TC ON E.tipo_combustible = TC.id_tipo_com WHERE E.id_unidad = $id 
        AND E.fecha BETWEEN   '$fechain2'  AND '$fechafi1' ORDER BY E.fecha ASC");
    
        while ($con = $query -> fetch(PDO:: FETCH_NUM))
        {
            $arrayre [] = array(
                //'combustible'=> $con[0],
                'litros' => $con[1],
                //'costo' => $con[2],
                //'costol' => $con[3],
                'fecha' => $con[4],
            );
        }
        /*$query = $this -> cn -> query("SELECT C.id_unidad, C.litros ,C.fecha, round((C.litros + EC.litros),2) AS costol FROM  combustible AS C INNER JOIN  entradas_combustible AS EC WHERE C.id_unidad= $id AND C.tipo_check = 'inicio' AND C.fecha BETWEEN $fechain2 AND $fechafi1 AND EC.fecha BETWEEN $fechain2 AND $fechafi1  AND EC.fecha = C.fecha AND EC.id_unidad = $id");
        while ($con = $query -> fetch(PDO::FETCH_NUM))
        {
            $arrayres [] = array(
                
                'litros' => $con[1],
                'fecha' => $con[2],
                //'costo' => $con[2],
                'costol' => $con[3],
                
            );
        }*/
        return $arrayre;
    }
    function costor()
    {
        $id = $_GET['id'];
        $fechain2=$_GET['startDate']; 
        $fechafi1=$_GET['endDate'];
        $query = "SELECT U.id_unidad AS id, U.nombre AS unidad, C.litros, C.fecha as fecha_combustible, C.tipo_check as check_combustible FROM unidad as U INNER JOIN combustible AS C ON U.id_unidad = C.id_unidad WHERE U.id_unidad = $id AND C.fecha BETWEEN ' $fechain2' AND ' $fechafi1'";
        $resulk = $this ->cn ->prepare($query);
        if($resulk -> execute())
        {
            if($resulk->rowCount()>0){
                while($fila=$resulk->fetch(PDO::FETCH_ASSOC))
                {
                    $datos[]= $fila;
                }
                return $datos;
            }else{
                return $datos = [];
            }
        }else{
            return $datos = [];
        }
    }
    function kmrecorido()
    {
        $id = $_GET['id'];
        $fechain2=$_GET['startDate']; 
        $query ="SELECT U.id_unidad AS id, U.nombre AS unidad, K.km, K.fecha as fecha_km, K.tipo_check as check_km FROM unidad as U INNER JOIN kilometraje AS K ON U.id_unidad = K.id_unidad WHERE U.id_unidad = $id AND K.fecha = '$fechain2' AND k.tipo_check = 'inicio'";
        $result= $this -> cn-> prepare($query);
        if($result -> execute())
        {
            if($result->rowCount()>0){
                while($fila=$result->fetch((PDO::FETCH_ASSOC)))
                {
                    $datos[] =$fila;
                }
                return $datos;
            }else{
                return $datos = [];
            }
        }else{
            return $datos = [];
        }
    }
    function kmrecoridofin()
    {
        $id = $_GET['id'];
        $fechafi1=$_GET['endDate'];
        $query ="SELECT U.id_unidad AS id, U.nombre AS unidad, K.km, K.fecha as fecha_km, K.tipo_check as check_km FROM unidad as U INNER JOIN kilometraje AS K ON U.id_unidad = K.id_unidad WHERE U.id_unidad = $id AND K.fecha = ' $fechafi1' AND k.tipo_check = 'fin'";
        $result= $this -> cn -> prepare($query);
        if($result -> execute())
        {
            if($result->rowCount()>0){
                while($fila=$result->fetch((PDO::FETCH_ASSOC)))
                {
                    $datos[] =$fila;
                }
                return $datos;
            }else{
                return $datos = [];
            }
        }else{
            return $datos = [];
        }
    }
    function kmrecoridot(){
         $id = $_GET['id'];
         $fechain2=$_GET['startDate']; 
         $fechafi1=$_GET['endDate'];
         $query = "SELECT U.id_unidad AS id, U.nombre AS unidad, K.km, K.fecha as fecha_km, K.tipo_check as check_km FROM unidad as U INNER JOIN kilometraje AS K ON U.id_unidad = K.id_unidad WHERE U.id_unidad = $id AND K.fecha BETWEEN ' $fechain2' AND ' $fechafi1';";
         $resultkm = $this -> cn -> prepare($query);
         if($resultkm -> execute())
         {
            if($resultkm -> rowCount()>0){
                while($fila = $resultkm->fetch((PDO::FETCH_ASSOC)))
                {
                    $datos [] = $fila;
                }
                return $datos;
            }else{
                return $datos =[];
            }
         }else{
            return $datos=[];
         }
    }
} 
      // Unidades
      $request = new dompdfs();
      $funcion = $request->unidad();
      if (!empty( $funcion)) {
        for ($i = 0; $i < count($funcion); $i++) {
            $list[] = array(
                "id" => $funcion[$i]['id_unidad'],
                "unidad" => $funcion[$i]['nombre'],
            );
        }
        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($list),
            "iTotalDisplayRecords" => count($list),
            "aaData" => $list
        );
       $json = json_encode($result);
       $jsond =json_decode($json, true);
       $id1=$jsond["aaData"][0]["id"];
       $unidad=$jsond["aaData"][0]["unidad"];
    }

    // Recargas de Gasolina
    $recarga = $request->recargagas($funcion, @$startDate);
    if (!empty( $recarga)) {
      for ($i = 0; $i < count($recarga); $i++) {
          $listr[] = array(
              "no" => $i + 1,
              "comb" => $recarga[$i]['combustible'],
              "l" => $recarga[$i]['litros'],
              "precio"=> $recarga[$i]['costo'],
              "preciol"=> $recarga[$i]['costol'],
              "date"=> $recarga[$i]['fecha'],
          );
      }
     $jsonr = json_encode($listr);
    }  
    $recar = json_decode($jsonr,true);
   
     for($i = 0; $i <count($recar); $i++){
            $fechare[] = $recar[$i]["l"];
     }
      $sumal =  array_sum($fechare);
     // echo json_encode($sumal);
  
   //costo de recorido
   $recorido = $request->costor();
   if(!empty($recorido )){
     for($i=0; $i< count($recorido); $i++){
        $listk [] = array(
            "id" => $recorido [$i]['id'],
            "litros" => $recorido [$i]['litros'],
            "fecha" =>$recorido [$i]['fecha_combustible'],
            "check" => $recorido [$i]['check_combustible'],
        );
        }
    } 
   $jsonkc = json_encode($listk);
   //echo  json_encode($listk);
   $jsondco = json_decode($jsonkc, true);
   //echo json_encode( $jsondco);
   $logch = count($jsondco);
   for($i=0; $i<$logch; $i++)
   {   // if($jsondco[$i]["fecha"] == $recar[$i]["date"]){}
       if($jsondco[$i]["check"] == 'inicio')
       {
            $litroin = $jsondco[$i]['litros'];
            $fechain = $jsondco[$i]['fecha'];
            $fechaina [] = array("fechas"=>$fechain,"litros"=>$litroin);
       }else{
            $litroin = $jsondco[$i]['litros'];
            $arrfin [] = array("litros"=>$litroin);
       }     
    } //
    $arrcol = array_column($fechaina,"litros");
    $fechai = array_column($fechaina, "fechas");
    $arrcol2 = array_column($arrfin,"litros");
    for($i=0; $i<count($fechaina); $i++)
    {       
        $total  = $arrcol[$i]-$arrcol2[$i];
       //$arrayt [] = array("fechas"=>$fechain,"precioLi"=>$total); 
       $arrayt [] = array("precioLi"=>$total);  
       
    } 
    $recargac = json_encode($listr);
    $jsonreca = json_decode($recargac,true);
    $combustible = json_encode($fechaina);
    $jsonCom = json_decode($combustible,true);
    for( $i = 0; $i<count($jsonCom); $i++)
   { 
    for( $j =0; $j <count($jsonreca); $j++)
    {
        $recofecha = $jsonCom[$i]["fechas"];
        $recofechar = $jsonreca[$j]["date"];
       if($recofecha = $recofecha)
        {
           $c=$jsonCom[$i]["litros"];
           $r = $jsonreca[$j]["l"];
           $total = $c + $r;
            //echo json_encode($c);
            $arraytotal []= array($total);
        }   
    }
   }
   $cotol = json_encode($arraytotal);

    /*for($j=0; $j<count($recar); $j++)
    {
        $fechar = $recar[$j]["date"];
        $precio = $recar[$j]["preciol"];
        $arrafe [] = array("fechar"=>$fechar, "preciol"=>$precio);
        
    }
       $fe = json_encode($arrayt);
       $fefin= json_decode($fe, true);
       $fe2 = json_encode($arrafe);
       $fefin2= json_decode($fe2, true);
    for($i=0; $i<count($fefin); $i++)
    { 
         //echo $fefin[$i]["fechas"];
        for($j=0; $j<count($fefin2); $j++)
        { 
          if($fefin[$i]["fechas"] === $fefin2[$j]["fechar"] )
          {
            $multi=$fefin[$i]["precioLi"]*$fefin2[$j]["preciol"];
            $arram []= array("subt"=>$multi);
           
          }  
        } 
    }
        //echo json_encode($arram);
        $arrtol = array_column($arram,"subt");
        $arrasuma= array_sum($arrtol).is_float(2);
        $det= json_encode( $arrasuma); 
        $descto= json_decode($det);*/
  
   //Funcion de Km recorido 
    $kmrecoridos = $request -> kmrecorido();
    if(!empty($kmrecoridos)){
        for($i=0; $i < count($kmrecoridos); $i++){
            $listkm [] = array(
                "kmi" => $kmrecoridos[$i]['km'],
            );
        }
       
        $jsonkm =json_encode($listkm);
        $jsondi = json_decode($jsonkm ,true);
       // echo $kmi;
    }
    $kmrecoridosf = $request -> kmrecoridofin();
    if(!empty($kmrecoridosf)){
        for($i=0; $i< count($kmrecoridosf); $i++){
            $listkmf [] = array(
                "kmf" => $kmrecoridosf[$i]['km'],
                
            );
        }
        $kmf =json_encode($listkmf);
        $jsondf = json_decode($kmf ,true);        
    }   
    
    $resukmf  = $jsondf[0]["kmf"];
    $resukmi = $jsondi[0]["kmi"];
   
    // LITROS DE COMBUSTIBLE CONSUMIDOS
    $kmrecorido = $request -> kmrecoridot();
    if(!empty($kmrecorido)){
        for($i=0; $i< count($kmrecorido); $i++)
        {
            $listkmt [] =array(
                "kmt" => $kmrecorido[$i]['km'],
            );
        }
        $jsonkmt = json_encode($listkmt);
    }
    $liscon = json_encode($listk);
    $decom = json_decode($liscon, true);
    for($i=0; $i<count($decom); $i++)
    {
        $litroc []= $decom[$i]['litros'];
    }
    $litro_con = 0;
    for($j=0; $j<count($litroc); $j++){
        
            $litro_con += ($litroc[$j]-$litroc[$j+1]);
            $j++;
    }
    $litros_costo = $litro_con +$sumal;
    //echo $litros_costo;
    for( $i = 0; $i<count($jsonCom); $i++)
    { 
     for( $j =0; $j <count($jsonreca); $j++)
     {
         $recofecha = $jsonCom[$i]["fechas"];
         $recofechar = $jsonreca[$j]["date"];
        if($recofecha = $recofecha)
         {
           $costol = $jsonreca[$j]["preciol"];
            $costoT = $costol * $litros_costo;
         }   
     }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Combustible</title>
    <style>
        .master {
            width: 100%;
            margin: 0px auto;
        }

        th {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #006ac1;
            /*background-color: #00AEEF;*/
            color: #000000;
        }

        h2 {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #000;
        }

        h3 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #000;
        }

        h4 {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
        }

        .label {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #000;
        }
        #contenedor {
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url(../img/ubiexpress.png);
        background-position: center;    
        background-size: cover;
        }       
    </style>
    <script src="../js/gasolina.js">


    </script>
</head>

<body>
    <main class="mt-5 pt-3">
        <div class="row justify-content-sm-center- mt-3">
            <div class="col-sm-auto text-center">
              <div id="contenedor">
            </div>
             <div >
                <h2 align="center"><label class="form-label text-uppercase fw-bold fs-3"> UBIEXPRESS</label><br></h2>
                <h2 align="center"><label class="form-label text-uppercase fw-bold fs-3">REPORTE DE CONSUMO DEL
                        COMBUSTIBLE</label><br></h2>
                <h3 align="center"><?php $fecha = date('d-M-Y');
                                           echo "$fecha <br>"?>
                </h3>
             </div>
                <div>
                    <label>Periodo de consumo de combustible</label> <?php  echo $fechain2;?> del:</label> <?php   echo  $fechafi1; ?>
                </div>              
                <div>
                    <table id="tableUnits" class="table table-striped table-boreded" style="width:100%">
                        <thead>
                            <tr align="center">
                                <th align="center">ID </th>
                                <th align="center">UNIDAD</th>
                            </tr>
                        </thead>
                        <td align="center"> <?php echo $id1;?></td>
                        <td align="center"><?php echo $unidad;?></td><br>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3 align="center"> <label class="form-label fw-bold"> Grafica</label></h3>
                    <?php         
                        $recarga2 = $request->recargagas2();
                        echo json_encode($recarga2);

                        for($i=0; $i<count($recar); $i++)
                        {
                            $litror = $recar[$i]['l'];
                            $fechaR = $recar[$i]['date'];
                            $arrayre [] = array("LitroRe" => $litror, "fechaR" => $fechaR);
                        }            
                        $recarga = json_encode($arrayre);
                        for($i=0; $i<count($jsondco);$i++)
                        {
                            $litro = $jsondco[$i]['litros'];
                            $fechac = $jsondco[$i]['fecha'];
                            $check = $jsondco[$i]['check'];
                            $arrayl []= array("litro"  => $litro);
                            $arraye [] = array("litro" => $litro, "fechac" => $fechac, "check" => $check);
                        }
                        $arraycol = array_column($arrayl, 'litro');
                         $aej = json_encode($arraye);
                      
                         for($i =0; $i<count($jsondco);$i++)
                         {
                            $litroc = $jsondco[$i]['litros'];
                            $fechac = $jsondco[$i]['fecha'];
                            $arrayf [] = array("afecha" => $fechac);
                            $checkc = $jsondco[0]['check'];
                           
                         }
                         for($i=0; $i<count($arrayf); $i++)
                         {
                             $row = $arrayf[0]['afecha'];
                            // echo json_encode($row);
                           if($arrayf[$i]['afecha'] === '2023-03-06')
                           {
                                 //cho json_encode($arrayf[$i]['afecha']);
                           }else{
                            // echo json_encode($arrayf[$i]['afecha']);
                           }

                         }
                         //echo json_encode($arrayf );

                       //echo implode(",", $arraycol );
                        for($j=0; $j<count($arraye); $j++)
                        {
                            if($arraye[$j]["check"] === "inicio")
                            {
                                if($arraye[$j]["fechac"] ===  $fechac)
                                {
                                    $sum = $arraye[$j]["litro"] + $litro;
                                    $array [] = array('litros' => $sum);
                                    //echo json_encode( $array);
                                }else{
                                    
                                   $sum = $arraye[$j]["litro"];
                                   $array [] = array('litros' =>$sum);
                                }
                            }
                            if($arraye[$j]["check"] === "fin")
                            {
                                $sum = $arraye[$j]["litro"];
                                $array [] = array('litros' =>$sum);
                            }
                        }
                        //echo json_encode($array);
                        
                        $resular = "";
                        foreach($arraycol as $rews)
                        {
                            $resular =$resular .",".$rews;
                            $cadena = trim($resular, ',');
                        }
                       //echo json_encode($cadena);
                        $arrelo = array($cadena);
                        $kmjson = json_decode($jsonkmt, true);
                        for($j=0; $j<count($kmjson); $j++)
                        {
                            $km = $kmjson[$j]['kmt'];
                            $arraykm1 [] = array("kmf"=>$km);
                        }
                         $arrcokm = array_column($arraykm1, 'kmf');
                        $resulkm = "";
                        foreach($arrcokm as $rekm)
                        {
                            //$resulkm = $resulkm . ",". $rekm;
                            $resulkm  = $resulkm.",".$rekm ;
                           $cadena1 = trim($resulkm, ',');   
                        }
                        //echo json_encode( $cadena1 );
                        $arrkmf= array($cadena1);
                        for($i=0; $i<count($arrelo); $i++)
                        {
                            for($j =0; $j<count($arrkmf); $j++)
                            { 
                     ?>
                    <img
                        src="https://quickchart.io//chart?w=360&h=200&v=2.9.4&c={type:'line', data:{labels: [<?php echo $arrkmf[$j];?>], 
                    datasets:[{label: '<?php echo $unidad;?>', borderColor: 'rgb(0, 191, 255)', data:[<?php echo $arrelo[$i];?>],lineTension: 0.2, fill:{target: {value: 30,},}}],}, 
                    options:{legend:{labels:{fontSize: 0, fontSyle: 'normal', fontColor: 'rgb(0, 0, 0)',}}, scales:{xAxes:[{ beginAtZero:true, scaleLabel: {display: true, labelString: 'Kilometraje', fontColor: 'rgb(0, 0, 0)', fontFamily: 'Mono', fontSize: 8,},ticks:{fontSize: 8},}], yAxes:[{ type:'linear', ticks:{fontSize: 8}, scaleLabel: {display: true, labelString: 'Combustible', fontColor: 'rgb(0, 0, 0)', fontFamily: 'Mono', fontSize: 7,},ticks:{fontSize: 8},}],}, 
                    plugins:{datalabels:{ display: true, align: 'top', offset: 5, labels:{title:{color: 'rgb(0, 0, 0)'},},borderRadius:20,backgroundColor: 'rgb(135, 206, 235)', font:{size: 5,},},}}}">
                    
                    <?php }} ?>
                </div>
                <div>
                    <h4><label class="form-label fw-bold">Recargas de Gasolina</label></h4>
                    <table id="table_gas_refill" class="table table-striped table-boreded" style="width:100%">
                        <thead>
                            <tr align="center">
                                <th align="center">No.</th>
                                <th align="center">FECHA</th>
                                <th align="center">COMBUSTIBLE</th>
                                <th align="center">LITROS</th>
                                <th align="center">COSTO</th>
                                <th align="center">COSTO/LITRO</th>
                            </tr>
                        </thead>
                        <?php        
                            $jsondr = json_decode($jsonr, true);
                            $logfn= count($jsondr);
                            for($i=0; $i < $logfn; $i++) {                
                        ?><tr>
                            <td align="center"><?php echo  $jsondr[$i]["no"];?></td>
                            <td align="center"><?php echo  $jsondr[$i]["date"];?></td>
                            <td align="center"><?php echo  $jsondr[$i]["comb"];?></td>
                            <td align="center"><?php echo  $jsondr[$i]["l"];?></td>
                            <td align="center"><?php echo  $jsondr[$i]["precio"];?></td>
                            <td align="center"><?php echo  $jsondr[$i]["preciol"];?></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
                <h4><label class="form-label fw bold"> Estadisticas</label> </h3>
            </div>
            <div>
                <table id="table_kilometros" class="table table-striped table-boreded" style="width: 100%;">
                    <thead>
                        <tr align="center">
                            <th>KILOMETROS RECORIDOS</th>
                        </tr>
                    </thead>
                    <tr>
                        <td align="center"><?php   $reta = $resukmf - $resukmi;  echo $reta, 'km'; ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <div class="row justify-content-center">
                    <div id="txt_liters_consumed" class="col-auto text-center">
                    </div>
                </div>
                <table id="table_Litros" class=" table table-striped table-boreded" style="width: 100%;">
                    <thead>
                        <tr>
                            <th align="center">LITROS DE COMBUSTIBLE CONSUMIDOS</th>
                        </tr>
                    </thead>
                    <?php ?><tr>
                        <td align="center"><?php echo   $litros_costo,'L';?></td>
                    </tr>
                </table>
            </div>
            <div>
                <table id="table_Costo" class="table table-striped table-boreded" style="width: 100%;">
                    <thead>
                        <tr>
                            <th align="center" >COSTO TOTAL DE RUTA</th>
                        </tr>
                    </thead>
                    <?php ?><tr>
                        <td align="center"><?php  echo '$',number_format(json_encode($costoT),2);?></td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
    </main>
</body>

</html>
<!--?php  
    require_once '../lib/dompdf/autoload.inc.php';
 
    use Dompdf\Dompdf;
    use Dompdf\Options;
    $options =new Options();
    $dompdf = new Dompdf();
    $options->set('isJavascriptEnabled', TRUE);
    $options->set('isRemoteEnabled', TRUE);
    $html=ob_get_clean();
    $dompdf= new Dompdf($options);
    $dompdf ->loadHtml($html);
    $dompdf ->setPaper('latter');
    $dompdf->render();
    $dompdf ->stream($unidad,);
    //$dompdf ->stream('Reporte.pdf', array("Attechment"=>false));
?-->