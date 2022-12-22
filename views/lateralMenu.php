<!-- offCanvas -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">


    <div class="offcanvas-header">

        <h5 class="offcanvas-title text-center" id="offcanvasExampleLabel"><?php echo $_SESSION['user'] ?></h5>
        <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <!-- MODULOS -->
        <nav class="navbar-dark mt-5 mb-3">

            <ul class="navbar-nav">
                <!-- Divisory line between sections -->
                <li class="my-2">
                    <hr class="navbar-divider">
                </li>
                <!-- /Divisory line between sections -->

                <a class="nav-link px-3 active" href="Unidad.php">

                    <span class="me-2">
                    <i class="bi bi-car-front-fill"></i>
                    </span>

                    <span>
                        Unidades
                    </span>

                </a>

                <a class="nav-link px-3 active" href="#">

                    <span class="me-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    </span>

                    <span>
                        Recorridos
                    </span>

                </a>

                <a class="nav-link px-3 active" href="Gasolina.php">

                    <span class="me-2">
                    <i class="bi bi-fuel-pump-fill"></i>
                    </span>

                    <span>
                        Gasolina
                    </span>

                </a>               

                <!-- Divisory line between sections -->
                <li class="my-4">
                    <hr class="navbar-divider">
                </li>
                <!-- /Divisory line between sections -->                

            </ul>
        </nav>

        <!-- /MODULOS -->

    </div>
</div>

<!-- /offCanvas -->