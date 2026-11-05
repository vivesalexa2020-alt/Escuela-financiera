<?php
/**
 * Vista: Planes y MembresÃ­as
 * Contenido migrado desde suscripcion.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
<!-- ============================================================
     SIDEBAR LATERAL IZQUIERDA (MENÚ PRINCIPAL)
     ============================================================ -->
  <aside class="sidebar-left" id="sidebarLeft">
    <div>
      <div class="sidebar-brand">
        <a href="index.php" class="brand-logo" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
          <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 42px; height: 36px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
            <g>
              <rect x="26" y="162" width="188" height="30" rx="8" fill="#fabb15"/>
              <rect x="34" y="168" width="172" height="18" rx="4" fill="#fff6dd"/>
              <rect x="26" y="162" width="26" height="30" rx="8" fill="#e09800"/>
              <rect x="42" y="128" width="156" height="30" rx="8" fill="#cbf63e" transform="rotate(-2 120 143)"/>
              <rect x="50" y="134" width="140" height="18" rx="4" fill="#f2ffcd" transform="rotate(-2 120 143)"/>
              <rect x="42" y="128" width="26" height="30" rx="8" fill="#a9cf1e" transform="rotate(-2 120 143)"/>
              <rect x="58" y="94" width="124" height="30" rx="8" fill="#ffffff" transform="rotate(2 120 109)"/>
              <rect x="66" y="100" width="108" height="18" rx="4" fill="#d7f4e6" transform="rotate(2 120 109)"/>
              <rect x="58" y="94" width="26" height="30" rx="8" fill="#bce9d2" transform="rotate(2 120 109)"/>
            </g>
            <g>
              <path d="M88,66 L88,90 C88,106 152,106 152,90 L152,66 L120,82 Z" fill="#032d1f"/>
              <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/>
              <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="none" stroke="#d7f4e6" stroke-width="3"/>
              <circle cx="120" cy="58" r="7" fill="#fabb15"/>
              <path d="M120,58 C160,58 196,60 204,62 L204,104" fill="none" stroke="#fabb15" stroke-width="5" stroke-linecap="round"/>
              <path d="M197,104 h14 l4,26 h-22 z" fill="#fabb15"/>
              <path d="M199,130 l1,14 M204,130 l0,14 M209,130 l-1,14" stroke="#fabb15" stroke-width="4" stroke-linecap="round"/>
            </g>
          </svg>
          <div>
            <div style="font-weight: 800; font-size: 16px; line-height: 1.1; color: #ffffff;">Educación</div>
            <div style="font-weight: 500; font-size: 12px; color: var(--accent-lime, #cbf63e);">Financiera</div>
          </div>
        </a>
        <button class="sidebar-close-mobile" onclick="toggleSidebar(false)" aria-label="Cerrar menú">✕</button>
      </div>

      <div class="sidebar-nav-title">MENÚ PRINCIPAL</div>
      <nav class="sidebar-nav">
        <a href="index.php" class="sidebar-link ">
          <span class="sidebar-icon">🏠</span>
          <span>Inicio</span>
        </a>
        <a href="index.php?page=reticula" class="sidebar-link ">
          <span class="sidebar-icon">🗺️</span>
          <span>Retícula Académica</span>
        </a>
        <a href="index.php?page=aula" class="sidebar-link ">
          <span class="sidebar-icon">🚀</span>
          <span>Aula Demo</span>
        </a>
        <a href="index.php?page=metas" class="sidebar-link ">
          <span class="sidebar-icon">🎯</span>
          <span>Metas</span>
        </a>
        <a href="index.php?page=recursos" class="sidebar-link ">
          <span class="sidebar-icon">🧮</span>
          <span>Recursos</span>
        </a>
        <a href="index.php?page=suscripcion" class="sidebar-link active">
          <span class="sidebar-icon">💳</span>
          <span>Membresía</span>
        </a>
        <a href="index.php?page=configuraciones" class="sidebar-link ">
          <span class="sidebar-icon">⚙️</span>
          <span>Configuraciones</span>
        </a>
      </nav>
    </div>

    <!-- Perfil del estudiante en la parte inferior del Sidebar -->
    <div class="sidebar-user-panel">
      <div class="sidebar-user-info">
        <div class="sidebar-user-avatar" id="sidebarUserAvatar">👤</div>
        <div class="sidebar-user-details">
          <div class="sidebar-user-name" id="sidebarUserName">Estudiante</div>
          <div class="sidebar-user-role">Estudiante Activo</div>
        </div>
      </div>
      <button class="sidebar-logout-btn" onclick="logout()" title="Cerrar sesión">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        <span>Salir</span>
      </button>
    </div>
  </aside>

  <!-- Backdrop para cerrar sidebar en responsive -->
  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

  <div class="main-wrapper" id="mainWrapper">

  <!-- Barra superior del estudiante -->
  <div class="logged-topbar">
    <div class="logged-topbar-left">
      <button class="btn-sidebar-toggle" onclick="toggleSidebar()" aria-label="Abrir menú lateral">☰</button>
      <div style="display: flex; align-items: center; gap: 10px;">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 24px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
          <g>
            <rect x="26" y="162" width="188" height="30" rx="8" fill="#fabb15"/>
            <rect x="34" y="168" width="172" height="18" rx="4" fill="#fff6dd"/>
            <rect x="26" y="162" width="26" height="30" rx="8" fill="#e09800"/>
            <rect x="42" y="128" width="156" height="30" rx="8" fill="#cbf63e" transform="rotate(-2 120 143)"/>
            <rect x="50" y="134" width="140" height="18" rx="4" fill="#f2ffcd" transform="rotate(-2 120 143)"/>
            <rect x="42" y="128" width="26" height="30" rx="8" fill="#a9cf1e" transform="rotate(-2 120 143)"/>
            <rect x="58" y="94" width="124" height="30" rx="8" fill="#ffffff" transform="rotate(2 120 109)"/>
            <rect x="66" y="100" width="108" height="18" rx="4" fill="#d7f4e6" transform="rotate(2 120 109)"/>
            <rect x="58" y="94" width="26" height="30" rx="8" fill="#bce9d2" transform="rotate(2 120 109)"/>
          </g>
          <g>
            <path d="M88,66 L88,90 C88,106 152,106 152,90 L152,66 L120,82 Z" fill="#032d1f"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="none" stroke="#d7f4e6" stroke-width="3"/>
            <circle cx="120" cy="58" r="7" fill="#fabb15"/>
            <path d="M120,58 C160,58 196,60 204,62 L204,104" fill="none" stroke="#fabb15" stroke-width="5" stroke-linecap="round"/>
            <path d="M197,104 h14 l4,26 h-22 z" fill="#fabb15"/>
            <path d="M199,130 l1,14 M204,130 l0,14 M209,130 l-1,14" stroke="#fabb15" stroke-width="4" stroke-linecap="round"/>
          </g>
        </svg>
        <div class="page-current-title">Membresía y Planes</div>
      </div>
    </div>
    <div class="logged-topbar-right">
      <span class="topbar-greeting">Hola, <strong id="topbarUserName">Estudiante</strong></span>
      <a href="index.php?page=suscripcion" class="btn-cta-upgrade" style="padding: 6px 14px; font-size: 13px; font-weight: 700; background: var(--amarillo-dorado); color: #06402d; border-radius: 8px; text-decoration: none;">Membresía Completa</a>
    </div>
  </div>


  <!-- HEADER -->
  <header class="site-header">
    <div class="container nav-wrap">
      <a href="index.php" class="brand-logo">
        <svg viewBox="0 0 240 210" width="32" height="28" role="img" aria-label="Logo Sombrero de Graduación con Libros">
          <g>
            <rect x="26" y="162" width="188" height="30" rx="8" fill="#F5B800"/>
            <rect x="34" y="168" width="172" height="18" rx="4" fill="#fff6dd"/>
            <rect x="42" y="128" width="156" height="30" rx="8" fill="#28C76F" transform="rotate(-2 120 143)"/>
            <rect x="58" y="94" width="124" height="30" rx="8" fill="#ffffff" transform="rotate(2 120 109)"/>
          </g>
          <g>
            <path d="M88,66 L88,90 C88,106 152,106 152,90 L152,66 L120,82 Z" fill="#032d1f"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/>
            <circle cx="120" cy="58" r="7" fill="#F5B800"/>
          </g>
        </svg>
        <span>Educación <strong>Financiera</strong></span>
      </a>

      <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php?page=reticula">Aula Demo</a></li>
        <li><a href="index.php?page=reticula">Plan de Estudios</a></li>
        <li><a href="index.php?page=recursos">Recursos</a></li>
      </ul>

      <div>
        <a href="index.php?page=reticula" class="btn-nav-demo">← Volver a la Retícula</a>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="pricing-hero">
    <div class="container">
      <div class="pricing-badge">
        <span>🔒 Inversión en tu futuro</span>
      </div>
      <h1>Inscripción a la Carrera de Educación Financiera</h1>
      <p>
        Carrera formativa de 2 años estructurada en 3 niveles (Básico, Intermedio y Avanzado). Tu <strong>Primer Semestre es de prueba 100% GRATIS</strong>; para acceder del <strong>Segundo Semestre en adelante</strong> necesitas pagar tu inscripción de $299 MXN/mes con cancelación libre.
      </p>
    </div>
  </section>

  <!-- CONTENIDO PRINCIPAL: 2 COLUMNAS -->
  <main class="container">
    <div class="pricing-layout">

      <!-- COLUMNA 1: RESUMEN DE BENEFICIOS -->
      <div class="plan-summary-card">
        <span class="plan-tag">INSCRIPCIÓN A LA CARRERA</span>
        <div class="plan-price-wrap">
          <span class="amount">$299</span>
          <span class="period">MXN / mes</span>
        </div>
        <p class="plan-desc">
          Cancela en cualquier momento sin penalizaciones. Formación práctica enfocada en resultados reales en tus finanzas.
        </p>

        <ul class="benefit-list">
          <li>
            <span class="benefit-icon">✓</span>
            <span><strong>Programa completo de 2 años (4 Semestres)</strong>: Básico, Intermedio y Avanzado.</span>
          </li>
          <li>
            <span class="benefit-icon">✓</span>
            <span><strong>Método anti-deuda guiado</strong> con plantillas de amortización en Excel.</span>
          </li>
          <li>
            <span class="benefit-icon">✓</span>
            <span><strong>Fondo de emergencia e inversión inicial</strong> explicados sin rodeos.</span>
          </li>
          <li>
            <span class="benefit-icon">✓</span>
            <span><strong>Calculadoras interactivas</strong> y recursos exclusivos para alumnos.</span>
          </li>
          <li>
            <span class="benefit-icon">✓</span>
            <span><strong>Certificado de acreditación</strong> al completar cada nivel formativo.</span>
          </li>
        </ul>
      </div>

      <!-- COLUMNA 2: PAGO Y DATOS BANCARIOS -->
      <div class="checkout-card">
        <h3>Elige tu método de pago</h3>
        <p class="subtitle">Acreditación rápida y segura de tu cuenta de estudiante</p>

        <!-- SELECTOR DE MÉTODO -->
        <div class="payment-methods-grid">
          <label class="method-card selected" id="methodSpeiLabel" onclick="selectMethod('spei')">
            <input type="radio" name="paymethod" id="paySpei" checked>
            <div class="method-details">
              <h5>🏦 Transferencia SPEI</h5>
              <p>Directo desde tu app bancaria.</p>
            </div>
          </label>

          <label class="method-card" id="methodCardLabel" onclick="selectMethod('card')">
            <input type="radio" name="paymethod" id="payCard">
            <div class="method-details">
              <h5>💳 Tarjeta Débito/Crédito</h5>
              <p>Cobro seguro en línea.</p>
            </div>
          </label>
        </div>

        <!-- DETALLES BANCARIOS SPEI -->
        <div class="bank-box" id="bankBox">
          <h4>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M3 10h18M5 10v11M19 10v11M9 10v11M15 10v11M12 2L2 7h20L12 2z"/></svg>
            Datos para tu Transferencia Interbancaria (SPEI):
          </h4>

          <div class="bank-data-row">
            <span class="bank-label">Banco receptor:</span>
            <span class="bank-val">BBVA México</span>
          </div>
          <div class="bank-data-row">
            <span class="bank-label">Beneficiario:</span>
            <span class="bank-val">Educación Financiera MX A.C.</span>
          </div>
          <div class="bank-data-row">
            <span class="bank-label">CLABE Interbancaria:</span>
            <span class="bank-val">
              <span id="clabeVal">012 180 01548962314 5</span>
              <button class="btn-copy" onclick="copyClabe()">Copiar</button>
            </span>
          </div>
          <div class="bank-data-row">
            <span class="bank-label">Monto exacto:</span>
            <span class="bank-val" style="color: var(--verde-principal); font-size: 15px;">$299.00 MXN</span>
          </div>
          <div class="bank-data-row">
            <span class="bank-label">Concepto / Referencia:</span>
            <span class="bank-val">EDU-8429</span>
          </div>

          <p style="font-size: 11.5px; color: var(--gris-medio); margin-top: 14px;">
            💡 <em>Al realizar tu transferencia, conserva tu comprobante. Tu cuenta se activará automáticamente al reportar la referencia.</em>
          </p>
        </div>

        <!-- FORMULARIO TARJETA (OCULTO POR DEFECTO) -->
        <div class="card-box" id="cardBox" style="display: none;">
          <div class="form-group">
            <label>Nombre del titular de la tarjeta</label>
            <input type="text" placeholder="Ej. Juan Pérez López">
          </div>
          <div class="form-group">
            <label>Número de tarjeta</label>
            <input type="text" placeholder="•••• •••• •••• ••••">
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div class="form-group">
              <label>Vencimiento (MM/AA)</label>
              <input type="text" placeholder="12/28">
            </div>
            <div class="form-group">
              <label>CVV (3 dígitos)</label>
              <input type="text" placeholder="123">
            </div>
          </div>
        </div>

        <button class="btn-complete-pay" onclick="handlePayAction()">
          Confirmar y Activar Inscripción ($299 MXN)
        </button>

        <div class="secure-note">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <span>Conexión cifrada de 256 bits • Garantía de satisfacción de 30 días</span>
        </div>
      </div>

    </div>
  </main>

  </div><!-- fin main-wrapper -->
<footer class="site-footer">
    <div class="container">
      <p><strong>Educación Financiera</strong> — Plataforma Educativa de Formación Integral.</p>
    </div>
  </footer>

  <script>
    function selectMethod(method) {
      const speiLabel = document.getElementById('methodSpeiLabel');
      const cardLabel = document.getElementById('methodCardLabel');
      const bankBox = document.getElementById('bankBox');
      const cardBox = document.getElementById('cardBox');

      if (method === 'spei') {
        speiLabel.classList.add('selected');
        cardLabel.classList.remove('selected');
        document.getElementById('paySpei').checked = true;
        bankBox.style.display = 'block';
        cardBox.style.display = 'none';
      } else {
        cardLabel.classList.add('selected');
        speiLabel.classList.remove('selected');
        document.getElementById('payCard').checked = true;
        bankBox.style.display = 'none';
        cardBox.style.display = 'block';
      }
    }

    function copyClabe() {
      const clabe = document.getElementById('clabeVal').innerText.replace(/\s+/g, '');
      navigator.clipboard.writeText(clabe).then(() => {
        alert("📋 ¡CLABE copiada al portapapeles! Ya puedes pegarla en la app de tu banco.");
      }).catch(() => {
        alert("CLABE: " + clabe);
      });
    }

    function handlePayAction() {
      const usaTarjeta = document.getElementById('payCard').checked;
      let quien = 'invitado';
      try {
        const sesion = localStorage.getItem('edu_fin_session');
        const usuario = sesion ? JSON.parse(sesion) : null;
        if (usuario && usuario.email) quien = String(usuario.email).toLowerCase();
      } catch (e) {}

      try {
        localStorage.setItem('edu_fin_membresia_' + quien, JSON.stringify({
          activa: true,
          metodo: usaTarjeta ? 'tarjeta' : 'spei',
          fecha: Date.now()
        }));
      } catch (e) {
        alert("No se pudo guardar tu inscripción. Revisa que tu navegador permita el almacenamiento local.");
        return;
      }

      alert("✅ ¡Inscripción activada! Ya puedes acceder a los Semestres 2, 3 y 4. Te redirigiremos a tu Retícula.");
      window.location.href = "index.php?page=reticula";
    }
  </script>
  <script src="public/js/script.js?v=20261102_recursos"></script>

  <!-- MODAL: REPRODUCTOR DE VIDEO REAL -->
  <div class="modal-overlay" id="videoPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 760px; padding: 22px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
        <h4 id="videoPlayerTitle" style="margin: 0; font-size: 17px; color: var(--gris-oscuro); display: flex; align-items: center; gap: 8px;">
          <span>🎥</span> <span>Clase en Video</span>
        </h4>
        <button class="modal-close-btn" onclick="closeVideoPlayerModal()" style="position: static;" aria-label="Cerrar reproductor">✕</button>
      </div>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000; box-shadow: 0 8px 24px rgba(0,0,0,0.18);">
        <iframe id="videoPlayerIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="" title="Reproductor de Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div style="margin-top: 12px; display: flex; justify-content: flex-end;">
        <button type="button" class="btn-cta-yellow" onclick="closeVideoPlayerModal()" style="padding: 8px 18px; font-size: 13.5px;">Cerrar Video</button>
      </div>
    </div>
  </div>

  <!-- MODAL: REPRODUCTOR DE AUDIO / PODCAST -->
  <div class="modal-overlay" id="audioPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 580px; padding: 24px; width: 95%; background: #ffffff;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 999px;">
          🎧 PODCAST & AUDIO-LECCIÓN OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeAudioPlayerModal()" style="position: static;" aria-label="Cerrar audio">✕</button>
      </div>

      <div style="background: linear-gradient(135deg, #053724 0%, #06402d 100%); color: #ffffff; padding: 22px; border-radius: 14px; margin-bottom: 18px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 14px;">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: var(--amarillo-dorado); display: grid; place-items: center; font-size: 26px; color: #06402d; flex-shrink: 0;">
            🎙️
          </div>
          <div>
            <h4 id="audioModalTitle" style="font-size: 17px; margin: 0 0 4px; font-weight: 700; color: #ffffff;">Título del Audio</h4>
            <div id="audioModalDuration" style="font-size: 12.5px; opacity: 0.85;">Duración: 18 min</div>
          </div>
        </div>

        <p id="audioModalDesc" style="font-size: 13px; opacity: 0.9; line-height: 1.5; margin-bottom: 16px;">
          Escucha esta síntesis comentada por el profesor mientras realizas tus actividades cotidianas.
        </p>

        <!-- Visualizador de ondas sonoras animadas -->
        <div class="audio-wave-visual" id="audioWaveVisual" style="display: flex; align-items: flex-end; justify-content: center; gap: 4px; height: 36px; margin-bottom: 16px;">
          <span class="wave-bar" style="height: 12px;"></span>
          <span class="wave-bar" style="height: 24px;"></span>
          <span class="wave-bar" style="height: 32px;"></span>
          <span class="wave-bar" style="height: 18px;"></span>
          <span class="wave-bar" style="height: 28px;"></span>
          <span class="wave-bar" style="height: 36px;"></span>
          <span class="wave-bar" style="height: 20px;"></span>
          <span class="wave-bar" style="height: 30px;"></span>
          <span class="wave-bar" style="height: 14px;"></span>
        </div>

        <!-- Barra de progreso -->
        <div style="background: rgba(255,255,255,0.2); height: 6px; border-radius: 999px; overflow: hidden; margin-bottom: 8px;">
          <div id="audioModalProgressBar" style="background: var(--amarillo-dorado); height: 100%; width: 0%; transition: width 0.3s ease;"></div>
        </div>
        <div style="display: flex; justify-content: space-between; font-size: 11px; opacity: 0.8;">
          <span id="audioModalCurrentTime">00:00</span>
          <span>Reproducción continua en HD</span>
        </div>
      </div>

      <div style="display: flex; gap: 12px; justify-content: space-between; align-items: center;">
        <button type="button" id="btnPlayAudioModal" onclick="toggleAudioPlayback()" class="btn-cta-yellow" style="flex: 1; padding: 12px; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px;">
          ▶️ Iniciar reproducción
        </button>
        <button type="button" onclick="closeAudioPlayerModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 12px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL: LECTOR Y DESCARGADOR DE LIBROS / GUÍAS -->
  <div class="modal-overlay" id="bookReaderModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 620px; padding: 24px; width: 95%; max-height: 90vh; overflow-y: auto;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #fef08a; color: #854d0e; padding: 4px 10px; border-radius: 999px;">
          📚 LECTURA & GUÍA OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeBookReaderModal()" style="position: static;" aria-label="Cerrar libro">✕</button>
      </div>

      <div style="display: flex; gap: 16px; margin-bottom: 16px; align-items: flex-start;">
        <div style="width: 58px; height: 76px; background: linear-gradient(135deg, #00703C, #06402d); border-radius: 8px; display: grid; place-items: center; font-size: 32px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); flex-shrink: 0; color: #ffffff;">
          📖
        </div>
        <div>
          <h3 id="bookModalTitle" style="font-size: 18px; margin: 0 0 4px; font-weight: 700; color: var(--gris-oscuro);">Título del Libro</h3>
          <div id="bookModalAuthor" style="font-size: 13.5px; color: var(--verde-bosque); font-weight: 600; margin-bottom: 6px;">Por Autor</div>
          <p id="bookModalDesc" style="font-size: 13px; color: var(--gris-medio); line-height: 1.45; margin: 0;">Descripción oficial del material formativo.</p>
        </div>
      </div>

      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 18px;">
        <h5 style="font-size: 14px; font-weight: 700; color: var(--verde-principal); margin: 0 0 10px; display: flex; align-items: center; gap: 6px;">
          <span>💡</span> <span>5 Principios y Lecciones de este libro:</span>
        </h5>
        <ul id="bookModalLessons" style="margin: 0; padding-left: 20px; font-size: 13px; color: #334155; line-height: 1.6;">
          <li><strong>Principio 1:</strong> La diferencia entre ingresos activos y generación de flujo pasivo.</li>
          <li><strong>Principio 2:</strong> Auditar y proteger el 20% de cada peso que ganas.</li>
          <li><strong>Principio 3:</strong> El costo oculto de la deuda y cómo eliminar intereses abusivos.</li>
          <li><strong>Principio 4:</strong> Inversión recurrente automatizada para aprovechar el interés compuesto.</li>
          <li><strong>Principio 5:</strong> Definir tu fecha y número exacto de libertad financiera.</li>
        </ul>
      </div>

      <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center;">
        <button type="button" onclick="descargarGuiaPdfActual()" class="btn-cta-yellow" style="padding: 10px 18px; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
          <span>📥</span> <span>Descargar Guía Oficial (PDF / HTML)</span>
        </button>
        <button type="button" onclick="closeBookReaderModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL: EJERCICIOS Y CASOS PRÁCTICOS -->
  <div class="modal-overlay" id="exercisePlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 620px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 999px;">
          📝 ACTIVIDAD PRÁCTICA DEL MÓDULO
        </span>
        <button class="modal-close-btn" onclick="closeExercisePlayerModal()" style="position: static;" aria-label="Cerrar ejercicio">✕</button>
      </div>
      <h3 id="exerciseModalTitle" style="font-size: 17px; margin: 0 0 6px; font-weight: 700; color: var(--gris-oscuro);">Título del Ejercicio</h3>
      <p id="exerciseModalDesc" style="color: var(--gris-medio); font-size: 13.5px; line-height: 1.5; margin-bottom: 16px;">Instrucciones para resolver el ejercicio.</p>

      <div id="exerciseModalOptions" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;"></div>

      <div id="exerciseModalFeedback" style="display: none; padding: 12px 14px; border-radius: 10px; font-size: 13.5px; margin-bottom: 16px; line-height: 1.5;"></div>

      <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px;">
        <button type="button" class="btn-cta-yellow" onclick="comprobarEjercicioModal()" style="padding: 10px 20px; font-size: 14px; font-weight: 700;">
          Comprobar respuesta
        </button>
        <button type="button" onclick="closeExercisePlayerModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>
