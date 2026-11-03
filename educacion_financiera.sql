-- Base de datos: educacion_financiera
-- Generado para proyecto "Educación Financiera"

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `educacion_financiera` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `educacion_financiera`;

-- --------------------------------------------------------
-- Tabla: usuarios
-- --------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `rol` ENUM('estudiante','admin') NOT NULL DEFAULT 'estudiante',
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `email_verificado` TINYINT(1) NOT NULL DEFAULT 0,
  `token_verificacion` VARCHAR(255) NULL,
  `eliminado_en` TIMESTAMP NULL DEFAULT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_usuarios_email` (`email`),
  KEY `idx_usuarios_activo` (`activo`),
  KEY `idx_usuarios_email_verificado` (`email_verificado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: membresias
-- --------------------------------------------------------

DROP TABLE IF EXISTS `membresias`;
CREATE TABLE `membresias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `activa` TINYINT(1) NOT NULL DEFAULT 1,
  `tipo_membresia` ENUM('gratis','pro','premium') NOT NULL DEFAULT 'gratis',
  `fecha_inicio` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_membresias_usuario_id` (`usuario_id`),
  CONSTRAINT `fk_membresias_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: inscripciones
-- --------------------------------------------------------

DROP TABLE IF EXISTS `inscripciones`;
CREATE TABLE `inscripciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `materia_id` VARCHAR(50) NOT NULL,
  `semestre` TINYINT UNSIGNED NOT NULL,
  `fecha_inscripcion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_usuario_materia` (`usuario_id`,`materia_id`),
  KEY `idx_inscripciones_usuario_id` (`usuario_id`),
  KEY `idx_inscripciones_semestre` (`semestre`),
  CONSTRAINT `fk_inscripciones_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: password_resets (recuperación de contraseña)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` TIMESTAMP NOT NULL,
  `usado` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_password_resets_email` (`email`),
  KEY `idx_password_resets_token` (`token`),
  KEY `idx_password_resets_expiracion` (`fecha_expiracion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: email_verifications (verificación de email)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `email_verifications`;
