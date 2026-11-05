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

  <!-- Estilos Globales -->
  <link rel="stylesheet" href="public/css/estilos.css?v=20261102_recursos">

  <!-- Estilos específicos de la página -->
  <?php foreach ((array)($pageCss ?? []) as $cssFile): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>?v=20261105_demo_fin">
  <?php endforeach; ?>
</head>
