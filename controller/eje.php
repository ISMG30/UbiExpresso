<?php 

    include '../config/conexionlogin.php';
    include '../config/wialon.php';

    $ver = new conexionlogin();
    $metodo = $ver -> conexion();
    $jsone = json_encode($metodo);
    $jsond = json_decode($jsone, true);
    foreach($jsond as $rowes){

          echo $rowes['token'] ,'<br/>';
          /*$wialon_api = new Wialon();
          $result = $wialon_api->login($row['token']);
          $json = json_decode($result, true);
           if(!isset($json['error']))
           {    
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
                 //echo $wialon_api->core_search_items(json_encode($params));
                 $dato = $wialon_api->core_search_items(json_encode($params));
                 $resul =json_decode($dato, true);
                 if(!isset($resul['error']))
                 {
                   $array=[];
                   foreach($resul['items'] as $row)
                   {
                      //$user1 = $user['items'];
                      $array []= array(
                         'id' => $row['id'],
                         'user'=>$row['nm']
                      );             
                   }
                  $resu = json_encode($array); 
                  //echo  json_encode($array); 
                        
                 } 
                 //$unidad = json_decode($resu);
                 echo $resu ;    
           }*/
           
        $wialon_api = new Wialon();
        $result = $wialon_api -> login($rowes['token']);
        $json =json_decode($result, true);
        if(!isset($json['error']))
        {
          // Buscar articulos  por propiedad   https://sdk.wialon.com/wiki/en/local/remoteapi2004/apiref/core/search_items
          $params = array(                  
            'spec' => array(                  //Especificacion de búsqueda      
                'itemsType' => 'avl_unit',    // Tipo de Busqueda
                'propName'=> 'sys_name',      //Nombre de la propiedad cuyo valor se buscará
                'propValueMask' =>'*',        //Máscara de valor de propiedad
                'sortType' => 'sys_name'      //Nombre de la propiedad utilizada para clasificar
            ),
            'force' => 1,                     //0: si se ha realizado dicha búsqueda, devuelve el resultado almacenado en caché, 1: para realizar una nueva búsqueda
            'from' => 0,                      //Indice del primer elemento devuelto 
            'to'=>0,                          //Indice del último elemento devuelto 
            'flags' => 4611686018427387903    //Indicadores de datos para la respuesta
          );     
        $dato = $wialon_api->core_search_items(json_encode($params));  //Se usa el comando core/search_items
        $resul = json_decode($dato, true);
          if(!isset($resul['error']))
          {
             $array = [];

             foreach($resul['items'] as $row)
             {
               $id = $row['id'];
               
              //Valores  de los sensores del último mensaje  https://sdk.wialon.com/wiki/en/local/remoteapi2004/apiref/unit/calc_last_message
               $params = array(
                'unitId'=> $id,                 //Identificación  de la unidad
                'sensores'=> 1,                 //Matriz de ID de sensores
                'flags' => 0x01                 //Bandera
                ); 
              $dato = $wialon_api->unit_calc_last_message(json_encode($params)); //Se usa el comando unit/calc_last_message
              $ver = json_decode($dato, true);
              if(!isset($ver['error']))
              { 
                if($ver && ['1'])
                {
                   $com = $ver['1'];
                   //$kmh = $ver['2']; // Cuando esta en moviento nos manda el Km
                                  
                   $array []= array(
                    'id' => $row['id'],
                    'user' => $row['nm'],
                    'com' =>$com,
                    'km'=>$row['cnm']
                    //'kmh' => $kmh
                   );             
                }
               }  
              }
                 echo json_encode($array);  
                $resu = json_encode($array);
                //$resul = json_decode($resu);
                //return $resu;
          }
        }
    }

?>