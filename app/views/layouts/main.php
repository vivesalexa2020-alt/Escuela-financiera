<?php
// Layout principal: documento HTML + contenido de la vista.
// El shell visual (sidebar, navbar, footer) vive en cada vista migrada.
include __DIR__ . '/header.php';
?>
<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">
<?php
try {
    $settingsObj = new \App\Models\SettingsModel();
    $anuncioActivo = $settingsObj->get('anuncio_activo', '0') === '1';
    $anuncioTexto  = trim((string)$settingsObj->get('anuncio_texto', ''));
    $anuncioTipo   = (string)$settingsObj->get('anuncio_tipo', 'info');
    $bannerBg = '#0284c7';
    if ($anuncioTipo === 'exito')  $bannerBg = '#16a34a';
    if ($anuncioTipo === 'alerta') $bannerBg = '#e11d48';
    if (($bodyClass ?? '') !== 'admin-page' && $anuncioActivo && $anuncioTexto !== '') {
        echo '<div style="background:' . $bannerBg . ';color:#fff;padding:10px 20px;text-align:center;font-size:14px;font-weight:600;position:sticky;top:0;z-index:99999;box-shadow:0 2px 10px rgba(0,0,0,0.12);display:flex;align-items:center;justify-content:center;gap:8px;">'
           . '<span>📢 ' . htmlspecialchars($anuncioTexto) . '</span>'
           . '</div>';
    }
} catch (\Throwable $e) {}
?>
<?= $content ?? '' ?>
</body>
</html>
