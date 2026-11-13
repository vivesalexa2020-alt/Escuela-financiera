<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;background:linear-gradient(135deg,#0f172a 0%,#1e293b 55%,#0b3b2e 100%);font-family:'Poppins',system-ui,sans-serif;">
  <div style="max-width:560px;width:100%;background:#fff;border-radius:20px;padding:44px 38px;text-align:center;box-shadow:0 24px 60px rgba(0,0,0,.35);">
    <div style="font-size:3rem;line-height:1;margin-bottom:18px;">🚧</div>
    <h1 style="margin:0 0 12px;font-size:1.55rem;font-weight:800;color:#0f172a;"><?= htmlspecialchars($nombre ?? 'Educación Financiera') ?></h1>
    <p style="margin:0 0 26px;font-size:.95rem;line-height:1.65;color:#475569;"><?= htmlspecialchars($mensaje ?? 'Estamos realizando mejoras en la plataforma. Vuelve en unos minutos.') ?></p>
    <a href="index.php?page=reticula#login" style="display:inline-block;background:#0ea5e9;color:#fff;text-decoration:none;font-weight:700;font-size:.88rem;padding:12px 24px;border-radius:10px;">Acceso administrador</a>
  </div>
</div>
