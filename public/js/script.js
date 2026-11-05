// ============================================================
// ESCUELA FINANCIERA - JAVASCRIPT GLOBAL
// ============================================================

// Clave de sesión local (solo guarda nombre y email, NUNCA contraseñas)
const SESSION_KEY = 'edu_fin_session';

// Base URL de la API PHP
const API_BASE = 'api';

// Token CSRF para peticiones autenticadas (se obtiene del endpoint session/login)
let CSRF_TOKEN = '';

function getCsrfHeaders() {
  return CSRF_TOKEN ? { 'X-CSRF-Token': CSRF_TOKEN } : {};
}

async function loadCsrfToken() {
  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=session', { credentials: 'include' });
    const data = await res.json();
    if (data && data.csrf_token) CSRF_TOKEN = data.csrf_token;
  } catch (e) { /* sin conexión: se reintentará en la próxima petición */ }
}

// ------------------------------------------------------------
// 1. ALTERNAR VISIBILIDAD DE CONTRASEÑA (OJITO)
// ------------------------------------------------------------
function togglePasswordVisibility(inputId, btn) {
  const input = document.getElementById(inputId);
  if (!input) return;
  const isPass = input.type === 'password';
  input.type = isPass ? 'text' : 'password';

  if (isPass) {
    // Icono Ojo con línea (Ocultar)
    btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
      <line x1="1" y1="1" x2="23" y2="23"></line>
    </svg>`;
    btn.setAttribute('aria-label', 'Ocultar contraseña');
    btn.setAttribute('title', 'Ocultar contraseña');
  } else {
    // Icono Ojo abierto (Mostrar)
    btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
      <circle cx="12" cy="12" r="3"></circle>
    </svg>`;
    btn.setAttribute('aria-label', 'Mostrar contraseña');
    btn.setAttribute('title', 'Mostrar contraseña');
  }
}

// ------------------------------------------------------------
// 2. TOGGLE SIDEBAR LATERAL (MOBILE / TABLET)
// ------------------------------------------------------------
function toggleSidebar(forceState) {
  const sidebar = document.getElementById('sidebarLeft');
  const backdrop = document.getElementById('sidebarBackdrop');
  if (!sidebar) return;

  const isOpen = sidebar.classList.contains('open');
  const nextState = (typeof forceState === 'boolean') ? forceState : !isOpen;

  if (nextState) {
    sidebar.classList.add('open');
    if (backdrop) backdrop.classList.add('open');
  } else {
    sidebar.classList.remove('open');
    if (backdrop) backdrop.classList.remove('open');
  }
}

// ------------------------------------------------------------
// 3. MODALES DE CURSOS Y RECURSOS
// ------------------------------------------------------------
const modalOverlay = document.getElementById('modalOverlay');
const modalTitle = document.getElementById('modalTitle');
const modalDescription = document.getElementById('modalDescription');
const modalCloseBtn = document.getElementById('modalCloseBtn');

function openCourseModal(title, desc) {
  if (!getCurrentUser()) {
    openLoginModal();
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = '🔒 Inicia sesión o crea tu cuenta para ver el temario completo de los cursos.';
    }
    return;
  }
  if (modalTitle) modalTitle.textContent = title;
  if (modalDescription) modalDescription.textContent = desc;
  if (modalOverlay) modalOverlay.classList.add('open');
}

function openResourceModal(title, desc) {
  const t = (title || '').toLowerCase();
  if (t.includes('presupuesto') || t.includes('50/30/20') || t.includes('plantilla')) {
    abrirEjercicioMateria('Mi presupuesto 50/30/20 (Plantilla interactiva)', desc || 'Calcula automáticamente la distribución óptima de tus ingresos.');
    return;
  }
  if (t.includes('calculadora') || t.includes('interés') || t.includes('inversión') || t.includes('cetes')) {
    abrirEjercicioMateria('Simulador de inversión en CETES e interés compuesto', desc || 'Calcula el rendimiento compuesto y proyección a plazos.');
    return;
  }
  if (t.includes('guía') || t.includes('ahorro') || t.includes('libro')) {
    abrirLibroMateria(title, 'Educación Financiera', desc || 'Guía oficial descargable en PDF con ejercicios prácticos.');
    return;
  }
  if (t.includes('certificación') || t.includes('mentoría')) {
    abrirEjercicioMateria('Test de Certificación Financiera', desc || 'Evalúa tus conocimientos y avanza en tu carrera.');
    return;
  }
  if (modalTitle) modalTitle.textContent = title;
  if (modalDescription) modalDescription.textContent = desc;
  if (modalOverlay) modalOverlay.classList.add('open');
}

function closeModal() {
  if (modalOverlay) modalOverlay.classList.remove('open');
}

if (modalCloseBtn) {
  modalCloseBtn.addEventListener('click', closeModal);
}
if (modalOverlay) {
  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) closeModal();
  });
}

// ------------------------------------------------------------
// 4. MODAL DE BÚSQUEDA
// ------------------------------------------------------------
const searchModal = document.getElementById('searchModal');
const btnSearch = document.getElementById('btnSearch');
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');

function openSearchModal() {
  if (!getCurrentUser()) {
    openLoginModal();
    return;
  }
  if (searchModal) {
    searchModal.classList.add('open');
    if (searchInput) setTimeout(() => searchInput.focus(), 100);
  }
}

function closeSearchModal() {
  if (searchModal) searchModal.classList.remove('open');
}

if (searchModal) {
  searchModal.addEventListener('click', (e) => {
    if (e.target === searchModal) closeSearchModal();
  });
}

if (searchInput && searchResults) {
  searchInput.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase().trim();
    if (!q) {
      searchResults.innerHTML = 'Escribe para encontrar cursos como "Finanzas personales", "Ahorro", "Presupuesto", o calculadoras interactivas.';
      return;
    }

    const items = [
      { name: 'Finanzas personales', type: 'Curso', link: 'index.php?page=cursos' },
      { name: 'Ahorro e inversión', type: 'Curso', link: 'index.php?page=cursos' },
      { name: 'Presupuesto mensual 50/30/20', type: 'Curso', link: 'index.php?page=cursos' },
      { name: 'Emprendimiento y negocios', type: 'Curso', link: 'index.php?page=cursos' },
      { name: 'Calculadora de interés compuesto', type: 'Recurso', link: 'index.php?page=recursos' },
      { name: 'Guía de ahorro descargable en PDF', type: 'Recurso', link: 'index.php?page=recursos' }
    ];

    const matches = items.filter(it => it.name.toLowerCase().includes(q));
    if (matches.length > 0) {
      searchResults.innerHTML = matches.map(m => `
        <div style="padding: 10px 0; border-bottom: 1px solid #f0f6f3; display: flex; justify-content: space-between; align-items: center;">
          <a href="${m.link}" onclick="closeSearchModal()" style="font-weight: 600; color: var(--text-dark); text-decoration: none;">${m.name}</a>
          <span style="color: #00ba6d; font-size: 11px; font-weight: 600;">${m.type}</span>
        </div>
      `).join('');
    } else {
      searchResults.innerHTML = 'No se encontraron resultados para "' + q + '".';
    }
  });
}

// ------------------------------------------------------------
// 5. MODAL DE LOGIN
// ------------------------------------------------------------
const loginModal = document.getElementById('loginModal');
const loginForm = document.getElementById('loginForm');
const loginEmail = document.getElementById('loginEmail');
const loginPassword = document.getElementById('loginPassword');
const loginMsg = document.getElementById('loginMsg');
const loginEmailErr = document.getElementById('loginEmailErr');
const loginPasswordErr = document.getElementById('loginPasswordErr');

function openLoginModal() {
  closeSignupModal();
  closeForgotModal();
  clearLoginErrors();
  if (loginMsg) {
    loginMsg.className = 'form-message';
    loginMsg.textContent = '';
  }
  if (loginForm) loginForm.reset();
  if (loginModal) loginModal.classList.add('open');
  if (loginEmail) setTimeout(() => loginEmail.focus(), 100);
}

function closeLoginModal() {
  if (loginModal) loginModal.classList.remove('open');
}

if (loginModal) {
  loginModal.addEventListener('click', (e) => {
    if (e.target === loginModal) closeLoginModal();
  });
}

function clearLoginErrors() {
  if (loginEmail) loginEmail.classList.remove('input-invalid');
  if (loginPassword) loginPassword.classList.remove('input-invalid');
  if (loginEmailErr) loginEmailErr.style.display = 'none';
  if (loginPasswordErr) loginPasswordErr.style.display = 'none';
}

async function handleLoginSubmit(e) {
  e.preventDefault();
  clearLoginErrors();
  if (loginMsg) loginMsg.className = 'form-message';

  const email = loginEmail ? loginEmail.value.trim() : '';
  const pass = loginPassword ? loginPassword.value : '';

  let valid = true;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    if (loginEmail) loginEmail.classList.add('input-invalid');
    if (loginEmailErr) loginEmailErr.style.display = 'block';
    valid = false;
  }
  if (pass.length < 1) {
    if (loginPassword) loginPassword.classList.add('input-invalid');
    if (loginPasswordErr) {
      loginPasswordErr.textContent = 'Ingresa tu contraseña.';
      loginPasswordErr.style.display = 'block';
    }
    valid = false;
  }
  if (!valid) return;

  // Mostrar indicador de carga
  const submitBtn = loginForm ? loginForm.querySelector('button[type="submit"]') : null;
  if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Iniciando sesión...'; }
  if (loginMsg) { loginMsg.className = 'form-message'; loginMsg.textContent = ''; }

  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ email, password: pass })
    });
    const data = await res.json();

    if (data.success) {
      setCurrentUser(data.user);
      if (data.csrf_token) CSRF_TOKEN = data.csrf_token;
      await syncInscripcionesDesdeAPI();
      await syncMembresiaDesdeAPI();
      updateAuthUI();
      closeLoginModal();
    } else {
      if (loginMsg) {
        loginMsg.className = 'form-message error';
        loginMsg.textContent = data.message || 'Correo o contraseña incorrectos.';
      }
    }
  } catch (err) {
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = 'Error de conexión. Verifica que el servidor esté activo.';
    }
  } finally {
    if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Iniciar sesión'; }
  }
}

// ------------------------------------------------------------
// 6. MODAL DE RECUPERACIÓN DE CONTRASEÑA
// ------------------------------------------------------------
const forgotModal = document.getElementById('forgotModal');
const forgotForm = document.getElementById('forgotForm');
const forgotEmail = document.getElementById('forgotEmail');
const forgotPassword = document.getElementById('forgotPassword');
const forgotConfirm = document.getElementById('forgotConfirm');
const forgotMsg = document.getElementById('forgotMsg');
const forgotEmailErr = document.getElementById('forgotEmailErr');
const forgotPasswordErr = document.getElementById('forgotPasswordErr');
const forgotConfirmErr = document.getElementById('forgotConfirmErr');

function openForgotModal() {
  closeLoginModal();
  closeSignupModal();
  clearForgotErrors();
  if (forgotMsg) {
    forgotMsg.className = 'form-message';
    forgotMsg.textContent = '';
  }
  if (forgotForm) forgotForm.reset();
  if (loginEmail && loginEmail.value.trim() && forgotEmail) {
    forgotEmail.value = loginEmail.value.trim();
  }
  if (forgotModal) forgotModal.classList.add('open');
  if (forgotEmail) setTimeout(() => forgotEmail.focus(), 100);
}

function closeForgotModal() {
  if (forgotModal) forgotModal.classList.remove('open');
}

if (forgotModal) {
  forgotModal.addEventListener('click', (e) => {
    if (e.target === forgotModal) closeForgotModal();
  });
}

function clearForgotErrors() {
  [forgotEmail, forgotPassword, forgotConfirm].forEach(i => {
    if (i) i.classList.remove('input-invalid');
  });
  [forgotEmailErr, forgotPasswordErr, forgotConfirmErr].forEach(e => {
    if (e) e.style.display = 'none';
  });
}

async function handleForgotSubmit(e) {
  e.preventDefault();
  clearForgotErrors();
  if (forgotMsg) forgotMsg.className = 'form-message';

  const email = forgotEmail ? forgotEmail.value.trim() : '';
  const pass = forgotPassword ? forgotPassword.value : '';
  const confirm = forgotConfirm ? forgotConfirm.value : '';

  let valid = true;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    if (forgotEmail) forgotEmail.classList.add('input-invalid');
    if (forgotEmailErr) forgotEmailErr.style.display = 'block';
    valid = false;
  }
  if (pass.length < 8) {
    if (forgotPassword) forgotPassword.classList.add('input-invalid');
    if (forgotPasswordErr) {
      forgotPasswordErr.textContent = 'La contraseña debe tener al menos 8 caracteres.';
      forgotPasswordErr.style.display = 'block';
    }
    valid = false;
  }
  // Validar complejidad: al menos una mayúscula, un número y un carácter especial
  const hasUpper = /[A-Z]/.test(pass);
  const hasNumber = /[0-9]/.test(pass);
  const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(pass);
  if (!hasUpper || !hasNumber || !hasSpecial) {
    if (forgotPassword) forgotPassword.classList.add('input-invalid');
    if (forgotPasswordErr) {
      forgotPasswordErr.textContent = 'La contraseña debe incluir mayúscula, número y carácter especial (!@#$%...).';
      forgotPasswordErr.style.display = 'block';
    }
    valid = false;
  }
  if (confirm !== pass) {
    if (forgotConfirm) forgotConfirm.classList.add('input-invalid');
    if (forgotConfirmErr) forgotConfirmErr.style.display = 'block';
    valid = false;
  }
  if (!valid) return;

  // NOTA: La recuperación real de contraseña requiere un flujo por email (token).
  // Por ahora se muestra un mensaje informativo ya que no existe endpoint de reset.
  if (forgotMsg) {
    forgotMsg.className = 'form-message success';
    forgotMsg.innerHTML = 'Si existe una cuenta con ese correo, recibirás instrucciones para restablecer tu contraseña.<br><button type="button" onclick="openLoginModal()" class="btn-cta-yellow" style="margin-top:12px; width:100%; justify-content:center; padding:9px;">Volver al inicio de sesión</button>';
  }
  if (forgotForm) forgotForm.reset();
}

// ------------------------------------------------------------
// 7. MODAL DE CREAR CUENTA
// ------------------------------------------------------------
const signupModal = document.getElementById('signupModal');
const signupForm = document.getElementById('signupForm');
const signupName = document.getElementById('signupName');
const signupEmail = document.getElementById('signupEmail');
const signupPassword = document.getElementById('signupPassword');
const signupConfirm = document.getElementById('signupConfirm');
const signupMsg = document.getElementById('signupMsg');
const signupNameErr = document.getElementById('signupNameErr');
const signupEmailErr = document.getElementById('signupEmailErr');
const signupPasswordErr = document.getElementById('signupPasswordErr');
const signupConfirmErr = document.getElementById('signupConfirmErr');

function openSignupModal() {
  closeLoginModal();
  closeForgotModal();
  clearSignupErrors();
  if (signupMsg) {
    signupMsg.className = 'form-message';
    signupMsg.textContent = '';
  }
  if (signupForm) signupForm.reset();
  if (signupModal) signupModal.classList.add('open');
  if (signupName) setTimeout(() => signupName.focus(), 100);
}

function closeSignupModal() {
  if (signupModal) signupModal.classList.remove('open');
}

if (signupModal) {
  signupModal.addEventListener('click', (e) => {
    if (e.target === signupModal) closeSignupModal();
  });
}

function clearSignupErrors() {
  [signupName, signupEmail, signupPassword, signupConfirm].forEach(i => {
    if (i) i.classList.remove('input-invalid');
  });
  [signupNameErr, signupEmailErr, signupPasswordErr, signupConfirmErr].forEach(e => {
    if (e) e.style.display = 'none';
  });
}

