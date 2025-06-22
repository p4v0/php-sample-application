<?php
// Cambios respecto al original:
// - Se usan variables de entorno para la configuración de la conexión por seguridad.
// - Se valida la presencia de las variables necesarias para diagnostico.
// - Se maneja y registra el error en caso de fallo de conexión.
// - Se configura PDO para registrar excepciones en el log de apache.

// Lee las variables de entorno necesarias para la conexión
$host = getenv('MYSQL_HOST');
$db   = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

// Verifica que todas las variables estén definidas
if (!$host || !$db || !$user || !$pass) {
    http_response_code(500);
    echo 'Faltan variables de entorno para la conexión a la base de datos.';
    exit;
}

try {
    // Retorna la instancia PDO para la conexión
    $dbConnection = new PDO(
        "mysql:host=$host;dbname=$db",
        $user,
        $pass,
        [PDO::ATTR_PERSISTENT => true]
    );
    // Configura el modo de error para lanzar excepciones
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
} catch (PDOException $e) {
    // Registra el error en el log y detiene la ejecución
    @file_put_contents(__DIR__ . '/../logs/error.log', '[DB ERROR] ' . $e->getMessage() . "\n", FILE_APPEND | LOCK_EX);
    http_response_code(500);
    echo 'No se pudo conectar a la base de datos.';
    exit;
}
