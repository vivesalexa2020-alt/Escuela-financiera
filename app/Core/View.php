<?php
namespace App\Core;

class View {
    private static string $viewsDir;

    private static function init(): void {
        self::$viewsDir = dirname(__DIR__) . '/Views';
    }

    /**
     * Renderiza una vista dentro de un layout o de forma independiente
     */
    public static function render(string $viewPath, array $data = [], ?string $layout = 'main'): void {
        self::init();

        // Extraer variables para la vista
        extract($data);

        $viewFile = self::$viewsDir . '/' . ltrim($viewPath, '/') . '.php';

        if (!file_exists($viewFile)) {
            // Buscar si existe como .html
            $viewFileHtml = self::$viewsDir . '/' . ltrim($viewPath, '/') . '.html';
            if (file_exists($viewFileHtml)) {
                $viewFile = $viewFileHtml;
            } else {
                http_response_code(404);
                echo "<h1>Error 404: Vista no encontrada</h1><p>{$viewPath}</p>";
                return;
            }
        }

        // Si se especificó un layout, capturar el contenido de la vista
        if ($layout !== null) {
            ob_start();
            include $viewFile;
            $content = ob_get_clean();

            $layoutFile = self::$viewsDir . '/layouts/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                include $layoutFile;
            } else {
                echo $content;
            }
        } else {
            include $viewFile;
        }
    }
}
