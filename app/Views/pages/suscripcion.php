<?php
/**
 * Vista: Suscripciones y Membresías
 * Variables disponibles: $pageTitle, $user
 */
?>
<section style="background: #06402d; color: #fff; padding: 60px 0; text-align: center;">
  <div class="container">
    <h1 style="font-size: 38px; font-weight: 800; margin-bottom: 14px;">Invierte en tu Educación Financiera</h1>
    <p style="color: #d1fae5; font-size: 16px; max-width: 600px; margin: 0 auto;">Elige el plan que mejor se adapte a tu etapa de crecimiento financiero. Cancela cuando quieras.</p>
  </div>
</section>

<section style="padding: 70px 0; background: #f8fafc;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; max-width: 1050px; margin: 0 auto;">
      
      <!-- Plan Gratis -->
      <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Plan Inicial</h3>
        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 24px;">Ideal para quienes inician con sus finanzas personales.</p>
        <div style="font-size: 36px; font-weight: 800; color: #06402d; margin-bottom: 24px;">$0 <span style="font-size: 14px; font-weight: 500; color: #64748b;">/ siempre</span></div>
        <ul style="list-style: none; margin-bottom: 30px; font-size: 14px; color: #475569; display: flex; flex-direction: column; gap: 12px; flex: 1;">
          <li>✓ Acceso al Semestre 1 completo</li>
          <li>✓ 3 calculadoras básicas</li>
          <li>✓ Comunidad de estudiantes</li>
        </ul>
        <button onclick="if(typeof openSignupModal==='function')openSignupModal();" style="width: 100%; padding: 12px; background: #f1f5f9; color: #1e293b; font-weight: 600; border: none; border-radius: 8px; cursor: pointer;">Comenzar Gratis</button>
      </div>

      <!-- Plan Pro (Destacado) -->
      <div style="background: #fff; border: 2px solid #28C76F; border-radius: 16px; padding: 36px 28px; box-shadow: 0 10px 25px -5px rgba(40,199,111,0.15); display: flex; flex-direction: column; position: relative;">
        <span style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #28C76F; color: #fff; font-size: 12px; font-weight: 700; padding: 4px 16px; border-radius: 999px;">MÁS POPULAR</span>
        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Plan PRO</h3>
        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 24px;">Para quienes buscan crear portafolios e invertir en serio.</p>
        <div style="font-size: 36px; font-weight: 800; color: #00703C; margin-bottom: 24px;">$299 <span style="font-size: 14px; font-weight: 500; color: #64748b;">MXN / mes</span></div>
        <ul style="list-style: none; margin-bottom: 30px; font-size: 14px; color: #475569; display: flex; flex-direction: column; gap: 12px; flex: 1;">
          <li>✓ Acceso a todos los semestres (1 al 4)</li>
          <li>✓ Simuladores avanzados de CETES y Bolsa</li>
          <li>✓ Descarga de todas las plantillas Excel</li>
          <li>✓ Certificado digital de finalización</li>
        </ul>
        <button onclick="if(typeof openSignupModal==='function')openSignupModal();" style="width: 100%; padding: 12px; background: #28C76F; color: #fff; font-weight: 700; border: none; border-radius: 8px; cursor: pointer;">Suscribirme a PRO</button>
      </div>

      <!-- Plan Premium -->
      <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Plan Premium</h3>
        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 24px;">Acompañamiento personalizado y sesiones en vivo.</p>
        <div style="font-size: 36px; font-weight: 800; color: #06402d; margin-bottom: 24px;">$699 <span style="font-size: 14px; font-weight: 500; color: #64748b;">MXN / mes</span></div>
        <ul style="list-style: none; margin-bottom: 30px; font-size: 14px; color: #475569; display: flex; flex-direction: column; gap: 12px; flex: 1;">
          <li>✓ Todo lo incluido en Plan PRO</li>
          <li>✓ 1 Mentoría 1 a 1 mensual</li>
          <li>✓ Revisión personalizada de portafolio</li>
          <li>✓ Soporte prioritario por WhatsApp</li>
        </ul>
        <button onclick="if(typeof openSignupModal==='function')openSignupModal();" style="width: 100%; padding: 12px; background: #06402d; color: #fff; font-weight: 600; border: none; border-radius: 8px; cursor: pointer;">Elegir Premium</button>
      </div>

    </div>
  </div>
</section>
