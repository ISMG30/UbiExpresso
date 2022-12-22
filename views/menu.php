<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="p-3 m-0 border-0 bd-example">
    <!-- <link rel="stylesheet" href="ejemplob.css">-->
    <!-- Example Code -->

    <nav class="navbar navbar-dark bg-dark fixed-top ">
        <div class="container-fluid ">
            <a class="navbar-brand mb-3 mx-auto " href="#">UbiExpress </a>
            <div class="offcanvas-header ">
                <img src="../imagenes/descarga.png" height="15">
                <img src="../imagenes/bootstrap-solid.svg" width="30" height="30" alt="">
            </div>

            <button class="navbar-toggler  position-absolute  " type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon "></span>
            </button>

            <!-- <div class="offcanvas offcanvas-end text-bg-dark " tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">-->
            <div class="offcanvas offcanvas-start w-20 text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title position-relative" id="offcanvasDarkNavbarLabel" style="clear: left;">
                        Bienvenidos

                    </h5>
                    <button type="button" class="btn-close btn-close-white " data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/Ubiexpresso/views/Unidad.php" id="unidades">Unidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/Ubiexpresso/views/mapa.html" href="#">Recoridos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gasolina</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">


                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!--<iframe class="iframe" src="mapa2.html"></iframe>-->

    <!-- End Example Code -->
</body>

</html>