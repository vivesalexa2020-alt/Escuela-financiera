<?php
/**
 * Vista: Retícula Académica / Plan de Estudios
 * Variables disponibles: $pageTitle, $user
 */
?>
<section style="background: #06402d; color: #fff; padding: 60px 0;">
  <div class="container">
    <h1 style="font-size: 34px; font-weight: 800; margin-bottom: 12px;">Retícula Académica Semestral</h1>
    <p style="color: #d1fae5; font-size: 16px; max-width: 600px;">Mapa curricular organizado por semestres para avanzar desde nivel novato hasta estratega financiero.</p>
  </div>
</section>

<section style="padding: 60px 0; background: #f8fafc;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      
      <?php for ($s = 1; $s <= 4; $s++): ?>
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px;">
          <div style="background: #eafaf1; color: #00703C; font-weight: 700; font-size: 13px; display: inline-block; padding: 4px 12px; border-radius: 999px; margin-bottom: 14px;">
            Semestre <?= $s ?>
          </div>
          <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
            <?= match($s) {
              1 => 'Fundamentos y Control de Gastos',
              2 => 'Ahorro, Deudas y Protección',
              3 => 'Inversión en Renta Fija y Bolsa',
              4 => 'Estrategias Fiscales y Retiro'
            } ?>
          </h3>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 20px;">
            <?= match($s) {
              1 => 'Aprende a diagnosticar tu salud financiera, dominar el presupuesto y crear tu colchón.',
              2 => 'Estrategias para eliminar deudas tóxicas y seleccionar seguros patrimoniales.',
              3 => 'CETES, fondos indexados, ETFs y creación de portafolios diversificados.',
              4 => 'Optimización de impuestos, PPRs, Afores e independencia financiera.'
            } ?>
          </p>
          <a href="index.php?page=cursos" style="display: inline-block; font-size: 13px; font-weight: 600; color: #00703C; text-decoration: underline;">
            Ver materias del semestre →
          </a>
        </div>
      <?php endfor; ?>

    </div>
  </div>
</section>