async function handleSignupSubmit(e) {
  e.preventDefault();
  clearSignupErrors();
  if (signupMsg) signupMsg.className = 'form-message';

  const name = signupName ? signupName.value.trim() : '';
  const email = signupEmail ? signupEmail.value.trim() : '';
  const pass = signupPassword ? signupPassword.value : '';
  const confirm = signupConfirm ? signupConfirm.value : '';

  let valid = true;
  if (name.length < 2) {
    if (signupName) signupName.classList.add('input-invalid');
    if (signupNameErr) signupNameErr.style.display = 'block';
    valid = false;
  }
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    if (signupEmail) signupEmail.classList.add('input-invalid');
    if (signupEmailErr) signupEmailErr.style.display = 'block';
    valid = false;
  }
  if (pass.length < 8) {
    if (signupPassword) signupPassword.classList.add('input-invalid');
    if (signupPasswordErr) {
      signupPasswordErr.textContent = 'La contraseña debe tener al menos 8 caracteres.';
      signupPasswordErr.style.display = 'block';
    }
    valid = false;
  }
  // Validar complejidad: al menos una mayúscula, un número y un carácter especial
  const hasUpper = /[A-Z]/.test(pass);
  const hasNumber = /[0-9]/.test(pass);
  const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(pass);
  if (!hasUpper || !hasNumber || !hasSpecial) {
    if (signupPassword) signupPassword.classList.add('input-invalid');
    if (signupPasswordErr) {
      signupPasswordErr.textContent = 'La contraseña debe incluir mayúscula, número y carácter especial (!@#$%...).';
      signupPasswordErr.style.display = 'block';
    }
    valid = false;
  }
  if (confirm !== pass) {
    if (signupConfirm) signupConfirm.classList.add('input-invalid');
    if (signupConfirmErr) signupConfirmErr.style.display = 'block';
    valid = false;
  }
  if (!valid) return;

  // Mostrar indicador de carga
  const submitBtn = signupForm ? signupForm.querySelector('button[type="submit"]') : null;
  if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Creando cuenta...'; }

  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=registro', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ nombre: name, email, password: pass })
    });
    const data = await res.json();

    if (data.success) {
      setCurrentUser(data.user);
      if (data.csrf_token) CSRF_TOKEN = data.csrf_token;
      await syncInscripcionesDesdeAPI();
      await syncMembresiaDesdeAPI();
      updateAuthUI();
      closeSignupModal();
      if (signupForm) signupForm.reset();
    } else {
      if (signupMsg) {
        signupMsg.className = 'form-message error';
        signupMsg.textContent = data.message || 'Error al crear la cuenta. Intenta de nuevo.';
      }
    }
  } catch (err) {
    if (signupMsg) {
      signupMsg.className = 'form-message error';
      signupMsg.textContent = 'Error de conexión. Verifica que el servidor esté activo.';
    }
  } finally {
    if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Crear cuenta'; }
  }
}

// ------------------------------------------------------------
// 8. FUNCIONES DE HASH PARA CONTRASEÑAS (SIMPLE SHA-256 LIKE)
// ------------------------------------------------------------
// Eliminadas: las contraseñas ya NO se almacenan en el cliente.
// El hash lo realiza PHP con password_hash() en el servidor.

// ------------------------------------------------------------
// 9. SESIÓN: solo nombre y email (SIN contraseñas en cliente)
// ------------------------------------------------------------
function setCurrentUser(user) {
  try {
    localStorage.setItem(SESSION_KEY, JSON.stringify({ name: user.name, email: user.email }));
  } catch (e) {}
}

function getCurrentUser() {
  try {
    const raw = localStorage.getItem(SESSION_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch (e) {
    return null;
  }
}

async function logout() {
  try {
    await fetch(API_BASE + '/index.php?endpoint=logout', {
      method: 'POST',
      credentials: 'include'
    });
  } catch (e) { /* ignorar errores de red al cerrar sesión */ }

  try { localStorage.removeItem(SESSION_KEY); } catch (e) {}

  updateAuthUI();

  // Si estamos en una página protegida, redirigir a inicio
  const path = (window.location.pathname + window.location.search).toLowerCase();
  if (path.includes('page=cursos') || path.includes('page=recursos') || path.includes('page=reticula') || path.includes('page=configuraciones')) {
    window.location.href = 'index.php';
  }
}

// Sincronizar inscripciones desde la API al iniciar sesión
async function syncInscripcionesDesdeAPI() {
  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=inscripciones', {
      method: 'GET',
      credentials: 'include'
    });
    const data = await res.json();
    if (data.success && Array.isArray(data.inscritas)) {
      const user = getCurrentUser();
      const key = RETICULA_ARRAY_KEY + ((user && user.email) ? user.email.toLowerCase() : 'invitado');
      localStorage.setItem(key, JSON.stringify({ inscritas: data.inscritas }));
    }
  } catch (e) { /* sin conexión, usar cache local */ }
}

// Sincronizar membresía desde la API al iniciar sesión
async function syncMembresiaDesdeAPI() {
  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=membresia', {
      method: 'GET',
      credentials: 'include'
    });
    const data = await res.json();
    if (data.success && data.membresia) {
      const user = getCurrentUser();
      const key = MEMBRESIA_KEY + ((user && user.email) ? user.email.toLowerCase() : 'invitado');
      const activa = data.membresia.tipo_membresia !== 'gratis' && !!data.membresia.activa;
      localStorage.setItem(key, JSON.stringify({
        activa: activa,
        tipo: data.membresia.tipo_membresia,
        fecha: data.membresia.fecha_inicio
      }));
    }
  } catch (e) { /* sin conexión, usar cache local */ }
}

// ------------------------------------------------------------
// 9. ACTUALIZACIÓN DE UI: CONTROL DEL MENÚ LATERAL Y PRIVACIDAD
// ------------------------------------------------------------
function ensureGuestAuthUI() {
  const existingBtn = document.getElementById('guestLoginBtn');
  if (existingBtn) existingBtn.remove();

  const userPanel = document.querySelector('.sidebar-user-panel');
  if (userPanel && !document.getElementById('sidebarGuestLoginBtn')) {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.id = 'sidebarGuestLoginBtn';
    btn.className = 'sidebar-guest-login-btn';
    btn.textContent = 'Iniciar sesión';
    btn.addEventListener('click', function () {
      toggleSidebar(false);
      openLoginModal();
    });
    userPanel.appendChild(btn);
  }
}

function updateAuthUI() {
  ensureGuestAuthUI();

  const user = getCurrentUser();

  const sidebar = document.getElementById('sidebarLeft');
  const sidebarUserName = document.getElementById('sidebarUserName');
  const sidebarUserAvatar = document.getElementById('sidebarUserAvatar');
  const topbarUserName = document.getElementById('topbarUserName');
  const sidebarUserRole = document.querySelector('.sidebar-user-role');
  const sidebarLogoutBtn = document.querySelector('.sidebar-logout-btn');
  const guestLoginBtn = document.getElementById('guestLoginBtn');
  const sidebarGuestLoginBtn = document.getElementById('sidebarGuestLoginBtn');

  const protectedSection = document.getElementById('protectedContent');
  const lockedBanner = document.getElementById('lockedBanner');
  const guestLanding = document.getElementById('guestLanding');
  const studentDashboard = document.getElementById('studentDashboard');
  const navGuestNotice = document.getElementById('navGuestNotice');

  if (user) {
    // USUARIO AUTENTICADO:
    document.body.classList.add('user-logged-in');
    document.body.classList.remove('not-logged-in');

    const displayName = user.name || 'Estudiante';
    const initial = displayName.charAt(0).toUpperCase();

    if (sidebarUserName) sidebarUserName.textContent = displayName;
    if (sidebarUserAvatar) sidebarUserAvatar.textContent = initial;
    if (topbarUserName) topbarUserName.textContent = displayName;
    if (sidebarUserRole) sidebarUserRole.textContent = 'Estudiante Activo';
    if (sidebarLogoutBtn) sidebarLogoutBtn.style.display = 'flex';
    if (guestLoginBtn) guestLoginBtn.style.display = 'none';
    if (sidebarGuestLoginBtn) sidebarGuestLoginBtn.style.display = 'none';

    if (protectedSection) protectedSection.style.display = 'block';
    if (lockedBanner) lockedBanner.style.display = 'none';

    // En index.php: mostrar panel del estudiante y ocultar portada
    if (studentDashboard) studentDashboard.style.display = 'block';
    if (guestLanding) guestLanding.style.display = 'none';
    if (navGuestNotice) navGuestNotice.style.display = 'none';
  } else {
    // USUARIO VISITANTE (SIN SESIÓN):
    // Permitir acceso directo a la retícula académica con Semestre 1 libre (Cero fricción)
    document.body.classList.add('user-logged-in');
    document.body.classList.remove('not-logged-in');

    if (sidebarUserName) sidebarUserName.textContent = 'Invitado (Demo)';
    if (sidebarUserAvatar) sidebarUserAvatar.textContent = '👋';
    if (topbarUserName) topbarUserName.textContent = 'Invitado';
    if (sidebarUserRole) sidebarUserRole.textContent = 'Invitado';
    if (sidebarLogoutBtn) sidebarLogoutBtn.style.display = 'none';
    if (guestLoginBtn) guestLoginBtn.remove();
    if (sidebarGuestLoginBtn) sidebarGuestLoginBtn.style.display = 'inline-flex';

    if (protectedSection) protectedSection.style.display = 'block';
    if (lockedBanner) lockedBanner.style.display = 'none';

    // En index.php: mostrar portada pública
    if (studentDashboard) studentDashboard.style.display = 'none';
    if (guestLanding) guestLanding.style.display = 'block';
    if (navGuestNotice) navGuestNotice.style.display = 'none';

    // Cerrar sidebar si estaba abierto en responsive
    if (sidebar && window.innerWidth <= 992) sidebar.classList.remove('open');
  }

  // Refrescar la retícula académica según el usuario actual
  renderReticula();
  // Refrescar la página de configuraciones si está presente
  renderConfiguracion();
}

// ------------------------------------------------------------
// 10. CALCULADORA DE INTERÉS COMPUESTO (RECURSOS)
// ------------------------------------------------------------
function calculateCompoundInterest() {
  const initInput = document.getElementById('calcInitial');
  const monthlyInput = document.getElementById('calcMonthly');
  const rateInput = document.getElementById('calcRate');
  const yearsInput = document.getElementById('calcYears');
  const resultDisplay = document.getElementById('calcTotalResult');
  const totalContributedDisplay = document.getElementById('calcContributed');
  const totalInterestDisplay = document.getElementById('calcInterest');

  if (!initInput || !resultDisplay) return;

  const P = parseFloat(initInput.value) || 0;
  const PMT = parseFloat(monthlyInput.value) || 0;
  const annualRate = (parseFloat(rateInput.value) || 0) / 100;
  const t = parseFloat(yearsInput.value) || 1;
  const n = 12; // capitalización mensual
  const r = annualRate / n;
  const totalMonths = t * n;

  // Fórmula: FV = P * (1 + r)^totalMonths + PMT * [((1 + r)^totalMonths - 1) / r]
  let total = P * Math.pow(1 + r, totalMonths);
  if (r > 0) {
    total += PMT * ((Math.pow(1 + r, totalMonths) - 1) / r);
  } else {
    total += PMT * totalMonths;
  }

  const totalContributed = P + (PMT * totalMonths);
  const totalInterest = Math.max(0, total - totalContributed);

  resultDisplay.textContent = '$' + Math.round(total).toLocaleString('es-MX');
  if (totalContributedDisplay) {
    totalContributedDisplay.textContent = '$' + Math.round(totalContributed).toLocaleString('es-MX');
  }
  if (totalInterestDisplay) {
    totalInterestDisplay.textContent = '$' + Math.round(totalInterest).toLocaleString('es-MX');
  }
}

// ------------------------------------------------------------
// 11. FAQ ACORDEÓN (NOSOTROS)
// ------------------------------------------------------------
function toggleFaq(btn) {
  const item = btn.closest('.faq-item');
  if (!item) return;
  const isOpen = item.classList.contains('open');

  // Cerrar otros
  document.querySelectorAll('.faq-item').forEach(i => {
    if (i !== item) i.classList.remove('open');
  });

  if (isOpen) {
    item.classList.remove('open');
  } else {
    item.classList.add('open');
  }
}

// ------------------------------------------------------------
// 12. PROTECCIÓN DE ENLACES PARA VISITANTES
// ------------------------------------------------------------
document.addEventListener('click', (e) => {
  const link = e.target.closest('a[href="index.php?page=cursos"], a[href="index.php?page=recursos"], a[href="index.php?page=configuraciones"]');
  if (link && !getCurrentUser()) {
    e.preventDefault();
    openLoginModal();
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = '🔒 Para acceder a esta interfaz, primero inicia sesión o crea tu cuenta gratis.';
    }
  }
});

// ------------------------------------------------------------
// 13. TECLA ESCAPE CIERRA MODALES
// ------------------------------------------------------------
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeModal();
    closeSearchModal();
    closeLoginModal();
    closeSignupModal();
    closeForgotModal();
    closeReticulaModal();
    cerrarAsistente();
    cerrarWhatsApp();
    toggleSidebar(false);
  }
});

// ------------------------------------------------------------
// 14. PANTALLA DE INICIO (SPLASH)
// ------------------------------------------------------------
const splash = document.getElementById('splash');
let splashTimer = null;

if (splash) {
  splashTimer = setTimeout(hideSplash, 5200);

  document.body.addEventListener('click', (e) => {
    if (e.target && e.target.closest && e.target.closest('.splash')) {
      hideSplash();
    }
  });
}

function hideSplash() {
  if (!splash || splash.classList.contains('hide')) return;
  splash.classList.add('hide');
  if (splashTimer) clearTimeout(splashTimer);
  setTimeout(() => {
    splash.style.display = 'none';
  }, 900);
}

