<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Get units</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
    
</head>
<body>

<div id="log"></div>
	<form action="../Panel.php" method="post">
		<h4> Unidades</h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="1"
					</code>
    			</pre>
			<div><input type="hidden" name="opcion" value="1"></div>
			<div><button class="subit">OBTENER JSON</button>
		</div>
	</form>
	<form action="../Panel.php" method="post">
	    <h4> Datos de combustible y kilometraje Total</h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="2"
					</code>
				</pre>
			<div><input type="hidden" name="opcion" value="2"></div>
		   <div><button class="subit">OBTENER JSON co</div>
	</form>

	<form action="../Panel.php" method="post">
		<h4>Kilometraje por Ruta </h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="3"
						name="fechai" value="15-12-2022 09:00 a.m."
						name="fechaf" value="15-12-2022 12:00 p.m."
					</code>
				</pre>
				<div><input type="hidden" name="opcion" value="3"></div>
		<div>De: <input type="datetime-local" name="fechai" value="15-12-2022 09:00 a.m."></div>
		<div>A:  <input type="datetime-local" name="fechaf" value="15-12-2022 12:00 p.m."></div>
		<div><button class="subit">OBTENER JSON co</div>
	</form>
	<form action="../Panel.php" method="post">
		<h4> Ruta de una Unidad  </h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="4"
						name="Unidad" value="C. ROJA SN-75-866"
						name="fechai" value="15-12-2022 09:00 a.m."
						name="fechaf" value="15-12-2022 12:00 p.m."
					</code>
				</pre>
		<div><input type="hidden" name="opcion" value="4"></div>
		<div>Unidad<input type="text" name="unidad" value="C. ROJA SN-75-866" ></div>
		<div>De: <input type="datetime-local" name="fechai" value="15-12-2022 09:00 a.m."></div>
		<div>A: <input type="datetime-local" name="fechaf" value="15-12-2022 12:00 p.m."></div>
		<div><button class="subit">OBTENER JSON co</div>
	</form>
	<form action="../Panel.php" method="post">
		<h4> Insertar Km </h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="5"
						
					</code>
				</pre>
		<div><input type="hidden" name="opcion" value="5"></div>
		<div><button class="subit">OBTENER JSON co</div>
	</form>
	</form>
	<form action="../Panel.php" method="post">
		<h4> Insertar combustible</h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="5"
						
					</code>
				</pre>
		<div><input type="hidden" name="opcion" value="6"></div>
		<div><button class="subit">OBTENER JSON co</div>
	</form>
	<form action="../Panel.php" method="post">
		<h4> Unidades </h4>
				<pre class="prettyprint">
					<code>
						method="post"
						name="opcion" value="5"
						
					</code>
				</pre>
		<div><input type="hidden" name="opcion" value="7"></div>
		<div><button class="subit">OBTENER JSON co</div>
	</form>


<script>
    $.ajax({
		url:"Respuesta.php",
		type: "POST",
		data: 'user'

	});
</script>
	</body>
</html>