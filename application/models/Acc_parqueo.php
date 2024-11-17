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
}

/* End of file Acc_parqueo.php */
/* Location: ./application/models/Acc_parqueo.php */