// Inicializar estado de interfaz al cargar el DOM
document.addEventListener('DOMContentLoaded', async () => {
  // Si hay sesión activa, sincronizar datos desde el servidor
  if (getCurrentUser()) {
    await loadCsrfToken();
    await syncInscripcionesDesdeAPI();
    await syncMembresiaDesdeAPI();
  }
  updateAuthUI();
  initAsistente();
  calculateCompoundInterest();
  if (window.location.hash === '#reticula') {
    setTimeout(() => {
      const el = document.getElementById('reticula');
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 250);
  }
});

// ------------------------------------------------------------
// 15. RETÍCULA ACADÉMICA INTERACTIVA
// ------------------------------------------------------------
const RETICULA_ARRAY_KEY = 'edu_fin_reticula_';

const RETICULA_SEMESTRES = [
  { id: 1, anio: 'Año 1', nivel: 'Básico', titulo: 'Semestre 1 (Nivel Básico — Prueba 100% Gratis)', limite: 3, requeridoPrevio: 0, gratis: true },
  { id: 2, anio: 'Año 1', nivel: 'Intermedio I', titulo: 'Semestre 2 (Nivel Intermedio I — Consolidación)', limite: 3, requeridoPrevio: 2, gratis: false },
  { id: 3, anio: 'Año 2', nivel: 'Intermedio II', titulo: 'Semestre 3 (Nivel Intermedio II — Inversiones)', limite: 3, requeridoPrevio: 1, gratis: false },
  { id: 4, anio: 'Año 2', nivel: 'Avanzado', titulo: 'Semestre 4 (Nivel Avanzado — Libertad Financiera)', limite: 3, requeridoPrevio: 1, gratis: false }
];

const RETICULA_MATERIAS = [
  // SEMESTRE 1 (Nivel Básico - Prueba 100% Gratis) — mismas unidades del Aula Demo
  {
    id: 'finanzas-personales', semestre: 1, icon: '📗',
    nombre: 'Unidad 1: Rompe el ciclo',
    desc: 'Diagnostica tu dinero, detecta fugas y aplica la regla 50/30/20 para tomar el control.',
    temario: [
      'Diagnóstico de tu dinero: ¿A dónde se va lo que ganas?',
      'Fugas y micro-gastos hormiga',
      'Regla 50/30/20 simplificada',
      'Método anti-deuda acelerado'
    ],
    videos: [
      { titulo: 'Diagnóstico financiero personal: ¿A dónde se va tu dinero?', url: 'https://www.youtube.com/embed/WF6qLnuh4EA', duracion: '14:32' },
      { titulo: 'Gastos hormiga: cómo detectar las fugas invisibles', url: 'https://www.youtube.com/embed/Of1490doP8c', duracion: '11:18' },
      { titulo: 'La regla 50/30/20 explicada con ejemplos reales en México', url: 'https://www.youtube.com/embed/_7a55m4opPw', duracion: '16:05' }
    ],
    ejercicios: [
      { titulo: 'Quiz: ¿Qué tan saludables son tus finanzas?', tipo: 'quiz', descripcion: 'Responde 15 preguntas para obtener tu diagnóstico financiero personalizado y descubrir tus áreas de mejora.' },
      { titulo: 'Rastreador de gastos semanal', tipo: 'practica', descripcion: 'Registra todos tus gastos durante 7 días, clasifícalos en necesidades, deseos y ahorro, y calcula tu porcentaje real.' },
      { titulo: 'Mi presupuesto 50/30/20', tipo: 'proyecto', descripcion: 'Crea tu presupuesto mensual aplicando la regla 50/30/20 con tus ingresos reales y presenta un plan de acción.' }
    ],
    audios: [
      { titulo: 'Mitos del dinero que te mantienen pobre', descripcion: 'Desmontamos las 7 creencias más comunes sobre el dinero en México que frenan tu crecimiento financiero.', duracion: '22:15' },
      { titulo: '¿Por qué no me alcanza el quincena?', descripcion: 'Análisis de los patrones de gasto más comunes entre mexicanos y cómo romper el ciclo quincena a quincena.', duracion: '18:40' }
    ],
    libros: [
      { titulo: 'Padre Rico, Padre Pobre', autor: 'Robert T. Kiyosaki', descripcion: 'El clásico que cambia tu mentalidad sobre el dinero: aprende la diferencia entre activos y pasivos.', tipo: 'ebook' },
      { titulo: 'Pequeño Cerdo Capitalista', autor: 'Sofía Macías', descripcion: 'La guía más popular de finanzas personales en México, con lenguaje sencillo y ejemplos locales.', tipo: 'pdf' }
    ]
  },
  {
    id: 'presupuesto', semestre: 1, icon: '📘',
    nombre: 'Unidad 2: Construye tu fortaleza',
    desc: 'Crea tu fondo de paz y aprende a negociar tus créditos de forma inteligente.',
    temario: ['Fondo de paz y contingencias', 'Negociación inteligente de créditos'],
    videos: [
      { titulo: 'Cómo crear tu fondo de emergencia desde cero', url: 'https://www.youtube.com/embed/zA67rkRiGXI', duracion: '13:22' },
      { titulo: 'Negociación de créditos: guía paso a paso', url: 'https://www.youtube.com/embed/xnDpXyRsKlU', duracion: '17:45' },
      { titulo: '5 errores fatales al manejar tarjetas de crédito', url: 'https://www.youtube.com/embed/pTFZrS_8jRk', duracion: '10:58' }
    ],
    ejercicios: [
      { titulo: 'Calculadora de fondo de emergencia', tipo: 'practica', descripcion: 'Calcula cuánto necesitas ahorrar para cubrir 3 y 6 meses de gastos fijos y variables con tu situación real.' },
      { titulo: 'Simulación de negociación de deuda', tipo: 'simulacion', descripcion: 'Practica con escenarios reales cómo negociar tasas de interés, quitas y reestructuras con tu banco.' }
    ],
    audios: [
      { titulo: 'Historias de crédito: lecciones aprendidas', descripcion: 'Tres personas reales comparten cómo salieron de deudas de tarjetas de crédito usando estrategias inteligentes.', duracion: '25:10' }
    ],
    libros: [
      { titulo: 'Guía práctica de presupuestos familiares', autor: 'CONDUSEF', descripcion: 'Manual oficial con plantillas y metodologías para organizar las finanzas del hogar mexicano.', tipo: 'pdf' },
      { titulo: 'Los secretos de la mente millonaria', autor: 'T. Harv Eker', descripcion: 'Descubre cómo tu programación mental sobre el dinero determina tus resultados financieros.', tipo: 'ebook' }
    ]
  },
  {
    id: 'gasto-hormiga', semestre: 1, icon: '📙',
    nombre: 'Unidad 3: Multiplica e invierte',
    desc: 'Protege tu dinero de la inflación y da tus primeros pasos en portafolios pasivos.',
    temario: ['Rendimientos reales contra inflación', 'Portafolios pasivos paso a paso'],
    videos: [
      { titulo: '¿Qué es la inflación y cómo te roba silenciosamente?', url: 'https://www.youtube.com/embed/PHe0bXAIuk0', duracion: '12:45' },
      { titulo: 'Tu primer portafolio pasivo con poco dinero', url: 'https://www.youtube.com/embed/HCN2GIzOn2U', duracion: '19:30' },
      { titulo: 'Interés compuesto: la octava maravilla del mundo', url: 'https://www.youtube.com/embed/WEDIj9JBTC8', duracion: '15:12' }
    ],
    ejercicios: [
      { titulo: 'Calculadora de interés compuesto', tipo: 'practica', descripcion: 'Ingresa tu capital inicial, aportación mensual y tasa de rendimiento para visualizar tu crecimiento a 5, 10 y 20 años.' },
      { titulo: 'Proyecto: Mi primer portafolio de inversión', tipo: 'proyecto', descripcion: 'Diseña un portafolio diversificado con instrumentos mexicanos, define porcentajes y justifica cada elección.' }
    ],
    audios: [
      { titulo: 'Inversiones para principiantes: por dónde empezar', descripcion: 'Explicación sencilla de los instrumentos de inversión disponibles en México para quienes nunca han invertido.', duracion: '20:05' },
      { titulo: 'La magia del interés compuesto con ejemplos reales', descripcion: 'Casos prácticos de cómo $1,000 pesos mensuales pueden convertirse en un patrimonio significativo.', duracion: '16:30' }
    ],
    libros: [
      { titulo: 'El inversor inteligente', autor: 'Benjamin Graham', descripcion: 'La biblia de la inversión en valor, con principios atemporales para proteger tu capital de la inflación.', tipo: 'ebook' },
      { titulo: 'Cómo invertir en CETES y más', autor: 'Banco de México', descripcion: 'Guía oficial paso a paso para abrir tu cuenta en CETES Directo y comenzar a invertir desde $100 pesos.', tipo: 'pdf' }
    ]
  },

  // SEMESTRE 2 (Nivel Intermedio I - Año 1)
  {
    id: 'fondo-emergencia', semestre: 2, icon: '🛡️',
    nombre: 'Ahorro formal y fondo de emergencia',
    desc: 'Construye tu escudo de tranquilidad financiera para 3 a 6 meses de gastos.',
    temario: ['Cálculo de tu fondo de paz mental', 'Cuentas de ahorro de alta liquidez', 'Estrategias antibloqueo'],
    videos: [
      { titulo: 'Cuentas de ahorro en México: ¿cuál te conviene?', url: 'https://www.youtube.com/embed/9xHOEs6WtaM', duracion: '14:50' },
      { titulo: 'Liquidez vs rendimiento: dónde guardar tu fondo de emergencia', url: 'https://www.youtube.com/embed/H48qw1QRGSA', duracion: '11:35' },
      { titulo: 'Cómo automatizar tu ahorro sin sentirlo', url: 'https://www.youtube.com/embed/RgKAFK5djSk', duracion: '13:20' }
    ],
    ejercicios: [
      { titulo: 'Calculadora de fondo de emergencia avanzada', tipo: 'simulacion', descripcion: 'Simula diferentes escenarios: pérdida de empleo, emergencia médica, reparación del auto. ¿Cuántos meses resistes?' },
      { titulo: 'Plan de ahorro personalizado a 6 meses', tipo: 'practica', descripcion: 'Crea un plan semana a semana para construir tu fondo de emergencia con metas progresivas y seguimiento.' },
      { titulo: 'Quiz: ¿Estás preparado para una emergencia financiera?', tipo: 'quiz', descripcion: 'Evalúa tu nivel de preparación financiera ante imprevistos con 12 preguntas de situaciones reales.' }
    ],
    audios: [
      { titulo: 'Historias de paz financiera', descripcion: 'Testimonios de personas que evitaron la crisis gracias a su fondo de emergencia bien planificado.', duracion: '19:45' },
      { titulo: 'El ahorro no es sacrificio, es libertad', descripcion: 'Cambia tu perspectiva sobre el ahorro: técnicas psicológicas para disfrutar el proceso de ahorrar.', duracion: '17:20' }
    ],
    libros: [
      { titulo: 'El hombre más rico de Babilonia', autor: 'George S. Clason', descripcion: 'Parábolas ancestrales sobre el ahorro y la riqueza que siguen vigentes para las finanzas modernas.', tipo: 'ebook' },
      { titulo: 'Estrategias de ahorro para mexicanos', autor: 'CONDUSEF', descripcion: 'Comparativo actualizado de cuentas de ahorro, pagarés y fondos de inversión de bajo riesgo en México.', tipo: 'pdf' }
    ]
  },
  {
    id: 'control-deudas', semestre: 2, icon: '💳',
    nombre: 'Control de deudas y crédito bancario',
    desc: 'Métodos probados (Bola de nieve y Avalancha) para liquidar tarjetas y créditos.',
    temario: ['El costo real de las tasas de interés', 'Estrategia bola de nieve vs avalancha', 'Renegociación sin quitas destructivas'],
    videos: [
      { titulo: 'Método bola de nieve vs avalancha: ¿cuál elegir?', url: 'https://www.youtube.com/embed/JGwWNGJdvx8', duracion: '16:28' },
      { titulo: 'Cómo entender tu estado de cuenta y el CAT', url: 'https://www.youtube.com/embed/LK7qEnwi_R0', duracion: '12:15' },
      { titulo: 'Renegociación de deudas bancarias sin destruir tu historial', url: 'https://www.youtube.com/embed/Hjv473hOiB0', duracion: '18:40' }
    ],
    ejercicios: [
      { titulo: 'Simulador de pago de deudas', tipo: 'simulacion', descripcion: 'Ingresa tus deudas actuales con tasas y montos. El simulador calcula cuándo las liquidarás con cada método.' },
      { titulo: 'Quiz: ¿Conoces tu score crediticio?', tipo: 'quiz', descripcion: 'Pon a prueba tus conocimientos sobre Buró de Crédito, score crediticio y cómo mejorarlo en México.' },
      { titulo: 'Caso de estudio: Familia García sale de deudas', tipo: 'caso-estudio', descripcion: 'Analiza el caso real de una familia con $180,000 en deudas y diseña la estrategia óptima de pago.' }
    ],
    audios: [
      { titulo: 'Mi camino libre de deudas', descripcion: 'Podcast con tres historias reales de mexicanos que liquidaron deudas de más de $100,000 pesos en menos de 2 años.', duracion: '28:30' }
    ],
    libros: [
      { titulo: 'La transformación total de su dinero', autor: 'Dave Ramsey', descripcion: 'Plan paso a paso para salir de deudas usando los 7 pasos del método Ramsey adaptados al contexto latino.', tipo: 'ebook' },
      { titulo: 'Guía para entender tu Buró de Crédito', autor: 'Círculo de Crédito', descripcion: 'Todo lo que necesitas saber sobre tu historial crediticio, cómo consultarlo y cómo mejorarlo.', tipo: 'articulo' }
    ]
  },
  {
    id: 'materiales-herramientas', semestre: 2, icon: '🧰',
    nombre: 'Materiales y herramientas digitales',
    desc: 'Plantillas automatizadas en Excel, calculadoras y apps para gestionar tus finanzas.',
    temario: ['Plantillas financieras automatizadas', 'Apps de seguimiento en tiempo real', 'Calculadoras de amortización'],
    videos: [
      { titulo: 'Crea tu plantilla de presupuesto en Excel desde cero', url: 'https://www.youtube.com/embed/Ct8Gxo8StBU', duracion: '22:10' },
      { titulo: 'Las 5 mejores apps de finanzas personales en México 2025', url: 'https://www.youtube.com/embed/FTQbiNvZqaY', duracion: '15:33' },
      { titulo: 'Google Sheets para tus finanzas: automatiza todo', url: 'https://www.youtube.com/embed/N2bXEUSAiTI', duracion: '19:48' }
    ],
    ejercicios: [
      { titulo: 'Construye tu hoja de cálculo financiera', tipo: 'proyecto', descripcion: 'Crea una hoja de cálculo con presupuesto, rastreador de gastos y gráficas automáticas usando fórmulas avanzadas.' },
      { titulo: 'Comparativo de apps financieras', tipo: 'practica', descripcion: 'Prueba 3 apps de finanzas personales durante una semana y elabora un análisis comparativo con pros y contras.' }
    ],
    audios: [
      { titulo: 'Fintech en México: revolución digital de tus finanzas', descripcion: 'Panorama de las herramientas fintech disponibles en México: neobancos, apps de inversión y plataformas de ahorro.', duracion: '21:15' }
    ],
    libros: [
      { titulo: 'Excel para finanzas personales', autor: 'María del Carmen Ruiz', descripcion: 'Manual práctico con 20 plantillas descargables para controlar presupuestos, deudas e inversiones.', tipo: 'pdf' },
      { titulo: 'La era de las fintech', autor: 'Banco de México', descripcion: 'Informe sobre la revolución tecnológica financiera en México y cómo aprovechar las nuevas herramientas digitales.', tipo: 'articulo' }
    ]
  },

  // SEMESTRE 3 (Nivel Intermedio II - Inversiones - Año 2)
  {
    id: 'ahorro-inversion', semestre: 3, icon: '📈',
    nombre: 'Estrategias de inversión y renta fija',
    desc: 'Pon tu dinero a trabajar con instrumentos regulados de bajo riesgo y renta fija.',
    temario: ['CETES Directo y Bonos gubernamentales', 'Interés compuesto y valor del dinero en el tiempo', 'Inflación vs rendimiento real'],
    videos: [
      { titulo: 'CETES Directo: tutorial completo para invertir desde $100', url: 'https://www.youtube.com/embed/hT_nvWreIhg', duracion: '18:25' },
      { titulo: 'Bonos gubernamentales explicados con manzanas', url: 'https://www.youtube.com/embed/YQHsXMglC9A', duracion: '14:10' },
      { titulo: 'Valor del dinero en el tiempo: ¿$10,000 hoy o mañana?', url: 'https://www.youtube.com/embed/lp-EO5I60KA', duracion: '12:55' }
    ],
    ejercicios: [
      { titulo: 'Simulador de inversión en CETES', tipo: 'simulacion', descripcion: 'Simula inversiones en CETES a 28, 91, 182 y 364 días. Compara rendimientos netos después de impuestos.' },
      { titulo: 'Quiz: Valor del dinero en el tiempo', tipo: 'quiz', descripcion: 'Resuelve 10 problemas de valor presente y valor futuro para dominar el concepto más importante de las finanzas.' },
      { titulo: 'Proyecto: Análisis de renta fija mexicana', tipo: 'proyecto', descripcion: 'Investiga y compara CETES, Bondes, Udibonos y pagarés bancarios. Presenta tu análisis con recomendaciones.' }
    ],
    audios: [
      { titulo: 'Renta fija en México: lo que nadie te cuenta', descripcion: 'Entrevista con un asesor financiero certificado sobre las mejores estrategias de renta fija para 2025.', duracion: '24:30' }
    ],
    libros: [
      { titulo: 'Fundamentos de inversiones', autor: 'Lawrence J. Gitman', descripcion: 'Texto académico de referencia sobre mercados financieros, bonos e instrumentos de deuda con enfoque práctico.', tipo: 'ebook' },
      { titulo: 'Guía del inversionista en CETES Directo', autor: 'Gobierno de México', descripcion: 'Manual oficial paso a paso para operar en la plataforma CETES Directo del gobierno federal.', tipo: 'pdf' }
    ]
  },
  {
    id: 'fondos-bolsa', semestre: 3, icon: '📊',
    nombre: 'Fondos indexados y renta variable',
    desc: 'Aprende a invertir a largo plazo en índices globales como el S&P 500.',
    temario: ['Qué son los ETFs y fondos indexados', 'Aportaciones periódicas (Dollar Cost Averaging)', 'Gestión del riesgo y horizonte temporal'],
    videos: [
      { titulo: 'ETFs explicados: invierte en el S&P 500 desde México', url: 'https://www.youtube.com/embed/fUr4GVauePo', duracion: '17:40' },
      { titulo: 'Dollar Cost Averaging: la estrategia que siempre gana', url: 'https://www.youtube.com/embed/byA-aYNNkJk', duracion: '13:55' },
      { titulo: 'Gestión del riesgo: cómo no perder tu dinero en la bolsa', url: 'https://www.youtube.com/embed/OwMf6gEMfg8', duracion: '20:15' }
    ],
    ejercicios: [
      { titulo: 'Constructor de portafolio diversificado', tipo: 'proyecto', descripcion: 'Diseña un portafolio con ETFs mexicanos e internacionales. Define porcentajes por clase de activo y justifica tu estrategia.' },
      { titulo: 'Quiz: Evaluación de perfil de riesgo', tipo: 'quiz', descripcion: 'Determina si eres un inversionista conservador, moderado o agresivo con este test de 20 preguntas validado.' },
      { titulo: 'Simulación: DCA vs inversión de golpe', tipo: 'simulacion', descripcion: 'Compara los resultados de invertir $60,000 de golpe vs $5,000 mensuales durante 12 meses con datos históricos reales.' }
    ],
    audios: [
      { titulo: 'La bolsa de valores desmitificada', descripcion: 'Explicación clara de cómo funciona la Bolsa Mexicana de Valores y por qué no necesitas ser experto para invertir.', duracion: '26:10' },
      { titulo: 'Entrevista: 10 años invirtiendo en ETFs desde México', descripcion: 'Un inversionista mexicano comparte su experiencia real invirtiendo en fondos indexados con aportaciones mensuales.', duracion: '32:45' }
    ],
    libros: [
      { titulo: 'El pequeño libro para invertir con sentido común', autor: 'John C. Bogle', descripcion: 'El creador de Vanguard explica por qué los fondos indexados son la mejor opción para el inversionista promedio.', tipo: 'ebook' },
      { titulo: 'Un paso adelante en Wall Street', autor: 'Peter Lynch', descripcion: 'Estrategias del legendario gestor de fondos para que inversionistas comunes superen a los profesionales.', tipo: 'ebook' }
    ]
  },
  {
    id: 'proteccion-impuestos', semestre: 3, icon: '🏛️',
    nombre: 'Protección patrimonial e impuestos',
    desc: 'Seguros indispensables y optimización fiscal para proteger tu capital.',
    temario: ['Seguros de gastos médicos y vida', 'Deducciones personales para devolución de impuestos', 'Plan personal de retiro (PPR)'],
    videos: [
      { titulo: 'Seguros que realmente necesitas (y los que no)', url: 'https://www.youtube.com/embed/QH2-TGUlwu4', duracion: '15:30' },
      { titulo: 'Deducciones fiscales en México: recupera miles de pesos', url: 'https://www.youtube.com/embed/CevxZvSJLk8', duracion: '18:22' },
      { titulo: 'PPR: tu arma secreta para el retiro y los impuestos', url: 'https://www.youtube.com/embed/eb7wmGOKmBs', duracion: '14:08' }
    ],
    ejercicios: [
      { titulo: 'Calculadora de deducciones fiscales', tipo: 'practica', descripcion: 'Ingresa tus gastos deducibles del año y calcula cuánto puedes recuperar en tu declaración anual del SAT.' },
      { titulo: 'Evaluación de necesidades de seguros', tipo: 'quiz', descripcion: 'Responde preguntas sobre tu situación personal y familiar para determinar qué seguros necesitas y cuánta cobertura.' },
      { titulo: 'Caso de estudio: Optimización fiscal de Ana', tipo: 'caso-estudio', descripcion: 'Analiza el caso de una profesionista que paga $45,000 al año en impuestos y diseña su estrategia de optimización.' }
    ],
    audios: [
      { titulo: 'Tips de optimización fiscal que tu contador no te dice', descripcion: 'Estrategias legales para reducir tu carga fiscal: desde PPR hasta donativos y gastos médicos deducibles.', duracion: '23:40' }
    ],
    libros: [
      { titulo: 'Planeación fiscal para personas físicas', autor: 'IMCP', descripcion: 'Guía del Instituto Mexicano de Contadores Públicos sobre deducciones, regímenes fiscales y optimización legal.', tipo: 'pdf' },
      { titulo: 'Seguros y finanzas personales', autor: 'AMIS', descripcion: 'Manual de la Asociación Mexicana de Instituciones de Seguros para elegir la protección adecuada según tu etapa de vida.', tipo: 'articulo' }
    ]
  },

  // SEMESTRE 4 (Nivel Avanzado - Libertad Financiera - Año 2)
  {
    id: 'emprendimiento', semestre: 4, icon: '💡',
    nombre: 'Emprendimiento y modelos de negocio',
    desc: 'Valida ideas, crea negocios rentables y diversifica tus fuentes de ingresos.',
    temario: ['Validación de ideas de negocio con bajo capital', 'Flujo de caja del negocio', 'Estrategias de ventas y pricing'],
    videos: [
      { titulo: 'Cómo validar tu idea de negocio sin gastar un peso', url: 'https://www.youtube.com/embed/SqcY0GlETPk', duracion: '16:55' },
      { titulo: 'Flujo de caja: el rey de los negocios rentables', url: 'https://www.youtube.com/embed/vLnPwxZdW4Y', duracion: '14:30' },
      { titulo: 'Pricing: cómo poner precio a tu producto o servicio', url: 'https://www.youtube.com/embed/eTFy8RnUkoU', duracion: '19:12' }
    ],
    ejercicios: [
      { titulo: 'Lienzo de modelo de negocio (Canvas)', tipo: 'proyecto', descripcion: 'Completa el Business Model Canvas para tu idea de negocio: propuesta de valor, segmento de clientes, canales y finanzas.' },
      { titulo: 'Estrategia de pricing para tu producto', tipo: 'practica', descripcion: 'Aplica 3 métodos de fijación de precios (costo plus, valor percibido y competencia) a un producto real o hipotético.' },
      { titulo: 'Caso de estudio: De empleado a emprendedor', tipo: 'caso-estudio', descripcion: 'Analiza cómo un mexicano pasó de ganar $15,000 como empleado a generar $80,000 mensuales con su negocio propio.' }
    ],
    audios: [
      { titulo: 'Entrevistas con emprendedores mexicanos exitosos', descripcion: 'Tres emprendedores comparten sus aprendizajes, errores y estrategias para crear negocios rentables en México.', duracion: '35:20' },
      { titulo: 'Errores financieros fatales al emprender', descripcion: 'Los 10 errores de flujo de caja más comunes en negocios nuevos y cómo evitar cada uno de ellos.', duracion: '18:55' }
    ],
    libros: [
      { titulo: 'El método Lean Startup', autor: 'Eric Ries', descripcion: 'Metodología probada para crear negocios exitosos con mínima inversión: construir, medir y aprender.', tipo: 'ebook' },
      { titulo: 'La semana laboral de 4 horas', autor: 'Timothy Ferriss', descripcion: 'Cómo diseñar un negocio que funcione con sistemas automatizados para generar ingresos sin estar presente.', tipo: 'ebook' }
    ]
  },
  {
    id: 'bienes-raices', semestre: 4, icon: '🏢',
    nombre: 'Inversión inmobiliaria y FIBRAs',
    desc: 'Participa en el sector inmobiliario con bajo capital a través de FIBRAs y rentas.',
    temario: ['Fideicomisos de bienes raíces (FIBRAs)', 'Rentas tradicionales vs temporales', 'Plusvalía y flujo constante'],
    videos: [
      { titulo: 'FIBRAs en México: invierte en bienes raíces desde $1,000', url: 'https://www.youtube.com/embed/WI5NKIe0DBk', duracion: '17:35' },
      { titulo: 'Rentas en Airbnb vs renta tradicional: ¿qué conviene más?', url: 'https://www.youtube.com/embed/pB-5XG-DbAA', duracion: '21:10' },
      { titulo: 'Cómo analizar plusvalía y rendimiento de una propiedad', url: 'https://www.youtube.com/embed/dP15zlyra3c', duracion: '15:48' }
    ],
    ejercicios: [
      { titulo: 'Análisis comparativo de FIBRAs mexicanas', tipo: 'proyecto', descripcion: 'Investiga 5 FIBRAs listadas en la BMV, compara rendimientos por dividendo, plusvalía y riesgo. Presenta tu top 3.' },
      { titulo: 'Calculadora de rendimiento por renta', tipo: 'simulacion', descripcion: 'Calcula el yield bruto y neto de una propiedad considerando precio, renta mensual, gastos y vacancia.' },
      { titulo: 'Quiz: ¿Sabes lo básico de inversión inmobiliaria?', tipo: 'quiz', descripcion: 'Evalúa tus conocimientos sobre CAP rate, yield, plusvalía, FIBRAs y financiamiento hipotecario en México.' }
    ],
    audios: [
      { titulo: 'Inversión inmobiliaria para no millonarios', descripcion: 'Estrategias reales para participar en el mercado inmobiliario mexicano sin necesitar millones de pesos.', duracion: '27:40' }
    ],
    libros: [
      { titulo: 'El ABC de la inversión en bienes raíces', autor: 'Ken McElroy', descripcion: 'Guía fundamental sobre cómo analizar, comprar y administrar propiedades para generar flujo de efectivo.', tipo: 'ebook' },
      { titulo: 'FIBRAs: inversión inmobiliaria en México', autor: 'BMV Educación', descripcion: 'Guía oficial de la Bolsa Mexicana de Valores sobre Fideicomisos de Inversión en Bienes Raíces.', tipo: 'pdf' }
    ]
  },
  {
    id: 'libertad-financiera', semestre: 4, icon: '🏆',
    nombre: 'Independencia y legado financiero',
    desc: 'Consolida tu portafolio patrimonial definitivo para vivir de tus rentas e inversiones.',
    temario: ['La regla del 4% para retiro', 'Portafolios todo terreno', 'Plan financiero a 10 y 20 años'],
    videos: [
      { titulo: 'La regla del 4%: cuánto necesitas para retirarte', url: 'https://www.youtube.com/embed/15RJzvoS2nc', duracion: '16:40' },
      { titulo: 'Portafolio All-Weather de Ray Dalio explicado', url: 'https://www.youtube.com/embed/Nu4lHaSh7D4', duracion: '20:25' },
      { titulo: 'Tu plan financiero a 10 y 20 años: hoja de ruta definitiva', url: 'https://www.youtube.com/embed/wD2cVhC-63I', duracion: '23:15' }
    ],
    ejercicios: [
      { titulo: 'Calculadora de retiro e independencia financiera', tipo: 'simulacion', descripcion: 'Calcula tu número mágico: cuánto necesitas acumular y en cuántos años puedes alcanzar la libertad financiera.' },
      { titulo: 'Proyecto: Mi plan patrimonial y legado', tipo: 'proyecto', descripcion: 'Diseña tu plan financiero integral a 20 años: inversiones, seguros, testamento y estrategia de legado familiar.' },
      { titulo: 'Quiz: ¿Qué tan cerca estás de la libertad financiera?', tipo: 'quiz', descripcion: 'Evalúa tu progreso hacia la independencia financiera con métricas reales: tasa de ahorro, patrimonio neto y flujo pasivo.' }
    ],
    audios: [
      { titulo: 'Historias FIRE: mexicanos financieramente libres', descripcion: 'Entrevistas con personas en México que alcanzaron la independencia financiera antes de los 50 años.', duracion: '38:15' },
      { titulo: 'Diseña la vida que quieres, luego ahorra para ella', descripcion: 'Reflexión sobre cómo definir tu estilo de vida ideal y construir el portafolio que lo haga posible.', duracion: '15:50' }
    ],
    libros: [
      { titulo: 'La bolsa o la vida', autor: 'Vicki Robin y Joe Dominguez', descripcion: 'El libro fundacional del movimiento FIRE: transforma tu relación con el dinero y alcanza la libertad financiera.', tipo: 'ebook' },
      { titulo: 'El camino simple a la riqueza', autor: 'JL Collins', descripcion: 'Estrategia minimalista de inversión en fondos indexados para alcanzar la independencia financiera paso a paso.', tipo: 'ebook' }
    ]
  }
];

function getReticulaStorageKey() {
  const user = getCurrentUser();
  const who = (user && user.email) ? String(user.email).toLowerCase() : 'invitado';
  return RETICULA_ARRAY_KEY + who;
}

function getReticulaState() {
  try {
    const raw = localStorage.getItem(getReticulaStorageKey());
    const parsed = raw ? JSON.parse(raw) : null;
    if (parsed && Array.isArray(parsed.inscritas)) return parsed;
  } catch (e) {}
  return { inscritas: [] };
}

function saveReticulaState(state) {
  try {
    localStorage.setItem(getReticulaStorageKey(), JSON.stringify(state));
  } catch (e) {}

  // Persistir en el servidor si el usuario está autenticado
  const user = getCurrentUser();
  if (!user) return;

  // Guardar cada materia nueva en el servidor (de forma asíncrona, sin bloquear UI)
  state.inscritas.forEach(function(materiaId) {
    const m = getMateriaPorId(materiaId);
    if (!m) return;
    fetch(API_BASE + '/index.php?endpoint=inscripciones', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ materia_id: materiaId, semestre: m.semestre })
    }).catch(function() { /* ignorar errores de red; el cache local sigue disponible */ });
  });
}

