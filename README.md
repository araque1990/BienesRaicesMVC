# 🏠 Bienes Raíces MVC - Professional Edition

Este proyecto es una plataforma de gestión inmobiliaria que utiliza una arquitectura **MVC personalizada**. A diferencia de la implementación estándar, esta edición ha sido refactorizada para cumplir con estándares de infraestructura moderna, seguridad de procesos y testing automatizado.

## 🚀 Diferenciadores Técnicos (Valor Añadido)

- **Hardened Docker Infrastructure:** Despliegue seguro mediante el mapeo dinámico de **UID/GID**. Esto evita vulnerabilidades de escalada de privilegios al asegurar que los procesos del contenedor no corran como `root` y coincidan con el usuario del host.
- **Blog Engine con Contenido Dinámico:** Implementación de lógica en el controlador para la generación de entradas con **Lorem Ipsum aleatorio** y soporte nativo para formatos de imagen de próxima generación (**WebP**).
- **Seguridad en Auth:** Sistema de hashing con `password_hash` y protección de rutas mediante un Router que intercepta peticiones no autorizadas.
- **Gestión Eficiente:** Uso de **pnpm** para una gestión de dependencias ultra rápida y ahorro de espacio mediante *content-addressable storage*.

## 🛠️ Stack Tecnológico
- **Backend:** PHP 8.4 (FPM)
- **Base de Datos:** MariaDB 11.4
- **Servidor Web:** Nginx (Configuración optimizada)
- **Frontend:** SASS, Vanilla JS, Gulp
- **Email:** Mailpit (Captura de SMTP local)
- **Gestores:** pnpm & Composer

## 📦 Estructura del Proyecto (Clean Architecture)
```bash
.
├── app/                  # Núcleo: Controllers, Models (ActiveRecord) y Router
├── docker/               # Infraestructura y Scripts SQL de inicio
├── public/               # Entry point (index.php) y Assets procesados
├── src/                  # Source de Assets (SCSS, JS original)
├── views/                # Templates del motor de vistas
├── scripts/              # Base de datos con datos de ejemplo
└── dev.sh                # Script de automatización total

⚙️ Instalación en 3 Pasos
1. Clonar y Preparar:
git clone git@github.com:araque1990/BienesRaicesMVC.git
cd BienesRaicesMVC
chmod +x dev.sh

2. ./dev.sh
Este script configurará tus permisos, levantará Docker, instalará pnpm/composer e importará la DB automáticamente.

3. Crear Usuario Admin: Una vez arriba, ejecuta por única vez: http://localhost/crearUsuario.php para generar el acceso administrativo con las credenciales definidas en tu .env.

🛡️ Ciberseguridad y Permisos
El Dockerfile ha sido auditado para garantizar que el usuario developer dentro del contenedor sea el propietario de los archivos generados (imágenes subidas, logs), eliminando la necesidad de usar sudo para el mantenimiento del proyecto y mejorando la superficie de ataque del servidor.

👨‍💻Sobre el Autor y el Proyecto
Este proyecto ha sido desarrollado por Cristian Araque (Enfoque: Mid-Developer / Cybersecurity Enthusiast). Si bien la base conceptual y visual nace del curso de "Desarrollo Web Completo" del profesor Juan de la Torre, esta implementación ha sido refactorizada y evolucionada íntegramente para cumplir con estándares modernos de ingeniería de software y seguridad.

🚀 Mejoras y Diferenciadores (Vs. Versión del Curso)
Infraestructura & DevOps:

Stack Moderno: Migración total de Apache a Nginx para una gestión de peticiones más eficiente.

Contenedorización: Uso avanzado de Docker para garantizar la portabilidad y versiones de PHP 8.4 y MariaDB 11.4.

Gestión de Paquetes: Implementación de pnpm en lugar de npm, optimizando el tiempo de instalación y el espacio en disco.

Automation: Creación de un script de instalación automática (dev.sh) para un despliegue "zero-friction" en entornos locales.

Ciberseguridad & Backend:

Hardening de DB: Estructura de base de datos modificada y sanitización estricta de datos para prevenir ataques de inyección (SQLi) y asegurar la integridad de la información.

Entorno Seguro: Gestión de credenciales mediante variables de entorno (.env), eliminando datos sensibles del código fuente.

Testing de Email: Integración de Mailpit en el flujo de Docker, permitiendo pruebas de correo seguras y locales sin depender de servicios externos como Mailtrap.

Lógica de Negocio Dinámica:

Escalabilidad: Refactorización del código para ser altamente dinámico y reutilizable.

Generación de Contenido: Implementación de lógica aleatoria para entradas de blog, permitiendo testear el diseño con datos variables en tiempo real.

Pipeline de Assets:

Actualización de Gulp y sus plugins para una compilación más rápida de SASS y optimización automática de imágenes a formato WebP.