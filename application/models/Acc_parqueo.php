<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_parqueo extends CI_Model {
    public function agregar($acc_parqueo) {
        $this->db->insert('acc_parqueo', $acc_parqueo);
    }
}

/* End of file Acc_parqueo.php */
/* Location: ./application/models/Acc_parqueo.php */
