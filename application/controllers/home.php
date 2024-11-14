<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Acc_parqueo'); // Carga el modelo Acc_parqueo
    }
    
    public function index() {
        #$datos['acc_parqueo'] = $this->Acc_parqueo->seleccionar_todo();
		$this->load->view('formulario_ingreso');
		
    }
    
    public function agregar() {
        $acc_parqueo = array(
            "patente" => $this->input->post('patente_camion'),
            "acoplado" => $this->input->post('patente_acoplado'),
            "tipomic" => $this->input->post('tipo_mic'),
            "mic" => $this->input->post('mic'),
            "entradapais" => $this->input->post('entradapais')
        ); 
        
        // Llama al método agregar del modelo para insertar datos
        $this->Acc_parqueo->agregar($acc_parqueo); 

        // Podrías redirigir o cargar otra vista después de agregar
        redirect('welcome/calzos'); // Redirige al índice después de agregar
    }
	public function calzos() {
        $this->load->view('calzos'); // Carga la vista 'calzos.php'
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */