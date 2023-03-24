<?php
session_start();
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

        <div class="container-fluid" style="height: auto" id="testing">
            <div class="row justify-content-sm-center mt-5">
                <div class="col-sm-auto text-center">
                    <label class="form-label text-uppercase fw-bold fs-3">Unidades Asiganadas</label>
                    
                </div>
            </div>
            <div class="row justify-content-sm-end mt-3">
                <div class="col-sm-auto text-right">
                    <form method="post" id="make_pdf" action="dompdf.php">

                        <!--button type="button" class="btn btn-danger" id="Desacarga">DESCARGAR PDF</button-->
                        </input>
                    </form>
                </div>
            </div>

            <div class="row justify-content-sm-center mt-3">
                <div class="col-sm-auto">
                    <label class="form-label fw-bold">Elija un rango de fechas:</label>
                </div>
            </div>

            <div class="row justify-content-sm-center mt-3">
                <div class="col-sm-auto">
                    <label class="form-label fw-bold">Del:</label>
                </div>

                <div class="col-sm-auto">
                    <form method="POST" action="dompdf.php" name="fechain">
                        <!--input type="date" class="form-control" onchange="" name="dateCheckInicio" id="dateCheckInicio"-->
                        <input type="date" class="form-control" name="dateCheckInicio" id="dateCheckInicio">

                    </form>
                </div>

                <div class="col-sm-auto">
                    <label class="form-label fw-bold">al:</label>
                </div>

                <div class="col-sm-auto">
                    <input type="date" class="form-control" onchange="" name="dateCheckFin" id="dateCheckFin">
                </div>

            </div>

            <div class="row justify-content-center mt-4" style="height: 100%;">

                <div id="table" class="col-auto text-center" style="height: 100%">
                    <?php include_once "tables/tableUnits.php" ?>
                </div>
                </input>
                <div class="col text-center">
                    <div class="container-chart">
                        <canvas id="canvasChart">
                        </canvas>
                    </div>

                </div>

            </div>

            <div id="statistics" class="row justify-content-center mt-4 py-4 mb-5">
                <div class="col-auto text-center">
                    <label class="form-label text-uppercase fw-bold fs-5">Estadisticas</label>
                </div>

                <div class="row mt-3">
                    <div id="gas-consumed" class="col-4 text-center ms-3">
                        <label class="form-label text-uppercase fw-bold fs-6">Recargas de gasolina</label>
                        <div class="row justify-content-md-center">
                            <?php include_once "tables/table_gasoline_refills.php"?>
                        </div>
                    </div>
                    <div class="col text-center mx-3">
                        <div class="row justify-content-md-between ms-3">
                            <div id="km_traveled" class="col-3 text-center my-2">
                                <label class="form-label text-uppercase fw-bold fs-6">Kilometros recorridos</label>
                                <div class="row justify-content-center">
                                    <div id="txt_km_traveled" class="col-auto text-center">

                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto text-center">
                                        <input type="hidden" name="hidden_html" id="hidden_html">
                                        <a data-bs-toggle="modal" data-bs-target="#modalKmDetails">Ver
                                            </input>
                                            detalles</a>
                                    </div>
                                </div>
                            </div>

                            <div id="litters_consumed" class="col-3 text-center my-2">
                                <label class="form-label text-uppercase fw-bold fs-6">Litros de combustible
                                    consumidos</label>
                                <div class="row justify-content-center">
                                    <div id="txt_liters_consumed" class="col-auto text-center">

                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto text-center">
                                        <a href="#">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <!--Ejemplo de combustible -->
                            <div id="litters_consumed" class="col-3 text-center my-2">
                                <label class="form-label text-uppercase fw-bold fs-6">Costo total de ruta:</label>
                                <div class="row justify-content-center">
                                    <div id="txt_liters_consumedf" class="col-auto text-center">

                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto text-center">
                                        <a href="#">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <!--div id="litters_consumed" class="col-3 text-center my-2">
                                <label class="form-label text-uppercase fw-bold fs-6">ejemplo</label>
                                <div class="row justify-content-center">
                                    <div id="txt_liters_consumedff" class="col-auto text-center">

                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto text-center">
                                        <a href="#">Ver detalles</a>
                                    </div>
                                </div-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>


    <!-- MODALS -->
    <?php include_once 'modals/ModalKmDetails.php' ?>
    <!-- /MODALS -->


    <!-- JAVASCRIPT -->
    <!--script src="../js/gasolina.js"></script-->
    <!--script src="../js/gasolina.js"></script-->
    <script src="../js/Gas.js"></script>
    <!--script src="../js/NuevoGas.js"></script-->
    <!--script src="../js/grafica.js"></script-->
    <!-- /JAVASCRIPT -->


</body>

</html>
