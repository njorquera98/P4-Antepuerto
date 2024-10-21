<<<<<<< HEAD
# Sistema de Gestión de Estacionamiento para el Antepuerto de Lluta

## Descripción del Proyecto

Este proyecto aborda un desafío crítico en la gestión del estacionamiento de camiones en el antepuerto de la empresa portuaria de Lluta. El antepuerto fue construido para disminuir el impacto de los camiones en las calles cercanas al puerto y proporcionar un área de estacionamiento organizada para camiones con carga provenientes de Bolivia. Sin embargo, actualmente no existe un sistema eficiente que asigne automáticamente los espacios de estacionamiento, lo que genera ocupación desordenada y falta de trazabilidad en la ubicación de los camiones.

### Problemática
La gestión actual del estacionamiento en el antepuerto presenta varios problemas:
- Los camiones ingresan sin una asignación automática de espacios, ocupando áreas de forma desordenada.
- La preferencia individual de estacionamiento de los conductores agrava la falta de organización, generando confusión en la ubicación de cada camión.
- La ausencia de trazabilidad en la posición de los vehículos afecta la eficiencia de las operaciones portuarias.

### Objetivo del Proyecto
Este proyecto tiene como objetivo desarrollar una solución informática que automatice la asignación de espacios de estacionamiento al ingreso de los camiones, brindando una distribución organizada y eficiente. Además, se busca crear una interfaz visual para que los operadores monitoreen la ocupación del estacionamiento en tiempo real, con la opción de ajustar manualmente la asignación de espacios en caso de errores.

## Funcionalidades
- **Asignación Automática de Calzos**: El sistema asigna automáticamente un espacio de estacionamiento numerado y sectorizado a cada camión en función de sus datos de ingreso.
- **Visualización en Tiempo Real**: La interfaz muestra el estado actual de ocupación de los espacios, permitiendo una visión clara de la disponibilidad de calzos en el antepuerto.
- **Ajuste Manual de Calzos**: Los operadores tienen la capacidad de modificar la asignación de un calzo específico, en caso de errores o requerimientos especiales.
- **Liberación de Espacios**: Al retirarse un camión, el sistema permite liberar el calzo de manera automática para optimizar la disponibilidad de espacios.

## Tecnologías

### Frontend:
- **Framework JavaScript**: AngularJS 1.3.6
- **Librerías JavaScript**:
  - jQuery 3.4.1
  - DataTables 1.10.0-dev
  - jQuery UI
- **UI Framework**: Bootstrap

### Backend:
- **Framework**: CodeIgniter 2.2.6
- **Lenguaje**: PHP

## Estructura del Proyecto
Este repositorio contiene el código fuente del sistema, estructurado en los siguientes módulos:
- **Backend**: Implementación de la lógica de negocio para la gestión de espacios y camiones.
- **Frontend**: Interfaz de usuario para visualizar el estado del estacionamiento y gestionar manualmente la asignación de calzos.
- **API de Integración**: Endpoints para capturar los datos de ingreso y gestionar el flujo de camiones dentro del sistema.

## Requisitos del Sistema
- **Servidor Web**: Recomendado Apache o Nginx
- **PHP**: Version 5.6 o superior
- **Base de Datos**: Se recomienda MySQL

## Instalación y Configuración
1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/usuario/sistema-estacionamiento-antepuerto.git
   cd sistema-estacionamiento-antepuerto
   ```
2. **Configura la Base de Datos**:
   Crea una base de datos MySQL y actualiza las credenciales de conexión en el archivo `application/config/database.php`.
4. **Configura el Entorno**:
   Renombra el archivo `application/config/config.php` para ajustar la configuración base del sistema.
6. **Inicia el Proyecto**:
   Abre el proyecto en un servidor web (Apache/Nginx) y accede a la interfaz frontend mediante la URL configurada.
=======
# CodeIgniter 2
Open Source PHP Framework (originally from EllisLab)

For more info, please refer to the user-guide at http://www.codeigniter.com/userguide2/  
(also available within the download package for offline use)

**WARNING:** *CodeIgniter 2.x is no longer under development and only receives security patches until October 31st, 2015.
Please update your installation to the latest CodeIgniter 3.x version available
(upgrade instructions [here](http://www.codeigniter.com/userguide3/installation/upgrade_300.html)).*
>>>>>>> d3950fb (first commit)
