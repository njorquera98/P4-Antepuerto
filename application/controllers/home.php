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
    
        if ($acc_parqueo_id) {
            // Verificar si el campo 'mic' es null
            if (empty($acc_parqueo['mic'])) {
                // Asignar el calzo más cercano al sector 4
                $calzoCercano = $this->Calzos->obtenerCalzoDisponibleMasCercano(4);
                if ($calzoCercano) {
                    $this->Calzos->asignarCalzo($calzoCercano['numero_calzo'], $acc_parqueo_id, 4, $acc_parqueo['patente']);
                    log_message('info', "Calzo cercano en el Sector 4 asignado: " . $calzoCercano['numero_calzo']);
                    $this->session->set_flashdata('success', 'Calzo asignado correctamente en el Sector 4.');
                } else {
                    $this->session->set_flashdata('error', 'No hay calzos disponibles en el Sector 4.');
                }
                // Redirigir después de asignar en el sector 4
                redirect('home/calzos');
                return;
            }
    
            // Proceder a designar el calzo usando la lógica de negocio
            $resultado = $this->Calzos->designarCalzo($acc_parqueo_id);
    
            if ($resultado['exito']) {
                $this->session->set_flashdata('success', $resultado['mensaje']);
            } else {
                $this->session->set_flashdata('error', $resultado['mensaje']);
            }
        } else {
            $this->session->set_flashdata('error', 'No se pudo agregar el registro de parqueo.');
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
        $data['calzos_libres_sector4'] = $this->Calzos->contarCalzosLibres(4);


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
    
    public function modificarCalzos() {
        // Obtén la lista de calzos y camiones para mostrarlos en la vista
        $data['calzos'] = $this->Calzos->obtenerCalzos();
        $data['camiones'] = $this->Acc_parqueo->seleccionar_todo(); // Asumiendo que este método devuelve la lista de camiones
        
        $data['calzos_libres'] = $this->Calzos->obtenerCalzosLibres();
        $calzosOcupados = $this->Calzos->obtenerCalzosOcupados();
        $data['calzosOcupados'] = $calzosOcupados;
        
        // Cargar la vista modificar_calzos.php
        $this->load->view('modificar_calzos', $data);
    }
    
    //No se usa
    public function modificarCamion($idCalzoOcupado) {
        $this->load->model('Calzos');
    
        // Obtener calzo ocupado y calzos libres
        $calzoOcupado = $this->Calzos->obtenerCalzoPorId($idCalzoOcupado);
        $calzosLibres = $this->Calzos->obtenerCalzosLibres();
    
        $data['calzoOcupado'] = $calzoOcupado;
        $data['calzosLibres'] = $calzosLibres;
    
        // Cargar la vista de reasignación
        $this->load->view('reasignar_calzo', $data);
    }
    
    public function modificar() {
        $this->load->model('Calzos');
        $calzoActualId = $this->input->post('calzo_actual_id');
        $nuevoCalzoId = $this->input->post('nuevo_calzo_id');
        $camion_designado = $this->input->post('camion_designado');  // Obtener la patente del camión
    
        log_message('info', 'Calzo actual recibido: ' . $calzoActualId);
        log_message('info', 'Nuevo calzo recibido: ' . $nuevoCalzoId);
        log_message('info', 'Patente recibida: ' . $camion_designado);
    
        // Consultar el calzo actual por su ID
        $this->db->where('id', $calzoActualId);
        $query = $this->db->get('calzos');
        log_message('info', 'Consulta SQL ejecutada: ' . $this->db->last_query());
    
        if ($query->num_rows() > 0) {
            $calzo = $query->row();
    
            // Verificar que el calzo esté ocupado antes de liberarlo
            if ($calzo->estado === 'ocupado') {
                $accParqueoId = $calzo->acc_parqueo_id;
                $this->Calzos->liberarCalzo($accParqueoId); // Liberar el calzo actual
            }
    
            // Consultar el nuevo calzo por su ID para obtener el numero_calzo
            if (!empty($nuevoCalzoId)) {
                $this->db->where('id', $nuevoCalzoId);
                $nuevoQuery = $this->db->get('calzos');
                log_message('info', 'Consulta SQL ejecutada para nuevo calzo: ' . $this->db->last_query());
    
                if ($nuevoQuery->num_rows() > 0) {
                    $nuevoCalzo = $nuevoQuery->row();
                    $numeroCalzo = $nuevoCalzo->numero_calzo; // Obtener el numero_calzo
                    $sectorNuevoCalzo = $nuevoCalzo->sector;
    
                    log_message('info', 'Asignando el nuevo calzo con patente: ' . $camion_designado . ' con numero_calzo: ' . $numeroCalzo . ', sector: ' . $sectorNuevoCalzo);
                    $this->Calzos->asignarCalzo($numeroCalzo, $accParqueoId, $sectorNuevoCalzo, $camion_designado);
    
                    $this->session->set_flashdata('success', 'El calzo se modificó exitosamente.');
                    redirect('home/Calzos');
                } else {
                    echo "<pre>Error: No se encontró el nuevo calzo especificado.</pre>";
                }
            } else {
                echo "<pre>Error: No se especificó un nuevo calzo para asignar.</pre>";
            }
        } else {
            log_message('error', 'No se encontró el calzo actual con ID: ' . $calzoActualId);
            echo "<pre>Error: No se encontró el calzo actual para liberar.</pre>";
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
    public function estadosCalzos() {
        $calzos_libres = $this->Calzos->contarCalzosLibres();
        error_log("Calzos libres: " . $calzos_libres);
        echo json_encode(['calzos_libres' => $calzos_libres]);
        die();
    }
}
