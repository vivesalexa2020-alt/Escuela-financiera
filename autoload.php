<?php
/**
 * Autoloader de la aplicación MVC.
 * Mantiene los namespaces App\\* y los mapea a carpetas en minúsculas.
 */
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $parts = explode('\\', substr($class, strlen($prefix)));
    $namespaceRoot = array_shift($parts);
    $directories = [
        'Core'        => __DIR__ . '/app/core/',
        'Controllers' => __DIR__ . '/app/controllers/',
        'Models'      => __DIR__ . '/app/models/',
        'Views'       => __DIR__ . '/app/views/',
        'Config'      => __DIR__ . '/config/',
    ];

    if (!isset($directories[$namespaceRoot]) || $parts === []) {
        return;
    }

    $className = array_pop($parts);
    if ($namespaceRoot === 'Config' && $className === 'Database') {
        $className = 'database';
    }

    $subdirectory = $parts ? implode('/', $parts) . '/' : '';
    $file = $directories[$namespaceRoot] . $subdirectory . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
