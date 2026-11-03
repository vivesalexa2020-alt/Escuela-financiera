<?php
// Layout principal del sistema MVC
include __DIR__ . '/header.php';
include __DIR__ . '/navbar.php';
?>

<main id="main-content" class="app-main-content">
  <?= $content ?? '' ?>
</main>

<?php
include __DIR__ . '/footer.php';
include dirname(__DIR__) . '/components/auth_modal.php';
?>

<!-- JavaScript Global y Módulos -->
<script src="script.js?v=20261102_recursos"></script>
</body>
</html>