async function resetInscripciones() {
  if (!confirm('¿Quitar todas las materias inscritas de tu retícula? Esta acción no se puede deshacer.')) return;

  const state = getReticulaState();
  // Eliminar en servidor cada materia inscrita
  const user = getCurrentUser();
  if (user) {
    for (const materiaId of state.inscritas) {
      try {
        await fetch(API_BASE + '/index.php?endpoint=inscripciones', {
          method: 'DELETE',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify({ materia_id: materiaId })
        });
      } catch (e) { /* continuar aunque falle la red */ }
    }
  }

  saveReticulaState({ inscritas: [] });
  closeReticulaModal();
  renderReticula();
  alert('✅ Tus inscripciones fueron eliminadas. Ya puedes inscribirte de nuevo desde el Semestre 1.');
}

function getMateriaPorId(id) {
  return RETICULA_MATERIAS.find(function (m) { return m.id === id; }) || null;
}

function getSemestreConfig(semId) {
  return RETICULA_SEMESTRES.find(function (s) { return s.id === semId; }) || null;
}

function contarInscritasEnSemestre(state, semId) {
  return state.inscritas.filter(function (id) {
    const m = getMateriaPorId(id);
    return m && m.semestre === semId;
  }).length;
}

const MEMBRESIA_KEY = 'edu_fin_membresia_';

function getMembresiaStorageKey() {
  const user = getCurrentUser();
  const who = (user && user.email) ? String(user.email).toLowerCase() : 'invitado';
  return MEMBRESIA_KEY + who;
}

function getMembresia() {
  const key = getMembresiaStorageKey();
  try {
    const raw = localStorage.getItem(key);
    const parsed = raw ? JSON.parse(raw) : null;
    if (parsed && parsed.activa) return parsed;
  } catch (e) {}

  // Si pagó como invitado y después creó su cuenta, heredar la inscripción.
  if (getCurrentUser()) {
    try {
      const rawInvitado = localStorage.getItem(MEMBRESIA_KEY + 'invitado');
      const parsedInvitado = rawInvitado ? JSON.parse(rawInvitado) : null;
      if (parsedInvitado && parsedInvitado.activa) {
        localStorage.setItem(key, rawInvitado);
        return parsedInvitado;
      }
    } catch (e) {}
  }

  return { activa: false };
}

function tieneMembresiaActiva() {
  return getMembresia().activa === true;
}

function activarMembresia(metodo) {
  try {
    localStorage.setItem(getMembresiaStorageKey(), JSON.stringify({
      activa: true,
      metodo: metodo || 'spei',
      fecha: Date.now()
    }));
    return true;
  } catch (e) {
    return false;
  }
}

function semestreRequierePago(semId) {
  const cfg = getSemestreConfig(semId);
  return !!(cfg && !cfg.gratis);
}

function semestreEstaBloqueadoPorPago(semId) {
  return false; // Todos los semestres liberados para estudio
}

function semestreEstaBloqueado(state, semId) {
  const cfg = getSemestreConfig(semId);
  if (!cfg) return false;
  if (semestreEstaBloqueadoPorPago(semId)) return true;
  if (cfg.requeridoPrevio <= 0) return false;
  const prev = RETICULA_SEMESTRES.find(function (s) { return s.id === semId - 1; });
  if (!prev) return false;
  return contarInscritasEnSemestre(state, prev.id) < cfg.requeridoPrevio;
}

function puedeInscribir(id) {
  const state = getReticulaState();
  const m = getMateriaPorId(id);
  if (!m) return { ok: false, motivo: 'error' };
  if (state.inscritas.indexOf(id) !== -1) return { ok: false, motivo: 'inscrita' };
  if (semestreEstaBloqueadoPorPago(m.semestre)) return { ok: false, motivo: 'pago' };
  if (semestreEstaBloqueado(state, m.semestre)) return { ok: false, motivo: 'bloqueado' };
  const cfg = getSemestreConfig(m.semestre);
  const limite = cfg ? cfg.limite : 1;
  if (contarInscritasEnSemestre(state, m.semestre) >= limite) {
    return { ok: false, motivo: 'limite' };
  }
  return { ok: true };
}

function estadoMateria(id, state) {
  if (state.inscritas.indexOf(id) !== -1) return 'inscrita';
  if (puedeInscribir(id).ok) return 'disponible';
  return 'bloqueada';
}

function renderReticula() {
  const grid = document.getElementById('reticulaGrid');
  if (!grid) return;

  const state = getReticulaState();
  const total = RETICULA_MATERIAS.length;
  const inscritas = state.inscritas.length;

  const resumen = document.getElementById('reticulaResumen');
  if (resumen) {
    let hint;
    const inscritasSem1 = contarInscritasEnSemestre(state, 1);
    const limiteSem1 = (getSemestreConfig(1) || {}).limite || 3;
    if (inscritas >= total) {
      hint = '¡Excelente! Has completado tu retícula formativa de 2 años';
    } else if (inscritasSem1 < limiteSem1) {
      const faltan = limiteSem1 - inscritasSem1;
      hint = 'Semestre 1 (Prueba Gratis): Inscríbete a ' + faltan + ' materia' + (faltan === 1 ? '' : 's') + ' más';
    } else if (contarInscritasEnSemestre(state, 2) < 3) {
      hint = tieneMembresiaActiva()
        ? '¡Semestre 1 completado! Continúa tu carrera de 2 años en el Semestre 2'
        : '¡Semestre 1 completado! Activa tu inscripción para continuar en el Semestre 2';
    } else if (contarInscritasEnSemestre(state, 3) < 3) {
      hint = '¡Año 2 desbloqueado! Inicia el Semestre 3 de Inversiones';
    } else {
      hint = '¡Nivel Avanzado! Completa el Semestre 4 de Libertad Financiera y Emprendimiento';
    }
    resumen.innerHTML =
      '<div class="reticula-resumen-num">' + inscritas + '<span> / ' + total + '</span></div>' +
      '<div class="reticula-resumen-txt">materias inscritas en tu retícula</div>' +
      '<div class="reticula-resumen-hint">🎯 ' + hint + '</div>';
  }

  grid.innerHTML = RETICULA_SEMESTRES.map(function (sem) {
    const cfg = sem;
    const materias = RETICULA_MATERIAS.filter(function (m) { return m.semestre === sem.id; });
    const inscritasSem = contarInscritasEnSemestre(state, sem.id);
    const bloqueado = semestreEstaBloqueado(state, sem.id);
    const requierePago = semestreEstaBloqueadoPorPago(sem.id);
    const pct = Math.min(100, Math.round((inscritasSem / cfg.limite) * 100));

    const chip = bloqueado
      ? '<span class="reticula-semester-chip locked">' + (requierePago ? '🔒 Requiere inscripción' : '🔒 Bloqueado') + '</span>'
      : '<span class="reticula-semester-chip">' + inscritasSem + ' / ' + cfg.limite +
        (cfg.limite === 1 ? ' materia' : ' materias') + '</span>';

    const cards = materias.map(function (m) {
      const st = estadoMateria(m.id, state);
      let etiqueta = 'Disponible';
      if (st === 'inscrita') etiqueta = '✓ Inscrita';
      else if (st === 'bloqueada') etiqueta = '🔒 Bloqueada';
      const accionClick = (st === 'inscrita')
        ? "window.location.href='index.php?page=aula'"
        : "openReticulaModal('" + m.id + "')";
      return '' +
        '<div class="reticula-materia is-' + st + '" onclick="' + accionClick + '">' +
          '<div class="reticula-materia-ico">' + m.icon + '</div>' +
          '<div class="reticula-materia-info">' +
            '<h5>' + m.nombre + '</h5>' +
            '<p>' + m.desc + '</p>' +
          '</div>' +
          '<div class="reticula-materia-estado">' + etiqueta + '</div>' +
        '</div>';
    }).join('');

    return '' +
      '<div class="reticula-semester">' +
        '<div class="reticula-semester-head">' +
          '<h4>🎓 ' + sem.titulo + '</h4>' +
          chip +
        '</div>' +
        '<div class="reticula-semester-bar"><i style="width:' + pct + '%"></i></div>' +
        '<div class="reticula-materias">' + cards + '</div>' +
      '</div>';
  }).join('');
}

let reticulaActualId = null;

function switchReticulaTab(tabName) {
  const tabs = ['temario', 'videos', 'ejercicios', 'audios', 'libros'];
  tabs.forEach(function (t) {
    const btn = document.getElementById('tabBtn-' + t);
    const pane = document.getElementById('tabContent-' + t);
    if (btn) {
      if (t === tabName) btn.classList.add('active');
      else btn.classList.remove('active');
    }
    if (pane) {
      pane.style.display = (t === tabName) ? 'block' : 'none';
    }
  });
}

let currentExerciseCorrectIdx = 1;
let selectedModalOptionIdx = null;

function reproducirVideoMateria(titulo, url) {
  const modal = document.getElementById('videoPlayerModal');
  const titleEl = document.getElementById('videoPlayerTitle');
  const iframe = document.getElementById('videoPlayerIframe');
  if (modal && iframe) {
    if (titleEl) titleEl.textContent = titulo;
    iframe.src = url || 'https://www.youtube.com/embed/WF6qLnuh4EA';
    modal.classList.add('open');
  } else {
    window.open(url, '_blank');
  }
}

function closeVideoPlayerModal() {
  const modal = document.getElementById('videoPlayerModal');
  const iframe = document.getElementById('videoPlayerIframe');
  if (iframe) iframe.src = '';
  if (modal) modal.classList.remove('open');
}

let currentExerciseType = 'quiz';
let currentExerciseExplanation = '';

function abrirEjercicioMateria(titulo, descripcion) {
  const modal = document.getElementById('exercisePlayerModal');
  const titleEl = document.getElementById('exerciseModalTitle');
  const descEl = document.getElementById('exerciseModalDesc');
  const optionsEl = document.getElementById('exerciseModalOptions');
  const feedbackEl = document.getElementById('exerciseModalFeedback');

  if (!modal) {
    alert('📝 ' + titulo + '\n\n' + descripcion);
    return;
  }

  if (titleEl) titleEl.textContent = titulo;
  if (descEl) descEl.textContent = descripcion;
  if (feedbackEl) feedbackEl.style.display = 'none';

  selectedModalOptionIdx = null;
  const t = (titulo || '').toLowerCase();

  // 1. CALCULADORA INTERACTIVA DE PRESUPUESTO 50/30/20
  if (t.includes('presupuesto') || t.includes('50/30/20') || t.includes('rastreador') || t.includes('gasto')) {
    currentExerciseType = 'calc_presupuesto';
    optionsEl.innerHTML = 
      '<div style="background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:12px; padding:16px; margin-bottom:12px;">' +
        '<label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:6px;">' +
          '💵 Ingresa tu Ingreso Mensual Neto ($ MXN):' +
        '</label>' +
        '<div style="display:flex; gap:10px; margin-bottom:14px;">' +
          '<input type="number" id="inputPresupuestoUser" value="16000" min="1000" step="500" style="flex:1; padding:10px 14px; border:1.5px solid #94a3b8; border-radius:8px; font-size:15px; font-weight:700;" oninput="recalcularPresupuestoModal()">' +
          '<button type="button" class="btn-cta-yellow" onclick="recalcularPresupuestoModal()" style="padding:10px 18px; font-size:13px;">Calcular</button>' +
        '</div>' +
        '<div style="display:flex; flex-direction:column; gap:8px;">' +
          '<div style="background:#ffffff; padding:10px 14px; border-left:4px solid #00703C; border-radius:6px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">' +
            '<div style="display:flex; justify-content:space-between; font-size:13px; font-weight:700; color:#00703C;">' +
              '<span>🏠 50% Necesidades Básicas:</span>' +
              '<span id="resPresupuesto50">$8,000 MXN</span>' +
            '</div>' +
            '<div style="font-size:11.5px; color:#64748b; margin-top:2px;">Renta, despensa, transporte y servicios fijos indispensables.</div>' +
          '</div>' +
          '<div style="background:#ffffff; padding:10px 14px; border-left:4px solid #f59e0b; border-radius:6px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">' +
            '<div style="display:flex; justify-content:space-between; font-size:13px; font-weight:700; color:#d97706;">' +
              '<span>🎉 30% Deseos y Estilo de Vida:</span>' +
              '<span id="resPresupuesto30">$4,800 MXN</span>' +
            '</div>' +
            '<div style="font-size:11.5px; color:#64748b; margin-top:2px;">Salidas, entretenimiento y gustos personales sin culpa.</div>' +
          '</div>' +
          '<div style="background:#ffffff; padding:10px 14px; border-left:4px solid #28C76F; border-radius:6px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">' +
            '<div style="display:flex; justify-content:space-between; font-size:13px; font-weight:700; color:#047857;">' +
              '<span>🛡️ 20% Ahorro e Inversión:</span>' +
              '<span id="resPresupuesto20">$3,200 MXN</span>' +
            '</div>' +
            '<div style="font-size:11.5px; color:#64748b; margin-top:2px;">En 1 año acumulas <strong>$38,400 MXN</strong> directo a tu patrimonio personal.</div>' +
          '</div>' +
        '</div>' +
      '</div>';
    modal.classList.add('open');
    recalcularPresupuestoModal();
    return;
  }

  // 2. CALCULADORA DE FONDO DE EMERGENCIA
  if (t.includes('fondo') || t.includes('emergencia') || t.includes('paz')) {
    currentExerciseType = 'calc_fondo';
    optionsEl.innerHTML = 
      '<div style="background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:12px; padding:16px; margin-bottom:12px;">' +
        '<div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:12px;">' +
          '<div>' +
            '<label style="display:block; font-size:12px; font-weight:700; color:#1e293b; margin-bottom:4px;">Gastos básicos mensuales ($):</label>' +
            '<input type="number" id="inputGastoFondoUser" value="9500" min="1000" step="500" style="width:100%; padding:8px 12px; border:1.5px solid #94a3b8; border-radius:8px; font-weight:700;" oninput="recalcularFondoModal()">' +
          '</div>' +
          '<div>' +
            '<label style="display:block; font-size:12px; font-weight:700; color:#1e293b; margin-bottom:4px;">Meses de respaldo:</label>' +
            '<select id="selectMesesFondoUser" style="width:100%; padding:8px 12px; border:1.5px solid #94a3b8; border-radius:8px; font-weight:700;" onchange="recalcularFondoModal()">' +
              '<option value="3">3 Meses (Ingreso fijo)</option>' +
              '<option value="6" selected>6 Meses (Recomendado estándar)</option>' +
              '<option value="12">12 Meses (Independientes)</option>' +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div style="background:#ecfdf5; border:1.5px solid #a7f3d0; padding:12px 14px; border-radius:8px; color:#06402d;">' +
          '<div style="font-size:12.5px; font-weight:600;">Meta de tu Fondo de Paz Mental:</div>' +
          '<div style="font-size:24px; font-weight:800; color:#047857; margin:2px 0;" id="resFondoTotal">$57,000 MXN</div>' +
          '<div style="font-size:12px; color:#065f46; line-height:1.4;">' +
            '💡 <strong>Regla de oro:</strong> Guardar en cuentas a la vista con rendimiento (CETES Directo Bonddia o cuenta con rendimiento diario). Nunca arriesgar en renta variable.' +
          '</div>' +
        '</div>' +
      '</div>';
    modal.classList.add('open');
    recalcularFondoModal();
    return;
  }

  // 3. SIMULADOR DE INVERSIÓN EN CETES & INTERÉS COMPUESTO
  if (t.includes('cetes') || t.includes('interés') || t.includes('inversión') || t.includes('portafolio') || t.includes('ahorro-inversion')) {
    currentExerciseType = 'calc_cetes';
    optionsEl.innerHTML = 
      '<div style="background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:12px; padding:16px; margin-bottom:12px;">' +
        '<div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:10px;">' +
          '<div>' +
            '<label style="display:block; font-size:12px; font-weight:700; color:#1e293b; margin-bottom:4px;">Inversión inicial ($):</label>' +
            '<input type="number" id="inputCetesInicial" value="3000" min="100" step="500" style="width:100%; padding:8px 12px; border:1.5px solid #94a3b8; border-radius:8px; font-weight:700;" oninput="recalcularCetesModal()">' +
          '</div>' +
          '<div>' +
            '<label style="display:block; font-size:12px; font-weight:700; color:#1e293b; margin-bottom:4px;">Aporte mensual ($):</label>' +
            '<input type="number" id="inputCetesMensual" value="1200" min="100" step="100" style="width:100%; padding:8px 12px; border:1.5px solid #94a3b8; border-radius:8px; font-weight:700;" oninput="recalcularCetesModal()">' +
          '</div>' +
        '</div>' +
        '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">' +
          '<span style="font-size:12px; color:#64748b; font-weight:600;">Tasa estimada CETES: <strong>11% Anual</strong></span>' +
          '<div style="width:120px;">' +
            '<select id="selectCetesAnios" style="width:100%; padding:6px 8px; border:1px solid #94a3b8; border-radius:6px; font-weight:700;" onchange="recalcularCetesModal()">' +
              '<option value="3">3 Años</option>' +
              '<option value="5" selected>5 Años</option>' +
              '<option value="10">10 Años</option>' +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div style="background:#ecfdf5; border:1.5px solid #a7f3d0; padding:12px 14px; border-radius:8px; color:#06402d;">' +
          '<div style="display:flex; justify-content:space-between; align-items:center;">' +
            '<span style="font-size:12.5px; font-weight:600;">Capital estimado final:</span>' +
            '<span style="font-size:22px; font-weight:800; color:#047857;" id="resCetesTotal">$98,400 MXN</span>' +
          '</div>' +
          '<div style="font-size:12px; color:#047857; margin-top:3px;" id="resCetesInteres">' +
            '📈 Ganancia pura por interés compuesto: <strong>$23,400 MXN</strong> sobre tu ahorro.' +
          '</div>' +
        '</div>' +
      '</div>';
    modal.classList.add('open');
    recalcularCetesModal();
    return;
  }

  // 4. QUIZZES ESPECÍFICOS Y CASOS DE ANÁLISIS
  currentExerciseType = 'quiz';
  let pregunta = '¿Cuál es el criterio financiero fundamental que debes aplicar según lo aprendido en esta lección?';
  let opciones = [
    'Anotar mentalmente los gastos y posponer el registro hasta fin de mes',
    'Auditar y registrar tus números reales por escrito antes de realizar cualquier gasto',
    'Pedir un préstamo bancario adicional para pagar gastos corrientes',
    'Esperar a ganar el doble de ingresos antes de comenzar a ahorrar'
  ];
  let correcta = 1;
  let explicacion = '¡Exacto! El principio innegociable de la inteligencia financiera es tener control visible y por escrito de cada peso que entra y sale de tu bolsillo.';

  if (t.includes('score') || t.includes('crédito') || t.includes('deuda')) {
    pregunta = 'Al pagar tus tarjetas de crédito cada mes, ¿cuál es la mejor práctica para proteger tu dinero y tu historial?';
    opciones = [
      'Pagar solamente el monto mínimo marcado en el estado de cuenta',
      'Pagar el saldo total para no generar intereses antes de la fecha límite (ser cliente totalero)',
      'Retirar dinero en efectivo de la tarjeta de crédito para pagar la despensa',
      'Dejar vencer la fecha de pago y negociar una quita con el banco después'
    ];
    correcta = 1;
    explicacion = '¡Correcto! Pagar el monto total para no generar intereses evita que te cobren costos financieros astronómicos y construye un historial crediticio intachable.';
  } else if (t.includes('fibra') || t.includes('inmobiliari') || t.includes('bienes')) {
    pregunta = '¿Por qué las FIBRAs son una excelente alternativa para iniciar en bienes raíces con poco dinero?';
    opciones = [
      'Porque te obligan a comprar una casa completa con crédito Infonavit',
      'Porque permiten comprar títulos desde $20-$100 pesos de portafolios comerciales e industriales que reparten rentas periódicas',
      'Porque nunca fluctúan de precio y están exentas de todo tipo de regulación',
      'Porque sustituyen a las cuentas de débito de los bancos tradicionales'
    ];
    correcta = 1;
    explicacion = '¡Excelente! Las FIBRAs democratizan los bienes raíces: cualquier persona puede comprar participaciones en naves industriales y centros comerciales de alta plusvalía.';
  } else if (t.includes('libertad') || t.includes('retiro') || t.includes('independencia')) {
    pregunta = '¿En qué consiste la regla del 4% para alcanzar la libertad financiera y el retiro temprano?';
    opciones = [
      'En ahorrar el 4% de tu salario durante toda tu vida laboral',
      'En acumular 25 veces tus gastos anuales para poder retirar el 4% anual sin descapitalizar tu portafolio de inversión',
      'En pedir prestado el 4% del valor de tu casa al banco',
      'En invertir el 4% de tu dinero en criptomonedas especulativas'
    ];
    correcta = 1;
    explicacion = '¡Correcto! La regla del 4% (Estudio Trinity) demuestra matemáticamente que retirando el 4% de un portafolio diversificado puedes vivir de tus rentas indefinidamente.';
  }

  currentExerciseCorrectIdx = correcta;
  currentExerciseExplanation = explicacion;

  optionsEl.innerHTML = 
    '<div style="font-size:14px; font-weight:600; color:#1e293b; margin-bottom:12px; line-height:1.5;">' +
      '❓ ' + pregunta +
    '</div>' +
    '<div style="display:flex; flex-direction:column; gap:8px;">' +
      opciones.map(function(opt, idx) {
        return '<div class="exercise-option" onclick="seleccionarOpcionModal(' + idx + ')" id="modalOpt' + idx + '" style="background:#ffffff; border:1.5px solid #d4e7de; border-radius:10px; padding:12px 16px; cursor:pointer; font-size:13.5px; display:flex; align-items:center; gap:10px; transition:all 0.2s ease;">' +
          '<span style="font-size:16px;">🔘</span> <span>' + opt + '</span>' +
        '</div>';
      }).join('') +
    '</div>';

  modal.classList.add('open');
}

