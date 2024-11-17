<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Acc_parqueo'); // Carga el modelo Acc_parqueo
        $this->load->model('Calzos'); // Carga el modelo Calzos
    }
    
    // Método para mostrar el formulario de ingreso y los datos de acc_parqueo
    public function index() {
        $datos['acc_parqueo'] = $this->Acc_parqueo->seleccionar_todo(); // Obtén los datos
        $this->load->view('formulario_ingreso', $datos); // Pasa los datos a la vista
    }
    
    // Método para agregar un nuevo registro a la base de datos
    public function agregar() {
        // Obtener los datos del formulario
        $acc_parqueo = array(
            "patente" => $this->input->post('patente_camion'),
            "acoplado" => $this->input->post('patente_acoplado'),
            "tipomic" => $this->input->post('tipo_mic'),
            "mic" => $this->input->post('mic'),
            "entradapais" => $this->input->post('entradapais')
        );
    
        // Agregar el camión al parqueo y obtener el ID del camión insertado
        $acc_parqueo_id = $this->Acc_parqueo->agregar($acc_parqueo);
    
        // Obtener el calzo más cercano disponible
        $calzo = $this->Calzos->obtenerCalzoDisponibleMasCercano();
    
        // Si se encontró un calzo disponible, asignarlo al camión
        if ($calzo) {
            // Asignar el calzo al camión con el ID del parqueo
            $this->Calzos->asignarCalzo($calzo['numero_calzo'], $acc_parqueo_id);
        }
    
        // Redirigir a la vista de calzos
        redirect('home/calzos');
    }

    public function calzos() {
        // Obtener todos los calzos desde la base de datos
        $data['calzos'] = $this->Calzos->obtenerCalzos();

        // Cargar la vista y pasar los datos
        $this->load->view('calzos', $data);
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
