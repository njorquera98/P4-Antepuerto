<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//parte 1
    public function obtenerCalzosSimplificadoPorFila($fila) {
        $this->db->select('numero_calzo, estado');
        $this->db->where('fila', $fila);
        $this->db->order_by('numero_calzo', 'ASC');
        $query = $this->db->get('calzos');
        
        return $query->result_array(); // Devuelve un arreglo con 'numero_calzo' y 'estado'
    }

    public function verificarReglaEspacios($fila) {
        // Obtener los calzos de la fila específica
        $estructuraFila = $this->obtenerCalzosSimplificadoPorFila($fila);
    
        // Iterar sobre cada calzo en la fila
        foreach ($estructuraFila as $i => $calzo) {
            // Crear los índices a revisar alrededor del índice actual
            $indices = [$i - 2, $i - 1, $i + 1, $i + 2];
    
            // Filtrar los índices que están fuera del rango válido
            $indicesFiltrados = array_filter($indices, function($index) use ($estructuraFila) {
                return $index >= 0 && $index < count($estructuraFila);
            });
    
            // Revisar si todos los calzos en los índices filtrados están libres
            $estanLibres = array_map(function($index) use ($estructuraFila) {
                return $estructuraFila[$index]['estado'] === 'libre';
            }, $indicesFiltrados);
    
            // Verificar si todos los espacios están libres
            if (!in_array(false, $estanLibres)) {
                // Retornar el calzo actual y la validación como verdadera
                return ['calzo' => $calzo, 'esValido' => true];
            }
        }
    
        // Si no se encontró un calzo válido
        return ['esValido' => false];
    }
    
//Parte 2

public function designarCalzo($camion) {
    $CANT_FILAS = 5;

    // 1. Revisar si hay espacios libres en el Sector 1
    if ($this->contarCalzosLibres(1) === 0) {
        return $this->designarSector3($camion);
    }

    // 2. Revisar la regla de cada fila
    for ($fila = 1; $fila <= $CANT_FILAS; $fila++) {
        $resultado = $this->verificarReglaEspacios($fila);
        if ($resultado['esValido']) {
            return $this->asignarCalzo($resultado['calzo'], $camion);
        }
    }

    // 3. Si ninguna fila cumple la regla, seleccionar el primer espacio libre
    $calzo = $this->primerCalzoDisponible();
    return $this->asignarCalzo($calzo, $camion);
}
