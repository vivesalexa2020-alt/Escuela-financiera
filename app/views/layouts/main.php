<?php
// Layout principal: documento HTML + contenido de la vista.
// El shell visual (sidebar, navbar, footer) vive en cada vista migrada.
include __DIR__ . '/header.php';
?>
<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">
<?= $content ?? '' ?>
</body>
</html>
