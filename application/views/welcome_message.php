<!DOCTYPE html>
<<<<<<< HEAD
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Transporte</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <!-- Card para Ingreso -->
    <div class="card mb-3">
      <div class="card-header">
        Ingreso
      </div>
      <div class="card-body">
        <!-- Formulario con la acción POST -->
        <form action="<?php echo site_url('formulario/guardar'); ?>" method="POST">
          <div class="form-group">
            <label for="patenteCamionIngreso">Patente Camión</label>
            <input type="text" class="form-control" id="patenteCamionIngreso" name="patente_camion" placeholder="Ingrese la patente del camión" required>
          </div>
          <div class="form-group">
            <label for="patenteAcopladoIngreso">Patente Acoplado</label>
            <input type="text" class="form-control" id="patenteAcopladoIngreso" name="patente_acoplado" placeholder="Ingrese la patente del acoplado" required>
          </div>
          <div class="form-group">
            <label for="tipoMic">Tipo de MIC</label>
            <select class="form-control" id="tipoMic" name="tipo_mic">
              <option value="bolivia">Bolivia</option>
              <option value="chile">Chile</option>
              <option value="peru">Perú</option>
            </select>
          </div>
          <div class="form-group">
            <label for="mic">MIC</label>
            <input type="text" class="form-control" id="mic" name="mic" placeholder="Ingrese el número de MIC" required>
          </div>
          <div class="form-group">
            <label for="carnetSanitario">Carnet Sanitario</label>
            <select class="form-control" id="carnetSanitario" name="carnet_sanitario">
              <option value="SI">SI TIENE</option>
              <option value="NO">NO TIENE</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ingresoPais">Ingreso País</label>
            <input type="text" class="form-control" id="ingresoPais" name="ingreso_pais" placeholder="Ingrese el país de ingreso" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
=======
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

>>>>>>> d3950fb (first commit)
</body>
</html>