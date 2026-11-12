-- Base de datos: educacion_financiera
-- Generado para proyecto "Educación Financiera" - Cursos, Videos, Ejercicios, Audios y Libros

SET FOREIGN_KEY_CHECKS = 0;
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
-- Tabla: cursos (cursos estructurados por nivel / semestre de 6 meses)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(50) NOT NULL UNIQUE,
  `semestre` TINYINT UNSIGNED NOT NULL DEFAULT 1,
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
  KEY `idx_cursos_semestre` (`semestre`),
  KEY `idx_cursos_categoria` (`categoria`),
  KEY `idx_cursos_nivel` (`nivel`),
  KEY `idx_cursos_activo` (`activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: lecciones (videos y lecciones de cursos)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `lecciones`;
CREATE TABLE `lecciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `contenido` TEXT NOT NULL,
  `video_url` VARCHAR(500) NULL,
  `duracion` VARCHAR(20) DEFAULT '15:00',
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_lecciones_curso` (`curso_id`),
  CONSTRAINT `fk_lecciones_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: ejercicios (quizzes, prácticas, simulaciones)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `ejercicios`;
CREATE TABLE `ejercicios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `tipo` VARCHAR(50) NOT NULL DEFAULT 'practica',
  `descripcion` TEXT NOT NULL,
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ejercicios_curso` (`curso_id`),
  CONSTRAINT `fk_ejercicios_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: audios (podcasts y audioguías)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `audios`;
CREATE TABLE `audios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `duracion` VARCHAR(20) NOT NULL DEFAULT '20:00',
  `audio_url` VARCHAR(500) NULL,
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_audios_curso` (`curso_id`),
  CONSTRAINT `fk_audios_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla: libros (ebooks, manuales y lecturas recomendadas)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `libros`;
CREATE TABLE `libros` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `autor` VARCHAR(150) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `tipo` VARCHAR(50) NOT NULL DEFAULT 'ebook',
  `archivo_url` VARCHAR(500) NULL,
  `orden` INT UNSIGNED NOT NULL DEFAULT 0,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_libros_curso` (`curso_id`),
  CONSTRAINT `fk_libros_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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

-- ========================================================
-- DATOS INICIALES: CURSOS, VIDEOS, EJERCICIOS, AUDIOS Y LIBROS
-- ========================================================

-- ========================================================
-- Materia 1: Unidad 1: Psicología del dinero y cambio de hábitos (Nivel 1)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (1, 'finanzas-personales', 1, 'Unidad 1: Psicología del dinero y cambio de hábitos', 'Entiende cómo tu mente decide con el dinero, rompe creencias limitantes y convierte la educación financiera en hábitos automáticos.', 'Nivel 1', 'principiante', 12.0, 'img/nivel1.jpg', 1);

-- Videos / Lecciones de Unidad 1: Psicología del dinero y cambio de hábitos
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (1, 'La psicología del dinero: comportamiento antes que conocimiento', 'Video lección práctica y conceptual: La psicología del dinero. Fundamento teórico de Morgen Housel, \'La psicología del dinero\'.', 'https://www.youtube.com/embed/WF6qLnuh4EA', '14:32', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (1, 'Hábitos atómicos financieros: identidad antes que motivación', 'Video lección práctica y conceptual: Hábitos atómicos (James Clear) y El poder de los hábitos (Charles Duhigg).', 'https://www.youtube.com/embed/DT6Nh3aV5Vc', '12:10', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (1, 'Cómo tu mente sabotea tu relación con el dinero', 'Video lección práctica y conceptual: Cómo tu mente sabotea tu relación con el dinero. Enlace oficial: https://youtu.be/DT6Nh3aV5Vc?si=7Goupsx4H4p_JuUP', 'https://www.youtube.com/embed/DT6Nh3aV5Vc', '13:45', 3);

-- Ejercicios prácticos de Unidad 1
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (1, 'Quiz: ¿Qué tan saludables son tus finanzas?', 'quiz', 'Responde 15 preguntas para obtener tu diagnóstico financiero personalizado y descubrir tus áreas de mejora.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (1, 'Rastreador de gastos semanal', 'practica', 'Registra todos tus gastos durante 7 días, clasifícalos en necesidades, deseos y ahorro, y calcula tu porcentaje real.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (1, 'Mi presupuesto 50/30/20', 'proyecto', 'Crea tu presupuesto mensual aplicando la regla 50/30/20 con tus ingresos reales y presenta un plan de acción.', 3);

-- Audios y Podcasts de Unidad 1
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (1, 'Mitos del dinero que te mantienen pobre', 'Desmontamos las 7 creencias más comunes sobre el dinero en México que frenan tu crecimiento financiero.', '22:15', 'audio/finanzas-personales-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (1, '¿Por qué no me alcanza el quincena?', 'Análisis de los patrones de gasto más comunes entre mexicanos y cómo romper el ciclo quincena a quincena.', '18:40', 'audio/finanzas-personales-2.mp3', 2);

-- Libros y Guías de Unidad 1: Psicología del dinero y cambio de hábitos
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (1, 'La psicología del dinero', 'Morgan Housel', 'Por qué la gente gana, ahorra e invierte distinto: el comportamiento importa más que el conocimiento.', 'ebook', 'libros/finanzas-personales-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (1, 'Hábitos atómicos', 'James Clear', 'Pequeños hábitos financieros diarios componen cambios extraordinarios: identidad primero, resultados después.', 'ebook', 'libros/finanzas-personales-2.epub', 2);

-- ========================================================
-- Materia 2: Unidad 2: Aprende a gastar y no gastar de más (Nivel 1)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (2, 'presupuesto', 1, 'Unidad 2: Aprende a gastar y no gastar de más', 'Domina la regla 50/30/20, elimina fugas hormiga y diseña un presupuesto base cero para que cada peso tenga un trabajo.', 'Nivel 1', 'principiante', 12.0, 'img/nivel1.jpg', 2);

-- Videos / Lecciones de Unidad 2: Aprende a gastar y no gastar de más
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (2, 'El presupuesto base cero paso a paso (Ramsey)', 'Video lección práctica y conceptual: El presupuesto base cero (Ramsey).', 'https://www.youtube.com/embed/zA67rkRiGXI', '15:30', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (2, 'La regla 50/30/20 aplicada con tu ingreso real', 'Video lección práctica y conceptual: La regla 50/30/20 aplicada a tu quincena.', 'https://www.youtube.com/embed/xnDpXyRsKlU', '16:05', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (2, 'Las 7 fugas invisibles de tu quincena', 'Video lección práctica y conceptual: Las 7 fugas invisibles de tu quincena (Ramsey).', 'https://www.youtube.com/embed/pTFZrS_8jRk', '11:18', 3);

-- Ejercicios prácticos de Unidad 2: Aprende a gastar y no gastar de más
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (2, 'Mi presupuesto base cero personalizado', 'practica', 'Ingresa tu ingreso mensual y define gasto-a-gasto dónde va cada peso aplicando la fórmula base cero.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (2, 'Simulador de compras por impulso', 'simulacion', 'Analiza 6 compras por impulso reales: ¿las harías en frío, en caliente o nunca?', 2);

-- Audios y Podcasts de Unidad 2: Construye tu fortaleza
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (2, 'Historias de crédito: lecciones aprendidas', 'Tres personas reales comparten cómo salieron de deudas de tarjetas de crédito usando estrategias inteligentes.', '25:10', 'audio/presupuesto-1.mp3', 1);

-- Libros y Guías de Unidad 2: Aprende a gastar y no gastar de más
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (2, 'Tu dinero o tu vida', 'Robin Dominguez y Vicki Robin', 'Mide tu dinero en horas de vida y gasta solo en lo que te hace libre: la guía socrática del gasto intencional.', 'ebook', 'libros/presupuesto-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (2, 'Pequeño Cerdo Capitalista', 'Sofía Macías', 'La guía mexicana más popular de finanzas personales, con lenguaje sencillo y ejemplos cercanos.', 'pdf', 'libros/presupuesto-2.pdf', 2);

-- ========================================================
-- Materia 3: Unidad 3: No pidas préstamos: sal de tus deudas (Nivel 1)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (3, 'gasto-hormiga', 1, 'Unidad 3: No pidas préstamos: sal de tus deudas', 'Bola de nieve y avalancha con fundamento conductual: liquida tarjetas y compromisos para nunca más vivir pidiendo prestado.', 'Nivel 1', 'principiante', 12.0, 'img/nivel1.jpg', 3);

-- Videos / Lecciones de Unidad 3: No pidas préstamos: sal de tus deudas
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (3, 'El costo real del CAT y las tasas de interés', 'Video lección práctica y conceptual: El costo real del CAT y las tasas de interés.', 'https://www.youtube.com/embed/JGwWNGJdvx8', '16:28', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (3, 'Bola de nieve vs avalancha: elige tu método', 'Video lección práctica y conceptual: Bola de nieve (Ramsey) vs avalancha.', 'https://www.youtube.com/embed/LK7qEnwi_R0', '18:40', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (3, 'Renegociación de deudas sin quitas destructivas', 'Video lección práctica y conceptual: Renegociación de deudas sin quitas destructivas. Enlace oficial: https://youtu.be/Hjv473hOiB0', 'https://www.youtube.com/embed/Hjv473hOiB0', '13:05', 3);

-- Ejercicios prácticos de Unidad 3
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (3, 'Calculadora de interés compuesto', 'practica', 'Ingresa tu capital inicial, aportación mensual y tasa de rendimiento para visualizar tu crecimiento a 5, 10 y 20 años.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (3, 'Proyecto: Mi primer portafolio de inversión', 'proyecto', 'Diseña un portafolio diversificado con instrumentos mexicanos, define porcentajes y justifica cada elección.', 2);

-- Audios y Podcasts de Unidad 3
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (3, 'Inversiones para principiantes: por dónde empezar', 'Explicación sencilla de los instrumentos de inversión disponibles en México para quienes nunca han invertido.', '20:05', 'audio/gasto-hormiga-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (3, 'La magia del interés compuesto con ejemplos reales', 'Casos prácticos de cómo $1,000 pesos mensuales pueden convertirse en un patrimonio significativo.', '16:30', 'audio/gasto-hormiga-2.mp3', 2);

-- Libros y Guías de Unidad 3: No pidas préstamos: sal de tus deudas
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (3, 'The Total Money Makeover', 'Dave Ramsey', 'El plan bola de nieve paso a paso para salir de deudas y nunca más pedir prestado.', 'ebook', 'libros/gasto-hormiga-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (3, 'Padre Rico, Padre Pobre', 'Robert Kiyosaki', 'La diferencia entre activos y pasivos: construye tu futuro sin depender del crédito.', 'ebook', 'libros/gasto-hormiga-2.epub', 2);

-- ========================================================
-- Materia 4: Aprende a ahorrar y crea tu fondo de emergencia (Nivel 1)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (4, 'fondo-emergencia', 1, 'Aprende a ahorrar y crea tu fondo de emergencia', 'Págate primero (principio de Clason) y construye tu escudo de 3 a 6 meses de gastos con un hábito de ahorro automático.', 'Nivel 1', 'intermedio', 12.0, 'img/nivel2.jpg', 4);

-- Videos / Lecciones de Aprende a ahorrar y crea tu fondo de emergencia
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (4, 'Págate primero: el 10% mágico (Clason)', 'Video lección práctica y conceptual: Págate primero (George S. Clason).', 'https://www.youtube.com/embed/9xHOEs6WtaM', '19:30', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (4, 'Cómo automatizar tu ahorro sin sentirlo', 'Video lección práctica y conceptual: Cómo automatizar tu ahorro sin sentirlo', 'https://www.youtube.com/embed/RgKAFK5djSk', '13:20', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (4, 'Tu fondo de paz mental: 3 a 6 meses', 'Video lección práctica y conceptual: Tu fondo de paz mental: 3 a 6 meses de gastos.', 'https://www.youtube.com/embed/H48qw1QRGSA', '14:50', 3);

-- Ejercicios prácticos de Ahorro formal y fondo de emergencia
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (4, 'Calculadora de fondo de emergencia avanzada', 'simulacion', 'Simula diferentes escenarios: pérdida de empleo, emergencia médica, reparación del auto. ¿Cuántos meses resistes?', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (4, 'Plan de ahorro personalizado a 6 meses', 'practica', 'Crea un plan semana a semana para construir tu fondo de emergencia con metas progresivas y seguimiento.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (4, 'Quiz: ¿Estás preparado para una emergencia financiera?', 'quiz', 'Evalúa tu nivel de preparación financiera ante imprevistos con 12 preguntas de situaciones reales.', 3);

-- Audios y Podcasts de Ahorro formal y fondo de emergencia
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (4, 'Historias de paz financiera', 'Testimonios de personas que evitaron la crisis gracias a su fondo de emergencia bien planificado.', '19:45', 'audio/fondo-emergencia-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (4, 'El ahorro no es sacrificio, es libertad', 'Cambia tu perspectiva sobre el ahorro: técnicas psicológicas para disfrutar el proceso de ahorrar.', '17:20', 'audio/fondo-emergencia-2.mp3', 2);

-- Libros y Guías de Aprende a ahorrar y crea tu fondo de emergencia
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (4, 'El hombre más rico de Babilonia', 'George S. Clason', 'Págate primero: el 10% mágico de Arkad para construir tu fondo con disciplina.', 'ebook', 'libros/fondo-emergencia-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (4, 'Estrategias de ahorro para mexicanos', 'CONDUSEF', 'Comparativo actualizado de cuentas de ahorro, pagarés y fondos de inversión de bajo riesgo en México.', 'pdf', 'libros/fondo-emergencia-2.pdf', 2);

-- ========================================================
-- Materia 5: Control de deudas y crédito bancario (Nivel 2)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (5, 'control-deudas', 2, 'Control de deudas y crédito bancario', 'Métodos probados (Bola de nieve y Avalancha) para liquidar tarjetas y créditos.', 'Nivel 2', 'intermedio', 12.0, 'img/nivel2.jpg', 5);

-- Videos / Lecciones de Control de deudas y crédito bancario
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (5, 'Método bola de nieve vs avalancha: ¿cuál elegir?', 'Video lección práctica y conceptual: Método bola de nieve vs avalancha: ¿cuál elegir?', 'https://www.youtube.com/embed/JGwWNGJdvx8', '16:28', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (5, 'Cómo entender tu estado de cuenta y el CAT', 'Video lección práctica y conceptual: Cómo entender tu estado de cuenta y el CAT', 'https://www.youtube.com/embed/LK7qEnwi_R0', '12:15', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (5, 'Renegociación de deudas bancarias sin destruir tu historial', 'Video lección práctica y conceptual: Renegociación de deudas bancarias sin destruir tu historial', 'https://www.youtube.com/embed/Hjv473hOiB0', '18:40', 3);

-- Ejercicios prácticos de Control de deudas y crédito bancario
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (5, 'Simulador de pago de deudas', 'simulacion', 'Ingresa tus deudas actuales con tasas y montos. El simulador calcula cuándo las liquidarás con cada método.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (5, 'Quiz: ¿Conoces tu score crediticio?', 'quiz', 'Pon a prueba tus conocimientos sobre Buró de Crédito, score crediticio y cómo mejorarlo en México.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (5, 'Caso de estudio: Familia García sale de deudas', 'caso-estudio', 'Analiza el caso real de una familia con $180,000 en deudas y diseña la estrategia óptima de pago.', 3);

-- Audios y Podcasts de Control de deudas y crédito bancario
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (5, 'Mi camino libre de deudas', 'Podcast con tres historias reales de mexicanos que liquidaron deudas de más de $100,000 pesos en menos de 2 años.', '28:30', 'audio/control-deudas-1.mp3', 1);

-- Libros y Guías de Control de deudas y crédito bancario
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (5, 'La transformación total de su dinero', 'Dave Ramsey', 'Plan paso a paso para salir de deudas usando los 7 pasos del método Ramsey adaptados al contexto latino.', 'ebook', 'libros/control-deudas-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (5, 'Guía para entender tu Buró de Crédito', 'Círculo de Crédito', 'Todo lo que necesitas saber sobre tu historial crediticio, cómo consultarlo y cómo mejorarlo.', 'articulo', 'libros/control-deudas-2.epub', 2);

-- ========================================================
-- Materia 6: Materiales y herramientas digitales (Nivel 2)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (6, 'materiales-herramientas', 2, 'Materiales y herramientas digitales', 'Plantillas automatizadas en Excel, calculadoras y apps para gestionar tus finanzas.', 'Nivel 2', 'intermedio', 12.0, 'img/nivel2.jpg', 6);

-- Videos / Lecciones de Materiales y herramientas digitales
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (6, 'Crea tu plantilla de presupuesto en Excel desde cero', 'Video lección práctica y conceptual: Crea tu plantilla de presupuesto en Excel desde cero', 'https://www.youtube.com/embed/Ct8Gxo8StBU', '22:10', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (6, 'Las 5 mejores apps de finanzas personales en México 2025', 'Video lección práctica y conceptual: Las 5 mejores apps de finanzas personales en México 2025', 'https://www.youtube.com/embed/FTQbiNvZqaY', '15:33', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (6, 'Google Sheets para tus finanzas: automatiza todo', 'Video lección práctica y conceptual: Google Sheets para tus finanzas: automatiza todo', 'https://www.youtube.com/embed/N2bXEUSAiTI', '19:48', 3);

-- Ejercicios prácticos de Materiales y herramientas digitales
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (6, 'Construye tu hoja de cálculo financiera', 'proyecto', 'Crea una hoja de cálculo con presupuesto, rastreador de gastos y gráficas automáticas usando fórmulas avanzadas.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (6, 'Comparativo de apps financieras', 'practica', 'Prueba 3 apps de finanzas personales durante una semana y elabora un análisis comparativo con pros y contras.', 2);

-- Audios y Podcasts de Materiales y herramientas digitales
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (6, 'Fintech en México: revolución digital de tus finanzas', 'Panorama de las herramientas fintech disponibles en México: neobancos, apps de inversión y plataformas de ahorro.', '21:15', 'audio/materiales-herramientas-1.mp3', 1);

-- Libros y Guías de Materiales y herramientas digitales
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (6, 'Excel para finanzas personales', 'María del Carmen Ruiz', 'Manual práctico con 20 plantillas descargables para controlar presupuestos, deudas e inversiones.', 'pdf', 'libros/materiales-herramientas-1.pdf', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (6, 'La era de las fintech', 'Banco de México', 'Informe sobre la revolución tecnológica financiera en México y cómo aprovechar las nuevas herramientas digitales.', 'articulo', 'libros/materiales-herramientas-2.epub', 2);

-- ========================================================
-- Materia 7: Estrategias de inversión y renta fija (Nivel 2)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (7, 'ahorro-inversion', 2, 'Estrategias de inversión y renta fija', 'Pon tu dinero a trabajar con instrumentos regulados de bajo riesgo y renta fija.', 'Nivel 2', 'intermedio', 12.0, 'img/nivel3.jpg', 7);

-- Videos / Lecciones de Estrategias de inversión y renta fija
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (7, 'CETES Directo: tutorial completo para invertir desde $100', 'Video lección práctica y conceptual: CETES Directo: tutorial completo para invertir desde $100', 'https://www.youtube.com/embed/hT_nvWreIhg', '18:25', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (7, 'Bonos gubernamentales explicados con manzanas', 'Video lección práctica y conceptual: Bonos gubernamentales explicados con manzanas', 'https://www.youtube.com/embed/YQHsXMglC9A', '14:10', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (7, 'Valor del dinero en el tiempo: ¿$10,000 hoy o mañana?', 'Video lección práctica y conceptual: Valor del dinero en el tiempo: ¿$10,000 hoy o mañana?', 'https://www.youtube.com/embed/lp-EO5I60KA', '12:55', 3);

-- Ejercicios prácticos de Estrategias de inversión y renta fija
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (7, 'Simulador de inversión en CETES', 'simulacion', 'Simula inversiones en CETES a 28, 91, 182 y 364 días. Compara rendimientos netos después de impuestos.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (7, 'Quiz: Valor del dinero en el tiempo', 'quiz', 'Resuelve 10 problemas de valor presente y valor futuro para dominar el concepto más importante de las finanzas.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (7, 'Proyecto: Análisis de renta fija mexicana', 'proyecto', 'Investiga y compara CETES, Bondes, Udibonos y pagarés bancarios. Presenta tu análisis con recomendaciones.', 3);

-- Audios y Podcasts de Estrategias de inversión y renta fija
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (7, 'Renta fija en México: lo que nadie te cuenta', 'Entrevista con un asesor financiero certificado sobre las mejores estrategias de renta fija para 2025.', '24:30', 'audio/ahorro-inversion-1.mp3', 1);

-- Libros y Guías de Estrategias de inversión y renta fija
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (7, 'Fundamentos de inversiones', 'Lawrence J. Gitman', 'Texto académico de referencia sobre mercados financieros, bonos e instrumentos de deuda con enfoque práctico.', 'ebook', 'libros/ahorro-inversion-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (7, 'Guía del inversionista en CETES Directo', 'Gobierno de México', 'Manual oficial paso a paso para operar en la plataforma CETES Directo del gobierno federal.', 'pdf', 'libros/ahorro-inversion-2.pdf', 2);

-- ========================================================
-- Materia 8: Fondos indexados y renta variable (Nivel 2)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (8, 'fondos-bolsa', 2, 'Fondos indexados y renta variable', 'Aprende a invertir a largo plazo en índices globales como el S&P 500.', 'Nivel 2', 'intermedio', 12.0, 'img/nivel3.jpg', 8);

-- Videos / Lecciones de Fondos indexados y renta variable
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (8, 'ETFs explicados: invierte en el S&P 500 desde México', 'Video lección práctica y conceptual: ETFs explicados: invierte en el S&P 500 desde México', 'https://www.youtube.com/embed/fUr4GVauePo', '17:40', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (8, 'Dollar Cost Averaging: la estrategia que siempre gana', 'Video lección práctica y conceptual: Dollar Cost Averaging: la estrategia que siempre gana', 'https://www.youtube.com/embed/byA-aYNNkJk', '13:55', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (8, 'Gestión del riesgo: cómo no perder tu dinero en la bolsa', 'Video lección práctica y conceptual: Gestión del riesgo: cómo no perder tu dinero en la bolsa', 'https://www.youtube.com/embed/OwMf6gEMfg8', '20:15', 3);

-- Ejercicios prácticos de Fondos indexados y renta variable
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (8, 'Constructor de portafolio diversificado', 'proyecto', 'Diseña un portafolio con ETFs mexicanos e internacionales. Define porcentajes por clase de activo y justifica tu estrategia.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (8, 'Quiz: Evaluación de perfil de riesgo', 'quiz', 'Determina si eres un inversionista conservador, moderado o agresivo con este test de 20 preguntas validado.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (8, 'Simulación: DCA vs inversión de golpe', 'simulacion', 'Compara los resultados de invertir $60,000 de golpe vs $5,000 mensuales durante 12 meses con datos históricos reales.', 3);

-- Audios y Podcasts de Fondos indexados y renta variable
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (8, 'La bolsa de valores desmitificada', 'Explicación clara de cómo funciona la Bolsa Mexicana de Valores y por qué no necesitas ser experto para invertir.', '26:10', 'audio/fondos-bolsa-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (8, 'Entrevista: 10 años invirtiendo en ETFs desde México', 'Un inversionista mexicano comparte su experiencia real invirtiendo en fondos indexados con aportaciones mensuales.', '32:45', 'audio/fondos-bolsa-2.mp3', 2);

-- Libros y Guías de Fondos indexados y renta variable
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (8, 'El pequeño libro para invertir con sentido común', 'John C. Bogle', 'El creador de Vanguard explica por qué los fondos indexados son la mejor opción para el inversionista promedio.', 'ebook', 'libros/fondos-bolsa-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (8, 'Un paso adelante en Wall Street', 'Peter Lynch', 'Estrategias del legendario gestor de fondos para que inversionistas comunes superen a los profesionales.', 'ebook', 'libros/fondos-bolsa-2.epub', 2);

-- ========================================================
-- Materia 9: Protección patrimonial e impuestos (Nivel 3)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (9, 'proteccion-impuestos', 3, 'Protección patrimonial e impuestos', 'Seguros indispensables y optimización fiscal para proteger tu capital.', 'Nivel 3', 'intermedio', 12.0, 'img/nivel3.jpg', 9);

-- Videos / Lecciones de Protección patrimonial e impuestos
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (9, 'Seguros que realmente necesitas (y los que no)', 'Video lección práctica y conceptual: Seguros que realmente necesitas (y los que no)', 'https://www.youtube.com/embed/QH2-TGUlwu4', '15:30', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (9, 'Deducciones fiscales en México: recupera miles de pesos', 'Video lección práctica y conceptual: Deducciones fiscales en México: recupera miles de pesos', 'https://www.youtube.com/embed/CevxZvSJLk8', '18:22', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (9, 'PPR: tu arma secreta para el retiro y los impuestos', 'Video lección práctica y conceptual: PPR: tu arma secreta para el retiro y los impuestos', 'https://www.youtube.com/embed/eb7wmGOKmBs', '14:08', 3);

-- Ejercicios prácticos de Protección patrimonial e impuestos
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (9, 'Calculadora de deducciones fiscales', 'practica', 'Ingresa tus gastos deducibles del año y calcula cuánto puedes recuperar en tu declaración anual del SAT.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (9, 'Evaluación de necesidades de seguros', 'quiz', 'Responde preguntas sobre tu situación personal y familiar para determinar qué seguros necesitas y cuánta cobertura.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (9, 'Caso de estudio: Optimización fiscal de Ana', 'caso-estudio', 'Analiza el caso de una profesionista que paga $45,000 al año en impuestos y diseña su estrategia de optimización.', 3);

-- Audios y Podcasts de Protección patrimonial e impuestos
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (9, 'Tips de optimización fiscal que tu contador no te dice', 'Estrategias legales para reducir tu carga fiscal: desde PPR hasta donativos y gastos médicos deducibles.', '23:40', 'audio/proteccion-impuestos-1.mp3', 1);

-- Libros y Guías de Protección patrimonial e impuestos
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (9, 'Planeación fiscal para personas físicas', 'IMCP', 'Guía del Instituto Mexicano de Contadores Públicos sobre deducciones, regímenes fiscales y optimización legal.', 'pdf', 'libros/proteccion-impuestos-1.pdf', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (9, 'Seguros y finanzas personales', 'AMIS', 'Manual de la Asociación Mexicana de Instituciones de Seguros para elegir la protección adecuada según tu etapa de vida.', 'articulo', 'libros/proteccion-impuestos-2.epub', 2);

-- ========================================================
-- Materia 10: Emprendimiento y modelos de negocio (Nivel 3)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (10, 'emprendimiento', 3, 'Emprendimiento y modelos de negocio', 'Valida ideas, crea negocios rentables y diversifica tus fuentes de ingresos.', 'Nivel 3', 'avanzado', 12.0, 'img/nivel3.jpg', 10);

-- Videos / Lecciones de Emprendimiento y modelos de negocio
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (10, 'Cómo validar tu idea de negocio sin gastar un peso', 'Video lección práctica y conceptual: Cómo validar tu idea de negocio sin gastar un peso', 'https://www.youtube.com/embed/SqcY0GlETPk', '16:55', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (10, 'Flujo de caja: el rey de los negocios rentables', 'Video lección práctica y conceptual: Flujo de caja: el rey de los negocios rentables', 'https://www.youtube.com/embed/vLnPwxZdW4Y', '14:30', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (10, 'Pricing: cómo poner precio a tu producto o servicio', 'Video lección práctica y conceptual: Pricing: cómo poner precio a tu producto o servicio', 'https://www.youtube.com/embed/eTFy8RnUkoU', '19:12', 3);

-- Ejercicios prácticos de Emprendimiento y modelos de negocio
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (10, 'Lienzo de modelo de negocio (Canvas)', 'proyecto', 'Completa el Business Model Canvas para tu idea de negocio: propuesta de valor, segmento de clientes, canales y finanzas.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (10, 'Estrategia de pricing para tu producto', 'practica', 'Aplica 3 métodos de fijación de precios (costo plus, valor percibido y competencia) a un producto real o hipotético.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (10, 'Caso de estudio: De empleado a emprendedor', 'caso-estudio', 'Analiza cómo un mexicano pasó de ganar $15,000 como empleado a generar $80,000 mensuales con su negocio propio.', 3);

-- Audios y Podcasts de Emprendimiento y modelos de negocio
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (10, 'Entrevistas con emprendedores mexicanos exitosos', 'Tres emprendedores comparten sus aprendizajes, errores y estrategias para crear negocios rentables en México.', '35:20', 'audio/emprendimiento-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (10, 'Errores financieros fatales al emprender', 'Los 10 errores de flujo de caja más comunes en negocios nuevos y cómo evitar cada uno de ellos.', '18:55', 'audio/emprendimiento-2.mp3', 2);

-- Libros y Guías de Emprendimiento y modelos de negocio
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (10, 'El método Lean Startup', 'Eric Ries', 'Metodología probada para crear negocios exitosos con mínima inversión: construir, medir y aprender.', 'ebook', 'libros/emprendimiento-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (10, 'La semana laboral de 4 horas', 'Timothy Ferriss', 'Cómo diseñar un negocio que funcione con sistemas automatizados para generar ingresos sin estar presente.', 'ebook', 'libros/emprendimiento-2.epub', 2);

-- ========================================================
-- Materia 11: Inversión inmobiliaria y FIBRAs (Nivel 3)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (11, 'bienes-raices', 3, 'Inversión inmobiliaria y FIBRAs', 'Participa en el sector inmobiliario con bajo capital a través de FIBRAs y rentas.', 'Nivel 3', 'avanzado', 12.0, 'img/nivel3.jpg', 11);

-- Videos / Lecciones de Inversión inmobiliaria y FIBRAs
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (11, 'FIBRAs en México: invierte en bienes raíces desde $1,000', 'Video lección práctica y conceptual: FIBRAs en México: invierte en bienes raíces desde $1,000', 'https://www.youtube.com/embed/WI5NKIe0DBk', '17:35', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (11, 'Rentas en Airbnb vs renta tradicional: ¿qué conviene más?', 'Video lección práctica y conceptual: Rentas en Airbnb vs renta tradicional: ¿qué conviene más?', 'https://www.youtube.com/embed/pB-5XG-DbAA', '21:10', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (11, 'Cómo analizar plusvalía y rendimiento de una propiedad', 'Video lección práctica y conceptual: Cómo analizar plusvalía y rendimiento de una propiedad', 'https://www.youtube.com/embed/dP15zlyra3c', '15:48', 3);

-- Ejercicios prácticos de Inversión inmobiliaria y FIBRAs
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (11, 'Análisis comparativo de FIBRAs mexicanas', 'proyecto', 'Investiga 5 FIBRAs listadas en la BMV, compara rendimientos por dividendo, plusvalía y riesgo. Presenta tu top 3.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (11, 'Calculadora de rendimiento por renta', 'simulacion', 'Calcula el yield bruto y neto de una propiedad considerando precio, renta mensual, gastos y vacancia.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (11, 'Quiz: ¿Sabes lo básico de inversión inmobiliaria?', 'quiz', 'Evalúa tus conocimientos sobre CAP rate, yield, plusvalía, FIBRAs y financiamiento hipotecario en México.', 3);

-- Audios y Podcasts de Inversión inmobiliaria y FIBRAs
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (11, 'Inversión inmobiliaria para no millonarios', 'Estrategias reales para participar en el mercado inmobiliario mexicano sin necesitar millones de pesos.', '27:40', 'audio/bienes-raices-1.mp3', 1);

-- Libros y Guías de Inversión inmobiliaria y FIBRAs
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (11, 'El ABC de la inversión en bienes raíces', 'Ken McElroy', 'Guía fundamental sobre cómo analizar, comprar y administrar propiedades para generar flujo de efectivo.', 'ebook', 'libros/bienes-raices-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (11, 'FIBRAs: inversión inmobiliaria en México', 'BMV Educación', 'Guía oficial de la Bolsa Mexicana de Valores sobre Fideicomisos de Inversión en Bienes Raíces.', 'pdf', 'libros/bienes-raices-2.pdf', 2);

-- ========================================================
-- Materia 12: Independencia y legado financiero (Nivel 3)
-- ========================================================
INSERT INTO `cursos` (`id`, `codigo`, `semestre`, `titulo`, `descripcion`, `categoria`, `nivel`, `duracion_horas`, `imagen_url`, `orden`) VALUES (12, 'libertad-financiera', 3, 'Independencia y legado financiero', 'Consolida tu portafolio patrimonial definitivo para vivir de tus rentas e inversiones.', 'Nivel 3', 'avanzado', 12.0, 'img/nivel3.jpg', 12);

-- Videos / Lecciones de Independencia y legado financiero
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (12, 'La regla del 4%: cuánto necesitas para retirarte', 'Video lección práctica y conceptual: La regla del 4%: cuánto necesitas para retirarte', 'https://www.youtube.com/embed/15RJzvoS2nc', '16:40', 1);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (12, 'Portafolio All-Weather de Ray Dalio explicado', 'Video lección práctica y conceptual: Portafolio All-Weather de Ray Dalio explicado', 'https://www.youtube.com/embed/Nu4lHaSh7D4', '20:25', 2);
INSERT INTO `lecciones` (`curso_id`, `titulo`, `contenido`, `video_url`, `duracion`, `orden`) VALUES (12, 'Tu plan financiero a 10 y 20 años: hoja de ruta definitiva', 'Video lección práctica y conceptual: Tu plan financiero a 10 y 20 años: hoja de ruta definitiva', 'https://www.youtube.com/embed/wD2cVhC-63I', '23:15', 3);

-- Ejercicios prácticos de Independencia y legado financiero
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (12, 'Calculadora de retiro e independencia financiera', 'simulacion', 'Calcula tu número mágico: cuánto necesitas acumular y en cuántos años puedes alcanzar la libertad financiera.', 1);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (12, 'Proyecto: Mi plan patrimonial y legado', 'proyecto', 'Diseña tu plan financiero integral a 20 años: inversiones, seguros, testamento y estrategia de legado familiar.', 2);
INSERT INTO `ejercicios` (`curso_id`, `titulo`, `tipo`, `descripcion`, `orden`) VALUES (12, 'Quiz: ¿Qué tan cerca estás de la libertad financiera?', 'quiz', 'Evalúa tu progreso hacia la independencia financiera con métricas reales: tasa de ahorro, patrimonio neto y flujo pasivo.', 3);

-- Audios y Podcasts de Independencia y legado financiero
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (12, 'Historias FIRE: mexicanos financieramente libres', 'Entrevistas con personas en México que alcanzaron la independencia financiera antes de los 50 años.', '38:15', 'audio/libertad-financiera-1.mp3', 1);
INSERT INTO `audios` (`curso_id`, `titulo`, `descripcion`, `duracion`, `audio_url`, `orden`) VALUES (12, 'Diseña la vida que quieres, luego ahorra para ella', 'Reflexión sobre cómo definir tu estilo de vida ideal y construir el portafolio que lo haga posible.', '15:50', 'audio/libertad-financiera-2.mp3', 2);

-- Libros y Guías de Independencia y legado financiero
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (12, 'La bolsa o la vida', 'Vicki Robin y Joe Dominguez', 'El libro fundacional del movimiento FIRE: transforma tu relación con el dinero y alcanza la libertad financiera.', 'ebook', 'libros/libertad-financiera-1.epub', 1);
INSERT INTO `libros` (`curso_id`, `titulo`, `autor`, `descripcion`, `tipo`, `archivo_url`, `orden`) VALUES (12, 'El camino simple a la riqueza', 'JL Collins', 'Estrategia minimalista de inversión en fondos indexados para alcanzar la independencia financiera paso a paso.', 'ebook', 'libros/libertad-financiera-2.epub', 2);



-- --------------------------------------------------------
-- Datos iniciales de logros
-- --------------------------------------------------------

INSERT INTO `logros` (`nombre`, `descripcion`, `icono`, `puntos_requeridos`, `cursos_requeridos`) VALUES
('Primer Paso', 'Completaste tu primer curso', '🎯', 100, 1),
('Estudiante Dedicado', 'Completaste 3 cursos', '📚', 300, 3),
('Maestro Financiero', 'Completaste 5 cursos', '🏆', 500, 5),
('Investigador', 'Exploraste todos los recursos', '🔍', 200, NULL),
('Consistente', 'Te has conectado 7 días seguidos', '🔥', 150, NULL);

-- --------------------------------------------------------
-- Usuario administrador inicial
-- Email: admin@educacionfinanciera.mx  |  Contraseña: Admin123!
-- IMPORTANTE: cambia la contraseña después del primer inicio de sesión.
-- --------------------------------------------------------

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password_hash`, `rol`, `activo`, `email_verificado`) VALUES
(1, 'Administrador', 'admin@educacionfinanciera.mx', '$2y$10$aGBuXVXmqc7FxmRXUpWyeOzQOVinbuhsl9llZq0Od4gKe764WX1Sa', 'admin', 1, 1);

INSERT INTO `membresias` (`usuario_id`, `activa`, `tipo_membresia`) VALUES (1, 1, 'gratis');
INSERT INTO `puntos_usuario` (`usuario_id`, `puntos_totales`, `nivel`) VALUES (1, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