function recalcularPresupuestoModal() {
  const el = document.getElementById('inputPresupuestoUser');
  if (!el) return;
  const val = parseFloat(el.value) || 0;
  const n50 = Math.round(val * 0.50);
  const n30 = Math.round(val * 0.30);
  const n20 = Math.round(val * 0.20);
  const t50 = document.getElementById('resPresupuesto50');
  const t30 = document.getElementById('resPresupuesto30');
  const t20 = document.getElementById('resPresupuesto20');
  if (t50) t50.textContent = '$' + n50.toLocaleString('es-MX') + ' MXN';
  if (t30) t30.textContent = '$' + n30.toLocaleString('es-MX') + ' MXN';
  if (t20) t20.textContent = '$' + n20.toLocaleString('es-MX') + ' MXN';
}

function recalcularFondoModal() {
  const gEl = document.getElementById('inputGastoFondoUser');
  const mEl = document.getElementById('selectMesesFondoUser');
  const resEl = document.getElementById('resFondoTotal');
  if (!gEl || !mEl || !resEl) return;
  const gasto = parseFloat(gEl.value) || 0;
  const meses = parseInt(mEl.value, 10) || 6;
  const total = gasto * meses;
  resEl.textContent = '$' + total.toLocaleString('es-MX') + ' MXN';
}

function recalcularCetesModal() {
  const iniEl = document.getElementById('inputCetesInicial');
  const menEl = document.getElementById('inputCetesMensual');
  const aniEl = document.getElementById('selectCetesAnios');
  const totEl = document.getElementById('resCetesTotal');
  const intEl = document.getElementById('resCetesInteres');
  if (!iniEl || !menEl || !aniEl || !totEl) return;
  const inicial = parseFloat(iniEl.value) || 0;
  const mensual = parseFloat(menEl.value) || 0;
  const anios = parseInt(aniEl.value, 10) || 5;
  const mesesTotales = anios * 12;
  const rMensual = 0.11 / 12;

  let total = inicial;
  let totalAportado = inicial;
  for (let i = 1; i <= mesesTotales; i++) {
    total = (total + mensual) * (1 + rMensual);
    totalAportado += mensual;
  }
  const ganancia = Math.round(total - totalAportado);
  totEl.textContent = '$' + Math.round(total).toLocaleString('es-MX') + ' MXN';
  if (intEl) {
    intEl.innerHTML = '📈 Ganancia pura por interés compuesto: <strong>$' + ganancia.toLocaleString('es-MX') + ' MXN</strong> sobre tu ahorro.';
  }
}

function seleccionarOpcionModal(idx) {
  selectedModalOptionIdx = idx;
  for (let i = 0; i < 4; i++) {
    const el = document.getElementById('modalOpt' + i);
    if (el) {
      if (i === idx) {
        el.style.borderColor = 'var(--btn-green)';
        el.style.background = '#e6f7ef';
        el.style.fontWeight = '700';
      } else {
        el.style.borderColor = '#d4e7de';
        el.style.background = '#ffffff';
        el.style.fontWeight = 'normal';
      }
    }
  }
  const feedbackEl = document.getElementById('exerciseModalFeedback');
  if (feedbackEl) feedbackEl.style.display = 'none';
}

function comprobarEjercicioModal() {
  const feedbackEl = document.getElementById('exerciseModalFeedback');
  if (!feedbackEl) return;

  feedbackEl.style.display = 'block';

  if (currentExerciseType === 'calc_presupuesto' || currentExerciseType === 'calc_fondo' || currentExerciseType === 'calc_cetes') {
    feedbackEl.style.background = '#ecfdf5';
    feedbackEl.style.color = '#047857';
    feedbackEl.style.border = '1px solid #a7f3d0';
    feedbackEl.innerHTML = '🎉 <strong>¡Actividad práctica resuelta y guardada!</strong><br>Has configurado tus números financieros con éxito.<br><span style="font-size:12px;">+50 Puntos añadidos a tu perfil de estudiante.</span>';
    return;
  }

  if (selectedModalOptionIdx === null) {
    feedbackEl.style.background = '#fef2f2';
    feedbackEl.style.color = '#b91c1c';
    feedbackEl.style.border = '1px solid #fecaca';
    feedbackEl.textContent = '⚠️ Por favor selecciona una opción antes de comprobar tu respuesta.';
    return;
  }

  if (selectedModalOptionIdx === currentExerciseCorrectIdx) {
    feedbackEl.style.background = '#ecfdf5';
    feedbackEl.style.color = '#047857';
    feedbackEl.style.border = '1px solid #a7f3d0';
    feedbackEl.innerHTML = '🎉 <strong>¡Respuesta correcta!</strong> ' + (currentExerciseExplanation || 'Has demostrado aplicar el criterio financiero adecuado.') + '<br><span style="font-size:12px;">+50 Puntos añadidos a tu perfil de estudiante.</span>';
  } else {
    feedbackEl.style.background = '#fffbeb';
    feedbackEl.style.color = '#b45309';
    feedbackEl.style.border = '1px solid #fde68a';
    feedbackEl.textContent = '❌ Esa no es la mejor opción financiera. Analiza la situación con el método visto en la video-clase e inténtalo de nuevo.';
  }
}

function closeExercisePlayerModal() {
  const modal = document.getElementById('exercisePlayerModal');
  if (modal) modal.classList.remove('open');
}

let currentAudioPlayer = null;
let audioIsPlaying = false;
let audioInterval = null;
let audioSeconds = 0;
let synthUtterance = null;

function reproducirAudioMateria(titulo, duracion, descripcion) {
  const modal = document.getElementById('audioPlayerModal');
  if (!modal) {
    alert('🎧 Reproduciendo podcast: ' + titulo);
    return;
  }

  const titleEl = document.getElementById('audioModalTitle');
  const durEl = document.getElementById('audioModalDuration');
  const descEl = document.getElementById('audioModalDesc');

  if (titleEl) titleEl.textContent = titulo;
  if (durEl) durEl.textContent = 'Duración: ' + (duracion || '18 min');
  if (descEl) descEl.textContent = descripcion || 'Episodio práctico con conceptos clave y aplicación inmediata.';
  
  audioSeconds = 0;
  audioIsPlaying = false;
  clearInterval(audioInterval);
  updateAudioDisplay();
  
  modal.classList.add('open');
  toggleAudioPlayback();
}

function toggleAudioPlayback() {
  const btn = document.getElementById('btnPlayAudioModal');
  const wave = document.getElementById('audioWaveVisual');
  audioIsPlaying = !audioIsPlaying;
  
  if (audioIsPlaying) {
    if (btn) btn.innerHTML = '⏸️ Pausar reproducción';
    if (wave) wave.classList.add('playing');
    playSyntheticVoiceSample();
    audioInterval = setInterval(function() {
      audioSeconds++;
      updateAudioDisplay();
    }, 1000);
  } else {
    if (btn) btn.innerHTML = '▶️ Iniciar reproducción';
    if (wave) wave.classList.remove('playing');
    clearInterval(audioInterval);
    stopSyntheticVoice();
  }
}

