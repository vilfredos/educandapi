<?php

return [
    /*
    |--------------------------------------------------------------------------
    | LTI Version
    |--------------------------------------------------------------------------
    |
    | Especifica la versión de LTI que estás utilizando.
    | El paquete soporta LTI 1.1, 1.2/2.0, y 1.3
    |
    */
    'version' => env('LTI_VERSION', '1.3'),

    /*
    |--------------------------------------------------------------------------
    | LTI Key and Secret
    |--------------------------------------------------------------------------
    |
    | La clave y el secreto que usarás para autenticar las solicitudes LTI.
    | Estos valores deben coincidir con los configurados en tu LMS (como Moodle).
    |
    */
    'key' => env('LTI_KEY', 'su_clave_lti'),
    'secret' => env('LTI_SECRET', 'su_secreto_lti'),

    /*
    |--------------------------------------------------------------------------
    | LTI Launch URL
    |--------------------------------------------------------------------------
    |
    | La URL a la que se enviarán las solicitudes de lanzamiento LTI.
    |
    */
    'launch_url' => env('LTI_LAUNCH_URL', '/lti/launch'),

    /*
    |--------------------------------------------------------------------------
    | LTI Tool Name and Description
    |--------------------------------------------------------------------------
    |
    | El nombre y la descripción de tu herramienta LTI que se mostrarán en el LMS.
    |
    */
    'tool_name' => env('LTI_TOOL_NAME', 'Mi Herramienta LTI'),
    'tool_description' => env('LTI_TOOL_DESCRIPTION', 'Descripción de mi herramienta LTI'),

    /*
    |--------------------------------------------------------------------------
    | LTI Consumer Key Settings
    |--------------------------------------------------------------------------
    |
    | Configuraciones para habilitar/deshabilitar claves de consumidor y
    | establecer tiempos de inicio/fin para el acceso.
    |
    */
    'consumer_key_settings' => [
        'enabled' => true,
        'start_date' => null,  // Formato: 'Y-m-d H:i:s'
        'end_date' => null,    // Formato: 'Y-m-d H:i:s'
    ],

    /*
    |--------------------------------------------------------------------------
    | LTI Collaboration Settings
    |--------------------------------------------------------------------------
    |
    | Configuración para permitir la colaboración entre usuarios de diferentes
    | enlaces de recursos dentro de un único enlace de proveedor de herramientas.
    |
    */
    'enable_collaboration' => false,

    /*
    |--------------------------------------------------------------------------
    | LTI Services
    |--------------------------------------------------------------------------
    |
    | Habilitar/deshabilitar servicios LTI específicos.
    |
    */
    'services' => [
        'names_and_roles_provisioning' => true,
        'assignment_and_grade' => true,
        'outcomes' => true,
        'memberships' => true,
        'setting' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | LTI Roles Mapping
    |--------------------------------------------------------------------------
    |
    | Mapeo de roles LTI a roles de tu aplicación.
    |
    */
    'roles_map' => [
        'Instructor' => 'teacher',
        'Learner' => 'student',
        'Administrator' => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | LTI Custom Parameters
    |--------------------------------------------------------------------------
    |
    | Parámetros personalizados que puedes usar en tu aplicación.
    |
    */
    'custom_parameters' => [
        // 'custom_param1' => 'value1',
        // 'custom_param2' => 'value2',
    ],
    'database' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3307'),
        'database' => env('DB_DATABASE', 'educ'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
    ],
];