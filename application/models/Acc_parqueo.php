<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_parqueo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Carga la base de datos
    }

    // Método para agregar un nuevo registro a la tabla acc_parqueo
    public function agregar($data) {
        $this->db->insert('acc_parqueo', $data);
        return $this->db->insert_id();  // Devuelve el ID insertado
    }

    // Método para obtener todos los registros de la tabla acc_parqueo
    public function seleccionar_todo() {
        $query = $this->db->get('acc_parqueo'); // 'acc_parqueo' es el nombre de tu tabla
        return $query->result_array(); // Devuelve los resultados como un array asociativo
    }

    public function obtenerPorPatente($patente_camion) {
        $this->db->select('id'); // Selecciona el ID de la tabla acc_parqueo
        $this->db->where('patente', $patente_camion);
        $query = $this->db->get('acc_parqueo');
        return $query->row_array();
    }
    
    public function actualizarSalida($id, $fecha_salida) {
        $data = array(
            'salida' => $fecha_salida
        );

        $this->db->where('id', $id);
        return $this->db->update('acc_parqueo', $data);  // Actualiza la tabla acc_parqueo
    }
}

/* End of file Acc_parqueo.php */
/* Location: ./application/models/Acc_parqueo.php */
