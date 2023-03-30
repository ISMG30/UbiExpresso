<?php
 session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unidades</title>
        <?php include_once "../lib/lib.php"?>
        <link rel="stylesheet" href="../styles/style_gasolina.css">
    </head>
    <body>
        <?php include_once "nav.php"?>
        <?php include_once "lateralMenu.php"?>
        <main class = "mt-5 pt-3">
            <div class="contariner-fluid" style="height:auto">
               <div class ="row justify-content-sm-center mt-4">
                 <div class="col-sm-auto text-center">
                    <label class="from-label text-uppercase fw-bold fs-3">Unidades</label>
                 </div>
               </div>
               <div class="row justify-content-center mt-4" style="height: 100%;">
                   <div id="table" class="col-auto text-center" style="height: 100%;">
                        <?PHP include_once "tables/tableUnidades.php "?>

                   </div>                
               </div>
        </main>
    
        
         <script src="../js/gasolina.js"></script>
         <script src="../js/unidades.js"></script>
    </body>
</html>