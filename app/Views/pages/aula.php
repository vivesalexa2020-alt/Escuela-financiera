<?php
/**
 * Vista: Aula Virtual Interactiva
 * Variables disponibles: $pageTitle, $user
 */
$cursoId = (int)($_GET['curso_id'] ?? 1);
?>
<section style="background: #032d1f; color: #fff; padding: 40px 0;">
  <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <div>
      <div style="font-size: 13px; color: #28C76F; font-weight: 600; margin-bottom: 6px;">🎓 Aula Virtual</div>
      <h1 style="font-size: 28px; font-weight: 700;">Reproductor y Material Interactivo</h1>
    </div>
    <div>
      <a href="index.php?page=cursos" style="color: #d1fae5; font-size: 14px; text-decoration: underline;">← Volver a Cursos</a>
    </div>
  </div>
</section>

<section style="padding: 40px 0; background: #0f172a; min-height: 70vh;">
  <div class="container" style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Reproductor Principal -->
    <div style="background: #1e293b; border-radius: 12px; overflow: hidden; padding: 20px;">
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; background: #000;">
        <iframe id="videoPlayer" style="position: absolute; top:0; left: 0; width: 100%; height: 100%; border:0;" src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
      </div>
      <div style="margin-top: 20px; color: #fff;">
        <h2 id="currentLessonTitle" style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">Lección en curso</h2>
        <p id="currentLessonDesc" style="color: #94a3b8; font-size: 14px; line-height: 1.6;">Selecciona una lección del panel lateral para comenzar a aprender.</p>
      </div>
    </div>

    <!-- Lista de Contenidos -->
    <div style="background: #1e293b; border-radius: 12px; padding: 20px; color: #fff; max-height: 600px; overflow-y: auto;">
      <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #334155;">Contenido del Curso</h3>
      <div id="lessonsList" style="display: flex; flex-direction: column; gap: 10px;">
        <div style="padding: 12px; background: #334155; border-radius: 8px; cursor: pointer;">
          <div style="font-size: 13.5px; font-weight: 600;">1. Fundamentos y Diagnóstico Financiero</div>
          <div style="font-size: 11.5px; color: #94a3b8; margin-top: 4px;">Duración: 15 min</div>
        </div>
        <div style="padding: 12px; background: rgba(51, 65, 85, 0.5); border-radius: 8px; cursor: pointer;">
          <div style="font-size: 13.5px; font-weight: 600;">2. Estructuración del Presupuesto 50/30/20</div>
          <div style="font-size: 11.5px; color: #94a3b8; margin-top: 4px;">Duración: 20 min</div>
        </div>
        <div style="padding: 12px; background: rgba(51, 65, 85, 0.5); border-radius: 8px; cursor: pointer;">
          <div style="font-size: 13.5px; font-weight: 600;">3. Creación del Fondo de Emergencia</div>
          <div style="font-size: 11.5px; color: #94a3b8; margin-top: 4px;">Duración: 18 min</div>
        </div>
      </div>
    </div>
  </div>
</section>
