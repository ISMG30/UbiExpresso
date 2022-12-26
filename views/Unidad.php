<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Get units</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
    
</head>
<body>

<p>Select unit: <span id="units"></span></p>
<div id="log"></div>
	<form action="../Panel.php" method="post">
		<h2> Usuario</h2>
    <div><input type="hidden" name="opcion" value="1"></div>
    <div><button class="nav-link mb-0 px-0 py-1 active ">OBTENER JSON</button>
		</div>
	</form>
	<form action="../Panel.php" method="post">
		<h1> Unidades</h1>
	<div><input type="hidden" name="opcion" value="2"></div>
	<div>Unidad<input type="text" name="unidad" value="C. ROJA SN-75-866"></div>
	<!--div>Unidades<select type="textbox" name="unidad"></div-->
	<div><button class="subit">OBTENER JSON</button>
	</div>
	</form>

	<form action="../Panel.php" method="post">
		<h1> Co</h1>
		<div><input type="hidden" name="opcion" value="3"></div>
		<div>Unidad<input type="text" name="unidad" value="C. ROJA SN-75-866"></div>
		<!--div>Unidades<select type="textbox" name="unidad"></div-->
		<div><button class="subit">OBTENER JSON</button>
		</div>
	</form>
	<form action="../Panel.php" method="post">
		<h1> Datos de combustible y kilometraje</h1>
		<div><input type="hidden" name="opcion" value="4"></div>
		<div>Unidad<input type="text" name="unidad" value="C. ROJA SN-75-866"></div>
		<!--div>Unidades<select type="textbox" name="unidad"></div-->
		<div><button class="subit">OBTENER JSON co
<script>
    $.ajax({
		url:"Respuesta.php",
		type: "POST",
		data: 'user'

	});
	

    </script>
	</body>
</html>