function updateAudioDisplay() {
  const timeEl = document.getElementById('audioModalCurrentTime');
  const bar = document.getElementById('audioModalProgressBar');
  const m = Math.floor(audioSeconds / 60);
  const s = audioSeconds % 60;
  if (timeEl) timeEl.textContent = (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
  if (bar) {
    const pct = Math.min(100, (audioSeconds / (18 * 60)) * 100);
    bar.style.width = pct + '%';
  }
}

function closeAudioPlayerModal() {
  const modal = document.getElementById('audioPlayerModal');
  if (modal) modal.classList.remove('open');
  audioIsPlaying = false;
  clearInterval(audioInterval);
  stopSyntheticVoice();
}

function playSyntheticVoiceSample() {
  if ('speechSynthesis' in window) {
    window.speechSynthesis.cancel();
    const title = (document.getElementById('audioModalTitle') && document.getElementById('audioModalTitle').textContent) || 'Episodio';
    const desc = (document.getElementById('audioModalDesc') && document.getElementById('audioModalDesc').textContent) || '';
    synthUtterance = new SpeechSynthesisUtterance('Bienvenido al episodio de audio: ' + title + '. ' + desc + '. Comencemos con los puntos clave.');
    synthUtterance.lang = 'es-MX';
    synthUtterance.rate = 1.0;
    window.speechSynthesis.speak(synthUtterance);
  }
}

function stopSyntheticVoice() {
  if ('speechSynthesis' in window) {
    window.speechSynthesis.cancel();
  }
}

function abrirLibroMateria(titulo, autor, descripcion) {
  const modal = document.getElementById('bookReaderModal');
  if (!modal) {
    alert('📚 Libro: ' + titulo + ' por ' + autor);
    return;
  }

  const titleEl = document.getElementById('bookModalTitle');
  const authorEl = document.getElementById('bookModalAuthor');
  const descEl = document.getElementById('bookModalDesc');

  if (titleEl) titleEl.textContent = titulo;
  if (authorEl) authorEl.textContent = 'Por ' + autor;
  if (descEl) descEl.textContent = descripcion || 'Material oficial y lectura recomendada para este módulo formativo.';
  
  const summaryEl = document.getElementById('bookModalLessons');
  if (summaryEl) {
    summaryEl.innerHTML = 
      '<li><strong>Principio 1:</strong> La diferencia entre ingresos activos y generación de flujo pasivo.</li>' +
      '<li><strong>Principio 2:</strong> Auditar y proteger el 20% de cada peso que ganas.</li>' +
      '<li><strong>Principio 3:</strong> El costo oculto de la deuda y cómo eliminar intereses abusivos.</li>' +
      '<li><strong>Principio 4:</strong> Inversión recurrente automatizada para aprovechar el interés compuesto.</li>' +
      '<li><strong>Principio 5:</strong> Definir tu fecha y número exacto de libertad financiera.</li>';
  }

  modal.classList.add('open');
}

function closeBookReaderModal() {
  const modal = document.getElementById('bookReaderModal');
  if (modal) modal.classList.remove('open');
}

function descargarGuiaPdfActual() {
  const title = (document.getElementById('bookModalTitle') && document.getElementById('bookModalTitle').textContent) || 'Guia-Financiera';
  const author = (document.getElementById('bookModalAuthor') && document.getElementById('bookModalAuthor').textContent) || 'Educación Financiera';
  
  const content = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' + title + '</title>' +
    '<style>body{font-family:sans-serif;padding:40px;color:#1e293b;line-height:1.6;}h1{color:#00703C;}h2{color:#06402d;}ul{margin-bottom:20px;}li{margin-bottom:8px;}</style></head>' +
    '<body><h1>' + title + '</h1><h3>' + author + ' - Guía Oficial de Aprendizaje</h3>' +
    '<hr><p>Esta es la síntesis de estudio para el programa académico de Educación Financiera.</p>' +
    '<h2>5 Principios Clave:</h2><ul>' +
    '<li><strong>1. Diagnóstico de tu dinero:</strong> Conoce tu flujo neto antes de gastar.</li>' +
    '<li><strong>2. Fondo de paz mental:</strong> Construye de 3 a 6 meses de gastos esenciales.</li>' +
    '<li><strong>3. Control de deudas:</strong> Aplica el método Bola de Nieve o Avalancha.</li>' +
    '<li><strong>4. Inversión regulada:</strong> Empieza con CETES directo y ETFs como el S&P 500.</li>' +
    '<li><strong>5. Libertad financiera:</strong> Aplica la regla del 4% para retiro temprano.</li></ul>' +
    '<footer style="margin-top:40px;font-size:12px;color:#64748b;">© Educación Financiera. Todos los derechos reservados.</footer></body></html>';

  const blob = new Blob([content], { type: 'text/html' });
  const a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = title.replace(/[^a-zA-Z0-9]/g, '_') + '_Guia_Oficial.html';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  alert('📥 ¡Descarga iniciada! Se ha generado tu guía oficial en formato digital para consulta sin conexión.');
}

function openReticulaModal(id) {
  const m = getMateriaPorId(id);
  if (!m) return;

  const state = getReticulaState();
  reticulaActualId = id;
  const cfg = getSemestreConfig(m.semestre);

  const levelEl = document.getElementById('reticulaModalLevel');
  const titleEl = document.getElementById('reticulaModalTitle');
  const descEl = document.getElementById('reticulaModalDesc');
  const temarioEl = document.getElementById('reticulaModalTemario');
  const estadoEl = document.getElementById('reticulaModalEstado');
  const actionEl = document.getElementById('reticulaModalAction');

  if (levelEl) levelEl.textContent = (cfg ? cfg.titulo : 'Semestre ' + m.semestre) + ' · ' + m.icon;
  if (titleEl) titleEl.textContent = m.nombre;
  if (descEl) descEl.textContent = m.desc;
  if (temarioEl) {
    temarioEl.innerHTML = m.temario.map(function (t) { return '<li>' + t + '</li>'; }).join('');
  }

  // Actualizar conteos de badges
  const bV = document.getElementById('badgeVideos');
  const bE = document.getElementById('badgeEjercicios');
  const bA = document.getElementById('badgeAudios');
  const bL = document.getElementById('badgeLibros');
  if (bV) bV.textContent = m.videos ? m.videos.length : 0;
  if (bE) bE.textContent = m.ejercicios ? m.ejercicios.length : 0;
  if (bA) bA.textContent = m.audios ? m.audios.length : 0;
  if (bL) bL.textContent = m.libros ? m.libros.length : 0;

  // Renderizar Videos
  const videosEl = document.getElementById('reticulaModalVideos');
  if (videosEl) {
    if (m.videos && m.videos.length > 0) {
      videosEl.innerHTML = m.videos.map(function (v, idx) {
        return '<div class="resource-item-card">' +
          '<div class="resource-item-left">' +
            '<div class="resource-item-icon">🎬</div>' +
            '<div class="resource-item-info">' +
              '<h5>Clase ' + (idx + 1) + ': ' + v.titulo + '</h5>' +
              '<div class="resource-meta-tags">' +
                '<span class="resource-pill pill-video">Video lección</span>' +
                '<span class="resource-pill pill-duration">⏱️ ' + v.duracion + '</span>' +
              '</div>' +
            '</div>' +
          '</div>' +
          '<button type="button" class="btn-resource-action" onclick="reproducirVideoMateria(\'' + v.titulo.replace(/'/g, "\\'") + '\', \'' + v.url + '\')">▶ Ver video</button>' +
        '</div>';
      }).join('');
    } else {
      videosEl.innerHTML = '<p style="color:var(--text-muted); font-size:13px;">Próximamente más videos disponibles.</p>';
    }
  }

  // Renderizar Ejercicios
  const ejerciciosEl = document.getElementById('reticulaModalEjercicios');
  if (ejerciciosEl) {
    if (m.ejercicios && m.ejercicios.length > 0) {
      ejerciciosEl.innerHTML = m.ejercicios.map(function (e, idx) {
        const tipoClass = 'pill-' + (e.tipo || 'practica');
        const tipoLabel = (e.tipo || 'Práctica').toUpperCase();
        return '<div class="resource-item-card">' +
          '<div class="resource-item-left">' +
            '<div class="resource-item-icon">📝</div>' +
            '<div class="resource-item-info">' +
              '<h5>' + (idx + 1) + '. ' + e.titulo + '</h5>' +
              '<p>' + e.descripcion + '</p>' +
              '<div class="resource-meta-tags">' +
                '<span class="resource-pill ' + tipoClass + '">' + tipoLabel + '</span>' +
              '</div>' +
            '</div>' +
          '</div>' +
          '<button type="button" class="btn-resource-action" onclick="abrirEjercicioMateria(\'' + e.titulo.replace(/'/g, "\\'") + '\', \'' + e.descripcion.replace(/'/g, "\\'") + '\')">Resolver</button>' +
        '</div>';
      }).join('');
    } else {
      ejerciciosEl.innerHTML = '<p style="color:var(--text-muted); font-size:13px;">Próximamente más ejercicios disponibles.</p>';
    }
  }

  // Renderizar Audios
  const audiosEl = document.getElementById('reticulaModalAudios');
  if (audiosEl) {
    if (m.audios && m.audios.length > 0) {
      audiosEl.innerHTML = m.audios.map(function (a, idx) {
        return '<div class="resource-item-card">' +
          '<div class="resource-item-left">' +
            '<div class="resource-item-icon">🎧</div>' +
            '<div class="resource-item-info">' +
              '<h5>Episodio ' + (idx + 1) + ': ' + a.titulo + '</h5>' +
              '<p>' + a.descripcion + '</p>' +
              '<div class="resource-meta-tags">' +
                '<span class="resource-pill pill-audio">Podcast / Audio</span>' +
                '<span class="resource-pill pill-duration">⏱️ ' + a.duracion + '</span>' +
              '</div>' +
            '</div>' +
          '</div>' +
          '<button type="button" class="btn-resource-action" onclick="reproducirAudioMateria(\'' + a.titulo.replace(/'/g, "\\'") + '\', \'' + a.duracion + '\', \'' + (a.descripcion || '').replace(/'/g, "\\'") + '\')">▶ Escuchar</button>' +
        '</div>';
      }).join('');
    } else {
      audiosEl.innerHTML = '<p style="color:var(--text-muted); font-size:13px;">Próximamente más audios disponibles.</p>';
    }
  }

  // Renderizar Libros
  const librosEl = document.getElementById('reticulaModalLibros');
  if (librosEl) {
    if (m.libros && m.libros.length > 0) {
      librosEl.innerHTML = m.libros.map(function (l, idx) {
        return '<div class="resource-item-card">' +
          '<div class="resource-item-left">' +
            '<div class="resource-item-icon">📖</div>' +
            '<div class="resource-item-info">' +
              '<h5>' + l.titulo + '</h5>' +
              '<p><strong>Autor:</strong> ' + l.autor + ' · ' + l.descripcion + '</p>' +
              '<div class="resource-meta-tags">' +
                '<span class="resource-pill pill-book">' + (l.tipo ? l.tipo.toUpperCase() : 'EBOOK') + '</span>' +
                '<span class="resource-pill pill-practica">Guía Oficial</span>' +
              '</div>' +
            '</div>' +
          '</div>' +
          '<button type="button" class="btn-resource-action" onclick="abrirLibroMateria(\'' + l.titulo.replace(/'/g, "\\'") + '\', \'' + l.autor.replace(/'/g, "\\'") + '\', \'' + (l.descripcion || '').replace(/'/g, "\\'") + '\')">📥 Descargar</button>' +
        '</div>';
      }).join('');
    } else {
      librosEl.innerHTML = '<p style="color:var(--text-muted); font-size:13px;">Próximamente más libros disponibles.</p>';
    }
  }

  // Seleccionar tab inicial
  switchReticulaTab('temario');

  let tipo = 'info';
  let texto = '';
  let label = 'Inscribirme';
  let deshabilitado = false;

  if (state.inscritas.indexOf(id) !== -1) {
    tipo = 'ok';
    texto = '✓ Materia activa. ¡Explora las pestañas de Videos, Ejercicios Interactivos, Podcasts y Libros!';
    label = '▶ Abrir lección en Aula Virtual';
    deshabilitado = false;
  } else {
    const chk = puedeInscribir(id);
    if (chk.ok) {
      tipo = 'warn';
      texto = '🟡 Materia disponible. Puedes inscribirte ahora mismo y acceder a todos sus recursos.';
      label = 'Inscribirme a esta materia';
    } else if (chk.motivo === 'pago') {
      tipo = 'info';
      texto = '🔒 Esta materia pertenece al ' + (cfg ? cfg.titulo : 'Semestre ' + m.semestre) + '. Tu Semestre 1 (Nivel Básico) es de prueba 100% GRATIS. Para acceder del Semestre 2 en adelante necesitas pagar tu inscripción de $299 MXN (SPEI o Tarjeta).';
      label = 'Pagar inscripción y desbloquear acceso →';
      deshabilitado = false;
    } else if (chk.motivo === 'bloqueado') {
      tipo = 'info';
      const prevSem = m.semestre - 1;
      const faltan = cfg ? Math.max(0, cfg.requeridoPrevio - contarInscritasEnSemestre(state, prevSem)) : 1;
      texto = '🔒 Para inscribir esta materia primero debes completar ' + faltan +
        (faltan === 1 ? ' materia' : ' materias') + ' del Semestre ' + prevSem + '.';
      label = 'Completa el semestre anterior';
      deshabilitado = true;
    } else if (chk.motivo === 'limite') {
      const limite = cfg ? cfg.limite : 1;
      tipo = 'info';
      texto = '⏳ Ya alcanzaste el límite de ' + limite +
        (limite === 1 ? ' materia' : ' materias') + ' en este semestre. Ya tienes todas las materias disponibles.';
      label = 'Sin cupo este semestre';
      deshabilitado = true;
    } else {
      deshabilitado = true;
    }
  }

  if (estadoEl) {
    estadoEl.setAttribute('data-tipo', tipo);
    estadoEl.textContent = texto;
  }
  if (actionEl) {
    actionEl.textContent = label;
    actionEl.disabled = deshabilitado;
  }

  const modal = document.getElementById('reticulaModal');
  if (modal) modal.classList.add('open');
}

function closeReticulaModal() {
  const modal = document.getElementById('reticulaModal');
  if (modal) modal.classList.remove('open');
  reticulaActualId = null;
}

function inscribirMateriaActual() {
  if (!reticulaActualId) return;
  const id = reticulaActualId;
  const state = getReticulaState();

  // Si ya está inscrita, ir directo al Aula Demo
  if (state.inscritas.indexOf(id) !== -1) {
    window.location.href = 'index.php?page=aula';
    return;
  }

  const chk = puedeInscribir(id);
  if (!chk.ok) {
    if (chk.motivo === 'pago') {
      window.location.href = 'index.php?page=suscripcion';
      return;
    }
    openReticulaModal(id);
    return;
  }

  state.inscritas.push(id);
  saveReticulaState(state);

  renderReticula();
  openReticulaModal(id);
}

// ------------------------------------------------------------
// 16. CONFIGURACIONES (PERFIL, SEGURIDAD Y PREFERENCIAS)
// ------------------------------------------------------------
const PREFS_KEY = 'edu_fin_prefs_';
const PREF_DEFAULTS = { recordatorios: true, novedades: true, tema: 'claro' };

function getPrefsStorageKey() {
  const user = getCurrentUser();
  const who = (user && user.email) ? String(user.email).toLowerCase() : 'invitado';
  return PREFS_KEY + who;
}

function getPrefs() {
  try {
    const raw = localStorage.getItem(getPrefsStorageKey());
    const parsed = raw ? JSON.parse(raw) : null;
    if (parsed && typeof parsed === 'object') {
      return Object.assign({}, PREF_DEFAULTS, parsed);
    }
  } catch (e) {}
  return Object.assign({}, PREF_DEFAULTS);
}

function savePrefs(prefs) {
  try {
    localStorage.setItem(getPrefsStorageKey(), JSON.stringify(prefs));
  } catch (e) {}
}

function renderConfiguracion() {
  const profileForm = document.getElementById('configProfileForm');
  if (!profileForm) return;

  const user = getCurrentUser();
  const nombre = (user && user.name) ? user.name : '';
  const correo = (user && user.email) ? user.email : '';

  const avatar = document.getElementById('configAvatar');
  if (avatar) avatar.textContent = nombre ? nombre.charAt(0).toUpperCase() : 'E';

  const nameEl = document.getElementById('configName');
  const emailEl = document.getElementById('configEmail');
  if (nameEl && document.activeElement !== nameEl) nameEl.value = nombre;
  if (emailEl && document.activeElement !== emailEl) emailEl.value = correo;

  const prefs = getPrefs();
  const rec = document.getElementById('prefRecordatorios');
  const nov = document.getElementById('prefNovedades');
  const tema = document.getElementById('prefTema');
  if (rec) rec.checked = !!prefs.recordatorios;
  if (nov) nov.checked = !!prefs.novedades;
  if (tema) tema.value = prefs.tema || 'claro';
}

async function handleProfileSubmit(e) {
  e.preventDefault();
  const user = getCurrentUser();
  const msg = document.getElementById('configProfileMsg');
  if (!user) return;
  if (msg) { msg.className = 'form-message'; msg.textContent = ''; }

  const nameEl = document.getElementById('configName');
  const emailEl = document.getElementById('configEmail');
  const name = nameEl ? nameEl.value.trim() : '';
  const email = emailEl ? emailEl.value.trim().toLowerCase() : '';
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (name.length < 2) {
    if (nameEl) nameEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Ingresa tu nombre completo.'; }
    return;
  }
  if (!emailRegex.test(email)) {
    if (emailEl) emailEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Ingresa un correo electrónico válido.'; }
    return;
  }

  const submitBtn = document.getElementById('configProfileForm') ? document.getElementById('configProfileForm').querySelector('button[type="submit"]') : null;
  if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Guardando...'; }

  try {
    const res = await fetch(API_BASE + '/index.php?endpoint=actualizar-perfil', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', ...getCsrfHeaders() },
      credentials: 'include',
      body: JSON.stringify({ nombre: name, email: email, csrf_token: CSRF_TOKEN })
    });
    const data = await res.json();

    if (data.success) {
      setCurrentUser({ name: name, email: email });
      updateAuthUI();
      if (msg) { msg.className = 'form-message success'; msg.textContent = '✅ Perfil actualizado correctamente.'; }
    } else {
      if (msg) { msg.className = 'form-message error'; msg.textContent = data.message || 'Error al actualizar el perfil.'; }
    }
  } catch (err) {
    // Si no hay respuesta del backend, actualizar al menos en almacenamiento local
    setCurrentUser({ name: name, email: email });
    updateAuthUI();
    if (msg) { msg.className = 'form-message success'; msg.textContent = '✅ Perfil actualizado localmente.'; }
  } finally {
    if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Guardar cambios'; }
  }
}

async function handlePasswordSubmit(e) {
  e.preventDefault();
  const user = getCurrentUser();
  const msg = document.getElementById('configPasswordMsg');
  if (!user) return;
  if (msg) { msg.className = 'form-message'; msg.textContent = ''; }

  const curEl = document.getElementById('configCurrentPassword');
  const newEl = document.getElementById('configNewPassword');
  const confEl = document.getElementById('configConfirmPassword');
  const current = curEl ? curEl.value : '';
  const nueva = newEl ? newEl.value : '';
  const conf = confEl ? confEl.value : '';

  [curEl, newEl, confEl].forEach(function (i) { if (i) i.classList.remove('input-invalid'); });

  if (!current) {
    if (curEl) curEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Ingresa tu contraseña actual.'; }
    return;
  }
  if (nueva.length < 8) {
    if (newEl) newEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'La nueva contraseña debe tener al menos 8 caracteres.'; }
    return;
  }
  // Validar complejidad: al menos una mayúscula, un número y un carácter especial
  const hasUpper = /[A-Z]/.test(nueva);
  const hasNumber = /[0-9]/.test(nueva);
  const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(nueva);
  if (!hasUpper || !hasNumber || !hasSpecial) {
    if (newEl) newEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'La contraseña debe incluir mayúscula, número y carácter especial (!@#$%...).'; }
    return;
  }
  if (nueva !== conf) {
    if (confEl) confEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Las contraseñas no coinciden.'; }
    return;
  }

  // Verificar contraseña actual y actualizar vía API
  const submitBtn = document.getElementById('configPasswordForm') ? document.getElementById('configPasswordForm').querySelector('button[type="submit"]') : null;
  if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Actualizando...'; }

  try {
    // Verificar y actualizar contraseña vía API
    const res = await fetch(API_BASE + '/index.php?endpoint=cambiar-password', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', ...getCsrfHeaders() },
      credentials: 'include',
      body: JSON.stringify({ password_actual: current, password_nueva: nueva, csrf_token: CSRF_TOKEN })
    });
    const data = await res.json();

    if (data.success) {
      if (msg) { msg.className = 'form-message success'; msg.textContent = '✅ Contraseña actualizada correctamente.'; }
      const form = document.getElementById('configPasswordForm');
      if (form) form.reset();
    } else {
      if (data.message && data.message.includes('actual')) {
        if (curEl) curEl.classList.add('input-invalid');
      }
      if (msg) { msg.className = 'form-message error'; msg.textContent = data.message || 'Error al actualizar la contraseña.'; }
    }
  } catch (err) {
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Error de conexión. Intenta de nuevo.'; }
  } finally {
    if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Actualizar contraseña'; }
  }
}

function togglePref(key, value) {
  const prefs = getPrefs();
  prefs[key] = value;
  savePrefs(prefs);
}

// ------------------------------------------------------------
// ELIMINAR CUENTA (BAJA PERMANENTE)
// ------------------------------------------------------------
async function deleteAccount() {
  try {
    const user = getCurrentUser();
    const email = (user && user.email) ? String(user.email).toLowerCase() : '';

    // Eliminar cuenta en el servidor (base de datos + destrucción de sesión)
    try {
      await fetch(API_BASE + '/index.php?endpoint=eliminar-cuenta', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', ...getCsrfHeaders() },
        credentials: 'include',
        body: JSON.stringify({ csrf_token: CSRF_TOKEN })
      });
    } catch (e) {}

    if (email) {
      // Borrar datos del usuario en localStorage (inscripciones, membresía, prefs)
      const keysToRemove = [];
      for (let i = 0; i < localStorage.length; i++) {
        const k = localStorage.key(i);
        if (k && k.includes(email)) keysToRemove.push(k);
      }
      keysToRemove.forEach(k => { try { localStorage.removeItem(k); } catch (e) {} });
    }

    // Cerrar sesión local
    try { localStorage.removeItem(SESSION_KEY); } catch (e) {}
    updateAuthUI();
    alert('Tu cuenta ha sido eliminada permanentemente.');
    window.location.href = 'index.php';
  } catch (e) {
    alert('No se pudo eliminar la cuenta. Intenta de nuevo.');
  }
}

// ------------------------------------------------------------
// INICIALIZACIÓN DE BOTONES DE CONFIGURACIÓN
// ------------------------------------------------------------
function initConfigButtons() {
  const btn = document.getElementById('btnDeleteAccount');
  if (btn && !btn.dataset.bound) {
    btn.dataset.bound = '1';
    btn.addEventListener('click', function () {
      if (confirm('¿Seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
        deleteAccount();
      }
    });
  }
}
initConfigButtons();


// ------------------------------------------------------------
// 17. ASISTENTE FINANCIERO "NEXO" (local, por reglas)
// ------------------------------------------------------------
const FIN_CONOCIMIENTO = [
  {
    claves: ['ahorro', 'ahorrar', 'guardar dinero', 'fondo de emergencia', 'emergencia'],
    respuesta: 'El ahorro es la base de tu salud financiera: aparta primero una parte de tus ingresos y gasta después. Empieza con un fondo de emergencia de 3 a 6 meses de tus gastos fijos.',
    enlaces: [{ texto: 'Ver cursos de ahorro', href: 'index.php?page=cursos' }]
  },
  {
    claves: ['interes compuesto', 'interes', 'inversion', 'invertir', 'rendimiento', 'capital'],
    respuesta: 'El interés compuesto es ganar intereses sobre tus intereses. Con el tiempo, ese efecto hace crecer tu dinero de forma exponencial. Puedes probarlo en la calculadora de Recursos.',
    enlaces: [{ texto: 'Abrir calculadora', href: 'index.php?page=recursos' }]
  },
  {
    claves: ['presupuesto', '50/30/20', 'gastos', 'ingresos', 'planificar'],
    respuesta: 'La regla 50/30/20 sugiere destinar 50% de tus ingresos a necesidades, 30% a gustos y 20% a ahorro o deudas. Es una guía simple para ordenar tus finanzas cada mes.',
    enlaces: [{ texto: 'Ver curso de presupuesto', href: 'index.php?page=cursos' }]
  },
  {
    claves: ['deuda', 'deudas', 'tarjeta', 'tarjeta de credito', 'credito', 'prestamo'],
    respuesta: 'Para salir de deudas, prioriza las de mayor interés (método avalancha) o las más pequeñas para ganar impulso (método bola de nieve). Evita financiar gustos con tarjeta de crédito.',
    enlaces: [{ texto: 'Ver recursos', href: 'index.php?page=recursos' }]
  },
  {
    claves: ['reticula', 'inscribir', 'inscripcion', 'semestre', 'materia', 'materias', 'curso'],
    respuesta: 'En tu Retícula Académica puedes inscribir hasta 3 materias por semestre. Entra y haz clic en cada materia para ver su temario e inscribirte.',
    enlaces: [{ texto: 'Ir a Retícula', href: 'index.php?page=reticula' }]
  },
  {
    claves: ['contrasena', 'contraseña', 'configuracion', 'configuraciones', 'perfil', 'cuenta', 'correo'],
    respuesta: 'Puedes actualizar tu perfil, cambiar tu contraseña y ajustar tus preferencias desde la página de Configuraciones.',
    enlaces: [{ texto: 'Ir a Configuraciones', href: 'index.php?page=configuraciones' }]
  },
  {
    claves: ['contacto', 'soporte', 'ayuda', 'duda', 'problema', 'correo de contacto'],
    respuesta: 'Estoy aquí para orientarte sobre finanzas y sobre cómo usar la plataforma. Si necesitas soporte, revisa la sección de Recursos.',
    enlaces: [{ texto: 'Ver Recursos', href: 'index.php?page=recursos' }]
  },
  {
    claves: ['hola', 'buenas', 'buenos dias', 'buenas tardes', 'hey', 'saludos', 'que tal'],
    respuesta: '¡Hola! Soy NEXO 🤖. Puedo explicarte conceptos de finanzas o guiarte por la plataforma. ¿Qué necesitas?',
    enlaces: []
  },
  {
    claves: ['gracias', 'muchas gracias', 'perfecto', 'excelente', 'genial'],
    respuesta: '¡Con gusto! 💚 Si tienes otra duda sobre tus finanzas, aquí estoy.',
    enlaces: []
  }
];

const FIN_SUGERENCIAS = [
  { label: '¿Qué es el ahorro?', texto: '¿Qué es el ahorro?' },
  { label: 'Interés compuesto', texto: 'Explícame el interés compuesto' },
  { label: 'Presupuesto 50/30/20', texto: 'Cómo hago un presupuesto 50/30/20' },
  { label: 'Cómo inscribirme', texto: 'Cómo me inscribo en la retícula' },
  { label: 'Cambiar contraseña', texto: 'Cómo cambio mi contraseña' }
];

function finNormalizar(txt) {
  return (txt || '').toString().toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .replace(/[¿?¡!.,;:()"'`]/g, ' ')
    .replace(/\s+/g, ' ').trim();
}

function finEscapar(txt) {
  return (txt || '').toString().replace(/[&<>]/g, function (c) {
    return { '&': '&amp;', '<': '&lt;', '>': '&gt;' }[c];
  });
}

function finBuscarRespuesta(texto) {
  const q = finNormalizar(texto);
  if (!q) return null;
  let mejor = null;
  let mejorPunt = 0;
  FIN_CONOCIMIENTO.forEach(function (tema) {
    let punt = 0;
    tema.claves.forEach(function (k) {
      const kk = finNormalizar(k);
      if (kk && q.includes(kk)) punt += kk.indexOf(' ') !== -1 ? 2 : 1;
    });
    if (punt > mejorPunt) { mejorPunt = punt; mejor = tema; }
  });
  return mejor;
}

function finConstruirRespuesta(tema) {
  let html = finEscapar(tema.respuesta);
  if (tema.enlaces && tema.enlaces.length) {
    const links = tema.enlaces.map(function (l) {
      return '<a href="' + l.href + '">' + finEscapar(l.texto) + '</a>';
    }).join(' · ');
    html += '\n' + links;
  }
  return html;
}

function initAsistente() {
  if (document.getElementById('finToggle')) return;

  const nexoBotHTML =
    '<span class="nexo-bot">' +
      '<span class="nexo-antenna"></span>' +
      '<span class="nexo-head">' +
        '<span class="nexo-eyes"><i></i><i></i></span>' +
        '<span class="nexo-mouth"></span>' +
      '</span>' +
    '</span>';

  const btn = document.createElement('button');
  btn.id = 'finToggle';
  btn.className = 'fin-btn';
  btn.setAttribute('type', 'button');
  btn.setAttribute('aria-label', 'Abrir asistente NEXO');
  btn.innerHTML = nexoBotHTML + '<span class="fin-btn-ping"></span>';

  const panel = document.createElement('div');
  panel.id = 'finPanel';
  panel.className = 'fin-panel';
  panel.setAttribute('role', 'dialog');
  panel.setAttribute('aria-label', 'Asistente NEXO');
  panel.innerHTML =
    '<div class="fin-header">' +
      '<div class="fin-avatar">' + nexoBotHTML + '</div>' +
      '<div class="fin-header-text"><strong>NEXO</strong><span><i class="fin-online-dot"></i>En línea · Asistente financiero</span></div>' +
      '<button class="fin-close" id="finClose" type="button" aria-label="Cerrar">×</button>' +
    '</div>' +
    '<div class="fin-messages" id="finMessages"></div>' +
    '<div class="fin-chips" id="finChips"></div>' +
    '<form class="fin-form" id="finForm">' +
      '<input type="text" id="finInput" placeholder="Escribe tu pregunta..." autocomplete="off" />' +
      '<button type="submit" aria-label="Enviar">➤</button>' +
    '</form>';

  document.body.appendChild(btn);
  document.body.appendChild(panel);

  const messages = panel.querySelector('#finMessages');
  const chips = panel.querySelector('#finChips');
  const form = panel.querySelector('#finForm');
  const input = panel.querySelector('#finInput');
  let yaSaludo = false;

  function agregar(rol, html) {
    const div = document.createElement('div');
    div.className = 'fin-msg ' + rol;
    div.innerHTML = html;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
    return div;
  }

  function pintarSugerencias() {
    chips.innerHTML = '';
    FIN_SUGERENCIAS.forEach(function (s) {
      const b = document.createElement('button');
      b.type = 'button';
      b.className = 'fin-chip';
      b.textContent = s.label;
      b.addEventListener('click', function () { enviar(s.texto); });
      chips.appendChild(b);
    });
  }

  function responder(texto) {
    const escribiendo = agregar('bot', '<span class="fin-typing"><span></span><span></span><span></span></span>');
    setTimeout(function () {
      escribiendo.remove();
      const tema = finBuscarRespuesta(texto);
      if (tema) {
        agregar('bot', finConstruirRespuesta(tema));
      } else {
        agregar('bot', 'Aún estoy aprendiendo sobre ese tema 🤔. Prueba con una de estas preguntas o escríbela de otra forma:');
        pintarSugerencias();
      }
    }, 420);
  }

  function enviar(texto) {
    const t = (texto || '').trim();
    if (!t) return;
    agregar('user', finEscapar(t));
    input.value = '';
    responder(t);
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    enviar(input.value);
  });

  btn.addEventListener('click', function () {
    const abrir = !panel.classList.contains('open');
    panel.classList.toggle('open', abrir);
    btn.setAttribute('aria-label', abrir ? 'Cerrar asistente NEXO' : 'Abrir asistente NEXO');
    if (abrir) {
      if (!yaSaludo) {
        yaSaludo = true;
        agregar('bot', '¡Hola! Soy <strong>NEXO</strong> 🤖, tu asistente financiero. ¿En qué te ayudo hoy?');
        pintarSugerencias();
      }
      setTimeout(function () { input.focus(); }, 150);
    }
  });

  panel.querySelector('#finClose').addEventListener('click', function () {
    panel.classList.remove('open');
  });
}

function cerrarAsistente() {
  const panel = document.getElementById('finPanel');
  if (panel) panel.classList.remove('open');
}

// (La inicialización ocurre en el evento DOMContentLoaded de arriba)
initAsistente();// ------------------------------------------------------------
// 18. WHATSAPP QUICK CONTACT
// ------------------------------------------------------------
  const WHATSAPP_NUM = '5210000000000'; // ⚠️ CAMBIAR POR NÚMERO REAL DE WHATSAPP ANTES DE PRODUCCIÓN
  const WHATSAPP_OPTS = [
    { label: 'Dudas de cursos', texto: 'Hola, tengo una duda sobre los cursos de Educación Financiera.' },
    { label: 'Soporte técnico', texto: 'Hola, necesito soporte para acceder a la plataforma.' },
  { label: 'Certificaciones', texto: 'Hola, tengo dudas sobre las certificaciones.' }
];

function abrirWhatsApp(msg) {
  const texto = encodeURIComponent(msg || 'Hola, me gustar�a recibir ayuda.');
  const url = 'https://wa.me/' + WHATSAPP_NUM.replace(/\D/g,'') + '?text=' + texto;
  window.open(url, '_blank');
}

function cerrarWhatsApp() {
  const panel = document.getElementById('wappPanel');
  if (panel) panel.classList.remove('open');
}

function initWhatsApp() {
  if (document.getElementById('wappToggle')) return;

  const svgWa = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M20.52 3.449C12.831-3.984 0 1.407 0 11.251c0 2.05.549 4.052 1.596 5.828L0 24l6.242-1.636c1.746.954 3.719 1.461 5.725 1.461 9.72 0 15.52-10.556 8.553-20.376zm-8.198 17.029c-1.676 0-3.321-.486-4.752-1.403l-.34-.202-3.703.971.987-3.614-.222-.357C1.687 13.801 2.172 7.591 7.07 4.537 11.968 1.482 18.18 4.904 19.76 9.795c1.58 4.892-.29 10.211-5.438 12.683zm5.436-7.554c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>';
  const btn = document.createElement('button');
  btn.id = 'wappToggle';
  btn.className = 'wapp-btn';
  btn.setAttribute('type','button');
  btn.setAttribute('aria-label','Abrir WhatsApp');
  btn.innerHTML = svgWa;

  const panel = document.createElement('div');
  panel.id = 'wappPanel';
  panel.className = 'wapp-panel';
  panel.setAttribute('role','dialog');
  panel.setAttribute('aria-label','Atención por WhatsApp');
  panel.innerHTML =
    '<div class="wapp-header">' +
      '<div class="wapp-avatar">' +
        '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM20.52 3.449C12.831-3.984 0 1.407 0 11.251c0 2.05.549 4.052 1.596 5.828L0 24l6.242-1.636c1.746.954 3.719 1.461 5.725 1.461 9.72 0 15.52-10.556 8.553-20.376z"/></svg>' +
      '</div>' +
      '<div class="wapp-header-text"><strong>Atención por WhatsApp</strong><span>En línea para ayudarte</span></div>' +
      '<button class="wapp-close" id="wappClose" type="button" aria-label="Cerrar">×</button>' +
    '</div>' +
    '<div class="wapp-body">' +
      '<div class="wapp-hint">¿En qué puedo ayudarte?</div>' +
      (WHATSAPP_OPTS.map(function(o){ return '<button class="wapp-option" data-text="'+o.texto.replace(/"/g,'&quot;')+'">'+o.label+'</button>'; }).join('')) +
    '</div>';

  document.body.appendChild(btn);
  document.body.appendChild(panel);

  panel.querySelectorAll('.wapp-option').forEach(function(b){
    b.addEventListener('click', function(){
      abrirWhatsApp(this.getAttribute('data-text'));
      cerrarWhatsApp();
    });
  });
  btn.addEventListener('click', function(){
    panel.classList.toggle('open');
  });
  panel.querySelector('#wappClose').addEventListener('click', cerrarWhatsApp);
}

document.addEventListener('DOMContentLoaded', function(){ initWhatsApp(); });
initWhatsApp();

document.addEventListener('DOMContentLoaded', function () {
  if (getCurrentUser()) return;
  const hash = (window.location.hash || '').toLowerCase();
  if (hash !== '#login' && hash !== '#signup') return;
  if (hash === '#login') {
    openLoginModal();
  } else {
    openSignupModal();
  }
  if (history.replaceState) {
    history.replaceState(null, '', window.location.pathname + window.location.search);
  }
});
