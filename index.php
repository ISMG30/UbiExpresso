<?php
session_unset();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/login.css">
    <title>UBIEXPRESS</title>

    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
    <script type="text/javascript" src="https://hst-api.wialon.com/wsdk/script/wialon.js"></script>
    <script type="text/javascript" src=" https://kit-api.wialon.com"></script>
    <link rel="stylesheet" href="lib/Toastr/toastr.min.css">
    <script src="lib/Toastr/toastr.min.js"></script>
</head>

<body>
    <div id="contenedor">
        <div class="container">
            <form id="loginform" class="form-horizontal" action="./config/login.php" method="post">
                <div id="contenedorcentrado">
                    <div id="derecho">
                        <div class="titulo">
                            <h1>UbiExpress</h1>                            
                        </div>
                    </div>
                    <div id="login">
                        <div class="form-group col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label">Usuario</label>
                            <div class="col-sm-10">
                                <!--input type="text" class="form-control" name="usuario" id="inputEmail3" placeholder="Usuario" required-->
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
                            <div class="col-sm-10">
                                <!--input type="password" class="form-control" name="contraseña" id="inputPassword3" placeholder="Contraseña" required-->
                                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div>
                            <input type="checkbox" name="Recordar" /><label>Recordar</label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="btn_login" class="btn btn-default">Ingresar</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>

