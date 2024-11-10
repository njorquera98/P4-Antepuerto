<?php
// Configuración básica sin CodeIgniter

// Establecer el entorno
define('ENVIRONMENT', 'development');

// Reportar todos los errores en desarrollo
if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

