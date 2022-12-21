<?php
//Aqui va a ir el LOGIN

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="config/login.php">
    <title>Wialon Playground - Get units</title>

    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
    <script type="text/javascript" src="https://hst-api.wialon.com/wsdk/script/wialon.js"></script>
    <script type="text/javascript" src=" https://kit-api.wialon.com"></script>
</head>

<body>
    <div id="contenedor">
        <div class="container">
            <form id="loginform" class="form-horizontal" action="../UbiExpresso/config/login.php" method="post">
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
                                <input type="texto" class="form-control" name="usuario" id="inputEmail3"
                                    placeholder="Usuario" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="contraseña" id="inputPassword3"
                                    placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div>
                            <input type="checkbox" name="Recordar" /><label>Recordar</label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>