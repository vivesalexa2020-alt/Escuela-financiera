<?php
/**
 * Vista: Biblioteca de Recursos y Herramientas
 * Variables disponibles: $pageTitle, $user
 */
?>
<section style="background: #06402d; color: #fff; padding: 60px 0;">
  <div class="container">
    <h1 style="font-size: 34px; font-weight: 800; margin-bottom: 12px;">Herramientas y Recursos Descargables</h1>
    <p style="color: #d1fae5; font-size: 16px; max-width: 600px;">Plantillas en Excel, simuladores financieros, calculadoras de interés compuesto y guías oficiales en PDF.</p>
  </div>
</section>

<section style="padding: 60px 0; background: #f8fafc;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      
      <div style="background: #fff; padding: 28px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="font-size: 32px; margin-bottom: 14px;">📊</div>
        <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Plantilla de Presupuesto 50/30/20</h3>
        <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 20px;">Organiza tus ingresos fijos y variables, automatizando la distribución para ahorro e inversión.</p>
        <button onclick="if(typeof openResourceModal==='function')openResourceModal('Mi presupuesto 50/30/20', 'Calculadora interactiva');" style="background: #00703C; color: #fff; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
          Abrir Herramienta
        </button>
      </div>

      <div style="background: #fff; padding: 28px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="font-size: 32px; margin-bottom: 14px;">📈</div>
        <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Simulador Interés Compuesto y CETES</h3>
        <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 20px;">Proyecta tus ahorros a 5, 10 y 20 años comparando rendimientos contra la inflación.</p>
        <button onclick="if(typeof openResourceModal==='function')openResourceModal('Simulador de inversión en CETES', 'Simulación compuesta');" style="background: #00703C; color: #fff; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
          Abrir Simulador
        </button>
      </div>

      <div style="background: #fff; padding: 28px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="font-size: 32px; margin-bottom: 14px;">📘</div>
        <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Guía Oficial de Salida de Deudas</h3>
        <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 20px;">Método bola de nieve y avalancha explicado paso a paso con hoja de seguimiento.</p>
        <button onclick="if(typeof openResourceModal==='function')openResourceModal('Guía oficial de ahorro y deudas', 'Guía PDF');" style="background: #00703C; color: #fff; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
          Descargar Guía
        </button>
      </div>

    </div>
  </div>
</section>
