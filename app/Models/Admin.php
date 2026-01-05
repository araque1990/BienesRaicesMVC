<?php

namespace App\Models;

class Admin extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public function __construct(
        public ?int $id = null,
        public ?string $email = null,
        public ?string $password = null,
    ) {

    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "El Email es obligatorio o no es válido";
        }

        if (!$this->password) {
            self::$errores[] = "El Password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        // Sanitizamos los atributos antes de la consulta
        $atributos = $this->sanitizarAtributos();

        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $atributos['email'] . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return false;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        // Revisar si el password es correcto
        $usuario = $resultado->fetch_object();

        // Verificar si el password es correcto o no
        $autenticado = password_verify((string) $this->password, (string) $usuario->password);

        if (!$autenticado) {
            self::$errores[] = 'El Password es incorrecto';
        }

        return $autenticado;
    }

    public function autenticar()
    {
        session_start();

        // Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
        exit;
    }
}