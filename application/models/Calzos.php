<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calzos extends CI_Model {

    public function obtenerCalzoDisponibleMasCercano() {
        $this->db->where('estado', 'libre');
        $this->db->where('sector', 1); // Solo seleccionar calzos del sector 1
        $this->db->order_by('numero_calzo', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('calzos');
        
        return $query->row_array();  // Retorna el calzo más cercano disponible en el sector 1
    }
    

    public function asignarCalzo($numero_calzo, $acc_parqueo_id) {
        // Verificar si el calzo es del sector 1 antes de asignarlo
        $this->db->where('numero_calzo', $numero_calzo);
        $this->db->where('sector', 1); // Asegurarse de que el calzo sea del sector 1
        $query = $this->db->get('calzos');
    
        if ($query->num_rows() > 0) {
            // Calzo encontrado en el sector 1, proceder a la asignación
            $data = array(
                'estado' => 'ocupado',
                'camion_designado' => $this->input->post('patente_camion'),
                'acc_parqueo_id' => $acc_parqueo_id  // Asignamos la FK
            );
    
            // Actualizar el calzo en el sector 1
            $this->db->where('numero_calzo', $numero_calzo);
            $this->db->where('sector', 1); // Asegurarse de que se actualice solo en el sector 1
            $this->db->update('calzos', $data);
        } else {
            // Si el calzo no se encuentra en el sector 1, manejar como un error o mensaje informativo
            log_message('error', 'Intento de asignar calzo que no pertenece al sector 1 o no existe: ' . $numero_calzo);
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
    
    
    

    public function contarCalzosLibres($sector = null) {
        $this->db->where('estado', 'libre');
        if ($sector !== null) {
            $this->db->where('sector', $sector);
        }
        $this->db->from('calzos');
        return $this->db->count_all_results();
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
}
