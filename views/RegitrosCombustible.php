<?php include_once "../config/conectionDB.php"?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Registro de Combustible</title>
        <?php include_once "../lib/lib.php"?>
        <link rel="stylesheet" href="../styles/style_gasolina.css">
    </head>
    <body>
        <?php include_once "nav.php"?>
        <?php include_once "lateralMenu.php" ?>
        <main class = "mt-5 pt-3">
            <div  class="contariner-fluid" style="height: auto;">
             <div class="row justify-content-sm-center mt-4">
                <div class="col-sm-auto text-center">
                    <label class="from-label text-uppercase fw-bold fs-3">Registro de Combustible</label>
                </div>
             </div>
    
             <!--form action="../controller/controllerGasolina.php" method="post"-->
             <form action="../controller/controllerGasolina.php" method="post">
                <div><input type="hidden" name="opcion" value="1"></div>
                <div class="row justify-content-sm-end mt-4" style="height: 100%;">
                <div id="table" class="col text-center" style="height: 100%">
             
             Unidad:  <select name="unidades">
                        <option value="103">TRAILER CASCADIA SN-88-974</option>
                        <option value="302">C. ROJA SN-75-866</option>
                        <option value="341">C. ROJA SN-75-862</option>
                      </select></br>
             Litros: <input name="litros" type="text"></br> 
             Tipo Combustible: <select name="tipoC">
                                    <option value="1" >Gasolina</option>
                                    <option value="2" >Disel</option>
                               </select></br>
             Costo Litros:  <input name="clitro" type="text"></br>

             Fecha: <input name="fecha" type="date"></br>

             <div><button class="" type="submuit">Insertar </button>
             </div>
            </div>
             </form> 
             
           
    </body>
    <script src="../js/combustible.js"></script>
</html>