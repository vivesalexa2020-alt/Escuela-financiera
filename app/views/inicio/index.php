<?php
/**
 * Vista: Inicio
 * Contenido migrado desde index.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
<!-- ============================================================
       SPLASH SCREEN — FONDO ILUSTRADO
       ============================================================ -->
  <div class="splash-screen" id="splashScreen">

    <!-- Halo solar -->
    <div class="splash-sun-halo"></div>

    <!-- Nubes flotantes -->
    <div class="splash-cloud c1"></div>
    <div class="splash-cloud c2"></div>
    <div class="splash-cloud c3"></div>

    <!-- ═══════════════════════════════════════════════════
         ESCENA ILUSTRADA: acantilados + plantas + suelo
         (SVG de ancho completo, pegado al fondo)
    ════════════════════════════════════════════════════ -->
    <svg style="position:absolute;bottom:0;left:0;width:100%;height:58%;z-index:1;overflow:visible;"
         viewBox="0 0 400 200" preserveAspectRatio="xMidYMax meet"
         xmlns="http://www.w3.org/2000/svg">
      <defs>
        <!-- Degradado acantilado izquierdo -->
        <linearGradient id="cliffL" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0%" stop-color="#8b6340"/>
          <stop offset="100%" stop-color="#c49a6c"/>
        </linearGradient>
        <!-- Degradado acantilado derecho -->
        <linearGradient id="cliffR" x1="1" y1="0" x2="0" y2="0">
          <stop offset="0%" stop-color="#8b6340"/>
          <stop offset="100%" stop-color="#c49a6c"/>
        </linearGradient>
        <!-- Suelo verde -->
        <linearGradient id="ground" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="#5aa84a"/>
          <stop offset="100%" stop-color="#3d7a30"/>
        </linearGradient>
      </defs>

      <!-- MONTAÑA LEJANA centro (azul-gris) -->
      <polygon points="100,120 200,40 300,120" fill="#7a9fbf" opacity="0.45"/>
      <polygon points="140,120 220,60 310,120" fill="#8aafc8" opacity="0.35"/>

      <!-- ACANTILADO IZQUIERDO (marrón-naranja, rocoso) -->
      <!-- Masa principal -->
      <path d="M0,200 L0,60 C10,55 20,48 28,52 C36,56 38,44 50,40 C60,36 62,50 72,46
               C80,43 82,55 90,52 C100,48 102,60 110,65 L110,200 Z"
            fill="url(#cliffL)"/>
      <!-- Sombras/detalles roca -->
      <path d="M0,100 C10,96 20,90 28,94 C36,98 40,88 50,86 C58,84 60,92 70,90 L70,200 L0,200Z"
            fill="rgba(0,0,0,.12)"/>
      <!-- Vegetación encima del acantilado izquierdo -->
      <ellipse cx="30"  cy="40" rx="22" ry="14" fill="#3d8c3a"/>
      <ellipse cx="52"  cy="34" rx="18" ry="12" fill="#4dab45"/>
      <ellipse cx="74"  cy="44" rx="16" ry="11" fill="#3d8c3a"/>
      <ellipse cx="18"  cy="44" rx="14" ry="10" fill="#2d7030"/>
      <!-- Palmas/helechos izquierda -->
      <path d="M20,60 Q4,38 -4,22" stroke="#2d7030" stroke-width="3" fill="none" stroke-linecap="round"/>
      <ellipse cx="-4" cy="20" rx="14" ry="8" fill="#3d9c38" transform="rotate(-30 -4 20)"/>
      <path d="M20,60 Q8,42 16,28" stroke="#2d7030" stroke-width="2.5" fill="none" stroke-linecap="round"/>
      <ellipse cx="16" cy="26" rx="12" ry="7" fill="#4dab45" transform="rotate(15 16 26)"/>

      <!-- ACANTILADO DERECHO (espejado) -->
      <path d="M400,200 L400,60 C390,55 380,48 372,52 C364,56 362,44 350,40 C340,36 338,50 328,46
               C320,43 318,55 310,52 C300,48 298,60 290,65 L290,200 Z"
            fill="url(#cliffR)"/>
      <path d="M400,100 C390,96 380,90 372,94 C364,98 360,88 350,86 C342,84 340,92 330,90 L330,200 L400,200Z"
            fill="rgba(0,0,0,.12)"/>
      <!-- Vegetación encima del acantilado derecho -->
      <ellipse cx="370" cy="40" rx="22" ry="14" fill="#3d8c3a"/>
      <ellipse cx="348" cy="34" rx="18" ry="12" fill="#4dab45"/>
      <ellipse cx="326" cy="44" rx="16" ry="11" fill="#3d8c3a"/>
      <ellipse cx="382" cy="44" rx="14" ry="10" fill="#2d7030"/>
      <!-- Palmas/helechos derecha -->
      <path d="M380,60 Q396,38 404,22" stroke="#2d7030" stroke-width="3" fill="none" stroke-linecap="round"/>
      <ellipse cx="404" cy="20" rx="14" ry="8" fill="#3d9c38" transform="rotate(30 404 20)"/>
      <path d="M380,60 Q392,42 384,28" stroke="#2d7030" stroke-width="2.5" fill="none" stroke-linecap="round"/>
      <ellipse cx="384" cy="26" rx="12" ry="7" fill="#4dab45" transform="rotate(-15 384 26)"/>

      <!-- SUELO VERDE inferior -->
      <path d="M0,200 L0,155 C40,148 80,142 110,148 C150,156 200,150 250,148
               C280,146 320,142 360,148 L400,155 L400,200 Z"
            fill="url(#ground)"/>
      <!-- Detalles hierba -->
      <ellipse cx="60"  cy="152" rx="40" ry="12" fill="#4dab45" opacity=".7"/>
      <ellipse cx="200" cy="148" rx="50" ry="10" fill="#4dab45" opacity=".5"/>
      <ellipse cx="340" cy="152" rx="40" ry="12" fill="#4dab45" opacity=".7"/>
    </svg>

    <!-- Texto lateral IZQUIERDO -->
    <span class="splash-side left">Grandes<br>metas</span>
    <!-- Texto lateral DERECHO -->
    <span class="splash-side right">Mejores<br>decisiones</span>

    <!-- Contenedor centrado con el logo y los textos -->
    <div class="splash-inner">

      <!-- ── ILUSTRACIÓN: Libros apilados + birrete ── -->
      <svg class="splash-logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"
           role="img" aria-label="Birrete de graduación sobre libros">
        <defs>
          <filter id="bookShadow" x="-10%" y="-10%" width="120%" height="130%">
            <feDropShadow dx="0" dy="4" stdDeviation="5" flood-color="rgba(0,0,0,.28)"/>
          </filter>
        </defs>

        <!-- LIBRO 1 (abajo) — amarillo dorado, el más ancho -->
        <rect x="14" y="154" width="172" height="34" rx="9" fill="#f5b800" filter="url(#bookShadow)"/>
        <rect x="22"  y="160" width="156" height="22" rx="5" fill="#fff3c0"/>
        <rect x="14"  y="154" width="24"  height="34" rx="9" fill="#d49a00"/>
        <!-- líneas de páginas -->
        <line x1="44" y1="156" x2="44" y2="186" stroke="#e8c84a" stroke-width=".8" opacity=".4"/>

        <!-- LIBRO 2 (medio) — verde esmeralda -->
        <rect x="22" y="120" width="156" height="34" rx="9" fill="#2bbd6e" filter="url(#bookShadow)"
              transform="rotate(-1.5 100 137)"/>
        <rect x="30"  y="126" width="140" height="22" rx="5" fill="#d0f5e2"
              transform="rotate(-1.5 100 137)"/>
        <rect x="22"  y="120" width="24"  height="34" rx="9" fill="#1e9a58"
              transform="rotate(-1.5 100 137)"/>

        <!-- LIBRO 3 (arriba) — azul cielo -->
        <rect x="30" y="88" width="140" height="34" rx="9" fill="#1a90d4" filter="url(#bookShadow)"
              transform="rotate(1.5 100 105)"/>
        <rect x="38"  y="94" width="124" height="22" rx="5" fill="#cde8f8"
              transform="rotate(1.5 100 105)"/>
        <rect x="30"  y="88" width="24"  height="34" rx="9" fill="#1270a8"
              transform="rotate(1.5 100 105)"/>

        <!-- BIRRETE DE GRADUACIÓN (encima de los libros) -->
        <g transform="translate(100,60) scale(1.15)">
          <!-- Cabeza del birrete (cilindro) -->
          <ellipse cx="0" cy="6"  rx="28" ry="8"  fill="#1a2550"/>
          <rect    x="-28" y="-10" width="56" height="18" fill="#1a2550"/>
          <ellipse cx="0" cy="-10" rx="28" ry="8"  fill="#232e62"/>
          <!-- Tablero (ala) -->
          <ellipse cx="0" cy="-12" rx="48" ry="12" fill="#0d1c3e"/>
          <ellipse cx="0" cy="-14" rx="48" ry="11" fill="#1a2550"/>
          <ellipse cx="0" cy="-15" rx="46" ry="9.5" fill="#232e62"/>
          <!-- Botón superior -->
          <circle  cx="0" cy="-24" r="5"   fill="#f5b800"/>
          <!-- Cordón -->
          <path d="M0,-24 C24,-24 36,-20 38,-10 L38,12"
                fill="none" stroke="#f5b800" stroke-width="3.5" stroke-linecap="round"/>
          <!-- Borla -->
          <rect x="32" y="10" width="12" height="18" rx="2" fill="#f5b800"/>
          <path d="M33,28 l0,10 M38,28 l0,10 M43,28 l0,10"
                stroke="#f5b800" stroke-width="3" stroke-linecap="round"/>
        </g>
      </svg>

      <!-- Título -->
      <div class="splash-textblock">
        <span class="edu">Educación</span>
        <span class="fin">Financiera</span>
      </div>

      <!-- Botón amarillo -->
      <div class="splash-tagline">¡Haz la prueba!</div>

      <!-- Barra de progreso -->
      <div class="splash-bar"><i></i></div>

      <!-- Saltar -->
      <button class="splash-skip" onclick="hideSplash()">Continuar al sitio</button>
    </div>

  </div>
  <!-- FIN SPLASH -->

  <!-- HEADER -->
  <header class="site-header">
    <div class="container nav-wrap">
      <a href="index.php" class="brand-logo">
        <svg viewBox="0 0 240 210" width="34" height="30" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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

      <div class="nav-actions">
      </div>
    </div>
  </header>

  <main>
    <!-- ============================================================
         1. HERO SUPERIOR: HISTORIAS DE ÉXITO REALES (CERO FASTIDIO)
         ============================================================ -->
    <section class="success-hero-section" id="testimonios">
      <div class="container">

        <div class="success-header">
          <div class="section-eyebrow">
            <span>✨ RESULTADOS REALES, CERO HUMO</span>
          </div>
          <h1>
            Personas reales que recuperaron su paz y <span class="highlight">transformaron sus finanzas</span>
          </h1>
          <p>
            Aquí no hay fórmulas mágicas ni promesas vacías. Descubre cómo personas con ingresos comunes lograron liquidar deudas, crear ahorros de emergencia y empezar a invertir con nuestro método práctico paso a paso.
          </p>
          <div class="success-header-badges">
            <span class="success-mini-tag">⏳ Carrera de 2 Años</span>
            <span class="success-mini-tag">🏆 3 Niveles: Básico, Intermedio y Avanzado</span>
            <span class="success-mini-tag">🎁 1er Semestre de prueba 100% GRATIS</span>
          </div>
        </div>

      </div>
    </section>

<!-- ══════════════════════════════════════════════════════
     SECCIÓN NUESTROS ESTUDIANTES (carrusel fiel al mockup)
     ══════════════════════════════════════════════════════ -->
<section class="m-estudiantes" id="estudiantes">
  <div class="container">

    <!-- Header de sección -->
    <div class="m-est-header">
      <div class="m-est-header-left">
        <div class="m-est-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div>
          <h2 class="m-est-title">Nuestros <span class="m-accent">estudiantes</span></h2>
          <p class="m-est-sub">Historias reales de personas que decidieron cambiar su futuro.</p>
        </div>
      </div>
      <div class="m-est-header-right">
        <div class="m-ya-badge">
          Ellos ya<br>lo lograron,<br><strong>¿y tú?</strong>
          <svg class="m-ya-arrow" viewBox="0 0 60 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 45 C25 45 45 25 55 5" stroke="#28C76F" stroke-width="3" stroke-linecap="round"/>
            <path d="M48 3 L55 5 L50 12" stroke="#28C76F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="m-nav-btns">
          <button class="m-nav-btn" id="mPrev" onclick="mCarousel(-1)">&#8249;</button>
          <button class="m-nav-btn" id="mNext" onclick="mCarousel(1)">&#8250;</button>
        </div>
      </div>
    </div>

    <!-- Track del carrusel -->
    <div class="m-carousel-wrap">
      <div class="m-carousel-track" id="mTrack">

        <!-- Tarjeta 1 -->
        <div class="m-card">
          <div class="m-card-top">
            <div class="m-avatar m-av-green">
              <img src="public/img/avatar-carlos.jpg" alt="Carlos Ramírez"
                   loading="lazy"
                   onerror="this.style.display='none'; this.parentNode.innerText='CR'">
            </div>
            <div class="m-card-info">
              <strong>Carlos Ramírez</strong>
              <span>34 años • Empleado administrativo</span>
            </div>
            <div class="m-play-btn">▶</div>
          </div>
          <p class="m-card-quote">
            "Vivía estresado, pagando mínimos en 3 tarjetas y llegando a fin de quincena en ceros.
            En la Unidad 1 entendí cómo renegociar con el banco sin trucos. Hoy ya no debo un solo
            peso y tengo 4 meses de gastos ahorrados."
          </p>
          <div class="m-card-metrics">
            <div class="m-metric">
              <span class="m-metric-ico">💵</span>
              <div><span>Deuda liquidada:</span><strong>$42,000 MXN</strong></div>
            </div>
            <div class="m-metric">
              <span class="m-metric-ico">⏱️</span>
              <div><span>Tiempo de cambio:</span><strong>4 meses</strong></div>
            </div>
          </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="m-card">
          <div class="m-card-top">
            <div class="m-avatar m-av-teal">
              <img src="public/img/avatar-mariana.jpg" alt="Mariana González"
                   loading="lazy"
                   onerror="this.style.display='none'; this.parentNode.innerText='MG'">
            </div>
            <div class="m-card-info">
              <strong>Mariana González</strong>
              <span>29 años • Independiente</span>
            </div>
            <div class="m-play-btn">▶</div>
          </div>
          <p class="m-card-quote">
            "Siempre creí que la educación financiera era para ricos o cursos de vendehumos en redes.
            Esta plataforma me dio plantillas simples que apliqué de inmediato. Pasé de no saber a
            dónde se iba mi dinero a invertir mensualmente."
          </p>
          <div class="m-card-metrics">
            <div class="m-metric">
              <span class="m-metric-ico">📈</span>
              <div><span>Ahorro mensual:</span><strong>+35% de ingresos</strong></div>
            </div>
            <div class="m-metric">
              <span class="m-metric-ico">🌱</span>
              <div><span>Inversión:</span><strong>Con solo $500</strong></div>
            </div>
          </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="m-card">
          <div class="m-card-top">
            <div class="m-avatar m-av-blue">
              <img src="public/img/avatar-roberto.jpg" alt="Roberto y Silvia"
                   loading="lazy"
                   onerror="this.style.display='none'; this.parentNode.innerText='RS'">
            </div>
            <div class="m-card-info">
              <strong>Roberto y Silvia</strong>
              <span>Pareja y padres de familia • 41 años</span>
            </div>
            <div class="m-play-btn">▶</div>
          </div>
          <p class="m-card-quote">
            "El dinero era motivo de discusiones cada fin de mes. Al tomar el curso juntos fijamos
            metas claras para la educación de nuestros hijos. Hoy tenemos tranquilidad y control
            total de nuestra economía familiar."
          </p>
          <div class="m-card-metrics">
            <div class="m-metric">
              <span class="m-metric-ico">🏠</span>
              <div><span>Meta familiar:</span><strong>Fondo universitario</strong></div>
            </div>
            <div class="m-metric">
              <span class="m-metric-ico">✅</span>
              <div><span>Control de gastos:</span><strong>100% organizado</strong></div>
            </div>
          </div>
        </div>

        <!-- Tarjeta 4 -->
        <div class="m-card">
          <div class="m-card-top">
            <div class="m-avatar m-av-purple">
              <img src="public/img/avatar-jorge.jpg" alt="Jorge Martínez"
                   loading="lazy"
                   onerror="this.style.display='none'; this.parentNode.innerText='JM'">
            </div>
            <div class="m-card-info">
              <strong>Jorge Martínez</strong>
              <span>Vendedor • 28 años</span>
            </div>
            <div class="m-play-btn">▶</div>
          </div>
          <p class="m-card-quote">
            "Pasaba de comisión en comisión sin guardar nada y ahora ya tengo mi fondo de emergencia.
            El curso me enseñó a planear y a ser constante. Hoy tengo más tranquilidad y estoy
            construyendo mis metas."
          </p>
          <div class="m-card-metrics">
            <div class="m-metric">
              <span class="m-metric-ico">💰</span>
              <div><span>Fondo de emergencia:</span><strong>6 meses cubiertos</strong></div>
            </div>
            <div class="m-metric">
              <span class="m-metric-ico">📊</span>
              <div><span>Control financiero:</span><strong>✔ Logrado</strong></div>
            </div>
          </div>
        </div>

        <!-- Tarjeta 5 -->
        <div class="m-card">
          <div class="m-card-top">
            <div class="m-avatar m-av-red">
              <img src="public/img/avatar-ana.jpg" alt="Ana López"
                   loading="lazy"
                   onerror="this.style.display='none'; this.parentNode.innerText='AL'">
            </div>
            <div class="m-card-info">
              <strong>Ana López</strong>
              <span>31 años • Enfermera</span>
            </div>
            <div class="m-play-btn">▶</div>
          </div>
          <p class="m-card-quote">
            "Tenía varias deudas pequeñas que me ahogaban y no veía la salida. Aprendí a hacer un
            presupuesto base cero y a negociar. En 8 meses logré saldar todo y ahora ahorro el 20%
            de mi sueldo sin esfuerzo."
          </p>
          <div class="m-card-metrics">
            <div class="m-metric">
              <span class="m-metric-ico">💵</span>
              <div><span>Deudas liquidadas:</span><strong>$28,500 MXN</strong></div>
            </div>
            <div class="m-metric">
              <span class="m-metric-ico">📈</span>
              <div><span>Ahorro mensual:</span><strong>20% de sueldo</strong></div>
            </div>
          </div>
        </div>

      </div><!-- /track -->
    </div><!-- /carousel-wrap -->

    <!-- Dots -->
    <div class="m-dots" id="mDots"></div>

  </div>

  <!-- ── Barra inferior de features ── -->
  <div class="m-features-bar">
    <div class="container m-features-inner">
      <div class="m-feat">
        <span class="m-feat-ico">🔥</span>
        <div>Tu futuro financiero<br><strong>también se aprende</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">💻</span>
        <div>100% en línea<br><strong>y a tu ritmo</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">🛡️</span>
        <div>Contenido práctico<br><strong>y fácil de aplicar</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">⭐</span>
        <div>Soporte de mentores<br><strong>y comunidad</strong></div>
      </div>
      <div class="m-feat m-feat-cursive">
        No es solo un curso,<br>es una nueva forma<br>de ver tu dinero 💚
      </div>
    </div>
  </div>

</section>
<section class="pillars-overview-section" id="pilares">
      <div class="container">
        
        <div class="pillars-overview-header">
          <div class="pillars-tagline">
            <span>🌱 Pequeñas decisiones, grandes resultados</span>
          </div>
          <h2>EDUCACIÓN FINANCIERA</h2>
          <p class="pillars-sub">3 Bloques fundamentales para transformar tu economía personal</p>
          <p class="pillars-slogan">"Tu futuro también se construye con buenas decisiones"</p>
          <div style="margin-top: 14px;">
            <a href="#tabla-pilares" class="btn-demo-cta" onclick="openFirstDemoBlock(event)" style="display: inline-flex; align-items: center; gap: 7px; padding: 9px 22px; font-size: 13.5px; font-weight: 700; border-radius: 30px; box-shadow: 0 3px 12px rgba(40,199,111,0.32); text-decoration: none;">
              <span>👉 Probar Demo Gratis</span>
            </a>
          </div>
        </div>

        <div class="pillars-grid" id="tabla-pilares" style="scroll-margin-top: 90px;">

          <!-- BLOQUE 1: ADMINISTRACIÓN DE TUS FINANZAS (AZUL) -->
          <div class="pillar-card pillar-blue">
            <div class="pillar-header">
              <div class="pillar-number">1</div>
              <h3>ADMINISTRACIÓN DE TUS FINANZAS</h3>
              <p>Aprende a manejar tu dinero de forma inteligente.</p>
              <button type="button" class="pillar-toggle" onclick="toggleDemoBlock(this)" aria-expanded="false">
                <span class="pillar-toggle-text">Ver contenido</span>
                <span class="pillar-toggle-chevron">▾</span>
              </button>
            </div>
            <div class="pillar-body">
              <div>
                <span class="pillar-temas-pill">Temas:</span>
                <div class="pillar-topic-list">
                  <!-- TEMA 1: INGRESOS Y GASTOS CON TARJETAS FLASH -->
                  <div class="pillar-topic-item topic-with-flashcards">
                    <div class="topic-main-row">
                      <div class="topic-icon-wrap">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/>
                          <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/>
                          <path d="M18 12a2 2 0 0 0 0 4h4v-4z"/>
                        </svg>
                      </div>
                      <div class="topic-texts">
                        <h4>Ingresos y gastos</h4>
                        <p>Conoce cuánto entra y cómo se usa tu dinero.</p>
                      </div>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE FLASHCARDS -->
                    <div class="flashcards-box">
                      <div class="flashcards-header-bar">
                        <span>🃏 TARJETAS FLASH (TOCA PARA GIRAR)</span>
                        <span class="flashcards-counter-badge" id="fcCounter">1 / 10</span>
                      </div>

                      <!-- ESCENARIO DE LA TARJETA (CLIC PARA GIRAR) -->
                      <div class="flashcard-stage" id="fcStage" onclick="toggleFlashcardFlip()" title="Haz clic o toca para voltear la tarjeta">
                        <div class="flashcard-flipper" id="fcFlipper">
                          
                          <!-- CARA FRONTAL: PREGUNTA -->
                          <div class="flashcard-side flashcard-front">
                            <div class="flashcard-top-tag" id="fcFrontBadge">📘 Ingresos</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-question-text" id="fcQuestion">¿Qué son los ingresos?</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>❓ Pregunta</span>
                              <span>Toca para ver respuesta ↻</span>
                            </div>
                          </div>

                          <!-- CARA TRASERA: RESPUESTA -->
                          <div class="flashcard-side flashcard-back">
                            <div class="flashcard-top-tag" id="fcBackBadge">💡 Respuesta</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-answer-text" id="fcAnswer">Es todo el dinero o recurso que recibes de forma periódica o puntual por tu trabajo, negocio, inversiones o ventas.</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>✅ Explicación</span>
                              <span>Toca para ver pregunta ↺</span>
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / GIRAR / SIGUIENTE -->
                      <div class="flashcards-controls-row">
                        <button type="button" class="fc-btn" onclick="prevFlashcard()">◀ Anterior</button>
                        <button type="button" class="fc-btn" onclick="toggleFlashcardFlip()">Girar 🔄</button>
                        <button type="button" class="fc-btn" onclick="nextFlashcard()">Siguiente ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA PREGUNTA -->
                      <div class="fc-chips-scroll" id="fcChipsContainer"></div>
                    </div>
                  </div>

                  <!-- TEMA 2: PRESUPUESTO CON SLIDER DESLIZABLE (CLICK PARA VER) -->
                  <div class="pillar-topic-item topic-with-slider">
                    <div class="topic-clickable-row" onclick="toggleTopicSlider('budgetSliderBox', 'budgetToggleBadge', 'budget')" title="Haz clic para ver las preguntas y descripciones">
                      <div class="topic-clickable-left">
                        <div class="topic-icon-wrap">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                          </svg>
                        </div>
                        <div class="topic-texts">
                          <h4>Presupuesto</h4>
                          <p>Planifica y controla tus gastos diarios y fijos.</p>
                        </div>
                      </div>
                      <span class="topic-toggle-badge" id="budgetToggleBadge">Ver guía ▾</span>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE SLIDER (PRESUPUESTO - OCULTO HASTA DAR CLIC) -->
                    <div class="budget-slider-box" id="budgetSliderBox" style="display: none; margin-top: 6px;">
                      <div class="budget-slider-header-bar">
                        <span>📋 GUÍA DE PREGUNTAS (DESLIZA PARA VER APARTADOS)</span>
                        <span class="budget-slider-counter-badge" id="budgetCounter">1 / 8</span>
                      </div>

                      <!-- ESCENARIO DEL SLIDER (DESLIZABLE) -->
                      <div class="budget-slider-stage" id="budgetStage">
                        <div class="budget-slider-track" id="budgetTrack"></div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / SIGUIENTE -->
                      <div class="budget-slider-controls">
                        <button type="button" class="bs-btn" onclick="prevBudgetSlide()">◀ Deslizar</button>
                        <span style="font-size: 8.5px; color: #03528e; font-weight: 600; opacity: 0.85;">Desliza o toca un apartado</span>
                        <button type="button" class="bs-btn" onclick="nextBudgetSlide()">Deslizar ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA APARTADO -->
                      <div class="bs-chips-scroll" id="budgetChipsContainer"></div>
                    </div>
                  </div>

                  <div class="pillar-topic-item">
                    <div class="topic-icon-wrap">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <circle cx="12" cy="12" r="6"/>
                        <circle cx="12" cy="12" r="2"/>
                      </svg>
                    </div>
                    <div class="topic-texts">
                      <h4>Metas financieras</h4>
                      <p>Define lo que quieres y traza un plan alcanzable.</p>
                    </div>
                  </div>

                  <!-- ── QUIZ: METAS FINANCIERAS ── -->
                  <div class="quiz-box" id="quizMetas">
                    <div class="quiz-header-bar">
                      <span>🎯 QUIZ — METAS FINANCIERAS</span>
                      <span class="quiz-progress-badge" id="quizMetasBadge">1 / 8</span>
                    </div>
                    <div class="quiz-body" id="quizMetasBody">
                      <div class="quiz-question" id="quizMetasQ"></div>
                      <div class="quiz-options" id="quizMetasOpts"></div>
                      <div class="quiz-feedback" id="quizMetasFb">
                        <span class="quiz-feedback-icon" id="quizMetasFbIcon"></span>
                        <span id="quizMetasFbText"></span>
                      </div>
                      <div class="quiz-controls">
                        <button class="quiz-btn-check" id="quizMetasBtnCheck" onclick="checkQuizMetas()" disabled>✔ Comprobar</button>
                        <button class="quiz-btn-next show" id="quizMetasBtnNext" onclick="nextQuizMetas()" style="display:none">Siguiente ▶</button>
                        <button class="quiz-btn-reset" id="quizMetasBtnReset" onclick="resetQuizMetas()">↺ Reiniciar</button>
                      </div>
                    </div>
                    <div class="quiz-result" id="quizMetasResult">
                      <div class="quiz-result-score" id="quizMetasScore"></div>
                      <div class="quiz-result-label">¡Quiz completado!</div>
                      <div class="quiz-result-bar-wrap"><div class="quiz-result-bar" id="quizMetasBar"></div></div>
                      <div class="quiz-result-msg" id="quizMetasMsg"></div>
                      <button class="quiz-btn-check" onclick="resetQuizMetas()" style="max-width:180px">↺ Intentar de nuevo</button>
                    </div>
                  </div>

                </div>
              </div>

              <div class="pillar-bottom-banner">
                ¡Organiza hoy, asegura mañana!
              </div>
            </div>
          </div>

          <!-- BLOQUE 2: AHORRO E INVERSIÓN (VERDE) -->
          <div class="pillar-card pillar-green">
            <div class="pillar-header">
              <div class="pillar-number">2</div>
              <h3>AHORRO E INVERSIÓN</h3>
              <p>Haz que tu dinero trabaje para ti.</p>
              <button type="button" class="pillar-toggle" onclick="toggleDemoBlock(this)" aria-expanded="false">
                <span class="pillar-toggle-text">Ver contenido</span>
                <span class="pillar-toggle-chevron">▾</span>
              </button>
            </div>
            <div class="pillar-body">
              <div>
                <span class="pillar-temas-pill">Temas:</span>
                <div class="pillar-topic-list">
                  <!-- TEMA 1: EL HÁBITO DEL AHORRO CON TARJETAS FLASH -->
                  <div class="pillar-topic-item topic-with-flashcards">
                    <div class="topic-main-row">
                      <div class="topic-icon-wrap">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M19 12a7 7 0 1 0-14 0c0 2.5 1.3 4.7 3.2 6H19a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-1z"/>
                          <circle cx="16" cy="8" r="1" fill="currentColor"/>
                          <path d="M11 6a4 4 0 0 1 4 4"/>
                          <path d="M9 18v3"/>
                          <path d="M15 18v3"/>
                        </svg>
                      </div>
                      <div class="topic-texts">
                        <h4>El hábito del ahorro</h4>
                        <p>Pequeños aportes constantes, grandes logros.</p>
                      </div>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE FLASHCARDS (AHORRO) -->
                    <div class="flashcards-box">
                      <div class="flashcards-header-bar">
                        <span>🃏 TARJETAS FLASH (TOCA PARA GIRAR)</span>
                        <span class="flashcards-counter-badge" id="fcAhorroCounter">1 / 10</span>
                      </div>

                      <!-- ESCENARIO DE LA TARJETA (CLIC PARA GIRAR) -->
                      <div class="flashcard-stage" id="fcAhorroStage" onclick="toggleFlashcardFlipAhorro()" title="Haz clic o toca para voltear la tarjeta">
                        <div class="flashcard-flipper" id="fcAhorroFlipper">
                          
                          <!-- CARA FRONTAL: PREGUNTA -->
                          <div class="flashcard-side flashcard-front">
                            <div class="flashcard-top-tag" id="fcAhorroFrontBadge">📗 Hábito del ahorro</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-question-text" id="fcAhorroQuestion">¿Qué es realmente el hábito del ahorro?</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>❓ Pregunta</span>
                              <span>Toca para ver respuesta ↻</span>
                            </div>
                          </div>

                          <!-- CARA TRASERA: RESPUESTA -->
                          <div class="flashcard-side flashcard-back">
                            <div class="flashcard-top-tag" id="fcAhorroBackBadge">💡 Respuesta</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-answer-text" id="fcAhorroAnswer">Separar y reservar una porción fija de tus ingresos de manera constante antes de gastar, no solo lo que sobra al final del mes.</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>✅ Explicación</span>
                              <span>Toca para ver pregunta ↺</span>
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / GIRAR / SIGUIENTE -->
                      <div class="flashcards-controls-row">
                        <button type="button" class="fc-btn" onclick="prevFlashcardAhorro()">◀ Anterior</button>
                        <button type="button" class="fc-btn" onclick="toggleFlashcardFlipAhorro()">Girar 🔄</button>
                        <button type="button" class="fc-btn" onclick="nextFlashcardAhorro()">Siguiente ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA PREGUNTA -->
                      <div class="fc-chips-scroll" id="fcAhorroChipsContainer"></div>
                    </div>
                  </div>

                  <!-- TEMA 2: TIPOS DE INVERSIÓN CON SLIDER DESLIZABLE (CLICK PARA VER) -->
                  <div class="pillar-topic-item topic-with-slider">
                    <div class="topic-clickable-row" onclick="toggleTopicSlider('inversionSliderBox', 'inversionToggleBadge', 'inversion')" title="Haz clic para ver las preguntas y descripciones">
                      <div class="topic-clickable-left">
                        <div class="topic-icon-wrap">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"/>
                            <line x1="12" y1="20" x2="12" y2="4"/>
                            <line x1="6" y1="20" x2="6" y2="14"/>
                            <path d="M4 14l8-8 6 6 4-4"/>
                          </svg>
                        </div>
                        <div class="topic-texts">
                          <h4>Tipos de inversión</h4>
                          <p>Conoce las opciones que se ajustan a tus objetivos.</p>
                        </div>
                      </div>
                      <span class="topic-toggle-badge" id="inversionToggleBadge">Ver guía ▾</span>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE SLIDER (INVERSIÓN - OCULTO HASTA DAR CLIC) -->
                    <div class="budget-slider-box" id="inversionSliderBox" style="display: none; margin-top: 6px;">
                      <div class="budget-slider-header-bar">
                        <span>📈 GUÍA DE INVERSIÓN (DESLIZA PARA VER APARTADOS)</span>
                        <span class="budget-slider-counter-badge" id="inversionCounter">1 / 8</span>
                      </div>

                      <!-- ESCENARIO DEL SLIDER (DESLIZABLE) -->
                      <div class="budget-slider-stage" id="inversionStage">
                        <div class="budget-slider-track" id="inversionTrack"></div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / SIGUIENTE -->
                      <div class="budget-slider-controls">
                        <button type="button" class="bs-btn" onclick="prevInversionSlide()">◀ Deslizar</button>
                        <span style="font-size: 8.5px; color: #007640; font-weight: 600; opacity: 0.85;">Desliza o toca un apartado</span>
                        <button type="button" class="bs-btn" onclick="nextInversionSlide()">Deslizar ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA APARTADO -->
                      <div class="bs-chips-scroll" id="inversionChipsContainer"></div>
                    </div>
                  </div>

                  <div class="pillar-topic-item">
                    <div class="topic-icon-wrap">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <ellipse cx="12" cy="6" rx="8" ry="3"/>
                        <path d="M4 6v6c0 1.66 3.58 3 8 3s8-1.34 8-3V6"/>
                        <path d="M4 12v6c0 1.66 3.58 3 8 3s8-1.34 8-3v-6"/>
                      </svg>
                    </div>
                    <div class="topic-texts">
                      <h4>Interés compuesto</h4>
                      <p>Tu dinero puede multiplicarse y crecer con el tiempo.</p>
                    </div>
                  </div>

                  <!-- ── QUIZ: INTERÉS COMPUESTO ── -->
                  <div class="quiz-box" id="quizInteres">
                    <div class="quiz-header-bar green-bar">
                      <span>📈 QUIZ — INTERÉS COMPUESTO</span>
                      <span class="quiz-progress-badge" id="quizInteresBadge">1 / 8</span>
                    </div>
                    <div class="quiz-body" id="quizInteresBody">
                      <div class="quiz-question" id="quizInteresQ"></div>
                      <div class="quiz-options" id="quizInteresOpts"></div>
                      <div class="quiz-feedback" id="quizInteresFb">
                        <span class="quiz-feedback-icon" id="quizInteresFbIcon"></span>
                        <span id="quizInteresFbText"></span>
                      </div>
                      <div class="quiz-controls">
                        <button class="quiz-btn-check" id="quizInteresBtnCheck" onclick="checkQuizInteres()" disabled style="background:linear-gradient(135deg,#1a7a45,#15603a)">✔ Comprobar</button>
                        <button class="quiz-btn-next" id="quizInteresBtnNext" onclick="nextQuizInteres()" style="display:none;background:linear-gradient(135deg,#22c55e,#16a34a)">Siguiente ▶</button>
                        <button class="quiz-btn-reset" id="quizInteresBtnReset" onclick="resetQuizInteres()">↺ Reiniciar</button>
                      </div>
                    </div>
                    <div class="quiz-result" id="quizInteresResult">
                      <div class="quiz-result-score" id="quizInteresScore"></div>
                      <div class="quiz-result-label">¡Quiz completado!</div>
                      <div class="quiz-result-bar-wrap"><div class="quiz-result-bar" id="quizInteresBar" style="background:linear-gradient(90deg,#16a34a,#22c55e)"></div></div>
                      <div class="quiz-result-msg" id="quizInteresMsg"></div>
                      <button class="quiz-btn-check" onclick="resetQuizInteres()" style="max-width:180px;background:linear-gradient(135deg,#1a7a45,#15603a)">↺ Intentar de nuevo</button>
                    </div>
                  </div>

                </div>
              </div>

              <div class="pillar-bottom-banner">
                Ahorra, invierte, crece.
              </div>
            </div>
          </div>

          <!-- BLOQUE 3: USO RESPONSABLE DEL CRÉDITO (ÍNDIGO) -->
          <div class="pillar-card pillar-indigo">
            <div class="pillar-header">
              <div class="pillar-number">3</div>
              <h3>USO RESPONSABLE DEL CRÉDITO</h3>
              <p>El crédito puede ser una herramienta, si lo usas con inteligencia.</p>
              <button type="button" class="pillar-toggle" onclick="toggleDemoBlock(this)" aria-expanded="false">
                <span class="pillar-toggle-text">Ver contenido</span>
                <span class="pillar-toggle-chevron">▾</span>
              </button>
            </div>
            <div class="pillar-body">
              <div>
                <span class="pillar-temas-pill">Temas:</span>
                <div class="pillar-topic-list">
                  <!-- TEMA 1: TIPOS DE CRÉDITO CON TARJETAS FLASH -->
                  <div class="pillar-topic-item topic-with-flashcards">
                    <div class="topic-main-row">
                      <div class="topic-icon-wrap">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <rect x="2" y="5" width="20" height="14" rx="2"/>
                          <line x1="2" y1="10" x2="22" y2="10"/>
                        </svg>
                      </div>
                      <div class="topic-texts">
                        <h4>Tipos de crédito</h4>
                        <p>Conoce sus características, plazos y diferencias.</p>
                      </div>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE FLASHCARDS (CRÉDITO) -->
                    <div class="flashcards-box">
                      <div class="flashcards-header-bar">
                        <span>🃏 TARJETAS FLASH (TOCA PARA GIRAR)</span>
                        <span class="flashcards-counter-badge" id="fcCreditoCounter">1 / 10</span>
                      </div>

                      <!-- ESCENARIO DE LA TARJETA (CLIC PARA GIRAR) -->
                      <div class="flashcard-stage" id="fcCreditoStage" onclick="toggleFlashcardFlipCredito()" title="Haz clic o toca para voltear la tarjeta">
                        <div class="flashcard-flipper" id="fcCreditoFlipper">
                          
                          <!-- CARA FRONTAL: PREGUNTA -->
                          <div class="flashcard-side flashcard-front">
                            <div class="flashcard-top-tag" id="fcCreditoFrontBadge">💳 Crédito</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-question-text" id="fcCreditoQuestion">¿Qué es realmente un crédito?</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>❓ Pregunta</span>
                              <span>Toca para ver respuesta ↻</span>
                            </div>
                          </div>

                          <!-- CARA TRASERA: RESPUESTA -->
                          <div class="flashcard-side flashcard-back">
                            <div class="flashcard-top-tag" id="fcCreditoBackBadge">💡 Respuesta</div>
                            <div class="flashcard-content-wrap">
                              <div class="flashcard-answer-text" id="fcCreditoAnswer">Es un préstamo de dinero que una entidad te otorga bajo el compromiso de devolverlo en un plazo pactado junto con los intereses y comisiones.</div>
                            </div>
                            <div class="flashcard-hint-bottom">
                              <span>✅ Explicación</span>
                              <span>Toca para ver pregunta ↺</span>
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / GIRAR / SIGUIENTE -->
                      <div class="flashcards-controls-row">
                        <button type="button" class="fc-btn" onclick="prevFlashcardCredito()">◀ Anterior</button>
                        <button type="button" class="fc-btn" onclick="toggleFlashcardFlipCredito()">Girar 🔄</button>
                        <button type="button" class="fc-btn" onclick="nextFlashcardCredito()">Siguiente ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA PREGUNTA -->
                      <div class="fc-chips-scroll" id="fcCreditoChipsContainer"></div>
                    </div>
                  </div>

                  <!-- TEMA 2: BUENAS PRÁCTICAS CON SLIDER DESLIZABLE (CLICK PARA VER) -->
                  <div class="pillar-topic-item topic-with-slider">
                    <div class="topic-clickable-row" onclick="toggleTopicSlider('practicasSliderBox', 'practicasToggleBadge', 'practicas')" title="Haz clic para ver las preguntas y descripciones">
                      <div class="topic-clickable-left">
                        <div class="topic-icon-wrap">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <polyline points="9 15 11 17 15 13"/>
                          </svg>
                        </div>
                        <div class="topic-texts">
                          <h4>Buenas prácticas</h4>
                          <p>Evita deudas innecesarias y cumple tus pagos a tiempo.</p>
                        </div>
                      </div>
                      <span class="topic-toggle-badge" id="practicasToggleBadge">Ver guía ▾</span>
                    </div>

                    <!-- MÓDULO INTERACTIVO DE SLIDER (BUENAS PRÁCTICAS - OCULTO HASTA DAR CLIC) -->
                    <div class="budget-slider-box" id="practicasSliderBox" style="display: none; margin-top: 6px;">
                      <div class="budget-slider-header-bar">
                        <span>💳 REGLAS DE ORO (DESLIZA PARA VER APARTADOS)</span>
                        <span class="budget-slider-counter-badge" id="practicasCounter">1 / 8</span>
                      </div>

                      <!-- ESCENARIO DEL SLIDER (DESLIZABLE) -->
                      <div class="budget-slider-stage" id="practicasStage">
                        <div class="budget-slider-track" id="practicasTrack"></div>
                      </div>

                      <!-- CONTROLES: ANTERIOR / SIGUIENTE -->
                      <div class="budget-slider-controls">
                        <button type="button" class="bs-btn" onclick="prevPracticasSlide()">◀ Deslizar</button>
                        <span style="font-size: 8.5px; color: #24307a; font-weight: 600; opacity: 0.85;">Desliza o toca un apartado</span>
                        <button type="button" class="bs-btn" onclick="nextPracticasSlide()">Deslizar ▶</button>
                      </div>

                      <!-- CHIPS DE ACCESO DIRECTO A CADA APARTADO -->
                      <div class="bs-chips-scroll" id="practicasChipsContainer"></div>
                    </div>
                  </div>

                  <div class="pillar-topic-item">
                    <div class="topic-icon-wrap">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                      </svg>
                    </div>
                    <div class="topic-texts">
                      <h4>Riesgos del sobreendeudamiento</h4>
                      <p>Cuida tu historial crediticio y tu estabilidad familiar.</p>
                    </div>
                  </div>

                  <!-- ── QUIZ: SOBREENDEUDAMIENTO ── -->
                  <div class="quiz-box" id="quizDeuda">
                    <div class="quiz-header-bar indigo-bar">
                      <span>⚠️ QUIZ — SOBREENDEUDAMIENTO</span>
                      <span class="quiz-progress-badge" id="quizDeudaBadge">1 / 8</span>
                    </div>
                    <div class="quiz-body" id="quizDeudaBody">
                      <div class="quiz-question" id="quizDeudaQ"></div>
                      <div class="quiz-options" id="quizDeudaOpts"></div>
                      <div class="quiz-feedback" id="quizDeudaFb">
                        <span class="quiz-feedback-icon" id="quizDeudaFbIcon"></span>
                        <span id="quizDeudaFbText"></span>
                      </div>
                      <div class="quiz-controls">
                        <button class="quiz-btn-check" id="quizDeudaBtnCheck" onclick="checkQuizDeuda()" disabled style="background:linear-gradient(135deg,#24307a,#1c2560)">✔ Comprobar</button>
                        <button class="quiz-btn-next" id="quizDeudaBtnNext" onclick="nextQuizDeuda()" style="display:none;background:linear-gradient(135deg,#6366f1,#4f46e5)">Siguiente ▶</button>
                        <button class="quiz-btn-reset" id="quizDeudaBtnReset" onclick="resetQuizDeuda()">↺ Reiniciar</button>
                      </div>
                    </div>
                    <div class="quiz-result" id="quizDeudaResult">
                      <div class="quiz-result-score" id="quizDeudaScore"></div>
                      <div class="quiz-result-label">¡Quiz completado!</div>
                      <div class="quiz-result-bar-wrap"><div class="quiz-result-bar" id="quizDeudaBar" style="background:linear-gradient(90deg,#4f46e5,#818cf8)"></div></div>
                      <div class="quiz-result-msg" id="quizDeudaMsg"></div>
                      <button class="quiz-btn-check" onclick="resetQuizDeuda()" style="max-width:180px;background:linear-gradient(135deg,#24307a,#1c2560)">↺ Intentar de nuevo</button>
                    </div>
                  </div>

                </div>
              </div>

              <div class="pillar-bottom-banner">
                El buen crédito también es libertad.
              </div>
            </div>
          </div>

        </div>

        <!-- TARJETA DEMO CONCLUIDA (REEMPLAZA LAS 3 TABLAS AL TERMINAR) -->
        <div class="demo-fin-card" id="demoFinCard" style="display: none;">
          <div class="demo-fin-card-inner">
            <div class="demo-fin-badge">🏁 DEMO GRATUITA CONCLUIDA</div>
            <div style="font-size: 46px; margin-bottom: 6px;">🎓</div>
            <h3 class="demo-fin-title">¡Has completado la revisión de las 3 tablas de prueba!</h3>
            <div class="demo-fin-pills">
              <span class="df-pill">✅ 1. Administración de Finanzas</span>
              <span class="df-pill">✅ 2. Ahorro e Inversión</span>
              <span class="df-pill">✅ 3. Uso Responsable del Crédito</span>
            </div>
            <p class="demo-fin-desc">
              Tu periodo de demostración gratuita ha terminado y <strong>las 3 tablas de prueba han sido retiradas</strong>. Ahora que conoces las bases, da el paso definitivo e <strong>inscríbete sin costo</strong> para desbloquear tu Semestre 1 completo de la carrera de 2 años sin ingresar tarjetas de crédito.
            </p>
            <div class="demo-fin-cta-box">
              <a href="index.php?page=reticula" class="btn-demo-fin-enroll" id="btnDemoFinEnroll">
                <span>👉 Ir a Inscribirme Ahora (100% Gratis)</span>
              </a>
              <div class="demo-fin-redirect-note" id="demoRedirectNotice">
                ⏳ Redirigiendo a tu inscripción en <strong id="demoCountdownSecs">3</strong> segundos...
              </div>
            </div>
            <div style="margin-top: 14px;">
              <button type="button" class="btn-demo-fin-reset" onclick="reiniciarDemoTest()">↺ Volver a abrir tablas (modo prueba)</button>
            </div>
          </div>
        </div>

        <!-- MÁS BAJITO: SECCIÓN PARA INSCRIBIRSE CON EL BOTÓN FINAL PARA INICIAR DEMO GRATIS -->
        <div class="enroll-cta-wrapper">
          <div class="enroll-badge">
            <span>🎁 1ER SEMESTRE DE PRUEBA 100% GRATIS</span>
          </div>
          <h2>Inscríbete y da el primer paso hacia tu libertad financiera</h2>
          <p>
            No te pedimos ingresar tarjetas de crédito ni datos bancarios. Comienza a estudiar hoy mismo nuestro programa de 2 años con acceso libre a las materias del Nivel Básico.
          </p>
          <div class="cta-button-group">
            <a href="index.php?page=reticula" class="btn-main-pulse">
              <span>👉 Inscríbete Ahora</span>
            </a>
          </div>
          <div class="no-register-note">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Acceso libre • Sin tarjeta de crédito • Comienza en menos de 1 minuto</span>
          </div>
        </div>

      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p><strong>Educación Financiera</strong> — Plataforma Educativa de Aprendizaje y Transformación.</p>
    </div>
  </footer>

  <script>
    /* ============================================================
       LÓGICA DE TARJETAS FLASH INTERACTIVAS (INGRESOS Y GASTOS)
       ============================================================ */
    const flashcardsData = [
      {
        badge: "📘 Ingresos",
        pregunta: "¿Qué son los ingresos?",
        respuesta: "Es todo el dinero o recurso que recibes de forma periódica o puntual por tu trabajo, negocio, inversiones o ventas.",
        chip: "1. ¿Qué son?"
      },
      {
        badge: "📘 Tipos de ingresos",
        pregunta: "¿Cuáles son los tipos de ingresos?",
        respuesta: "<strong>• Fijos:</strong> Sueldo o pensión constante.<br><strong>• Variables:</strong> Comisiones, propinas o ventas.<br><strong>• Pasivos:</strong> Rentas o rendimientos sin esfuerzo diario.",
        chip: "2. Tipos ingresos"
      },
      {
        badge: "📘 Ejemplos",
        pregunta: "¿Cuáles son ejemplos comunes de ingresos?",
        respuesta: "Salario mensual/quincenal, pago de horas extras, ganancias de un negocio propio, dividendos de inversión y rentas cobradas.",
        chip: "3. Ejemplos"
      },
      {
        badge: "📘 Importancia",
        pregunta: "¿Por qué son importantes los ingresos?",
        respuesta: "Son el motor de tu estabilidad: cubren tus necesidades vitales, te permiten crear un fondo de emergencia e invertir en tu futuro.",
        chip: "4. Importancia"
      },
      {
        badge: "📙 Gastos",
        pregunta: "¿Qué son los gastos?",
        respuesta: "Es cualquier salida o desembolso de dinero destinado a adquirir bienes, pagar servicios o liquidar compromisos financieros.",
        chip: "5. Gastos"
      },
      {
        badge: "📙 Tipos de gastos",
        pregunta: "¿Cuáles son los tipos de gastos?",
        respuesta: "<strong>• Fijos:</strong> Renta, hipoteca, servicios.<br><strong>• Variables:</strong> Alimentación diaria, transporte.<br><strong>• Discrecionales:</strong> Salidas, ropa por gusto y ocio.",
        chip: "6. Tipos gastos"
      },
      {
        badge: "⚠️ Gastos hormiga",
        pregunta: "¿Qué son los 'gastos hormiga'?",
        respuesta: "Pequeños consumos cotidianos casi imperceptibles (cafés diarios, botanas, suscripciones sin uso) que al mes representan una fuerte fuga de dinero.",
        chip: "7. Gastos hormiga"
      },
      {
        badge: "⚖️ Criterio",
        pregunta: "¿Cómo diferenciar una necesidad de un deseo?",
        respuesta: "<strong>• Necesidad:</strong> Esencial para vivir o trabajar (alimentación básica, salud, techo).<br><strong>• Deseo:</strong> Prescindible que satisface un antojo momentáneo o estatus.",
        chip: "8. Necesidad o deseo"
      },
      {
        badge: "💡 Regla 50/30/20",
        pregunta: "¿Qué es la regla 50/30/20 en ingresos y gastos?",
        respuesta: "Es un método práctico: destinar el <strong>50%</strong> a necesidades básicas, el <strong>30%</strong> a deseos o estilo de vida, y el <strong>20%</strong> a ahorro o pagar deudas.",
        chip: "9. Regla 50/30/20"
      },
      {
        badge: "📈 Control",
        pregunta: "¿Cómo lograr un flujo de dinero positivo?",
        respuesta: "Gasta siempre menos de lo que ingresas. La regla de oro: <em>Ingresos - Ahorro primero = Gastos</em>. Ahorra al recibir, no lo que sobre.",
        chip: "10. Flujo positivo"
      }
    ];

    let currentCardIndex = 0;

    function renderFlashcard() {
      const card = flashcardsData[currentCardIndex];
      const flipper = document.getElementById('fcFlipper');
      if (flipper) {
        flipper.classList.remove('is-flipped');
      }
      
      const fcFrontBadge = document.getElementById('fcFrontBadge');
      const fcQuestion = document.getElementById('fcQuestion');
      const fcAnswer = document.getElementById('fcAnswer');
      const fcCounter = document.getElementById('fcCounter');
      
      if (fcFrontBadge) fcFrontBadge.textContent = card.badge;
      if (fcQuestion) fcQuestion.textContent = card.pregunta;
      if (fcAnswer) fcAnswer.innerHTML = card.respuesta;
      if (fcCounter) fcCounter.textContent = `${currentCardIndex + 1} / ${flashcardsData.length}`;

      const chips = document.querySelectorAll('#fcChipsContainer .fc-chip');
      chips.forEach((c, idx) => {
        if (idx === currentCardIndex) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function toggleFlashcardFlip() {
      const flipper = document.getElementById('fcFlipper');
      if (flipper) {
        flipper.classList.toggle('is-flipped');
      }
    }

    function nextFlashcard() {
      currentCardIndex = (currentCardIndex + 1) % flashcardsData.length;
      renderFlashcard();
    }

    function prevFlashcard() {
      currentCardIndex = (currentCardIndex - 1 + flashcardsData.length) % flashcardsData.length;
      renderFlashcard();
    }

    function selectFlashcard(idx) {
      currentCardIndex = idx;
      renderFlashcard();
    }

    function initFlashcards() {
      const container = document.getElementById('fcChipsContainer');
      if (!container) return;
      container.innerHTML = '';
      flashcardsData.forEach((item, index) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `fc-chip ${index === 0 ? 'active' : ''}`;
        btn.textContent = item.chip;
        btn.onclick = () => selectFlashcard(index);
        container.appendChild(btn);
      });
      renderFlashcard();
    }

    /* ============================================================
       LÓGICA DE TARJETAS FLASH INTERACTIVAS (EL HÁBITO DEL AHORRO)
       ============================================================ */
    const flashcardsDataAhorro = [
      {
        badge: "📗 Hábito del ahorro",
        pregunta: "¿Qué es realmente el hábito del ahorro?",
        respuesta: "Separar y reservar una porción fija de tus ingresos de manera constante antes de gastar, no solo lo que sobra al final del mes.",
        chip: "1. ¿Qué es?"
      },
      {
        badge: "📗 Importancia",
        pregunta: "¿Por qué es tan importante ahorrar con constancia?",
        respuesta: "Te da paz mental ante emergencias, evita endeudarte con intereses altos y construye el capital base para invertir.",
        chip: "2. Importancia"
      },
      {
        badge: "💡 Regla de oro",
        pregunta: "¿Qué significa 'Págate a ti mismo primero'?",
        respuesta: "Apenas recibes tus ingresos, apartas tu ahorro automáticamente. Si esperas a gastar primero, rara vez queda dinero.",
        chip: "3. Págate primero"
      },
      {
        badge: "🛡️ Fondo de paz",
        pregunta: "¿Qué es un fondo de emergencia y cuánto debe ser?",
        respuesta: "Un colchón seguro para imprevistos (salud, desempleo, reparaciones). Lo ideal es reunir entre <strong>3 y 6 meses</strong> de tus gastos básicos.",
        chip: "4. Fondo emergencia"
      },
      {
        badge: "⚖️ Criterio",
        pregunta: "¿Cuál es la diferencia entre ahorrar e invertir?",
        respuesta: "<strong>• Ahorro:</strong> Dinero seguro y disponible a corto plazo.<br><strong>• Inversión:</strong> Dinero que trabaja para ganarle a la inflación y multiplicarse.",
        chip: "5. Ahorro vs Invertir"
      },
      {
        badge: "📊 Porcentaje ideal",
        pregunta: "¿Cuánto dinero debería ahorrar cada mes?",
        respuesta: "La meta sugerida es del <strong>10% al 20%</strong> de tus ingresos. Si hoy te cuesta, empieza con el <strong>1% o 5%</strong> y aumenta paso a paso.",
        chip: "6. ¿Cuánto ahorrar?"
      },
      {
        badge: "⚠️ Inflación",
        pregunta: "¿Por qué guardar el dinero estancado es un error?",
        respuesta: "Por la inflación: con el tiempo las cosas suben de precio y el efectivo guardado pierde poder adquisitivo día con día.",
        chip: "7. Inflación"
      },
      {
        badge: "🤖 Automatización",
        pregunta: "¿Cómo lograr el hábito del ahorro sin esfuerzo?",
        respuesta: "Programa una transferencia automática a otra cuenta el día que cobras. Si no ves el dinero disponible en tu cuenta diaria, no lo gastas.",
        chip: "8. Automatizar"
      },
      {
        badge: "🧠 Psicología",
        pregunta: "¿Cómo frenar los gastos impulsivos que dañan el ahorro?",
        respuesta: "Aplica la regla de las <strong>48 horas</strong>: espera 2 días antes de comprar un antojo. En el 80% de los casos el deseo desaparece.",
        chip: "9. Regla 48 horas"
      },
      {
        badge: "🎯 Propósito",
        pregunta: "¿Por qué el ahorro debe tener un objetivo claro?",
        respuesta: "Ahorrar 'por si acaso' es fácil de romper. Al ponerle nombre ('Fondo de paz', 'Enganche', 'Cursos'), tu mente lo respeta y defiende.",
        chip: "10. Propósito claro"
      }
    ];

    let currentCardIndexAhorro = 0;

    function renderFlashcardAhorro() {
      const card = flashcardsDataAhorro[currentCardIndexAhorro];
      const flipper = document.getElementById('fcAhorroFlipper');
      if (flipper) {
        flipper.classList.remove('is-flipped');
      }
      
      const fcFrontBadge = document.getElementById('fcAhorroFrontBadge');
      const fcQuestion = document.getElementById('fcAhorroQuestion');
      const fcAnswer = document.getElementById('fcAhorroAnswer');
      const fcCounter = document.getElementById('fcAhorroCounter');
      
      if (fcFrontBadge) fcFrontBadge.textContent = card.badge;
      if (fcQuestion) fcQuestion.textContent = card.pregunta;
      if (fcAnswer) fcAnswer.innerHTML = card.respuesta;
      if (fcCounter) fcCounter.textContent = `${currentCardIndexAhorro + 1} / ${flashcardsDataAhorro.length}`;

      const chips = document.querySelectorAll('#fcAhorroChipsContainer .fc-chip');
      chips.forEach((c, idx) => {
        if (idx === currentCardIndexAhorro) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function toggleFlashcardFlipAhorro() {
      const flipper = document.getElementById('fcAhorroFlipper');
      if (flipper) {
        flipper.classList.toggle('is-flipped');
      }
    }

    function nextFlashcardAhorro() {
      currentCardIndexAhorro = (currentCardIndexAhorro + 1) % flashcardsDataAhorro.length;
      renderFlashcardAhorro();
    }

    function prevFlashcardAhorro() {
      currentCardIndexAhorro = (currentCardIndexAhorro - 1 + flashcardsDataAhorro.length) % flashcardsDataAhorro.length;
      renderFlashcardAhorro();
    }

    function selectFlashcardAhorro(idx) {
      currentCardIndexAhorro = idx;
      renderFlashcardAhorro();
    }

    function initFlashcardsAhorro() {
      const container = document.getElementById('fcAhorroChipsContainer');
      if (!container) return;
      container.innerHTML = '';
      flashcardsDataAhorro.forEach((item, index) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `fc-chip ${index === 0 ? 'active' : ''}`;
        btn.textContent = item.chip;
        btn.onclick = () => selectFlashcardAhorro(index);
        container.appendChild(btn);
      });
      renderFlashcardAhorro();
    }

    /* ============================================================
       LÓGICA DE TARJETAS FLASH INTERACTIVAS (TIPOS DE CRÉDITO)
       ============================================================ */
    const flashcardsDataCredito = [
      {
        badge: "💳 ¿Qué es?",
        pregunta: "¿Qué es realmente un crédito financiero?",
        respuesta: "Es dinero que una entidad te presta bajo el compromiso de devolverlo en un plazo pactado con intereses y comisiones.",
        chip: "1. ¿Qué es?"
      },
      {
        badge: "💳 Revolvente",
        pregunta: "¿Cómo funciona una tarjeta de crédito?",
        respuesta: "Línea de crédito que reutilizas al pagar. Si cubres el 100% de tu saldo antes de la fecha límite, <strong>¡pagas 0% de interés!</strong>",
        chip: "2. Tarjeta crédito"
      },
      {
        badge: "👤 Personal",
        pregunta: "¿Para qué sirve un préstamo personal?",
        respuesta: "Monto fijo a mensualidades predecibles. Ideal para emergencias o consolidar deudas con intereses muy altos en un solo pago.",
        chip: "3. Personal"
      },
      {
        badge: "🚗 Automotriz",
        pregunta: "¿Qué caracteriza al crédito automotriz?",
        respuesta: "Es un crédito con garantía: el propio vehículo respalda el préstamo hasta que terminas de pagar la última mensualidad.",
        chip: "4. Automotriz"
      },
      {
        badge: "🏠 Hipotecario",
        pregunta: "¿Qué es un crédito hipotecario?",
        respuesta: "Préstamo de largo plazo (10 a 20 años) para adquirir o remodelar vivienda. Es el tipo de crédito con la tasa más baja.",
        chip: "5. Hipotecario"
      },
      {
        badge: "💼 De nómina",
        pregunta: "¿Qué ventaja y riesgo tiene el crédito de nómina?",
        respuesta: "Se descuenta en automático de tu sueldo. Es de aprobación rápida, pero reduce directo tu flujo quincenal disponible.",
        chip: "6. De nómina"
      },
      {
        badge: "📊 ¿Qué es el CAT?",
        pregunta: "¿Qué es el Costo Anual Total (CAT)?",
        respuesta: "Es la medida real de lo que pagarás: incluye intereses, comisiones, anualidad y seguros obligatorios. <strong>Compara siempre el CAT</strong>.",
        chip: "7. Medida CAT"
      },
      {
        badge: "⚖️ Criterio",
        pregunta: "¿Cómo diferenciar deuda buena de deuda mala?",
        respuesta: "<strong>• Buena:</strong> Financia activos que generan valor o ingresos (educación, negocio).<br><strong>• Mala:</strong> Financia caprichos y gastos efímeros.",
        chip: "8. Buena vs Mala"
      },
      {
        badge: "🛡️ Límite sano",
        pregunta: "¿Cuál es tu límite máximo de endeudamiento?",
        respuesta: "Tus pagos de deuda mensuales nunca deben rebasar entre el <strong>30% y 35%</strong> de tus ingresos netos para vivir tranquilo.",
        chip: "9. Límite deuda"
      },
      {
        badge: "⭐ Historial",
        pregunta: "¿Por qué cuidar tu Buró o historial crediticio?",
        respuesta: "Es tu reputación financiera: un puntaje positivo te garantiza tasas más bajas, mayores montos y acceso a mejores oportunidades.",
        chip: "10. Buró crédito"
      }
    ];

    let currentCardIndexCredito = 0;

    function renderFlashcardCredito() {
      const card = flashcardsDataCredito[currentCardIndexCredito];
      const flipper = document.getElementById('fcCreditoFlipper');
      if (flipper) {
        flipper.classList.remove('is-flipped');
      }
      
      const fcFrontBadge = document.getElementById('fcCreditoFrontBadge');
      const fcQuestion = document.getElementById('fcCreditoQuestion');
      const fcAnswer = document.getElementById('fcCreditoAnswer');
      const fcCounter = document.getElementById('fcCreditoCounter');
      
      if (fcFrontBadge) fcFrontBadge.textContent = card.badge;
      if (fcQuestion) fcQuestion.textContent = card.pregunta;
      if (fcAnswer) fcAnswer.innerHTML = card.respuesta;
      if (fcCounter) fcCounter.textContent = `${currentCardIndexCredito + 1} / ${flashcardsDataCredito.length}`;

      const chips = document.querySelectorAll('#fcCreditoChipsContainer .fc-chip');
      chips.forEach((c, idx) => {
        if (idx === currentCardIndexCredito) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function toggleFlashcardFlipCredito() {
      const flipper = document.getElementById('fcCreditoFlipper');
      if (flipper) {
        flipper.classList.toggle('is-flipped');
      }
    }

    function nextFlashcardCredito() {
      currentCardIndexCredito = (currentCardIndexCredito + 1) % flashcardsDataCredito.length;
      renderFlashcardCredito();
    }

    function prevFlashcardCredito() {
      currentCardIndexCredito = (currentCardIndexCredito - 1 + flashcardsDataCredito.length) % flashcardsDataCredito.length;
      renderFlashcardCredito();
    }

    function selectFlashcardCredito(idx) {
      currentCardIndexCredito = idx;
      renderFlashcardCredito();
    }

    function initFlashcardsCredito() {
      const container = document.getElementById('fcCreditoChipsContainer');
      if (!container) return;
      container.innerHTML = '';
      flashcardsDataCredito.forEach((item, index) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `fc-chip ${index === 0 ? 'active' : ''}`;
        btn.textContent = item.chip;
        btn.onclick = () => selectFlashcardCredito(index);
        container.appendChild(btn);
      });
      renderFlashcardCredito();
    }

    function initAllFlashcards() {
      initFlashcards();
      initFlashcardsAhorro();
      initFlashcardsCredito();
      initBudgetSlider();
      initInversionSlider();
      initPracticasSlider();
    }

    /* ============================================================
       FUNCIÓN PARA MOSTRAR / OCULTAR SLIDERS AL DAR CLIC EN EL TEMA
       ============================================================ */
    function toggleTopicSlider(sliderId, badgeId, type) {
      const sliderBox = document.getElementById(sliderId);
      const badge = document.getElementById(badgeId);
      if (!sliderBox) return;

      const isHidden = (sliderBox.style.display === 'none' || getComputedStyle(sliderBox).display === 'none');

      if (isHidden) {
        sliderBox.style.display = 'flex';
        if (badge) {
          badge.innerHTML = 'Ocultar ▴';
        }
        if (type === 'budget') {
          goToBudgetSlide(currentBudgetIndex);
        } else if (type === 'inversion') {
          goToInversionSlide(currentInversionIndex);
        } else if (type === 'practicas') {
          goToPracticasSlide(currentPracticasIndex);
        }
      } else {
        sliderBox.style.display = 'none';
        if (badge) {
          badge.innerHTML = 'Ver guía ▾';
        }
      }
    }

    /* ============================================================
       LÓGICA DE SLIDER DESLIZABLE (PRESUPUESTO: PREGUNTA + DESCRIPCIÓN)
       ============================================================ */
    const budgetData = [
      {
        badge: "📘 1. Concepto",
        pregunta: "¿Qué es realmente un presupuesto?",
        descripcion: "Es un plan financiero escrito donde proyectas tus ingresos y decides anticipadamente a dónde irá cada peso, evitando sorpresas a fin de mes.",
        chip: "1. ¿Qué es?"
      },
      {
        badge: "💡 2. Beneficio",
        pregunta: "¿Por qué es indispensable presupuestar?",
        descripcion: "Te da control absoluto de tu dinero: frena compras compulsivas, detecta fugas y te da paz mental al saber que todos tus compromisos están cubiertos.",
        chip: "2. Utilidad"
      },
      {
        badge: "📝 3. Pasos clave",
        pregunta: "¿Cuáles son los pasos para armar tu presupuesto?",
        descripcion: "1) Suma tus ingresos netos reales, 2) Anota tus gastos fijos obligatorios, 3) Fija topes a gastos variables y 4) Asigna ahorro desde el día uno.",
        chip: "3. Pasos clave"
      },
      {
        badge: "📊 4. Distribución",
        pregunta: "¿Cómo distribuir tu dinero en el presupuesto?",
        descripcion: "Aplica la regla básica: <strong>50%</strong> a necesidades esenciales (renta, servicios, comida), <strong>30%</strong> a estilo de vida y <strong>20%</strong> a ahorro o deudas.",
        chip: "4. Regla 50/30/20"
      },
      {
        badge: "🎯 5. Base Cero",
        pregunta: "¿Qué es el presupuesto 'Base Cero'?",
        descripcion: "Consiste en asignarle una tarea específica a cada peso hasta que <em>Ingresos - Gastos = 0</em>. El excedente no gastado se destina directo a tus metas.",
        chip: "5. Base Cero"
      },
      {
        badge: "⏱️ 6. Frecuencia",
        pregunta: "¿Con qué frecuencia debes revisarlo?",
        descripcion: "Se planifica una vez al mes, pero se monitorea una vez por semana o al hacer compras grandes. Si te pasas en un rubro, compensa recortando en otro.",
        chip: "6. Seguimiento"
      },
      {
        badge: "⚠️ 7. Desbalance",
        pregunta: "¿Qué hacer si tus gastos superan tus ingresos?",
        descripcion: "Pausa consumos discrecionales, cancela suscripciones sin uso y busca ingresos extra temporales para evitar financiar tu vida con préstamos caros.",
        chip: "7. Si no alcanza"
      },
      {
        badge: "🛠️ 8. Herramientas",
        pregunta: "¿Qué herramientas facilitan llevar tu presupuesto?",
        descripcion: "Desde una libreta o plantilla en Excel/Google Sheets hasta apps móviles dedicadas. Lo importante no es la herramienta, sino el hábito de registrar.",
        chip: "8. Herramientas"
      }
    ];

    let currentBudgetIndex = 0;

    function goToBudgetSlide(idx) {
      currentBudgetIndex = idx;
      const track = document.getElementById('budgetTrack');
      const counter = document.getElementById('budgetCounter');
      
      if (track) {
        track.style.transform = `translateX(-${currentBudgetIndex * 100}%)`;
      }
      if (counter) {
        counter.textContent = `${currentBudgetIndex + 1} / ${budgetData.length}`;
      }

      const chips = document.querySelectorAll('#budgetChipsContainer .bs-chip');
      chips.forEach((c, i) => {
        if (i === currentBudgetIndex) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function nextBudgetSlide() {
      const nextIdx = (currentBudgetIndex + 1) % budgetData.length;
      goToBudgetSlide(nextIdx);
    }

    function prevBudgetSlide() {
      const prevIdx = (currentBudgetIndex - 1 + budgetData.length) % budgetData.length;
      goToBudgetSlide(prevIdx);
    }

    function initBudgetSlider() {
      const track = document.getElementById('budgetTrack');
      const chipsContainer = document.getElementById('budgetChipsContainer');
      const stage = document.getElementById('budgetStage');
      if (!track || !chipsContainer) return;

      track.innerHTML = '';
      chipsContainer.innerHTML = '';

      budgetData.forEach((item, index) => {
        const slide = document.createElement('div');
        slide.className = 'budget-slide';
        slide.innerHTML = `
          <div class="budget-slide-top-tag">${item.badge}</div>
          <div class="budget-slide-content">
            <div class="budget-slide-question">${item.pregunta}</div>
            <div class="budget-slide-desc">${item.descripcion}</div>
          </div>
          <div class="budget-slide-hint">
            <span>Apartado ${index + 1} de ${budgetData.length}</span>
            <span>Desliza para siguiente →</span>
          </div>
        `;
        track.appendChild(slide);

        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = `bs-chip ${index === 0 ? 'active' : ''}`;
        chip.textContent = item.chip;
        chip.onclick = () => goToBudgetSlide(index);
        chipsContainer.appendChild(chip);
      });

      goToBudgetSlide(0);

      if (stage) {
        let touchStartX = 0;
        let touchEndX = 0;

        stage.addEventListener('touchstart', (e) => {
          touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        stage.addEventListener('touchend', (e) => {
          touchEndX = e.changedTouches[0].screenX;
          const diff = touchEndX - touchStartX;
          if (diff < -35) {
            nextBudgetSlide();
          } else if (diff > 35) {
            prevBudgetSlide();
          }
        }, { passive: true });
      }
    }

    /* ============================================================
       LÓGICA DE SLIDER DESLIZABLE (TIPOS DE INVERSIÓN)
       ============================================================ */
    const inversionData = [
      {
        badge: "📈 1. Concepto",
        pregunta: "¿Qué significa realmente invertir?",
        descripcion: "Es poner tu dinero a trabajar en activos o instrumentos financieros para que genere rendimientos y crezca por encima de la inflación.",
        chip: "1. ¿Qué es?"
      },
      {
        badge: "⚖️ 2. Categorías",
        pregunta: "¿Cuál es la diferencia entre Renta Fija y Renta Variable?",
        descripcion: "<strong>• Renta Fija:</strong> Conoces el rendimiento y plazo desde el inicio.<br><strong>• Renta Variable:</strong> El valor fluctúa en el mercado con mayor potencial.",
        chip: "2. Fija vs Variable"
      },
      {
        badge: "🏛️ 3. Renta Fija",
        pregunta: "¿Qué son los CETES o bonos gubernamentales?",
        descripcion: "Préstamos respaldados por el gobierno con una tasa garantizada. Es la inversión con menor riesgo del país y la base para proteger tu dinero.",
        chip: "3. Bonos y Cetes"
      },
      {
        badge: "🌐 4. Diversificación",
        pregunta: "¿Qué son los fondos indexados y los ETFs?",
        descripcion: "Canastas que compran cientos de empresas a la vez (como el S&P 500). Te permiten invertir en la economía global con bajas comisiones.",
        chip: "4. Indexados / ETFs"
      },
      {
        badge: "🏢 5. Renta Variable",
        pregunta: "¿Cómo funciona invertir en acciones de empresas?",
        descripcion: "Compras una fracción de una compañía pública. Ganas si la empresa aumenta su valor en el tiempo o si reparte dividendos periódicos.",
        chip: "5. Acciones"
      },
      {
        badge: "🏠 6. Inmobiliario",
        pregunta: "¿Cómo invertir en bienes raíces desde poco dinero?",
        descripcion: "A través de FIBRAs o REITs: fideicomisos que cotizan en bolsa y reparten rentas de centros comerciales, naves y oficinas desde montos accesibles.",
        chip: "6. Bienes Raíces"
      },
      {
        badge: "🧠 7. Tolerancia",
        pregunta: "¿Qué es el perfil de inversionista?",
        descripcion: "Define cuánto riesgo puedes asumir: <strong>Conservador</strong> (prioriza seguridad), <strong>Moderado</strong> (equilibrio) o <strong>Agresivo</strong> (máximo crecimiento).",
        chip: "7. Tu Perfil"
      },
      {
        badge: "🛡️ 8. Regla de oro",
        pregunta: "¿Por qué nunca debes invertir todo en un solo lugar?",
        descripcion: "La diversificación protege tu patrimonio: si a un activo le va mal, los demás compensan el resultado manteniendo tu capital seguro.",
        chip: "8. Diversificar"
      }
    ];

    let currentInversionIndex = 0;

    function goToInversionSlide(idx) {
      currentInversionIndex = idx;
      const track = document.getElementById('inversionTrack');
      const counter = document.getElementById('inversionCounter');
      
      if (track) {
        track.style.transform = `translateX(-${currentInversionIndex * 100}%)`;
      }
      if (counter) {
        counter.textContent = `${currentInversionIndex + 1} / ${inversionData.length}`;
      }

      const chips = document.querySelectorAll('#inversionChipsContainer .bs-chip');
      chips.forEach((c, i) => {
        if (i === currentInversionIndex) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function nextInversionSlide() {
      const nextIdx = (currentInversionIndex + 1) % inversionData.length;
      goToInversionSlide(nextIdx);
    }

    function prevInversionSlide() {
      const prevIdx = (currentInversionIndex - 1 + inversionData.length) % inversionData.length;
      goToInversionSlide(prevIdx);
    }

    function initInversionSlider() {
      const track = document.getElementById('inversionTrack');
      const chipsContainer = document.getElementById('inversionChipsContainer');
      const stage = document.getElementById('inversionStage');
      if (!track || !chipsContainer) return;

      track.innerHTML = '';
      chipsContainer.innerHTML = '';

      inversionData.forEach((item, index) => {
        const slide = document.createElement('div');
        slide.className = 'budget-slide';
        slide.innerHTML = `
          <div class="budget-slide-top-tag">${item.badge}</div>
          <div class="budget-slide-content">
            <div class="budget-slide-question">${item.pregunta}</div>
            <div class="budget-slide-desc">${item.descripcion}</div>
          </div>
          <div class="budget-slide-hint">
            <span>Apartado ${index + 1} de ${inversionData.length}</span>
            <span>Desliza para siguiente →</span>
          </div>
        `;
        track.appendChild(slide);

        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = `bs-chip ${index === 0 ? 'active' : ''}`;
        chip.textContent = item.chip;
        chip.onclick = () => goToInversionSlide(index);
        chipsContainer.appendChild(chip);
      });

      goToInversionSlide(0);

      if (stage) {
        let touchStartX = 0;
        let touchEndX = 0;

        stage.addEventListener('touchstart', (e) => {
          touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        stage.addEventListener('touchend', (e) => {
          touchEndX = e.changedTouches[0].screenX;
          const diff = touchEndX - touchStartX;
          if (diff < -35) {
            nextInversionSlide();
          } else if (diff > 35) {
            prevInversionSlide();
          }
        }, { passive: true });
      }
    }

    /* ============================================================
       LÓGICA DE SLIDER DESLIZABLE (BUENAS PRÁCTICAS DEL CRÉDITO)
       ============================================================ */
    const practicasData = [
      {
        badge: "⭐ 1. Regla de oro",
        pregunta: "¿Qué significa ser un usuario 'totalero'?",
        descripcion: "Pagar el 100% de tu saldo antes de la fecha límite. Al hacerlo, el banco te financia hasta por 50 días <strong>con 0% de interés</strong>.",
        chip: "1. Ser totalero"
      },
      {
        badge: "📅 2. El calendario",
        pregunta: "¿Cuál es la diferencia entre fecha de corte y de pago?",
        descripcion: "<strong>• Corte:</strong> El día que el banco cierra tu cuenta mensual.<br><strong>• Límite de pago:</strong> Tienes unos 20 días tras el corte para pagar sin recargos.",
        chip: "2. Fechas clave"
      },
      {
        badge: "⚠️ 3. Trampa común",
        pregunta: "¿Por qué nunca debes pagar solo el mínimo?",
        descripcion: "El pago mínimo solo abona a comisiones e IVA. La deuda principal se extiende por años generando intereses desproporcionados.",
        chip: "3. Pago mínimo"
      },
      {
        badge: "🛍️ 4. Promociones",
        pregunta: "¿Cómo aprovechar los Meses Sin Intereses (MSI)?",
        descripcion: "Úsalos solo para bienes duraderos (herramientas, electrodomésticos) cuya vida útil sea mayor al plazo, nunca para despensa o salidas.",
        chip: "4. MSI responsable"
      },
      {
        badge: "🛑 5. Mentalidad",
        pregunta: "¿Por qué el límite de tu tarjeta no es dinero extra?",
        descripcion: "Es un préstamo que saldrá de tus ingresos futuros. Gastar por encima de lo que cobras crea una bola de nieve peligrosa.",
        chip: "5. No es ingreso"
      },
      {
        badge: "🔔 6. Seguridad",
        pregunta: "¿Cómo evitar olvidos y cargos sospechosos?",
        descripcion: "Activa notificaciones al celular para cada compra y domicilia o programa el pago automático en tu banca digital.",
        chip: "6. Automatizar"
      },
      {
        badge: "📋 7. Diagnóstico",
        pregunta: "¿Cada cuánto debes revisar tu Buró de Crédito?",
        descripcion: "Tienes una consulta gratis al año por ley en Buró de Crédito. Revísala para detectar homonimias, fraudes o créditos no reconocidos.",
        chip: "7. Reporte Buró"
      },
      {
        badge: "🤝 8. Negociación",
        pregunta: "¿Qué hacer si no puedes cubrir tu pago del mes?",
        descripcion: "Comunícate de inmediato con la entidad antes de caer en mora: solicita una reestructuración a tasa fija o consolidación de pasivos.",
        chip: "8. Si te atrasas"
      }
    ];

    let currentPracticasIndex = 0;

    function goToPracticasSlide(idx) {
      currentPracticasIndex = idx;
      const track = document.getElementById('practicasTrack');
      const counter = document.getElementById('practicasCounter');
      
      if (track) {
        track.style.transform = `translateX(-${currentPracticasIndex * 100}%)`;
      }
      if (counter) {
        counter.textContent = `${currentPracticasIndex + 1} / ${practicasData.length}`;
      }

      const chips = document.querySelectorAll('#practicasChipsContainer .bs-chip');
      chips.forEach((c, i) => {
        if (i === currentPracticasIndex) {
          c.classList.add('active');
          c.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
        } else {
          c.classList.remove('active');
        }
      });
    }

    function nextPracticasSlide() {
      const nextIdx = (currentPracticasIndex + 1) % practicasData.length;
      goToPracticasSlide(nextIdx);
    }

    function prevPracticasSlide() {
      const prevIdx = (currentPracticasIndex - 1 + practicasData.length) % practicasData.length;
      goToPracticasSlide(prevIdx);
    }

    function initPracticasSlider() {
      const track = document.getElementById('practicasTrack');
      const chipsContainer = document.getElementById('practicasChipsContainer');
      const stage = document.getElementById('practicasStage');
      if (!track || !chipsContainer) return;

      track.innerHTML = '';
      chipsContainer.innerHTML = '';

      practicasData.forEach((item, index) => {
        const slide = document.createElement('div');
        slide.className = 'budget-slide';
        slide.innerHTML = `
          <div class="budget-slide-top-tag">${item.badge}</div>
          <div class="budget-slide-content">
            <div class="budget-slide-question">${item.pregunta}</div>
            <div class="budget-slide-desc">${item.descripcion}</div>
          </div>
          <div class="budget-slide-hint">
            <span>Apartado ${index + 1} de ${practicasData.length}</span>
            <span>Desliza para siguiente →</span>
          </div>
        `;
        track.appendChild(slide);

        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = `bs-chip ${index === 0 ? 'active' : ''}`;
        chip.textContent = item.chip;
        chip.onclick = () => goToPracticasSlide(index);
        chipsContainer.appendChild(chip);
      });

      goToPracticasSlide(0);

      if (stage) {
        let touchStartX = 0;
        let touchEndX = 0;

        stage.addEventListener('touchstart', (e) => {
          touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        stage.addEventListener('touchend', (e) => {
          touchEndX = e.changedTouches[0].screenX;
          const diff = touchEndX - touchStartX;
          if (diff < -35) {
            nextPracticasSlide();
          } else if (diff > 35) {
            prevPracticasSlide();
          }
        }, { passive: true });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initAllFlashcards);
    } else {
      initAllFlashcards();
    }
  </script>

  <script>
    // ── Splash screen ──────────────────────────────────────────
    (function() {
      var sp = document.getElementById('splashScreen');
      if (!sp) return;
      function hideSplash() {
        sp.classList.add('hide');
      }
      window.hideSplash = hideSplash;
      setTimeout(hideSplash, 5200);
    })();

    // ══════════════════════════════════════════════════════════
    // MOTOR DE QUIZ — función genérica reutilizable
    // ══════════════════════════════════════════════════════════
    function buildQuiz(cfg) {
      // cfg: { id, questions, color }
      var state = { idx: 0, score: 0, answered: false, selected: null };

      function render() {
        var q = cfg.questions[state.idx];
        document.getElementById(cfg.id + 'Badge').textContent =
          (state.idx + 1) + ' / ' + cfg.questions.length;
        document.getElementById(cfg.id + 'Q').textContent = q.q;
        var optsEl = document.getElementById(cfg.id + 'Opts');
        optsEl.innerHTML = '';
        var letters = ['A','B','C'];
        q.opts.forEach(function(opt, i) {
          var div = document.createElement('div');
          div.className = 'quiz-option';
          div.innerHTML =
            '<span class="quiz-opt-letter">' + letters[i] + '</span>' +
            '<span>' + opt + '</span>';
          div.onclick = function() { selectOpt(i, div); };
          optsEl.appendChild(div);
        });
        hideFeedback();
        document.getElementById(cfg.id + 'BtnCheck').disabled = true;
        document.getElementById(cfg.id + 'BtnNext').style.display = 'none';
        document.getElementById(cfg.id + 'BtnReset').style.display = 'none';
        state.answered = false;
        state.selected = null;
      }

      function selectOpt(i, el) {
        if (state.answered) return;
        state.selected = i;
        document.querySelectorAll('#' + cfg.id + 'Opts .quiz-option').forEach(function(o) {
          o.classList.remove('selected');
        });
        el.classList.add('selected');
        document.getElementById(cfg.id + 'BtnCheck').disabled = false;
      }

      function check() {
        if (state.selected === null || state.answered) return;
        state.answered = true;
        var q = cfg.questions[state.idx];
        var opts = document.querySelectorAll('#' + cfg.id + 'Opts .quiz-option');
        opts.forEach(function(o) { o.classList.add('disabled'); });
        var fbEl   = document.getElementById(cfg.id + 'Fb');
        var iconEl = document.getElementById(cfg.id + 'FbIcon');
        var txtEl  = document.getElementById(cfg.id + 'FbText');
        if (state.selected === q.correct) {
          state.score++;
          opts[state.selected].classList.replace('selected','correct');
          fbEl.className = 'quiz-feedback show fb-ok';
          iconEl.textContent = '✅';
          txtEl.textContent  = '¡Correcto! ' + q.explain;
        } else {
          opts[state.selected].classList.replace('selected','wrong');
          opts[q.correct].classList.add('correct');
          fbEl.className = 'quiz-feedback show fb-err';
          iconEl.textContent = '❌';
          txtEl.textContent  = 'Incorrecto. ' + q.explain;
        }
        document.getElementById(cfg.id + 'BtnCheck').disabled = true;
        var isLast = state.idx >= cfg.questions.length - 1;
        if (isLast) {
          document.getElementById(cfg.id + 'BtnReset').style.display = 'block';
          setTimeout(function() { showResult(); }, 1400);
        } else {
          document.getElementById(cfg.id + 'BtnNext').style.display = 'block';
        }
      }

      function next() {
        state.idx++;
        render();
      }

      function reset() {
        state.idx = 0; state.score = 0; state.answered = false; state.selected = null;
        document.getElementById(cfg.id + 'Body').style.display = '';
        document.getElementById(cfg.id + 'Result').classList.remove('show');
        render();
      }

      function showResult() {
        document.getElementById(cfg.id + 'Body').style.display = 'none';
        var pct   = Math.round((state.score / cfg.questions.length) * 100);
        var resEl = document.getElementById(cfg.id + 'Result');
        resEl.classList.add('show');
        document.getElementById(cfg.id + 'Score').textContent =
          state.score + '/' + cfg.questions.length;
        document.getElementById(cfg.id + 'Bar').style.width = pct + '%';
        var msg = pct >= 80
          ? '¡Excelente! Dominas este tema. 🏆'
          : pct >= 50
            ? 'Buen esfuerzo. Repasa los conceptos y vuelve a intentarlo. 💪'
            : 'Sigue practicando, cada intento te acerca al dominio del tema. 📚';
        document.getElementById(cfg.id + 'Msg').textContent = msg;
        if (typeof cfg.onComplete === 'function') {
          setTimeout(cfg.onComplete, 900);
        }
      }

      function hideFeedback() {
        document.getElementById(cfg.id + 'Fb').className = 'quiz-feedback';
      }

      // Exponer funciones globales
      window['checkQuiz'  + cfg.suffix] = check;
      window['nextQuiz'   + cfg.suffix] = next;
      window['resetQuiz'  + cfg.suffix] = reset;

      render();
    }

    // ══════════════════════════════════════════════════════════
    // PREGUNTAS — METAS FINANCIERAS
    // ══════════════════════════════════════════════════════════
    buildQuiz({
      id: 'quizMetas', suffix: 'Metas',
      onComplete: function() { window.marcarTablaDemoCompletada('admin'); },
      questions: [
        {
          q: '¿Cuál es la principal característica de una meta financiera SMART?',
          opts: ['Es vaga y flexible para adaptarse a cualquier situación', 'Es específica, medible, alcanzable, relevante y con tiempo definido', 'Solo depende de los ingresos actuales sin considerar el plazo'],
          correct: 1,
          explain: 'SMART: Específica, Medible, Alcanzable, Relevante y con Tiempo definido.'
        },
        {
          q: '¿Cuál de estos ejemplos es una meta financiera correctamente definida?',
          opts: ['Quiero ahorrar dinero algún día', 'Ahorraré $3,000 en 12 meses depositando $250 cada mes', 'Gastaré menos y tendré más dinero'],
          correct: 1,
          explain: 'Una meta bien definida tiene monto, plazo y acciones concretas.'
        },
        {
          q: '¿Cuántos tipos de metas financieras existen según el plazo?',
          opts: ['Dos: corto y largo plazo', 'Tres: corto, mediano y largo plazo', 'Cuatro: inmediato, corto, mediano y largo plazo'],
          correct: 1,
          explain: 'Se clasifican en corto (hasta 1 año), mediano (1–5 años) y largo plazo (más de 5 años).'
        },
        {
          q: '¿Qué debes hacer primero antes de establecer una meta financiera?',
          opts: ['Pedir un préstamo para tener capital inicial', 'Analizar tus ingresos, gastos y situación financiera actual', 'Escoger la meta más grande posible para motivarte'],
          correct: 1,
          explain: 'Conocer tu punto de partida (ingresos, gastos, deudas) es el primer paso para fijar metas realistas.'
        },
        {
          q: '¿Cuál es un ejemplo de meta financiera de LARGO PLAZO?',
          opts: ['Pagar la factura del teléfono este mes', 'Comprar un automóvil en 2 años', 'Acumular el fondo para el retiro en 30 años'],
          correct: 2,
          explain: 'Las metas de largo plazo superan los 5 años; el retiro es el ejemplo clásico.'
        },
        {
          q: '¿Qué herramienta ayuda a priorizar metas cuando los recursos son limitados?',
          opts: ['Una lista ordenada por urgencia e importancia', 'Solicitar créditos para todas las metas a la vez', 'Posponer todas las metas hasta tener más ingresos'],
          correct: 0,
          explain: 'Priorizar según urgencia e importancia permite avanzar con recursos limitados sin perder el rumbo.'
        },
        {
          q: '¿Qué sucede si no revisas periódicamente tus metas financieras?',
          opts: ['Las metas se cumplen solas con el tiempo', 'Pueden volverse irreales o desalineadas con tu situación', 'El dinero ahorrado crece igual sin revisión'],
          correct: 1,
          explain: 'Revisar y ajustar las metas regularmente garantiza que sigan siendo relevantes y alcanzables.'
        },
        {
          q: '¿Cuál es la función del fondo de emergencia dentro de las metas financieras?',
          opts: ['Invertir en activos de alto riesgo', 'Proteger las demás metas ante imprevistos económicos', 'Usarse mensualmente para gastos fijos'],
          correct: 1,
          explain: 'Un fondo de 3 a 6 meses de gastos evita que un imprevisto destruya el avance de otras metas.'
        }
      ]
    });

    // ══════════════════════════════════════════════════════════
    // PREGUNTAS — INTERÉS COMPUESTO
    // ══════════════════════════════════════════════════════════
    buildQuiz({
      id: 'quizInteres', suffix: 'Interes',
      onComplete: function() { window.marcarTablaDemoCompletada('ahorro'); },
      questions: [
        {
          q: '¿Qué es el interés compuesto?',
          opts: ['El interés que se calcula solo sobre el capital inicial', 'El interés que se calcula sobre el capital más los intereses acumulados', 'Un tipo de comisión bancaria fija mensual'],
          correct: 1,
          explain: 'El interés compuesto genera "interés sobre interés", produciendo crecimiento exponencial.'
        },
        {
          q: '¿A quién se atribuye la frase "el interés compuesto es la octava maravilla del mundo"?',
          opts: ['Warren Buffett', 'Albert Einstein', 'Benjamin Franklin'],
          correct: 1,
          explain: 'Se atribuye a Albert Einstein, destacando el poder del crecimiento exponencial del dinero.'
        },
        {
          q: 'Si inviertes $1,000 al 10% anual compuesto, ¿cuánto tendrás después de 3 años?',
          opts: ['$1,300 (interés simple)', '$1,331 (interés compuesto)', '$1,100 (solo el primer año)'],
          correct: 1,
          explain: '$1,000 × 1.1³ = $1,331. El interés del año anterior genera nuevo interés.'
        },
        {
          q: '¿Cuál de estos factores NO afecta el crecimiento del interés compuesto?',
          opts: ['La tasa de interés anual', 'El color de la cuenta bancaria', 'El tiempo que el dinero permanece invertido'],
          correct: 1,
          explain: 'El interés compuesto depende de: capital, tasa, frecuencia de capitalización y tiempo.'
        },
        {
          q: '¿Qué significa la "frecuencia de capitalización"?',
          opts: ['Cuántas veces al año se agregan los intereses al capital', 'La cantidad mínima que debes invertir', 'La penalización por retirar dinero anticipadamente'],
          correct: 0,
          explain: 'Mayor frecuencia (mensual, diaria) = más veces se calculan intereses sobre intereses = mayor rendimiento.'
        },
        {
          q: '¿Qué es la "Regla del 72" en el contexto del interés compuesto?',
          opts: ['El límite máximo de inversión sin pagar impuestos', 'Una fórmula para estimar en cuántos años se duplica tu dinero dividiendo 72 entre la tasa', 'El porcentaje mínimo de ahorro recomendado mensualmente'],
          correct: 1,
          explain: 'Divide 72 entre la tasa de interés anual y obtendrás los años aproximados para duplicar tu capital.'
        },
        {
          q: '¿Por qué es importante empezar a invertir lo más joven posible?',
          opts: ['Porque los bancos dan mejores tasas a personas jóvenes', 'Porque el tiempo es el factor más poderoso del interés compuesto', 'Porque los jóvenes no pagan impuestos sobre inversiones'],
          correct: 1,
          explain: 'Cuanto más tiempo tiene el dinero para crecer, más pronunciado es el efecto del interés compuesto.'
        },
        {
          q: '¿En qué situación el interés compuesto PERJUDICA al consumidor?',
          opts: ['Cuando ahorra en una cuenta de alto rendimiento', 'Cuando tiene deudas con tarjeta de crédito sin pagar el saldo completo', 'Cuando invierte en un fondo de retiro a largo plazo'],
          correct: 1,
          explain: 'Las deudas con interés compuesto crecen exponencialmente; una deuda pequeña se vuelve enorme si no se paga.'
        }
      ]
    });

    // ══════════════════════════════════════════════════════════
    // PREGUNTAS — RIESGOS DEL SOBREENDEUDAMIENTO
    // ══════════════════════════════════════════════════════════
    buildQuiz({
      id: 'quizDeuda', suffix: 'Deuda',
      onComplete: function() { window.marcarTablaDemoCompletada('credito'); },
      questions: [
        {
          q: '¿Qué se considera sobreendeudamiento?',
          opts: ['Tener un solo préstamo hipotecario vigente', 'Cuando las deudas superan la capacidad real de pago de una persona', 'Usar la tarjeta de crédito para compras menores de $100'],
          correct: 1,
          explain: 'El sobreendeudamiento ocurre cuando los compromisos financieros exceden la capacidad de pago, generando una espiral de deuda.'
        },
        {
          q: '¿Cuál de estas señales de alerta indica posible sobreendeudamiento?',
          opts: ['Pagar todas las deudas antes de la fecha límite', 'Usar un crédito para pagar otro crédito (ciclo de deuda)', 'Tener un fondo de emergencia equivalente a 3 meses de gastos'],
          correct: 1,
          explain: 'Pagar deudas con más deudas es una señal crítica: el saldo total crece y la situación empeora.'
        },
        {
          q: '¿Qué porcentaje máximo de los ingresos se recomienda destinar al pago de deudas?',
          opts: ['Hasta el 20–30% de los ingresos netos mensuales', 'Hasta el 60–70% de los ingresos netos mensuales', 'No importa el porcentaje si los pagos son puntuales'],
          correct: 0,
          explain: 'Destinar más del 30% de tus ingresos a deudas limita tu capacidad de ahorro y genera estrés financiero.'
        },
        {
          q: '¿Qué consecuencia tiene el sobreendeudamiento en el historial crediticio?',
          opts: ['Mejora la calificación crediticia al demostrar uso activo del crédito', 'Daña el historial, reduciendo el acceso a créditos futuros con buenas condiciones', 'No tiene ningún efecto si se paga eventualmente'],
          correct: 1,
          explain: 'Un mal historial crediticio cierra puertas: empleos, vivienda y créditos futuros pueden verse afectados.'
        },
        {
          q: '¿Cuál es el impacto del sobreendeudamiento en la salud mental?',
          opts: ['No tiene ningún efecto emocional', 'Genera estrés, ansiedad, conflictos familiares y deterioro de la calidad de vida', 'Motiva a trabajar más y mejorar los ingresos'],
          correct: 1,
          explain: 'El estrés financiero es una de las principales causas de ansiedad, depresión y problemas en las relaciones personales.'
        },
        {
          q: '¿Qué estrategia ayuda a salir del sobreendeudamiento más rápido?',
          opts: ['Ignorar las deudas y esperar que prescriban', 'Método "bola de nieve": pagar primero la deuda más pequeña para ganar impulso', 'Solicitar más créditos para aumentar el flujo de efectivo disponible'],
          correct: 1,
          explain: 'El método "bola de nieve" libera recursos progresivamente: cada deuda eliminada aumenta la motivación y los fondos para la siguiente.'
        },
        {
          q: '¿Qué es una reestructuración de deuda?',
          opts: ['Borrar la deuda del registro sin pagarla', 'Negociar nuevas condiciones (plazo, tasa o monto) con el acreedor para hacerla manejable', 'Transferir la deuda al nombre de un familiar'],
          correct: 1,
          explain: 'Reestructurar una deuda es una solución legal que facilita el pago sin dañar más el historial crediticio.'
        },
        {
          q: '¿Cuál es la mejor defensa contra el sobreendeudamiento?',
          opts: ['Evitar por completo el uso de cualquier tipo de crédito', 'Elaborar un presupuesto, mantener un fondo de emergencia y usar el crédito con responsabilidad', 'Ganar más dinero sin importar cómo se administra'],
          correct: 1,
          explain: 'Un presupuesto sólido + fondo de emergencia + uso responsable del crédito = blindaje financiero real.'
        }
      ]
    });
  </script>
  <!-- CARRUSEL ESTUDIANTES JS -->
  <script>
    (function() {
      const track = document.getElementById('mTrack');
      const dotsContainer = document.getElementById('mDots');
      if (!track) return;

      const cards = track.querySelectorAll('.m-card');
      const cardCount = cards.length;
      let currentIndex = 0;
      let cardWidth = 0;
      let visibleCount = 4;
      const gap = 20;

      function getVisibleCount() {
        const w = window.innerWidth;
        if (w < 600) return 1;
        if (w < 900) return 2;
        if (w < 1200) return 3;
        return 4;
      }

      function buildDots() {
        dotsContainer.innerHTML = '';
        const groups = Math.ceil(cardCount / visibleCount);
        for (let i = 0; i < groups; i++) {
          const dot = document.createElement('button');
          dot.className = 'm-dot' + (i === 0 ? ' active' : '');
          dot.addEventListener('click', function() { goTo(i * visibleCount); });
          dotsContainer.appendChild(dot);
        }
      }

      function updateDots() {
        const dots = dotsContainer.querySelectorAll('.m-dot');
        const activeGroup = Math.floor(currentIndex / visibleCount);
        dots.forEach((d, i) => d.classList.toggle('active', i === activeGroup));
      }

      function getCardWidth() {
        if (cards.length === 0) return 300;
        return cards[0].getBoundingClientRect().width;
      }

      function goTo(idx) {
        const maxIdx = Math.max(0, cardCount - visibleCount);
        currentIndex = Math.max(0, Math.min(idx, maxIdx));
        cardWidth = getCardWidth();
        const offset = currentIndex * (cardWidth + gap);
        track.style.transform = 'translateX(-' + offset + 'px)';
        updateDots();
      }

      window.mCarousel = function(dir) {
        goTo(currentIndex + dir * visibleCount);
      };

      function init() {
        visibleCount = getVisibleCount();
        buildDots();
        goTo(0);
      }

      window.addEventListener('resize', function() {
        visibleCount = getVisibleCount();
        buildDots();
        goTo(currentIndex);
      });

      // Auto-slide cada 6 segundos
      setInterval(function() {
        const maxIdx = Math.max(0, cardCount - visibleCount);
        if (currentIndex >= maxIdx) {
          goTo(0);
        } else {
          goTo(currentIndex + 1);
        }
      }, 6000);

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
      } else {
        init();
      }
    })();
  </script>

  <!-- GESTIÓN DE FINALIZACIÓN DE LA DEMO GRATUITA (3 TABLAS) -->
  <script>
    (function() {
      var DEMO_FINAL_KEY = 'demo_pilares_finalizada';
      var DEMO_REVIEW_KEY = 'demo_pilares_revisadas';
      var reviewed = {};
      try {
        reviewed = JSON.parse(localStorage.getItem(DEMO_REVIEW_KEY) || '{}') || {};
      } catch(e) {
        reviewed = {};
      }

      function saveReviewed() {
        try { localStorage.setItem(DEMO_REVIEW_KEY, JSON.stringify(reviewed)); } catch(e) {}
      }

      function setPillarToggleState(card, open) {
        if (!card) return;
        card.classList.toggle('is-open', open);
        var btn = card.querySelector('.pillar-toggle');
        if (btn) btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        var txt = card.querySelector('.pillar-toggle-text');
        if (txt) txt.textContent = open ? 'Ocultar contenido' : 'Ver contenido';
      }

      function closeAllPillars(except) {
        document.querySelectorAll('#tabla-pilares .pillar-card.is-open').forEach(function(card) {
          if (card !== except) setPillarToggleState(card, false);
        });
      }

      window.toggleDemoBlock = function(btn) {
        var card = btn && btn.closest ? btn.closest('.pillar-card') : null;
        if (!card) return;
        var willOpen = !card.classList.contains('is-open');
        closeAllPillars(card);
        setPillarToggleState(card, willOpen);
        if (willOpen) {
          setTimeout(function() {
            card.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }, 80);
        }
      };

      window.openFirstDemoBlock = function(event) {
        if (event) event.preventDefault();
        var grid = document.getElementById('tabla-pilares');
        if (!grid) return;
        var first = grid.querySelector('.pillar-card');
        if (!first) return;
        if (!first.classList.contains('is-open')) {
          var btn = first.querySelector('.pillar-toggle');
          if (btn) window.toggleDemoBlock(btn);
          return;
        }
        first.scrollIntoView({ behavior: 'smooth', block: 'start' });
      };

      (function initDemoAccordion() {
        var grid = document.getElementById('tabla-pilares');
        if (!grid) return;
        grid.classList.add('demo-accordion-enabled');
        grid.querySelectorAll('.pillar-card').forEach(function(card) {
          setPillarToggleState(card, false);
        });
      })();

      window.marcarTablaDemoCompletada = function(id) {
        if (!id) return;
        reviewed[id] = true;
        saveReviewed();

        if (reviewed.admin && reviewed.ahorro && reviewed.credito) {
          setTimeout(function() {
            if (typeof window.finalizarDemoGratis === 'function') {
              window.finalizarDemoGratis();
            }
          }, 500);
        }
      };

      window.finalizarDemoGratis = function() {
        try { localStorage.setItem(DEMO_FINAL_KEY, 'true'); } catch(e) {}

        var grid = document.getElementById('tabla-pilares');
        var card = document.getElementById('demoFinCard');
        var btnTop = document.querySelector('.btn-demo-cta');

        if (grid) {
          grid.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
          grid.style.opacity = '0';
          grid.style.transform = 'scale(0.98)';
          setTimeout(function() { grid.style.display = 'none'; }, 420);
        }
        if (btnTop) {
          btnTop.removeAttribute('onclick');
          btnTop.innerHTML = '<span>✅ Demo Concluida • Inscríbete</span>';
          btnTop.href = 'index.php?page=reticula';
        }
        if (card) {
          card.style.display = 'block';
          card.style.opacity = '0';
          card.style.transition = 'opacity 0.5s ease';
          setTimeout(function() {
            card.style.opacity = '1';
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }, 200);
        }

        var count = 3;
        var counterEl = document.getElementById('demoCountdownSecs');
        if (window._demoRedirectTimer) clearInterval(window._demoRedirectTimer);
        window._demoRedirectTimer = setInterval(function() {
          count--;
          if (counterEl) counterEl.textContent = count;
          if (count <= 0) {
            clearInterval(window._demoRedirectTimer);
            window.location.href = 'index.php?page=reticula';
          }
        }, 1000);
      };

      window.reiniciarDemoTest = function() {
        try {
          localStorage.removeItem(DEMO_FINAL_KEY);
          localStorage.removeItem(DEMO_REVIEW_KEY);
        } catch(e) {}
        reviewed = {};
        if (window._demoRedirectTimer) clearInterval(window._demoRedirectTimer);

        var grid = document.getElementById('tabla-pilares');
        var card = document.getElementById('demoFinCard');
        var btnTop = document.querySelector('.btn-demo-cta');

        if (grid) {
          grid.style.display = '';
          grid.style.opacity = '1';
          grid.style.transform = 'none';
        }
        if (card) card.style.display = 'none';
        if (btnTop) {
          btnTop.setAttribute('onclick', 'openFirstDemoBlock(event)');
          btnTop.innerHTML = '<span>👉 Probar Demo Gratis</span>';
          btnTop.href = '#tabla-pilares';
        }
        document.querySelectorAll('#tabla-pilares .pillar-card').forEach(function(pillar) {
          setPillarToggleState(pillar, false);
        });
        if (grid) grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
      };

      (function checkDemoPrevia() {
        try {
          if (localStorage.getItem(DEMO_FINAL_KEY) === 'true') {
            var grid = document.getElementById('tabla-pilares');
            var card = document.getElementById('demoFinCard');
            var notice = document.getElementById('demoRedirectNotice');
            var btnTop = document.querySelector('.btn-demo-cta');

            if (grid) grid.style.display = 'none';
            if (btnTop) {
              btnTop.removeAttribute('onclick');
              btnTop.innerHTML = '<span>✅ Demo Concluida • Inscríbete</span>';
              btnTop.href = 'index.php?page=reticula';
            }
            if (card) card.style.display = 'block';
            if (notice) {
              notice.innerHTML = '<span>Tu demo gratuita ya ha finalizado. Haz clic en el botón verde para inscribirte.</span>';
            }
          }
        } catch(e) {}
      })();
    })();
  </script>
