<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('Acc_parqueo'); // Carga el modelo Acc_parqueo
        $this->load->model('Calzos'); // Carga el modelo Calzos
    }

    public function index() {
        $datos['acc_parqueo'] = $this->Acc_parqueo->seleccionar_todo();
        $this->load->view('formulario', $datos);
    }

    public function agregar() {
        $acc_parqueo = array(
            "patente" => $this->input->post('patente_camion'),
            "acoplado" => $this->input->post('patente_acoplado'),
            "tipomic" => $this->input->post('tipo_mic'),
            "mic" => $this->input->post('mic'),
            "entradapais" => $this->input->post('entradapais')
        );
    
        $acc_parqueo_id = $this->Acc_parqueo->agregar($acc_parqueo);
    
        // Designar calzo usando la lógica del modelo
        $resultado = $this->Calzos->designarCalzo($acc_parqueo_id);
    
        if ($resultado['exito']) {
            $this->session->set_flashdata('success', 'Calzo asignado correctamente.');
        } else {
            $this->session->set_flashdata('error', $resultado['mensaje']);
        }
    
        redirect('home/calzos');
    }
    
    
    

    public function calzos($sector = null) {
        $data['calzos'] = $this->Calzos->obtenerCalzos();

        // Obtén el sector desde el parámetro o predeterminado
        if (!$sector) {
            $sector = $this->input->get('sector'); 
        }
        if (!$sector) {
            $sector = '1'; // Valor predeterminado si no se pasa un sector
        }

        // Obtener calzos agrupados por fila y sector
        $data['calzos_por_fila'] = $this->Calzos->obtenerCalzosPorFilaPorSector($sector);
        $data['sector_actual'] = $sector;

        // Obtener el número de calzos libres por sector
        $data['calzos_libres_sector1'] = $this->Calzos->contarCalzosLibres(1);
        $data['calzos_libres_sector3'] = $this->Calzos->contarCalzosLibres(3);

        $this->load->view('estados_calzos', $data);
    }

    public function liberarCalzoPorPatente() {
        $patente_camion = $this->input->post('patenteCamionSalida');
        $camion = $this->Acc_parqueo->obtenerPorPatente($patente_camion);
    
        if (isset($camion['id'])) {
            $acc_parqueo_id = $camion['id'];
            $fecha_salida = date('Y-m-d H:i:s');
            $this->Acc_parqueo->actualizarSalida($acc_parqueo_id, $fecha_salida);
    
            // Liberar el calzo asociado al acc_parqueo_id
            $resultado = $this->Calzos->liberarCalzo($acc_parqueo_id);
    
            if ($resultado) {
                $this->session->set_flashdata('success', 'El calzo ha sido liberado y la salida registrada correctamente.');
            } else {
                $this->session->set_flashdata('error', 'No se pudo liberar el calzo o el calzo ya estaba libre.');
            }
        } else {
            $this->session->set_flashdata('error', 'No se encontró el camión con la patente proporcionada.');
        }
    
        redirect('home/calzos');
    }
    
    
    

    public function estadosCalzos() {
        $calzos_libres = $this->Calzos->contarCalzosLibres();
        error_log("Calzos libres: " . $calzos_libres);
        echo json_encode(['calzos_libres' => $calzos_libres]);
        die();
    }
}
