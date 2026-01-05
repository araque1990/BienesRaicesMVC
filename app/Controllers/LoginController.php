<?php

namespace App\Controllers;

use App\Router;
use App\Models\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin(
                email: $_POST['email'] ?? null,
                password: $_POST['password'] ?? null
            );

            $errores = $auth->validar();

            if (empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    // Verificar si el usuario existe o no
                    $errores = Admin::getErrores();

                } else {
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar el usuario
                        $auth->autenticar();

                    } else {
                        // Password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores,
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        session_destroy();

        header('Location: /');
        exit;
    }
}