<?php
require_once __DIR__ . '/../includes/app.php';

/**
 * SEGURIDAD: Solo permitir la ejecución si estamos en entorno de desarrollo.
 * Esto evita que el script se ejecute accidentalmente en producción.
 */
if (($_ENV['APP_ENV'] ?? 'dev') !== 'dev') {
    die("❌ Acceso denegado. Este script solo puede ejecutarse en entorno de desarrollo.");
}

// Utilizar este archivo solo una vez para crear el administrador con el password hasheado
$email = $_ENV['DB_USER_ADMIN'] ?? "admin@correo.com";
$passwordPlano = $_ENV['DB_PASS_ADMIN'] ?? "admin123";

// Hash de la contraseña
$passwordHash = password_hash($passwordPlano, PASSWORD_BCRYPT);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}');";

try {
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
        echo "<div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #d4edda; border-radius: 8px; background-color: #f8f9fa;'>";
        echo "<h2 style='color: #28a745;'>✅ Usuario Administrador creado con éxito</h2>";
        echo "<p><b>📧 Email:</b> " . htmlspecialchars($email) . "</p>";
        echo "<p><b>🔒 Password:</b> [Configurado en su .env]</p>";
        echo "<hr>";
        echo "<p style='color: #856404; background-color: #fff3cd; padding: 10px; border-radius: 4px;'>
                ⚠️ <b>SEGURIDAD:</b> Por seguridad, elimine este archivo (<code>public/crearUsuario.php</code>) ahora.
              </p>";
        echo "<p style='text-align: center; margin-top: 20px;'>
                Redirigiendo al Login en 3 segundos...
              </p>";
        echo "</div>";

        // Redirección automática después de 3 segundos
        header("Refresh: 3; url=/login");
        exit;
    }
} catch (Exception $e) {
    echo "<div style='font-family: sans-serif; color: #721c24; background-color: #f8d7da; padding: 20px; border-radius: 8px; margin: 50px auto; max-width: 600px;'>";
    echo "❌ <b>Error al crear el usuario:</b> " . $e->getMessage();
    echo "</div>";
}