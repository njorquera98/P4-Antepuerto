<!DOCTYPE html>
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
        <?php echo form_open('welcome/agregar'); ?>
<div class="form-group">
    <label for="patenteCamionIngreso">Patente Camión</label>
    <input type="text" class="form-control" id="patente" name="patente_camion" placeholder="Ingrese la patente del camión" required>
</div>
<div class="form-group">
    <label for="patenteAcopladoIngreso">Patente Acoplado</label>
    <input type="text" class="form-control" id="acoplado" name="patente_acoplado" placeholder="Ingrese la patente del acoplado" required>
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
    <label for="ingresoPais">Ingreso País</label>
    <input type="datetime-local" class="form-control" id="entradapais" name="entradapais" placeholder="Ingrese el país de ingreso" required>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
<?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
