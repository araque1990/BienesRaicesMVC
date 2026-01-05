#!/bin/bash

# Script de configuración automatizada para reclutadores/desarrolladores
echo "🏠 Configurando Bienes Raíces MVC - Professional Edition..."

# 1. Variables de Entorno
if [ ! -f .env ]; then
    echo "📄 Generando .env desde plantilla..."
    cp .env.example .env
    # Detectar UID/GID para permisos Docker (Ciberseguridad/Hardening)
    sed -i "s/UID=1000/UID=$(id -u)/" .env
    sed -i "s/GID=1000/GID=$(id -g)/" .env
fi

# 2. Instalación de dependencias (Rápido con pnpm)
echo "📦 Instalando dependencias de Node con pnpm..."
pnpm install

echo "🐘 Instalando dependencias de PHP con Composer..."
docker run --rm -v $(pwd):/app composer install

# 3. Infraestructura
echo "🐳 Levantando contenedores (Nginx, MariaDB, PHP 8.4, Mailpit)..."
docker-compose up -d --build

# 4. Base de Datos
echo "🗄️  Esperando a la base de datos para importar esquema..."
sleep 10
docker exec -i bienesraices_db mysql -u root -p$(grep DB_PASS .env | cut -d'=' -f2) bienesraices_crud < scripts/bienesraices_MVC.sql

echo "✅ Entorno listo en http://localhost"
echo "📧 Mailpit (Email testing) en http://localhost:8025"

echo "⚠️  IMPORTANTE: Abre http://localhost/crearUsuario.php para generar tu acceso admin"
echo "usando las credenciales definidas en tu .env"