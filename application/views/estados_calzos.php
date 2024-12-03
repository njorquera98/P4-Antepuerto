<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estado de los Calzos</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .calzo-container {
        display: flex; /* Alinea las filas horizontalmente */
        justify-content: center; /* Centra las filas horizontalmente */
        gap: 90px; /* Aumenta el espacio entre las filas */
        margin: 20px;
    }

    .fila {
        display: flex;
        flex-direction: column; /* Los calzos dentro de una fila son verticales */
        align-items: center; /* Centra el contenido horizontalmente */
        gap: 10px; /* Espacio entre los elementos de la fila */
    }

    .fila h4 {
        margin: 0;
        font-size: 1.2rem; /* Ajusta el tamaño de texto del título de cada fila */
    }

    .calzos {
        display: flex;
        flex-direction: column; /* Alinea los calzos verticalmente */
        gap: 10px; /* Espaciado entre los calzos */
    }

    .calzo {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        width: 80px;
    }

    .calzo.disponible {
        background-color: #d4edda;
        color: #155724;
    }

    .calzo.ocupado {
        background-color: #f8d7da;
        color: #721c24;
    }

    .titulo {
    text-align: center;
    margin-bottom: 20px;
    margin-top: 50px; /* Aumenta el margen superior */
}
  </style>
</head>
<body>
<div class="titulo text-center">
  <h2>Estado de los Calzos</h2>
  <p>Sector 1: <?php echo isset($calzos_libres_sector1) ? $calzos_libres_sector1 : 0; ?> disponibles</p>
  <p>Sector 3: <?php echo isset($calzos_libres_sector3) ? $calzos_libres_sector3 : 0; ?> disponibles</p>
</div>

<div class="calzo-container">
    <?php foreach ($calzos_por_fila as $fila => $calzos): ?>
        <div class="fila">
            <h4>Fila <?php echo $fila; ?></h4>
            <div class="calzos">
                <?php foreach ($calzos as $calzo): ?>
                    <div 
                        class="calzo <?php echo $calzo['estado'] == 'libre' ? 'disponible' : 'ocupado'; ?>" 
                        title="Camión: <?php echo isset($calzo['camion_designado']) ? $calzo['camion_designado'] : 'Ninguno'; ?>">
                        <?php echo $calzo['numero_calzo']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>