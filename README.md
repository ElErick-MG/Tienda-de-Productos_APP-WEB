<div align="center">

# 🛍️ E-Commerce Web Application (PHP & MySQL)

  <p align="center">
    <strong>Una aplicación web de tienda en línea moderna, ligera y segura construida con PHP puro, MySQL y Arquitectura Profesional `public/` & `app/`.</strong>
  </p>

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Architecture](https://img.shields.io/badge/Architecture-Public%2FApp%20Pattern-00C7B7?style=for-the-badge)](https://github.com/)
[![UI Design](https://img.shields.io/badge/UI-Dark%20Mode%20%26%20Glassmorphism-7c3aed?style=for-the-badge)](https://google.github.io/)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

</div>

---

## 🌟 Descripción General

Esta aplicación demuestra cómo construir una **tienda en línea robusta y elegante sin frameworks pesados**, utilizando **PHP Nativo (Puro)** bajo las mejores prácticas de la industria:

- **Separación de Responsabilidades**: Directorio público `public/` aislado del núcleo del sistema `app/`.
- **Experiencia de Usuario (UX) Premium**: Diseño _Dark Mode_, tarjetas con efectos _Glassmorphism_, transiciones fluidas e interacción dinámica.
- **Internacionalización (i18n)**: Cambio instantáneo entre Español e Inglés persistido en Cookies.
- **Carrito de Compras Persistente**: Gestión completa de artículos y totales calculados en sesión de PHP.

---

## ⚡ Características Principales

| Característica                            | Descripción                                                                                 |
| :---------------------------------------- | :------------------------------------------------------------------------------------------ |
| 🔐 **Autenticación & Sesiones**           | Sistema de Login seguro con opción _"Recuérdame"_ (Cookie persistence).                     |
| 🛡️ **Arquitectura Segura (`public/app`)** | Las credenciales de BD y la lógica de negocio quedan fuera del alcance HTTP directo.        |
| 🌐 **Soporte Multi-idioma (i18n)**        | Selector dinámico `ES / EN` con carga modular de vocabularios.                              |
| 🎨 **Diseño Dark Mode Premium**           | Estilos CSS personalizados con gradientes violeta/cyan, fuentes Inter y micro-animaciones.  |
| 🛍️ **Catálogo & Filtrado por Idioma**     | Consulta dinámica a tablas especializadas (`productoses` / `productosen`).                  |
| 🛒 **Carrito de Compras**                 | Acumulación dinámica de ítems con feedback visual (Toasts & Badges) y cálculo de totales.   |
| ⚡ **Cero Dependencias Externas**         | Construido con HTML5, CSS3 puro y JavaScript Vanilla (sin frameworks ni librerías masivas). |

---

## 📁 Estructura del Proyecto

El proyecto implementa el patrón **Public Document Root**, garantizando que el servidor web solo exponga activos estáticos y controladores de vista:

```microservices
Tienda-de-Productos_APP-WEB/
│
├── 📄 index.php                   # Redirección transparente hacia public/index.php
├── 📄 README.md                   # Documentación oficial del repositorio
│
├── 📂 public/                     # 🌐 WEB ROOT (Única carpeta expuesta por el servidor web)
│   ├── 📄 index.php               # Vista de Iniciar Sesión (Punto de entrada)
│   ├── 📄 autorizar.php           # Controlador de autenticación y cookies
│   ├── 📄 mipanel.php             # Vista principal del catálogo de productos
│   ├── 📄 producto.php            # Vista detallada del producto seleccionado
│   ├── 📄 carrito.php             # Vista del carrito de compras y resumen
│   ├── 📄 cerrarsesion.php        # Controlador de cierre de sesión
│   └── 📂 assets/                 # Recursos estáticos de la interfaz
│       ├── 📂 css/
│       │   └── 🎨 style.css       # Sistema de diseño global (Glassmorphism & Dark Mode)
│       └── 📂 js/
│           └── ⚡ main.js         # Interacciones de usuario, Toast notifications y Ripples
│
├── 📂 app/                        # 🛡️ CORE APP (Protegido contra accesos web directos)
│   ├── 📂 config/
│   │   └── ⚙️ db.config.php       # Parámetros y credenciales de conexión a MySQL
│   ├── 📂 core/
│   │   └── 🔌 DBConnection.php    # Clase wrapper para consultas MySQLi en UTF-8
│   ├── 📂 helpers/
│   │   └── 🛠️ session.helper.php  # Helpers de verificación de sesión e idioma
│   └── 📂 lang/
│       ├── 🌍 es.php              # Diccionario de textos en Español
│       └── 🌍 en.php              # Diccionario de textos en Inglés
│
└── 📂 database/
    └── 🗄️ tienda.sql              # Script SQL de creación e inserción de datos iniciales
```

---

## 🔒 Arquitectura & Seguridad

> [!IMPORTANT]
> **¿Por qué separar en `public/` y `app/`?**
> En un servidor de producción o en XAMPP, los archivos sensibles como `db.config.php` contienen contraseñas de la base de datos. Si el servidor web sufre una falla de configuración, los archivos PHP dentro de la raíz directa podrían quedar expuestos en texto plano.
>
> Al aislar la carpeta `public/` como el **DocumentRoot**:
>
> 1. Un atacante jamás puede acceder por URL directa a `http://localhost/app/config/db.config.php`.
> 2. Solo las vistas públicas y los assets estáticos se entregan al navegador.
> 3. Sigue los mismos estándares de seguridad que **Laravel**, **Symfony** o **Yii2**.

---

## 🚀 Guía de Instalación Rápida (XAMPP / WAMPP)

### Prerrequisitos

- **PHP** `>= 8.0`
- **MySQL** / MariaDB
- Servidor Web **Apache** (vía XAMPP, WAMPP o servidor local)

### Pasos

1. **Clonar o descargar el repositorio:**

   ```bash
   git clone https://github.com/tu-usuario/Tienda-de-Productos_APP-WEB.git
   ```

   _(Si usas XAMPP, ubica el proyecto en `C:\xampp\htdocs\Tienda-de-Productos_APP-WEB`)_

2. **Configurar la Base de Datos:**
   - Inicia los servicios de **Apache** y **MySQL** en XAMPP Control Panel.
   - Abre [phpMyAdmin](http://localhost/phpmyadmin/).
   - Crea una nueva base de datos llamada `tienda`.
   - Importa el archivo SQL ubicado en: [`database/tienda.sql`](database/tienda.sql).

3. **Verificar Configuración de BD:**
   Si tus credenciales de MySQL en local difieren de las predeterminadas (`localhost`, usuario `root`, sin clave), edita el archivo [`app/config/db.config.php`](app/config/db.config.php):

   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'tienda');
   ```

4. **Ejecutar en el Navegador:**
   Abre tu navegador e ingresa a:
   ```http
   http://localhost/Tienda-de-Productos_APP-WEB/
   ```
   _(El sistema te redirigirá automáticamente a la pantalla de login en `public/index.php`)_

---

## 🔑 Credenciales de Prueba

Para ingresar al sistema durante demostraciones o evaluaciones, utiliza las siguientes credenciales:

| Campo          | Credencial |
| :------------- | :--------- |
| **Usuario**    | `test`     |
| **Contraseña** | `test123`  |

---

## 🛠️ Tecnologías Utilizadas

- **Language:** PHP 8+ (Programación Orientada a Objetos, Manejo de Sesiones & Cookies)
- **Database:** MySQL / MariaDB (driver `mysqli` con charset `utf8mb4`)
- **Frontend Core:** HTML5 Semántico
- **Styles:** CSS3 Vanilla (Custom Properties, Flexbox, CSS Grid, Glassmorphism effects)
- **Typography:** [Inter Font](https://fonts.google.com/specimen/Inter) vía Google Fonts
- **Client Scripting:** JavaScript ES6+ (DOM API, Fetch, Toast Notifications)

---

<div align="center">
  <sub>Desarrollado con dedicación y enfoque en código limpio. Si este proyecto te sirve de inspiración, ¡no olvides darle una ⭐️ en GitHub! | erickdevlml@gmail.com</sub>
</div>
