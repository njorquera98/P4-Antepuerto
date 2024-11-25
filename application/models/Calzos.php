<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calzos extends CI_Model {

    public function obtenerCalzoDisponibleMasCercano() {
        $this->db->where('estado', 'libre');
        $this->db->order_by('numero_calzo', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get('calzos');
        
        return $query->row_array();  // Retorna el calzo más cercano disponible
    }

    public function asignarCalzo($numero_calzo, $acc_parqueo_id) {
        // Actualizamos el calzo para asignar el camión y su id
        $data = array(
            'estado' => 'ocupado',
            'camion_designado' => $this->input->post('patente_camion'),
            'acc_parqueo_id' => $acc_parqueo_id  // Asignamos la FK
        );

        $this->db->where('numero_calzo', $numero_calzo);  // Filtramos por el número de calzo
        $this->db->update('calzos', $data);  // Actualizamos la tabla calzos
    }

    public function obtenerCalzos() {
        // Obtener todos los calzos de la base de datos
        $query = $this->db->get('calzos');
        return $query->result_array();  // Retorna todos los calzos
    }

    public function liberarCalzo($acc_parqueo_id) {
        $this->db->where('acc_parqueo_id', $acc_parqueo_id);
        $this->db->update('calzos', array( // Cambia 'calzo' a 'calzos'
            'estado' => 'libre',
            'camion_designado' => null,
            'acc_parqueo_id' => null
        ));
    }
    
    public function contarCalzosLibres() {
        $this->db->where('estado', 'libre');
        $this->db->from('calzos');
        return $this->db->count_all_results(); // Devuelve el conteo de registros
    }

}
