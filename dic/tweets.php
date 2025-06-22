<?php
# Cambios respecto al original:
// lee la config de la base de datos desde una ruta segura fuera del DocumentRoot
// se añade validación simple para asegurar que la conexión se obtiene correctamente


$dbConnection = require '/var/www/config-dev/db-connection.php';
if (!$dbConnection) {
    http_response_code(500);
    echo 'No se pudo obtener la conexión a la base de datos.';
    exit;
}
return new Service\TweetsService(
    $dbConnection
);
