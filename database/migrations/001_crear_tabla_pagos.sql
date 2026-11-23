-- Migración: registrar pagos pendientes de verificación administrativa.
-- Ejecutar una sola vez sobre una base de datos ya instalada.

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `unidad` TINYINT UNSIGNED NOT NULL DEFAULT 2,
  `monto` DECIMAL(10,2) NOT NULL,
  `metodo_pago` ENUM('spei','tarjeta') NOT NULL,
  `referencia` VARCHAR(100) NOT NULL,
  `estado` ENUM('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_revision` DATETIME NULL DEFAULT NULL,
  `revisado_por` INT UNSIGNED NULL DEFAULT NULL,
  `notas` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pagos_referencia` (`referencia`),
  KEY `idx_pagos_usuario_id` (`usuario_id`),
  KEY `idx_pagos_estado` (`estado`),
  CONSTRAINT `fk_pagos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
