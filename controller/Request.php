<?php 
require "../config/conectionDB.php";


class Request{
    public $cnx;
    

    function __construct(){
        $this->cnx = Conexion::ConectarDB();
    }

    function unitList(){
        
        $query = "SELECT * FROM unidad";
        $result = $this->cnx->prepare($query);
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

    function gasFillList($id, $date){
        $query = "SELECT
        TC.nombre as combustible, E.litros, E.totalCosto as costo, round((E.totalCosto / E.litros),2) as costol, E.fecha
        FROM entradas_combustible as E INNER JOIN tipo_combustible as TC 
        ON E.tipo_combustible = TC.id_tipo_com
        WHERE E.id_unidad = ? 
        AND E.fecha = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$date);
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

    function gasFillList2($id, $dateStart, $dateEnd){
        $query = "SELECT
        TC.nombre as combustible, E.litros, E.totalCosto as costo, round((E.totalCosto / E.litros),2) as costol, E.fecha
        FROM entradas_combustible as E INNER JOIN tipo_combustible as TC 
        ON E.tipo_combustible = TC.id_tipo_com
        WHERE E.id_unidad = ? 
        AND E.fecha BETWEEN ? AND ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$dateStart);
        $result->bindParam(3,$dateEnd);
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

    function getLitersDatesBetween($id, $startDate, $endDate){
        $query = "SELECT U.id_unidad AS id, U.nombre AS unidad, 
        C.litros, C.fecha as fecha_combustible, C.tipo_check as check_combustible
        FROM unidad as U INNER JOIN combustible AS C ON U.id_unidad = C.id_unidad
        WHERE U.id_unidad = ?
        AND C.fecha BETWEEN ? AND ?;";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$startDate);
        $result->bindParam(3,$endDate);
        
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

    function getLitersOneDate($id, $date){
        $query = "SELECT U.id_unidad AS id, U.nombre AS unidad, 
        C.litros, C.fecha as fecha_combustible, C.tipo_check as check_combustible
        FROM unidad as U INNER JOIN combustible AS C ON U.id_unidad = C.id_unidad
        WHERE U.id_unidad = ?
        AND C.fecha = ?;";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$date);
        
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

    function getKmDatesBetween($id, $startDate, $endDate){
        $query = "SELECT 
        U.id_unidad AS id, U.nombre AS unidad, 
        K.km, K.fecha as fecha_km, K.tipo_check as check_km
        FROM unidad as U INNER JOIN kilometraje AS K ON U.id_unidad = K.id_unidad
        WHERE U.id_unidad = ?
        AND K.fecha BETWEEN ? AND ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$startDate);
        $result->bindParam(3,$endDate);
        
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

    function getKmOneDate($id, $date){
        $query = "SELECT 
        U.id_unidad AS id, U.nombre AS unidad, 
        K.km, K.fecha as fecha_km, K.tipo_check as check_km
        FROM unidad as U INNER JOIN kilometraje AS K ON U.id_unidad = K.id_unidad
        WHERE U.id_unidad = ?
        AND K.fecha = ?";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$date);
        
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

    function getRangeDates($id,$dateStart,$dateEnd) {
        $query = "SELECT
        TC.nombre as combustible, E.litros, E.totalCosto as costo, round((E.totalCosto / E.litros),2) as costol, E.fecha
        FROM entradas_combustible as E INNER JOIN tipo_combustible as TC 
        ON E.tipo_combustible = TC.id_tipo_com
        WHERE E.id_unidad = ? 
        AND E.fecha BETWEEN ? AND ?
        ORDER BY E.fecha ASC";
        $result = $this->cnx->prepare($query);
        $result->bindParam(1,$id);
        $result->bindParam(2,$dateStart);
        $result->bindParam(3,$dateEnd);
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
    function getRecargaComb1($id,$date)
    {
        $query = "SELECT U.id_unidad AS id, U.nombre AS unidad, C.litros, C.fecha as fecha_combustible FROM unidad as U 
        INNER JOIN entradas_combustible AS C ON U.id_unidad = C.id_unidad WHERE U.id_unidad = ? AND 
        C.fecha = ?  ";
         $result = $this->cnx->prepare($query);
         $result->bindParam(1,$id);
         $result->bindParam(2,$date);
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

}


?>