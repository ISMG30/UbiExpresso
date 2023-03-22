<?php

class Conexion {

    static function Conectar()
    {
        try {

            require "conexion.php";

            $cnx = new PDO(DSN,USERNAME,PASSWORD);

            return $cnx;

        } catch (PDOException $ex){

            die($ex->getMessage());

        }


    }
    


}

?>