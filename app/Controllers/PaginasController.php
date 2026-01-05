<?php

namespace App\Controllers;

use App\Models\Propiedad;
use App\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $urlActual = $_SERVER['REQUEST_URI'] ?? '';
        $urlActual = strtok($urlActual, '?');

        $lorem = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id tellus a nisi dictum hendrerit. Maecenas finibus ipsum nec mi euismod, nec imperdiet urna laoreet. Donec sit amet dui vel felis commodo mollis vel quis velit.",
            "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In hac habitasse platea dictumst. Vivamus efficitur scelerisque tellus, a elementum ex scelerisque nec. Sed at nisl non.",
            "Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris porta eros at sem feugiat, non accumsan nisi varius. Nulla facilisi. Curabitur vel sem a metus interdum.",
            "Fusce vehicula ex eu mi congue, at elementum elit pretium. Aenean nec lacus neque. Nullam id vulputate nisi. Ut iaculis urna at velit varius, eu scelerisque lorem elementum. Maecenas eget tincidunt tellus."
        ];

        $entradas = [
            '/entrada-exterior' => [
                'titulo' => 'Como sacar provecho a tu zona exterior',
                'imagen' => 'blog2',
                'contenido' => 'Disfruta de las vistas, relájate y aprovecha las ventajas de tener un paraíso en tu hogar...',
                'fecha' => '20 de Mayo, 2025',
                'autor' => 'Admin'
            ],
            '/entrada-habitacion' => [
                'titulo' => 'Decoración de habitaciones modernas',
                'imagen' => 'blog4',
                'contenido' => 'Aprende a combinar colores y texturas en tu dormitorio...',
                'fecha' => '22 de Mayo, 2025',
                'autor' => 'Admin'
            ],
            '/entrada-salon' => [
                'titulo' => 'Maximiza el espacio en tu salón',
                'imagen' => 'blog3',
                'contenido' => 'Trucos de diseño para que tu salón parezca más grande...',
                'fecha' => '25 de Mayo, 2025',
                'autor' => 'Admin'
            ],
            '/entrada-terraza' => [
                'titulo' => 'Terraza en el techo de tu casa',
                'imagen' => 'blog1',
                'contenido' => 'Cómo convertir un balcón pequeño en una terraza increíble...',
                'fecha' => '30 de Mayo, 2025',
                'autor' => 'Admin'
            ]
        ];

        if (!array_key_exists($urlActual, $entradas)) {
            header('Location: /blog');
            return;
        }

        $datos = $entradas[$urlActual];

        $entrada = (object) $datos;
        $entrada->loremAleatorio = $lorem[array_rand($lorem)];

        $router->render('paginas/entrada', [
            'entrada' => $entrada,

        ]);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['contacto'])) {
                $contacto = $_POST['contacto'];

                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = $_SERVER['EMAIL_HOST'] ?? $_ENV['EMAIL_HOST'];
                $phpmailer->SMTPAuth = false;
                $phpmailer->Port = $_SERVER['EMAIL_PORT'] ?? $_ENV['EMAIL_PORT'];

                $phpmailer->setFrom('admin@bienesraices.com', 'BienesRaices.com');
                $phpmailer->addAddress('admin@bienesraices.com');
                $phpmailer->Subject = 'Nuevo Mensaje de Contacto';

                ob_start();
                include __DIR__ . '/../../views/paginas/mensaje_email.php';
                $contenido = ob_get_clean();

                $phpmailer->isHTML(true);
                $phpmailer->CharSet = 'UTF-8';
                $phpmailer->Body = $contenido;

                if ($phpmailer->send()) {
                    $mensaje = "Mensaje enviado Correctamente";
                } else {
                    $mensaje = "El mensaje no se pudo enviar";
                }

            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}