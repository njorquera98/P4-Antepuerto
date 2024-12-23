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
        Ingreso de Camión
      </div>
      <div class="card-body">
        <!-- Formulario con la acción POST para enviar los datos -->
        <?php echo form_open('home/agregar'); ?>
        
        <div class="form-group">
          <label for="patenteCamionIngreso">Patente Camión</label>
          <input type="text" class="form-control" id="patente" name="patente_camion" placeholder="Ingrese la patente del camión" required>
        </div>

        <div class="form-group">
          <label for="patenteAcopladoIngreso">Patente Acoplado</label>
          <input type="text" class="form-control" id="acoplado" name="patente_acoplado" placeholder="Ingrese la patente del acoplado">
        </div>

        <div class="form-group">
          <label for="tipoMic">Tipo de MIC</label>
          <select class="form-control" id="tipoMic" name="tipo_mic">
            <option value="No Tiene">No Tiene</option>
            <option value="bolivia">Bolivia</option>
            <option value="chile">Chile</option>
            <option value="peru">Perú</option>
          </select>
        </div>

        <div class="form-group">
          <label for="mic">MIC</label>
          <input type="text" class="form-control" id="mic" name="mic" placeholder="Ingrese el número de MIC">
        </div>

        <div class="form-group">
          <label for="ingresoPais">Ingreso País</label>
          <input type="datetime-local" class="form-control" id="entradapais" name="entradapais" required>
        </div>

        <!-- Mostrar el calzo asignado si existe -->
        <?php if (isset($calzo_asignado)): ?>
          <div class="alert alert-success mt-3">
            <strong>Calzo asignado:</strong> El calzo con ID <?php echo $calzo_asignado; ?> ha sido asignado al camión.
          </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Enviar</button>
        
        <?php echo form_close(); ?>
      </div>
    </div>
    <!-- Card para Salida -->
    <div class="card mb-3">
    <div class="card-header">
        Salida
    </div>
    <div class="card-body">
        <?php echo form_open('home/liberarCalzoPorPatente'); ?>
        <div class="form-group">
            <label for="patenteCamionSalida">Patente Camión</label>
            <input type="text" class="form-control" id="patenteCamionSalida" name="patenteCamionSalida" placeholder="Ingrese la patente del camión" required>
        </div>
        <button type="submit" class="btn btn-primary">Liberar Calzo</button>
        <?php echo form_close(); ?>
    </div>
</div>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
