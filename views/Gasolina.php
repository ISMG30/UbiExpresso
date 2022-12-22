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
        <div class="container">
            <div class="row justify-content-sm-center mt-5">
                <div class="col-sm-auto text-center">
                    <label  class="form-label fw-bold">Unidades asiganadas</label>
                </div>                
            </div>
        </div>
    </main>
</body>
</html>