# Educación Financiera

Plataforma web de educación financiera con sistema de autenticación, cursos interactivos, gamificación y seguimiento de progreso.

## 📋 Características

- **Sistema de autenticación completo**: Registro, login, recuperación de contraseña
- **Cursos dinámicos**: Gestión de cursos y lecciones desde base de datos
- **Sistema de membresías**: Gratis, Pro, Premium
- **Gamificación**: Puntos, niveles, logros y badges
- **Arquitectura MVC**: Modelo-Vista-Controlador organizado profesionalmente
- **Seguridad avanzada**:
  - Rate limiting contra ataques de fuerza bruta
  - Protección CSRF en formularios
  - Soft delete de usuarios
  - Auditoría de cambios y accesos
  - Verificación de email
- **Diseño responsivo**: Optimizado para móvil, tablet y desktop
- **Caching de API**: Mejora de rendimiento
- **Lazy loading**: Optimización de carga de imágenes

## 🛠️ Tecnologías

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 8.2+ (Arquitectura MVC)
- **Base de datos**: MySQL 5.7+ / MariaDB 10.3+
- **Servidor web**: Apache (XAMPP) o Nginx

## 🏗️ Arquitectura MVC

```
EDUCACION_FINANCIERA/
├── autoload.php                 # Autoloader PSR-4 (namespace App\)
├── index.php                    # Front Controller Web
│
├── app/                         # ========= Arquitectura MVC =========
│   ├── Config/
│   │   ├── AppConfig.php        # CORS, constantes globales
│   │   └── Database.php         # Conexión PDO (Singleton)
│   │
│   ├── Core/                    # Framework base reutilizable
│   │   ├── Controller.php       # Controlador base (JSON, auth, CSRF)
│   │   ├── Model.php            # Modelo base (transacciones PDO)
│   │   ├── View.php             # Motor de vistas con layouts
│   │   ├── Router.php           # Enrutador (soporta ?page= y rutas)
│   │   ├── Session.php          # Gestión segura de sesiones
│   │   ├── Csrf.php             # Tokens CSRF
│   │   ├── RateLimiter.php      # Protección de fuerza bruta
│   │   └── Logger.php           # Sistema de logs en disco
│   │
│   ├── Models/                  # Capa de datos (consultas SQL)
│   │   ├── UserModel.php        # Usuarios, login, perfil, auditoría
│   │   ├── CourseModel.php      # Cursos, lecciones, ejercicios
│   │   ├── EnrollmentModel.php  # Inscripciones a materias
│   │   ├── ProgressModel.php    # Progreso y porcentaje por curso
│   │   ├── AchievementModel.php # Puntos, niveles, logros
│   │   └── MembershipModel.php  # Membresías y suscripciones
│   │
│   ├── Controllers/             # Lógica de negocio
│   │   ├── AuthController.php   # Login, registro, logout, sesión
│   │   ├── UserController.php   # Perfil, contraseña, eliminar cuenta
│   │   ├── CourseController.php  # Listado y detalle de cursos
│   │   ├── EnrollmentController.php # Inscripciones (GET/POST/DELETE)
│   │   ├── ProgressController.php   # Progreso de usuario
│   │   ├── AchievementController.php # Logros y puntos
│   │   ├── MembershipController.php  # Membresías
│   │   └── PageController.php        # Renderiza las páginas
│   │
│   └── Views/                   # Capa de presentación
│       ├── layouts/
│       │   ├── header.php       # <head> HTML (title + CSS por página)
│       │   └── main.php         # Envoltura <body> + contenido
│       └── pages/               # Una vista por página (contenido completo)
│           ├── home.php         # Página principal
│           ├── cursos.php       # Catálogo de cursos
│           ├── aula.php         # Aula virtual con reproductor
│           ├── recursos.php     # Herramientas y descargas
│           ├── reticula.php     # Retícula académica semestral
│           ├── metas.php        # Seguimiento de metas financieras
│           ├── configuraciones.php # Configuración de cuenta
│           └── suscripcion.php  # Planes y membresías
│
├── routes/                      # Definición de rutas
│   ├── web.php                  # Rutas de páginas
│   └── api.php                  # Rutas de la API REST
├── api/                         # Front Controller API
│   └── index.php                # Entrada API (?endpoint=)
├── database/                    # Esquema SQL de la base de datos
│   └── educacion_financiera.sql # Definición de tablas y relaciones
│
├── public/                      # Archivos estáticos públicos
│   ├── css/                      # Estilos, incluido CSS por página
│   ├── img/                      # Imágenes
│   ├── estilos.css               # Hoja de estilos principal
│   └── script.js                 # JavaScript global (API + CSRF)
├── legacy/                      # Código y datos archivados (no se sirve)
│   ├── api/                     # Endpoints PHP antiguos
│   ├── html/                    # Páginas HTML originales
│   ├── css/                     # CSS antiguo (main, base, components)
│   ├── js/                      # JS modular antiguo
│   ├── views/                   # Vistas antiguas (navbar/footer/modales)
│   ├── backups/                 # Copias .bak
│   ├── data/                    # JSON auxiliares
│   └── scripts/                 # Scripts PowerShell de un solo uso
├── .env                         # Variables de entorno
├── .env.example                 # Plantilla de .env
└── .gitignore
```

