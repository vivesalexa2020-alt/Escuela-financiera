<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Educación Financiera') ?></title>
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
  <link rel="stylesheet" href="public/css/estilos.css?v=<?= time() ?>">

  <!-- Estilos específicos de la página -->
  <?php foreach ((array)($pageCss ?? []) as $cssFile): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>?v=<?= time() ?>">
  <?php endforeach; ?>

  <!-- Capa tipográfica global (debe cargar al final) -->
  <link rel="stylesheet" href="public/css/typography.css?v=<?= time() ?>">

  <script>
    try {
      if (sessionStorage.getItem('ef_splash_seen') === '1') {
        document.documentElement.classList.add('splash-seen');
      }
    } catch (e) {}
  </script>
</head>