CREATE TABLE `email_verifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `email_nuevo` VARCHAR(150) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` TIMESTAMP NOT NULL,
  `usado` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_email_verifications_usuario` (`usuario_id`),
  KEY `idx_email_verifications_token` (`token`),
  CONSTRAINT `fk_email_verifications_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: login_logs (auditoría de ingresos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE `login_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NULL,
  `email` VARCHAR(150) NOT NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` VARCHAR(500) NULL,
  `exitoso` TINYINT(1) NOT NULL,
  `fecha_intent` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_login_logs_usuario` (`usuario_id`),
  KEY `idx_login_logs_email` (`email`),
  KEY `idx_login_logs_fecha` (`fecha_intent`),
  CONSTRAINT `fk_login_logs_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: cambios_perfil (auditoría de cambios)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cambios_perfil`;
CREATE TABLE `cambios_perfil` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `campo_cambiado` VARCHAR(50) NOT NULL,
  `valor_anterior` TEXT NULL,
  `valor_nuevo` TEXT NULL,
  `ip_address` VARCHAR(45) NULL,
  `fecha_cambio` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cambios_perfil_usuario` (`usuario_id`),
  KEY `idx_cambios_perfil_fecha` (`fecha_cambio`),
  CONSTRAINT `fk_cambios_perfil_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: rate_limits (protección contra ataques)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `rate_limits`;
CREATE TABLE `rate_limits` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `accion` VARCHAR(50) NOT NULL,
  `intentos` INT UNSIGNED NOT NULL DEFAULT 1,
  `fecha_ultimo_intento` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_bloqueo` TIMESTAMP NULL DEFAULT NULL,
  `fecha_desbloqueo` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_rate_limits_ip_accion` (`ip_address`, `accion`),
  KEY `idx_rate_limits_fecha_bloqueo` (`fecha_bloqueo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: cursos (cursos dinámicos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `nivel` ENUM('principiante','intermedio','avanzado') NOT NULL DEFAULT 'principiante',
  `duracion_horas` DECIMAL(5,2) NULL,
  `imagen_url` VARCHAR(500) NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cursos_categoria` (`categoria`),
  KEY `idx_cursos_nivel` (`nivel`),
  KEY `idx_cursos_activo` (`activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: lecciones (lecciones de cursos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `lecciones`;
CREATE TABLE `lecciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `contenido` TEXT NOT NULL,
  `video_url` VARCHAR(500) NULL,
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_lecciones_curso` (`curso_id`),
  CONSTRAINT `fk_lecciones_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: progreso_usuario (progreso de cursos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `progreso_usuario`;
CREATE TABLE `progreso_usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `curso_id` INT UNSIGNED NOT NULL,
  `leccion_id` INT UNSIGNED NULL,
  `completado` TINYINT(1) NOT NULL DEFAULT 0,
  `porcentaje` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `fecha_inicio` TIMESTAMP NULL DEFAULT NULL,
  `fecha_completado` TIMESTAMP NULL DEFAULT NULL,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_progreso_usuario_curso` (`usuario_id`, `curso_id`),
  KEY `idx_progreso_usuario_usuario` (`usuario_id`),
  KEY `idx_progreso_curso` (`curso_id`),
  CONSTRAINT `fk_progreso_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_progreso_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: logros (badges y recompensas)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `logros`;
CREATE TABLE `logros` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `icono` VARCHAR(100) NULL,
  `puntos_requeridos` INT UNSIGNED NOT NULL DEFAULT 0,
  `cursos_requeridos` INT UNSIGNED NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_logros_activo` (`activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: logros_usuario (logros desbloqueados)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `logros_usuario`;
CREATE TABLE `logros_usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `logro_id` INT UNSIGNED NOT NULL,
  `fecha_desbloqueo` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_logros_usuario` (`usuario_id`, `logro_id`),
  KEY `idx_logros_usuario_usuario` (`usuario_id`),
  CONSTRAINT `fk_logros_usuario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_logros_usuario_logro` FOREIGN KEY (`logro_id`) REFERENCES `logros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: puntos_usuario (sistema de puntos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `puntos_usuario`;
CREATE TABLE `puntos_usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `puntos_totales` INT UNSIGNED NOT NULL DEFAULT 0,
  `nivel` INT UNSIGNED NOT NULL DEFAULT 1,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_puntos_usuario` (`usuario_id`),
  CONSTRAINT `fk_puntos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Datos iniciales de cursos (opcional)
-- --------------------------------------------------------

INSERT INTO `cursos` (`titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES
('Finanzas Personales', 'Aprende a gestionar tu dinero de forma inteligente y alcanzar tus metas financieras.', 'Básico', 'principiante', 10.5, 'img/nivel1.jpg', 1),
('Ahorro e Inversión', 'Descubre estrategias efectivas para ahorrar y hacer crecer tu dinero.', 'Intermedio', 'intermedio', 15.0, 'img/nivel2.jpg', 2),
('Presupuesto Mensual 50/30/20', 'Domina la regla 50/30/20 para optimizar tus gastos.', 'Básico', 'principiante', 8.0, 'img/nivel3.jpg', 3),
('Emprendimiento y Negocios', 'Transforma tus ideas en un negocio rentable.', 'Avanzado', 'avanzado', 20.0, NULL, 4);

-- --------------------------------------------------------
-- Datos iniciales de logros (opcional)
-- --------------------------------------------------------

INSERT INTO `logros` (`nombre`, `descripcion`, `icono`, `puntos_requeridos`, `cursos_requeridos`) VALUES
('Primer Paso', 'Completaste tu primer curso', '🎯', 100, 1),
('Estudiante Dedicado', 'Completaste 3 cursos', '📚', 300, 3),
('Maestro Financiero', 'Completaste 5 cursos', '🏆', 500, 5),
('Investigador', 'Exploraste todos los recursos', '🔍', 200, NULL),
('Consistente', 'Te has conectado 7 días seguidos', '🔥', 150, NULL);

COMMIT;