## 📦 Instalación

### Requisitos previos

- PHP 8.0 o superior (XAMPP 8.2 recomendado)
- MySQL 5.7+ o MariaDB 10.3+
- Servidor web (Apache/Nginx)

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd EDUCACION_FINANCIERA
   ```

2. **Configurar base de datos**
   ```bash
   mysql -u root -p
   CREATE DATABASE educacion_financiera;
   ```

3. **Importar estructura de la base de datos**
   ```bash
   mysql -u root -p educacion_financiera < database/educacion_financiera.sql
   ```

4. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   # Editar .env con tus credenciales
   ```

5. **Acceder a la plataforma**
   - **Vistas MVC**: `http://localhost/EDUCACION_FINANCIERA/index.php`
   - **Páginas**: `index.php?page=home|cursos|aula|recursos|reticula|metas|configuraciones|suscripcion`
   - **API REST MVC**: `http://localhost/EDUCACION_FINANCIERA/api/index.php?endpoint=session`

## 📱 API Endpoints

### Vía Front Controller MVC (`api/index.php`)

| Endpoint | Método | Descripción |
|----------|--------|-------------|
| `?endpoint=login` | POST | Iniciar sesión |
| `?endpoint=registro` | POST | Registrar usuario |
| `?endpoint=logout` | POST | Cerrar sesión |
| `?endpoint=session` | GET | Verificar sesión activa |
| `?endpoint=verificar-email` | POST | Verificar email |
| `?endpoint=actualizar-perfil` | POST | Actualizar perfil |
| `?endpoint=cambiar-password` | POST | Cambiar contraseña |
| `?endpoint=eliminar-cuenta` | POST | Eliminar cuenta (soft delete) |
| `?endpoint=cursos` | GET | Listar cursos |
| `?endpoint=cursos&id=1` | GET | Detalle de curso |
| `?endpoint=inscripciones` | GET/POST/DELETE | Inscripciones a materias |
| `?endpoint=progreso` | GET/POST | Progreso de usuario |
| `?endpoint=logros` | GET | Logros y puntos |
| `?endpoint=membresia` | GET | Membresía activa |

### Código legacy

Los endpoints PHP individuales (`login.php`, `registro.php`, etc.) y sus adaptadores de compatibilidad fueron archivados en `legacy/api/` y ya no forman parte del flujo activo. La única entrada de la API es `api/index.php?endpoint=...`.

## 🔒 Seguridad

1. **Rate Limiting**: Limita intentos de login/registro por IP
2. **CSRF Protection**: Tokens en formularios POST
3. **Password Hashing**: Usando `password_hash()` de PHP
4. **Soft Delete**: Los usuarios no se eliminan permanentemente
5. **Auditoría**: Registro de todos los cambios importantes
6. **Secure Cookies**: Configuración httponly, samesite
7. **SQL Injection Protection**: Usando prepared statements

## 🚀 Despliegue

### Producción

1. Minificar CSS y JS
2. Habilitar compresión gzip
3. Configurar CDN para assets estáticos
4. Usar HTTPS con certificado SSL
5. Configurar CORS apropiadamente
6. Deshabilitar display_errors en PHP
7. Configurar cache-control apropiado
