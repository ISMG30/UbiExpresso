<?php
session_start();
include_once "../config/validateUser.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasto de gasolina</title>
    <?php include_once "../lib/lib.php" ?>
    <link rel="stylesheet" href="../styles/style_gasolina.css">
</head>

<body>
    <?php include_once "nav.php" ?>
    <?php include_once "lateralMenu.php" ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row justify-content-sm-center mt-5">
                <div class="col-sm-auto text-center">
                    <label class="form-label fw-bold">Unidades Asiganadas</label>
                </div>
            </div>
            <div class="row justify-content-sm-end mt-3">
                <div class="col-sm-auto text-right">
                    <button type="button" class="btn btn-danger">DESCARGAR PDF</button>
                </div>
            </div>

            <div class="row d-flex mt-3">
                <div id="table" class="col-4 border border-4 rounded-4" style="height: 500px; min-height: 100%; overflow-y: scroll;">
                    <?php include_once "tables/tableUnits.php" ?>
                </div>
                <div id="chart" class="col flex-grow-1" style="height: 500px; width: 200px;">
                    <canvas id="canvasChart">

                    </canvas>
                </div>
            </div>
            
        </div>
    </main>
    <!-- JAVASCRIPT -->
    <script src="../js/gasolina.js"></script>
    <!-- /JAVASCRIPT -->

</body>

</html>