<?php
/**
 * Vista: Catálogo de Cursos
 * Variables disponibles: $pageTitle, $user, $cursos
 */
?>
<section style="background: #06402d; color: #fff; padding: 60px 0;">
  <div class="container">
    <h1 style="font-size: 36px; font-weight: 800; margin-bottom: 12px;">Catálogo Completo de Cursos</h1>
    <p style="color: #d1fae5; font-size: 16px; max-width: 650px;">Aprende paso a paso con rutas de aprendizaje estructuradas, vídeos HD, ejercicios prácticos y recursos descargables.</p>
  </div>
</section>

<section style="padding: 60px 0; background: #f8fafc;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px;">
      <?php if (!empty($cursos)): ?>
        <?php foreach ($cursos as $curso): ?>
          <div class="curso-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
            <div style="padding: 24px; flex: 1;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                <span style="background: #eafaf1; color: #00703C; font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 999px;">
                  Semestre <?= htmlspecialchars($curso['semestre'] ?? '1') ?>
                </span>
                <span style="font-size: 12px; color: #64748b; font-weight: 600;">
                  Nivel <?= htmlspecialchars($curso['nivel'] ?? '1') ?>
                </span>
              </div>
              <h3 style="font-size: 19px; font-weight: 700; color: #1e293b; margin-bottom: 10px; line-height: 1.3;">
                <?= htmlspecialchars($curso['titulo'] ?? '') ?>
              </h3>
              <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 20px;">
                <?= htmlspecialchars($curso['descripcion'] ?? '') ?>
              </p>
              
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 12.5px; color: #475569; background: #f8fafc; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <div>📺 <?= $curso['total_lecciones'] ?? 0 ?> Clases</div>
                <div>📝 <?= $curso['total_ejercicios'] ?? 0 ?> Ejercicios</div>
                <div>🎧 <?= $curso['total_audios'] ?? 0 ?> Podcasts</div>
                <div>📖 <?= $curso['total_libros'] ?? 0 ?> Guías PDF</div>
              </div>
            </div>

            <div style="padding: 16px 24px; background: #fbfcfe; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <a href="index.php?page=aula&curso_id=<?= $curso['id'] ?>" class="btn-primary" style="display: inline-block; background: #00703C; color: #fff; font-size: 13px; font-weight: 600; padding: 10px 18px; border-radius: 8px; text-decoration: none;">
                Ir al Aula →
              </a>
              <button onclick="if(typeof openCourseModal==='function')openCourseModal('<?= htmlspecialchars($curso['titulo']) ?>', '<?= htmlspecialchars($curso['descripcion']) ?>');" style="background: none; border: 1px solid #cbd5e1; color: #475569; font-size: 12px; font-weight: 600; padding: 9px 14px; border-radius: 8px; cursor: pointer;">
                Ver Temario
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px; background: #fff; border-radius: 12px;">
          <p style="font-size: 16px; color: #64748b;">No hay cursos registrados o la base de datos se está inicializando.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
