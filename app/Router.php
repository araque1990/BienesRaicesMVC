<?php

namespace App;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        // Forzamos al navegador a NO guardar la página en caché
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.

        $auth = $_SESSION['login'] ?? null;


        // Arreglo de rutas protegidas
        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar',];

        $metodo = $_SERVER['REQUEST_METHOD'];

        // Obtener la URL
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';

        // Quitar los parámetros GET (ej: ?id=1)
        $urlActual = strtok($urlActual, '?');

        // Si la url no es la raíz "/" y termina en "/", quítale el último caracter
        if ($urlActual !== '/' && substr($urlActual, -1) === '/') {
            $urlActual = rtrim($urlActual, '/');
        }

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if (in_array($urlActual, $rutasProtegidas) && !$auth) {
            header('Location: /');
            exit;
        }

        if ($fn) {
            // Ejecutar la función asociada (Controlador)
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada (404)";
        }
    }

    // Método para renderizar las vistas
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en memoria temporal
        include __DIR__ . "/../views/$view.php";
        $contenido = ob_get_clean(); // Limpia el buffer
        include __DIR__ . "/../views/layout/layout.php";
    }
}
