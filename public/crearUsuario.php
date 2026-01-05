<?php
require_once __DIR__ . '/../includes/app.php';

// utiliar este archivo solo una vez para crear el administrador con el password hasheado y luego eliminar, reemplaza las variables a las que tengas en tu .env
$email = $_ENV['DB_USER_ADMIN'] ?? "admin@correo.com";
$passwordPlano = $_ENV['DB_PASS_ADMIN'] ?? "admin123";

// Hash de la contraseña
$passwordHash = password_hash($passwordPlano, PASSWORD_BCRYPT);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}');";

try {
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
        echo "✅ Usuario Administrador creado con éxito.<br>";
        echo "📧 Email: " . htmlspecialchars($email) . "<br>";
        echo "🔒 Password: [Configurado en su .env]<br>";
        echo "⚠️  Por seguridad, elimine este archivo (public/crearUsuario.php) ahora.";
    }
} catch (Exception $e) {
    echo "❌ Error al crear el usuario: " . $e->getMessage();
}