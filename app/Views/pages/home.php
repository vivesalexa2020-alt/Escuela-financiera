<?php
/**
 * Vista: Inicio / Dashboard Principal (Home)
 * Variables disponibles: $pageTitle, $user, $cursos
 */
?>
<section class="hero-section" style="background: linear-gradient(135deg, #032d1f 0%, #06402d 100%); color: #ffffff; padding: 80px 0 100px; position: relative;">
  <div class="container" style="display: flex; align-items: center; justify-content: space-between; gap: 40px; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 320px; max-width: 600px;">
      <div style="display: inline-block; background: rgba(40, 199, 111, 0.15); color: #28C76F; border: 1px solid rgba(40, 199, 111, 0.3); padding: 6px 14px; border-radius: 999px; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
        🎓 Formación Financiera Integral
      </div>
      <h1 style="font-size: 42px; font-weight: 800; line-height: 1.2; margin-bottom: 20px;">
        Resultados Reales, <span style="color: #28C76F;">Cero Humo</span>.
      </h1>
      <p style="font-size: 16px; color: #d1fae5; line-height: 1.7; margin-bottom: 30px;">
        Aprende finanzas personales, presupuestos reales, inversiones estratégicas y construye tu libertad financiera con metodologías probadas y acompañamiento interactivo.
      </p>
      <div style="display: flex; gap: 16px; flex-wrap: wrap;">
        <a href="index.php?page=cursos" class="btn-primary" style="display: inline-block; background: #28C76F; color: #fff; font-weight: 700; padding: 14px 28px; border-radius: 999px; text-decoration: none;">Explorar Cursos</a>
        <a href="index.php?page=recursos" class="btn-secondary" style="display: inline-block; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: #fff; font-weight: 600; padding: 14px 28px; border-radius: 999px; text-decoration: none;">Herramientas Gratuitas</a>
      </div>
    </div>
    <div style="flex: 1; min-width: 300px; text-align: center;">
      <img src="img/hero-character.png" alt="Educación Financiera" style="max-width: 100%; height: auto; border-radius: 16px; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.3));" onerror="this.src='img/experiencia-educacion.png'">
    </div>
  </div>
</section>

<!-- Catálogo Destacado de Cursos -->
<section style="padding: 80px 0; background: #f8fafc;">
  <div class="container">
    <div style="text-align: center; margin-bottom: 50px;">
      <h2 style="font-size: 32px; font-weight: 700; color: #06402d; margin-bottom: 12px;">Cursos Prácticos y Especializados</h2>
      <p style="color: #64748b; font-size: 15px; max-width: 600px; margin: 0 auto;">Desde fundamentos básicos hasta portafolios avanzados y planeación de retiro.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      <?php if (!empty($cursos)): ?>
        <?php foreach (array_slice($cursos, 0, 6) as $curso): ?>
          <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <div style="padding: 24px;">
              <span style="display: inline-block; background: #eafaf1; color: #00703C; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 999px; margin-bottom: 12px;">
                Nivel <?= htmlspecialchars($curso['nivel'] ?? '1') ?>
              </span>
              <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 10px;"><?= htmlspecialchars($curso['titulo'] ?? 'Curso') ?></h3>
              <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 18px;"><?= htmlspecialchars($curso['descripcion'] ?? '') ?></p>
              <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 14px; font-size: 13px; color: #00703C; font-weight: 600;">
                <span>📚 <?= $curso['total_lecciones'] ?? 0 ?> Lecciones</span>
                <span>🎧 <?= $curso['total_audios'] ?? 0 ?> Audios</span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #fff; border-radius: 12px; color: #64748b;">
          Cursos disponibles en la sección <a href="index.php?page=cursos" style="color: #00703C; font-weight: 600;">Catálogo de Cursos</a>.
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
