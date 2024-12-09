<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Calzo de Camión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center mb-4">Modificar Calzo de Camión</h2>

        <!-- Tabla de Calzos Ocupados -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Sector</th>
                        <th>Fila</th>
                        <th>Número de Calzo</th>
                        <th>Camión Designado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($calzosOcupados)): ?>
                        <?php foreach ($calzosOcupados as $calzo): ?>
                            <tr>
                                <td><?= $calzo['sector']; ?></td>
                                <td><?= $calzo['fila']; ?></td>
                                <td><?= $calzo['numero_calzo']; ?></td>
                                <td><?= $calzo['camion_designado']; ?></td>
                                <td>
                                    <!-- Formulario para modificar -->
                                    <form action="<?= site_url('home/modificar') ?>" method="post">
                                        <input type="hidden" name="calzo_actual_id" value="<?= $calzo['id']; ?>">
                                        <input type="hidden" name="camion_designado" value="<?= $calzo['camion_designado']; ?>">
                                        <div class="mb-2">
                                            <label for="nuevo_calzo" class="form-label">Nuevo Calzo:</label>
                                            <select name="nuevo_calzo_id" class="form-select" required>
                                                <option value="" disabled selected>Seleccione un calzo</option>
                                                <?php foreach ($calzos_libres as $libre): ?>
                                                    <option value="<?= $libre['id']; ?>">
                                                        Número: <?= $libre['numero_calzo']; ?>, 
                                                        Sector: <?= $libre['sector']; ?>, 
                                                        Fila: <?= $libre['fila']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay calzos ocupados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
