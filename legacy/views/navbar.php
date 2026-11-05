  <!-- ============================================================
       TOP HEADER / NAVBAR (GUEST & INVITADO)
       ============================================================ -->
  <header class="site-header guest-header">
    <div class="container">
      <nav class="nav-wrap">
        <a href="index.php" class="brand-logo">
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
            <div style="font-weight: 800; font-size: 15px; color: #fff;">Educación</div>
            <div style="font-weight: 500; font-size: 11px; color: #28c76f; letter-spacing: 1px;">FINANCIERA</div>
          </div>
        </a>

        <ul class="nav-menu">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="index.php?page=cursos">Cursos</a></li>
          <li><a href="index.php?page=recursos">Recursos</a></li>
          <li><a href="index.php?page=reticula">Retícula</a></li>
          <li><a href="index.php?page=metas">Metas</a></li>
          <li><a href="index.php?page=suscripcion">Suscripción</a></li>
        </ul>

        <div class="nav-actions">
          <button class="btn-search" onclick="if(typeof openSearchModal==='function')openSearchModal();" aria-label="Buscar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>
          <button class="btn-login" onclick="if(typeof openLoginModal==='function')openLoginModal();">Iniciar Sesión</button>
          <button class="btn-signup" onclick="if(typeof openSignupModal==='function')openSignupModal();">Registrarse</button>
        </div>
      </nav>
    </div>
  </header>

  <!-- Barra superior del estudiante (tras iniciar sesión) -->
  <div class="logged-topbar" style="display: none;">
    <div class="logged-topbar-left">
      <button class="btn-sidebar-toggle" onclick="if(typeof toggleSidebar==='function')toggleSidebar();" aria-label="Abrir menú lateral">☰</button>
      <div style="display: flex; align-items: center; gap: 10px;">
        <span class="page-current-title"><?= htmlspecialchars($pageTitle ?? 'Educación Financiera') ?></span>
      </div>
    </div>
    <div class="logged-topbar-right">
      <span class="topbar-greeting">Hola, <strong id="topbarUserName"><?= htmlspecialchars($user['name'] ?? 'Estudiante') ?></strong></span>
      <button class="btn-search" onclick="if(typeof openSearchModal==='function')openSearchModal();" aria-label="Buscar">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>
  </div>
