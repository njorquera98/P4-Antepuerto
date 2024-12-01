<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calzos extends CI_Model {

    public function obtenerCalzoDisponibleMasCercano($sector = 1) {
        // Log para registrar el sector que se busca
        log_message('info', "Buscando calzo disponible en el sector {$sector}");
    
        $this->db->where('estado', 'libre');
        $this->db->where('sector', $sector); // Selecciona calzos del sector especificado
        $this->db->order_by('numero_calzo', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('calzos');
        
        $resultado = $query->row_array();
    
        // Log para registrar el resultado de la consulta
        if ($resultado) {
            log_message('info', "Calzo encontrado: " . print_r($resultado, true));
        } else {
            log_message('info', "No se encontró un calzo disponible en el sector {$sector}");
        }
    
        return $resultado; // Retorna el calzo más cercano disponible en el sector especificado
    }
    
    
    

    public function asignarCalzo($numero_calzo, $acc_parqueo_id, $sector = 1) {
        $this->db->where('numero_calzo', $numero_calzo);
        $this->db->where('sector', $sector);
        $query = $this->db->get('calzos');
    
        if ($query->num_rows() > 0) {
            $data = array(
                'estado' => 'ocupado',
                'camion_designado' => $this->input->post('patente_camion'),
                'acc_parqueo_id' => $acc_parqueo_id
            );
    
            $this->db->where('numero_calzo', $numero_calzo);
            $this->db->where('sector', $sector);
            $update_result = $this->db->update('calzos', $data);
    
            if ($update_result) {
                log_message('info', "Calzo {$numero_calzo} asignado exitosamente a acc_parqueo_id {$acc_parqueo_id}");
            } else {
                log_message('error', "Error al asignar el calzo {$numero_calzo} a acc_parqueo_id {$acc_parqueo_id}");
            }
        } else {
            log_message('error', "Calzo {$numero_calzo} no encontrado en el sector {$sector}");
        }
    }
    
    
    
    
    

    public function obtenerCalzos() {
        $query = $this->db->get('calzos');
        return $query->result_array();
    }

    public function liberarCalzo($acc_parqueo_id) {
        // Verificar si el calzo existe y está ocupado
        $this->db->where('acc_parqueo_id', $acc_parqueo_id);
        $query = $this->db->get('calzos');
    
        if ($query->num_rows() > 0) {
            $calzo = $query->row_array();
    
            // Comprobar si el calzo está ocupado antes de liberarlo
            if ($calzo['estado'] === 'ocupado') {
                $this->db->where('acc_parqueo_id', $acc_parqueo_id);
                $this->db->update('calzos', array(
                    'estado' => 'libre',
                    'camion_designado' => null,
                    'acc_parqueo_id' => null
                ));
    
                log_message('info', 'Calzo liberado correctamente para acc_parqueo_id ' . $acc_parqueo_id);
                return true; // La operación fue exitosa
            } else {
                log_message('info', 'El calzo con acc_parqueo_id ' . $acc_parqueo_id . ' ya estaba libre.');
                return false; // El calzo ya estaba libre
            }
        } else {
            log_message('error', 'No se encontró un calzo con acc_parqueo_id ' . $acc_parqueo_id);
            return false; // No se encontró el calzo
        }
    }
    
    
    public function contarCalzosLibres($sector) {
        $this->db->where('estado', 'libre');
        $this->db->where('sector', $sector);
        return $this->db->count_all_results('calzos');
    }

    public function obtenerCalzosPorFilaPorSector($sector) {
        $this->db->where('sector', $sector);
        $this->db->order_by('fila, numero_calzo', 'ASC');
        $query = $this->db->get('calzos');

        $resultados = $query->result_array();
        $agrupados = [];
        foreach ($resultados as $calzo) {
            $agrupados[$calzo['fila']][] = $calzo;
        }

        return $agrupados;
    }

//nuevo


public function designarCalzo($acc_parqueo_id) {
    $CANT_FILAS = 5;

    // 1. Verificar si hay calzos disponibles en el Sector 1
    if ($this->contarCalzosLibres(1) === 0) {
        // Intentar asignar en el Sector 3 si el Sector 1 está lleno
        log_message('info', 'No hay calzos libres en el Sector 1, intentando en el Sector 3');
        $calzoSector3 = $this->obtenerCalzoDisponibleMasCercano(3);
        if ($calzoSector3) {
            log_message('info', "Calzo asignado en el Sector 3: " . print_r($calzoSector3, true));
            
            // Asignar el calzo encontrado en el Sector 3
            $this->asignarCalzo($calzoSector3['numero_calzo'], $acc_parqueo_id, 3);
            return ['exito' => true, 'mensaje' => 'Calzo asignado correctamente en el Sector 3.'];
        } else {
            log_message('error', 'No hay calzos disponibles en el Sector 3.');
            return ['exito' => false, 'mensaje' => 'No hay calzos disponibles en el Sector 1 ni en el Sector 3.'];
        }
    }

    // 2. Evaluar filas en el Sector 1 para cumplir con la regla de espacios
    for ($fila = 1; $fila <= $CANT_FILAS; $fila++) {
        $resultado = $this->verificarReglaEspacios($fila, 1);
        if ($resultado['esValido']) {
            log_message('info', "Calzo asignado: " . print_r($resultado['calzo'], true));
            
            // Asignar el calzo encontrado
            $this->asignarCalzo($resultado['calzo']['numero_calzo'], $acc_parqueo_id, 1);
            return ['exito' => true, 'mensaje' => 'Calzo asignado correctamente.'];
        }
    }

    // 3. Si no se encontró un calzo válido en el Sector 1, asignar el primero disponible en el Sector 1
    $calzo = $this->obtenerCalzoDisponibleMasCercano(1);
    if ($calzo) {
        log_message('info', "Calzo asignado de forma predeterminada: " . print_r($calzo, true));
        $this->asignarCalzo($calzo['numero_calzo'], $acc_parqueo_id, 1);
        return ['exito' => true, 'mensaje' => 'Calzo asignado correctamente.'];
    }

    // 4. Si no hay calzos disponibles, reportar un error
    log_message('error', 'No hay calzos disponibles en el Sector 1 ni en el Sector 3.');
    return ['exito' => false, 'mensaje' => 'No hay calzos disponibles en el Sector 1 ni en el Sector 3.'];
}




public function verificarReglaEspacios($fila, $sector) {
    // Ahora la variable $sector se recibe correctamente y se puede usar dentro de la función
    $estructuraFila = $this->obtenerCalzosSimplificadoPorFila($fila, $sector);
    log_message('info', "Fila a revisar: " . print_r($estructuraFila, true));

    foreach ($estructuraFila as $i => $calzo) {
        if ($calzo['estado'] !== 'libre') {
            continue; // Si el calzo no está libre, pasar al siguiente
        }

        // Mostrar el calzo actual y su número
        log_message('info', "Revisando calzo en posición {$i} con número {$calzo['numero_calzo']} y estado {$calzo['estado']}");

        // Verificar índices adyacentes
        $indices = [$i - 2, $i - 1, $i + 1, $i + 2];
        $indicesFiltrados = array_filter($indices, function($index) use ($estructuraFila) {
            return $index >= 0 && $index < count($estructuraFila);
        });

        // Construir el log de índices adyacentes con sus números de calzo
        $logIndices = [];
        foreach ($indicesFiltrados as $index) {
            $logIndices[$index] = [
                'numero_calzo' => $estructuraFila[$index]['numero_calzo'],
                'estado' => $estructuraFila[$index]['estado']
            ];
        }
        log_message('info', "Índices adyacentes a {$i} revisados: " . print_r($logIndices, true));

        // Verificar que todos los índices adyacentes estén libres y que los ocupados no interfieran
        $estanTodosLibres = true;
        foreach ($indicesFiltrados as $index) {
            if ($estructuraFila[$index]['estado'] !== 'libre') {
                // Si se encuentra un calzo ocupado, verificamos si es una condición válida para la asignación
                if ($estructuraFila[$index]['estado'] === 'ocupado') {
                    $estanTodosLibres = false;
                    break; // Salimos del bucle si encontramos un calzo ocupado
                }
            }
        }

        // Si todos los adyacentes están libres, consideramos el calzo como válido
        if ($estanTodosLibres) {
            log_message('info', "Calzo válido encontrado en índice {$i}: " . print_r($calzo, true));
            return ['calzo' => $calzo, 'esValido' => true];
        }
    }

    log_message('info', "No se encontró un calzo válido en la fila {$fila}");
    return ['esValido' => false];
}










    

    
public function obtenerCalzosSimplificadoPorFila($fila, $sector) {
    $this->db->select('numero_calzo, estado');
    $this->db->where('fila', $fila);
    $this->db->where('sector', $sector); // Agregar filtro por sector
    $this->db->order_by('numero_calzo', 'ASC');
    $query = $this->db->get('calzos');
    
    // Obtener el resultado y registrarlo en el log
    $resultado = $query->result_array();
    log_message('info', 'Resultado de obtenerCalzosSimplificadoPorFila: ' . print_r($resultado, true));

    return $resultado; // Devuelve un arreglo con 'numero_calzo' y 'estado'
}


}
