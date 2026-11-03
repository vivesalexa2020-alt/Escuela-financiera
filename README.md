# Educación Financiera

Plataforma web de educación financiera con sistema de autenticación, cursos interactivos, gamificación y seguimiento de progreso.

## 📋 Características

- **Sistema de autenticación completo**: Registro, login, recuperación de contraseña
- **Cursos dinámicos**: Gestión de cursos y lecciones desde base de datos
- **Sistema de membresías**: Gratis, Pro, Premium
- **Gamificación**: Puntos, niveles, logros y badges
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
- **Backend**: PHP 7.4+
- **Base de datos**: MySQL 5.7+ / MariaDB 10.3+
- **Servidor web**: Apache o Nginx

## 📦 Instalación

### Requisitos previos

- PHP 7.4 o superior
- MySQL 5.7+ o MariaDB 10.3+
- Servidor web (Apache/Nginx)
- Composer (opcional, para dependencias futuras)

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd EDUCACION_FINANCIERA
   ```

2. **Configurar base de datos**
   ```bash
   # Crear base de datos
   mysql -u root -p
   CREATE DATABASE educacion_financiera;
   ```

3. **Importar estructura de la base de datos**
   ```bash
   mysql -u root -p educacion_financiera < educacion_financiera.sql
   ```

4. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   # Editar .env con tus credenciales
   ```

5. **Configurar permisos**
   ```bash
   # Asegurar que la carpeta api tenga permisos de escritura para logs
   chmod 755 api
   ```

6. **Configurar servidor web**
   
   **Apache**:
   - Asegurar que mod_rewrite esté habilitado
   - Configurar DocumentRoot apuntando a la carpeta del proyecto
   
   **Nginx**:
   ```nginx
   server {
       listen 80;
       server_name localhost;
       root /ruta/a/EDUCACION_FINANCIERA;
       index index.html;
       
       location / {
           try_files $uri $uri/ /index.html;
       }
       
       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
           fastcgi_index index.php;
           include fastcgi_params;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       }
   }
   ```

## 🔧 Configuración

### Variables de entorno (.env)

```env
DB_HOST=localhost
DB_NAME=educacion_financiera
DB_USER=root
DB_PASSWORD=tu_contraseña
```

### Estructura de carpetas

```
EDUCACION_FINANCIERA/
├── api/                  # Endpoints PHP
│   ├── conexion.php      # Conexión a BD
│   ├── login.php         # Autenticación
│   ├── registro.php      # Registro
│   ├── csrf.php          # Protección CSRF
│   ├── rate_limiter.php  # Rate limiting
│   └── ...
├── css/                  # Estilos modulares
│   ├── base/            # Variables, reset, layout
│   ├── components/      # Botones, modales, etc.
│   └── main.css         # Archivo principal
├── js/                   # JavaScript modular
│   ├── modules/         # Módulos ES6
│   │   ├── auth.js      # Autenticación
│   │   └── ui.js        # Componentes UI
│   └── main.js          # Punto de entrada
├── img/                  # Imágenes y assets
├── *.html               # Páginas del sitio
├── .env                 # Variables de entorno (no versionar)
├── .env.example         # Plantilla de .env
└── README.md            # Este archivo
```

## 🗄️ Base de datos

### Tablas principales

- `usuarios`: Información de usuarios
- `membresias`: Tipos de suscripción
- `inscripciones`: Inscripciones a cursos
- `cursos`: Cursos disponibles
- `lecciones`: Lecciones de cursos
- `progreso_usuario`: Progreso de cada usuario
- `logros`: Badges y recompensas
- `logros_usuario`: Logros desbloqueados
- `puntos_usuario`: Sistema de puntos y niveles
- `login_logs`: Auditoría de ingresos
- `cambios_perfil`: Auditoría de cambios
- `rate_limits`: Control de intentos
- `password_resets`: Tokens de recuperación
- `email_verifications`: Verificación de email

## 🔒 Seguridad

### Implementaciones de seguridad

1. **Rate Limiting**: Limita intentos de login/registro por IP
2. **CSRF Protection**: Tokens en formularios POST
3. **Password Hashing**: Usando `password_hash()` de PHP
4. **Soft Delete**: Los usuarios no se eliminan permanentemente
5. **Auditoría**: Registro de todos los cambios importantes
6. **Secure Cookies**: Configuración httponly, samesite
7. **SQL Injection Protection**: Usando prepared statements

### Buenas prácticas

- Nunca commitar `.env` (incluido en .gitignore)
- Usar HTTPS en producción
- Mantener PHP y MySQL actualizados
- Revisar logs regularmente
- Implementar backups automáticos

## 🚀 Despliegue

### Producción

1. Minificar CSS y JS
2. Habilitar compresión gzip
3. Configurar CDN para assets estáticos
4. Usar HTTPS con certificado SSL
5. Configurar CORS apropiadamente
6. Deshabilitar display_errors en PHP
7. Configurar cache-control apropiado

## 📱 API Endpoints

### Autenticación

- `POST /api/login.php` - Iniciar sesión
- `POST /api/registro.php` - Registrar usuario
- `POST /api/logout.php` - Cerrar sesión
- `GET /api/session.php` - Verificar sesión
- `POST /api/verificar-email.php` - Verificar email

### Perfil

- `POST /api/actualizar-perfil.php` - Actualizar perfil
- `POST /api/cambiar-password.php` - Cambiar contraseña
- `POST /api/eliminar-cuenta.php` - Eliminar cuenta

### Cursos

- `GET /api/cursos.php` - Listar cursos
- `GET /api/cursos.php?id=X` - Obtener curso específico
- `POST /api/inscripciones.php` - Inscribirse a curso
- `DELETE /api/inscripciones.php` - Cancelar inscripción

### Progreso

- `GET /api/progreso.php` - Obtener progreso
- `POST /api/progreso.php` - Actualizar progreso

## 🧪 Testing

```bash
# Pruebas de conexión a BD
php -r "require 'api/conexion.php'; echo 'Conexión exitosa';"

# Verificar logs
tail -f api/logs/error.log
```

## 📝 Contribución

1. Fork el proyecto
2. Crear rama feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abrir Pull Request

## 📄 Licencia

Este proyecto es de uso educativo. Todos los derechos reservados.

## 🆘 Soporte

Para reportar bugs o solicitar features, abrir un issue en el repositorio.

## 🔄 Roadmap

- [ ] Sistema de pagos integrado
- [ ] Chat en tiempo real
- [ ] API REST completa
- [ ] App móvil
- [ ] Sistema de referidos
- [ ] Certificados de completación
- [ ] Analytics avanzado
