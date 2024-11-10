<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseTest extends CI_Controller {

    public function index() {
        // Intenta hacer una consulta simple para verificar la conexión
        $query = $this->db->query('SHOW TABLES');

        if ($query) {
            echo "Conexión exitosa. Las tablas en tu base de datos son:<br><br>";

            // Mostrar todas las tablas en la base de datos
            foreach ($query->result_array() as $row) {
                echo $row['Tables_in_nombre_base_de_datos'] . "<br>"; // Cambia 'nombre_base_de_datos' por el nombre de tu base de datos
            }
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    }
}

