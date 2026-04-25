<?php

class View
{
    public static function render($template, $data = [])
    {
        $templatePath = __DIR__ . '/Views/' . $template . '.php';
        if (!file_exists($templatePath)) {
            throw new RuntimeException("Vista no encontrada: {$template}");
        }

        extract($data, EXTR_SKIP);
        require $templatePath;
    }

    public static function redirect($route)
    {
        header('Location: ?route=' . urlencode($route));
        exit;
    }
}
