<?php
// Cambios respecto al original:
// - Se agregó la carga del autoloader de Composer para manejar dependencias externas.
// - Se usó __DIR__ en los require para asegurar rutas absolutas.
// - Estos cambios son necesarios para que la aplicación funcione correctamente en un entorno contenerizado,
//   por si el directorio de trabajo varía

// Carga el autoloader de Composer para dependencias externas
require __DIR__ . '/vendor/autoload.php';

// Carga autoloader personalizado y el manejador de errores
require __DIR__ . '/autoloader.php';
require __DIR__ . '/error_handler.php';
