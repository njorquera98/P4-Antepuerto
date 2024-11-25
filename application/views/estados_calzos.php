<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estado de los Calzos</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .calzo {
      width: 100px; /* Ajusta el tamaño para caber más calzos */
      height: 60px;
      margin: 8px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: white;
      position: relative;
      font-size: 14px;
      text-align: center;
      padding: 5px;
      box-sizing: border-box;
      transition: transform 0.3s ease;
    }

    .calzo.disponible {
      background-color: #28a745;
    }

    .calzo.ocupado {
      background-color: #dc3545;
    }

    /* Contenedor de Calzos */
    .calzo-container {
      display: flex;
      justify-content: center; /* Centra los calzos en la fila */
      flex-wrap: nowrap; /* Evita que los calzos se distribuyan en varias filas */
      overflow-x: auto; /* Permite desplazamiento horizontal si los calzos exceden el ancho de la pantalla */
      padding: 10px 0; /* Espacio superior e inferior */
    }

    .calle {
      height: 30px;
      background-color: #f8f9fa;
      width: 100%;
      margin: 60px 0;
    }

    .espaciador {
      height: 50px;
    }

    /* Asegura que el contenedor se ajuste a la pantalla sin mostrar la barra */
    .container-fluid {
      padding-left: 0;
      padding-right: 0;
    }
  </style>
</head>
<body>
  <div class="container-fluid mt-5">


  <h3>Calzos disponibles: <?php echo isset($calzos_libres) ? $calzos_libres : 'Información no disponible'; ?></h3>



<!--
    <h2 class="mb-5 text-center" style="margin-top: 50px;">Estado de los Calzos</h2>
    <h3 class= "mb-5 text-center" style="margin-top: 50px;">Calzos Totales Sector 1</h3>
    <h3 class= "mb-5 text-center" style="margin-top: 50px;">Calzos Libres</h3>
    <h3 class= "mb-5 text-center" style="margin-top: 50px;">Calzos Totales Sector 3</h3>
    <h3 class= "mb-5 text-center" style="margin-top: 50px;">Calzos Libres</h3>
-->
    <div class="espaciador"></div>

    <!-- Contenedor de Calzos -->
    <div class="calzo-container">
      <?php foreach ($calzos as $calzo): ?>
        <div class="calzo <?php echo $calzo['estado'] == 'libre' ? 'disponible' : 'ocupado'; ?>" title="Camión: <?php echo $calzo['camion_designado']; ?>">
          Calzo #<?php echo $calzo['numero_calzo']; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="calle"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
