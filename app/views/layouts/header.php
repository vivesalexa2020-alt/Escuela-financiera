<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Educación Financiera') ?></title>
  <?php
    $siteName = \App\Config\AppConfig::APP_NAME;
    $assetVersion = \App\Config\AppConfig::APP_VERSION;
    $forwardedProto = strtolower((string)($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));
    $forwardedHost = (string)($_SERVER['HTTP_X_FORWARDED_HOST'] ?? '');
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
      || $forwardedProto === 'https'
      || (int)($_SERVER['HTTP_X_FORWARDED_PORT'] ?? 0) === 443;
    $scheme = $isHttps ? 'https' : 'http';
    $rawHost = $forwardedHost !== '' ? strtok($forwardedHost, ',') : (string)($_SERVER['HTTP_HOST'] ?? 'localhost');
    $host = preg_replace('/[^A-Za-z0-9.:\[\]-]/', '', (string)$rawHost);
    $scriptPath = str_replace('\\', '/', (string)($_SERVER['SCRIPT_NAME'] ?? '/'));
    $basePath = preg_replace('#/index\.php.*$#', '', $scriptPath);
    $basePath = preg_replace('#/public/?$#', '', $basePath);
    $requestPath = strtok((string)($_SERVER['REQUEST_URI'] ?? '/'), '?');
    $canonicalUrl = $scheme . '://' . $host . $requestPath;
    $ogImageUrl = $scheme . '://' . $host . $basePath . '/public/img/experiencia-educacion-og.jpg';
    $ogDescription = 'Aprende educación financiera con cursos, herramientas y comunidad para ahorrar, invertir y cumplir tus metas.';
  ?>
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? $siteName, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image" content="<?= htmlspecialchars($ogImageUrl, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="654">
  <meta property="og:image:height" content="468">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle ?? $siteName, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImageUrl, ENT_QUOTES, 'UTF-8') ?>">
  <?php if (defined('APP_DIRECT_PUBLIC_ENTRY') && APP_DIRECT_PUBLIC_ENTRY): ?>
    <base href="../">
  <?php endif; ?>

  <!-- Google Fonts: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Flaticon UIcons — Librería de iconos profesionales -->
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css">

  <!-- Estilos Globales -->
  <link rel="stylesheet" href="public/css/estilos.css?v=<?= $assetVersion ?>">

  <!-- Estilos específicos de la página -->
  <?php foreach ((array)($pageCss ?? []) as $cssFile): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>?v=<?= $assetVersion ?>">
  <?php endforeach; ?>

  <!-- Capa tipográfica global (debe cargar al final) -->
  <link rel="stylesheet" href="public/css/typography.css?v=<?= $assetVersion ?>">

  <script>
    try {
      if (sessionStorage.getItem('ef_splash_seen') === '1') {
        document.documentElement.classList.add('splash-seen');
      }
    } catch (e) {}
  </script>
</head>
