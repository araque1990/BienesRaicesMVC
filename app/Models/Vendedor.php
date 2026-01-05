<?php

namespace App\Models;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public function __construct(
        public ?int $id = null,
        public ?string $nombre = null,
        public ?string $apellido = null,
        public ?string $telefono = null,
    ) {}

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El Teléfono es Obligatorio";
        }

        if ($this->telefono && !preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'El formato del Teléfono no es Válido';
        }

        return self::$errores;
    }
}
