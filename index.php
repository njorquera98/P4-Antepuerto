<?php

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'bsl7inabn6jg3cdzf0qq-mysql.services.clever-cloud.com';
$db['default']['username'] = 'uiyxtc3bdhaq5s0q';
$db['default']['password'] = 'L2ynF4ltQ0NeRKZhDCgP';
$db['default']['database'] = 'bsl7inabn6jg3cdzf0qq';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

// Intentar conectar a la base de datos
$connection = new mysqli(
    $db['default']['hostname'],
    $db['default']['username'],
    $db['default']['password'],
    $db['default']['database']
);

// Comprobar si la conexión es exitosa
if ($connection->connect_error) {
    // Mostrar el error en el navegador
    echo "Error en la conexión a la base de datos: " . $connection->connect_error;

    // También registrar el error en los logs de CodeIgniter
    log_message('error', 'Error en la conexión a la base de datos: ' . $connection->connect_error);
} else {
    // Si la conexión es exitosa, mostrar mensaje en el navegador
    echo "Conexión a la base de datos exitosa.";

    // También registrar el éxito en los logs de CodeIgniter
    log_message('info', 'Conexión a la base de datos exitosa.');
}

// Cerrar la conexión
$connection->close();

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 */
define('ENVIRONMENT', 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 */
$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 */
$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * DEFAULT CONTROLLER
 *---------------------------------------------------------------
 */
// El controlador predeterminado puede configurarse en routes.php

// END OF USER CONFIGURABLE SETTINGS

/*
 * ---------------------------------------------------------------
 * Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path).'/';
}

$system_path = rtrim($system_path, '/').'/';

if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly.");
}

/*
 * ---------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * ---------------------------------------------------------------
 */
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', str_replace(SELF, '', __FILE__));
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));
define('APPPATH', $application_folder.'/');

// Cargar el archivo de bootstrap
require_once BASEPATH.'core/CodeIgniter.php';

