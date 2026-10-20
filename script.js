// ============================================================
// ESCUELA FINANCIERA - JAVASCRIPT GLOBAL
// ============================================================

// Claves de almacenamiento local
const USERS_KEY = 'edu_fin_users';
const SESSION_KEY = 'edu_fin_session';

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

  // Si es Finanzas personales, incluir accesos rápidos a los tutoriales de gastos hormiga y ahorro
  const extraContent = document.getElementById('modalExtraContent');
  if (extraContent) {
    if (title === 'Finanzas personales') {
      extraContent.innerHTML = `
        <div class="modal-extra-heading">
          <span>🐜🌱</span> Tutoriales prácticos incluidos:
        </div>
        <div class="modal-extra-list">
          <div class="modal-extra-item" onclick="closeModal(); openTutorialModal('gastos-hormiga-1');">
            <div class="modal-extra-item-left">
              <span class="icon">🔍</span>
              <div>
                <strong>¿Qué son los Gastos Hormiga y cómo detectarlos?</strong>
                <small>Calculadora interactiva de fugas silenciosas</small>
              </div>
            </div>
            <span class="arrow">→</span>
          </div>
          <div class="modal-extra-item" onclick="closeModal(); openTutorialModal('gastos-hormiga-2');">
            <div class="modal-extra-item-left">
              <span class="icon">🔄</span>
              <div>
                <strong>Método de Sustitución Inteligente</strong>
                <small>Matriz de reemplazo de gastos sin sufrir</small>
              </div>
            </div>
            <span class="arrow">→</span>
          </div>
          <div class="modal-extra-item" onclick="closeModal(); openTutorialModal('ahorro-1');">
            <div class="modal-extra-item-left">
              <span class="icon">💰</span>
              <div>
                <strong>De $0 a tu primer ahorro: "Págate a ti primero"</strong>
                <small>Simulador por porcentaje y metas quincenales</small>
              </div>
            </div>
            <span class="arrow">→</span>
          </div>
          <div class="modal-extra-item" onclick="closeModal(); openTutorialModal('ahorro-2');">
            <div class="modal-extra-item-left">
              <span class="icon">🛡️</span>
              <div>
                <strong>Cómo construir tu Fondo de Emergencia</strong>
                <small>Calculadora de colchón de 1 a 3 meses y semáforo</small>
              </div>
            </div>
            <span class="arrow">→</span>
          </div>
        </div>
      `;
    } else {
      extraContent.innerHTML = '';
    }
  }

  if (modalOverlay) modalOverlay.classList.add('open');
}

function openResourceModal(title, desc) {
  if (!getCurrentUser()) {
    openLoginModal();
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = '🔒 Inicia sesión o crea tu cuenta para acceder a las herramientas y calculadoras.';
    }
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
      { name: 'Finanzas personales', type: 'Curso', link: 'cursos.html' },
      { name: 'Ahorro e inversión', type: 'Curso', link: 'cursos.html' },
      { name: 'Presupuesto mensual 50/30/20', type: 'Curso', link: 'cursos.html' },
      { name: 'Emprendimiento y negocios', type: 'Curso', link: 'cursos.html' },
      { name: 'Calculadora de interés compuesto', type: 'Recurso', link: 'recursos.html' },
      { name: 'Guía de ahorro descargable en PDF', type: 'Recurso', link: 'recursos.html' }
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

function handleLoginSubmit(e) {
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

  const users = getUsers();
  const user = users.find(u => u.email.toLowerCase() === email.toLowerCase() && u.password === pass);
  if (!user) {
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = 'Correo o contraseña incorrectos. Si olvidaste tu contraseña, haz clic en "¿Olvidaste tu contraseña?".';
    }
    return;
  }

  setCurrentUser(user);
  updateAuthUI();
  closeLoginModal();
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

function handleForgotSubmit(e) {
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
  if (pass.length < 6) {
    if (forgotPassword) forgotPassword.classList.add('input-invalid');
    if (forgotPasswordErr) forgotPasswordErr.style.display = 'block';
    valid = false;
  }
  if (confirm !== pass) {
    if (forgotConfirm) forgotConfirm.classList.add('input-invalid');
    if (forgotConfirmErr) forgotConfirmErr.style.display = 'block';
    valid = false;
  }
  if (!valid) return;

  const users = getUsers();
  const userIndex = users.findIndex(u => u.email.toLowerCase() === email.toLowerCase());

  if (userIndex === -1) {
    if (forgotMsg) {
      forgotMsg.className = 'form-message error';
      forgotMsg.textContent = 'No encontramos ninguna cuenta registrada con ese correo electrónico.';
    }
    return;
  }

  // Actualizar la contraseña
  users[userIndex].password = pass;
  saveUsers(users);

  if (forgotMsg) {
    forgotMsg.className = 'form-message success';
    forgotMsg.innerHTML = '¡Tu contraseña ha sido actualizada con éxito! <br><button type="button" onclick="openLoginModal()" class="btn-cta-yellow" style="margin-top:12px; width:100%; justify-content:center; padding:9px;">Iniciar sesión ahora</button>';
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

function handleSignupSubmit(e) {
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
  if (pass.length < 6) {
    if (signupPassword) signupPassword.classList.add('input-invalid');
    if (signupPasswordErr) signupPasswordErr.style.display = 'block';
    valid = false;
  }
  if (confirm !== pass) {
    if (signupConfirm) signupConfirm.classList.add('input-invalid');
    if (signupConfirmErr) signupConfirmErr.style.display = 'block';
    valid = false;
  }
  if (!valid) return;

  let users = getUsers();
  if (users.find(u => u.email.toLowerCase() === email.toLowerCase())) {
    if (signupMsg) {
      signupMsg.className = 'form-message error';
      signupMsg.textContent = 'Ya existe una cuenta con ese correo electrónico. Inicia sesión.';
    }
    return;
  }

  const newUser = { name, email: email.toLowerCase(), password: pass, createdAt: Date.now() };
  users.push(newUser);
  saveUsers(users);
  setCurrentUser(newUser);
  updateAuthUI();
  closeSignupModal();
  if (signupForm) signupForm.reset();
}

// ------------------------------------------------------------
// 8. ALMACENAMIENTO LOCAL
// ------------------------------------------------------------
function getUsers() {
  try {
    const raw = localStorage.getItem(USERS_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch (e) {
    return [];
  }
}

function saveUsers(users) {
  try {
    localStorage.setItem(USERS_KEY, JSON.stringify(users));
  } catch (e) {}
}

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

function logout() {
  try {
    localStorage.removeItem(SESSION_KEY);
  } catch (e) {}
  updateAuthUI();

  // Si estamos en una página protegida, redirigir a inicio
  const path = window.location.pathname.toLowerCase();
  if (path.includes('cursos.html') || path.includes('recursos.html') || path.includes('reticula.html') || path.includes('configuraciones.html')) {
    window.location.href = 'index.html';
  }
}

// ------------------------------------------------------------
// 9. ACTUALIZACIÓN DE UI: CONTROL DEL MENÚ LATERAL Y PRIVACIDAD
// ------------------------------------------------------------
function updateAuthUI() {
  const user = getCurrentUser();

  const sidebar = document.getElementById('sidebarLeft');
  const sidebarUserName = document.getElementById('sidebarUserName');
  const sidebarUserAvatar = document.getElementById('sidebarUserAvatar');
  const topbarUserName = document.getElementById('topbarUserName');

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

    if (protectedSection) protectedSection.style.display = 'block';
    if (lockedBanner) lockedBanner.style.display = 'none';

    // En index.html: mostrar panel del estudiante y ocultar portada
    if (studentDashboard) studentDashboard.style.display = 'block';
    if (guestLanding) guestLanding.style.display = 'none';
    if (navGuestNotice) navGuestNotice.style.display = 'none';
  } else {
    // USUARIO VISITANTE (SIN SESIÓN):
    document.body.classList.add('not-logged-in');
    document.body.classList.remove('user-logged-in');

    if (protectedSection) protectedSection.style.display = 'none';
    if (lockedBanner) lockedBanner.style.display = 'block';

    // En index.html: mostrar portada pública y ocultar panel privado
    if (studentDashboard) studentDashboard.style.display = 'none';
    if (guestLanding) guestLanding.style.display = 'block';
    if (navGuestNotice) navGuestNotice.style.display = 'flex';

    // Cerrar sidebar si estaba abierto en responsive
    if (sidebar) sidebar.classList.remove('open');
  }

  // Refrescar la retícula académica según el usuario actual
  renderReticula();
  // Refrescar la página de configuraciones si está presente
  renderConfiguracion();
  // Refrescar tutoriales interactivos en cursos.html
  if (typeof renderTutoriales === 'function') {
    renderTutoriales();
  }
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
  const link = e.target.closest('a[href="cursos.html"], a[href="recursos.html"], a[href="reticula.html"], a[href="configuraciones.html"]');
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
    closeDiagnosticoModal();
    closeTutorialModal();
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
document.addEventListener('DOMContentLoaded', () => {
  updateAuthUI();
  initAsistente();
  calculateCompoundInterest();
  if (window.location.hash === '#reticula') {
    setTimeout(() => {
      const el = document.getElementById('reticula');
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 250);
  }

  const diagModalEl = document.getElementById('diagnosticoModal');
  if (diagModalEl) {
    diagModalEl.addEventListener('click', (e) => {
      if (e.target === diagModalEl) closeDiagnosticoModal();
    });
  }
});

// ------------------------------------------------------------
// 15. RETÍCULA ACADÉMICA INTERACTIVA Y DIAGNÓSTICO INICIAL
// ------------------------------------------------------------
const RETICULA_ARRAY_KEY = 'edu_fin_reticula_';

const RETICULA_SEMESTRES = [
  {
    id: 1,
    etapaNum: 2,
    etapaTag: 'Etapa 2 de 3',
    titulo: 'Semestre 1',
    nombreEtapa: 'Fundamentos Financieros',
    limite: 2,
    requeridoPrevio: 0,
    icono: '🌱'
  },
  {
    id: 2,
    etapaNum: 3,
    etapaTag: 'Etapa 3 de 3',
    titulo: 'Semestre 2',
    nombreEtapa: 'Consolidación y Crecimiento',
    limite: 1,
    requeridoPrevio: 2,
    icono: '🚀'
  }
];

const RETICULA_MATERIAS = [
  {
    id: 'finanzas-personales', semestre: 1, icon: '🐷',
    nombre: 'Finanzas personales',
    desc: 'Administra tu dinero, controla tus gastos y crea hábitos financieros saludables.',
    temario: ['Registro de ingresos y gastos', 'Fondo de emergencia', 'Definición de metas financieras']
  },
  {
    id: 'presupuesto', semestre: 1, icon: '💰',
    nombre: 'Presupuesto',
    desc: 'Planifica tus ingresos y gastos para alcanzar mayor estabilidad financiera.',
    temario: ['La regla 50/30/20', 'Presupuesto mensual paso a paso', 'Ahorro programado']
  },
  {
    id: 'gasto-hormiga', semestre: 1, icon: '🐜',
    nombre: 'Gasto hormiga',
    desc: 'Detecta y elimina esos pequeños gastos diarios que se comen tus finanzas sin que lo notes.',
    temario: ['¿Qué es el gasto hormiga?', 'Cómo identificarlo en tu día a día', 'Redirigir esos montos al ahorro']
  },
  {
    id: 'ahorro-inversion', semestre: 2, icon: '📈',
    nombre: 'Ahorro e inversión',
    desc: 'Haz crecer tu dinero y alcanza tus metas a largo plazo con estrategias de inversión.',
    temario: ['Interés compuesto', 'Instrumentos de ahorro e inversión', 'Diversificación del riesgo']
  },
  {
    id: 'materiales-herramientas', semestre: 2, icon: '🧰',
    nombre: 'Materiales y herramientas',
    desc: 'Conoce las herramientas, plantillas y recursos para gestionar tus finanzas como un profesional.',
    temario: ['Plantillas financieras', 'Apps y recursos digitales', 'Calculadoras de ahorro y deuda']
  },
  {
    id: 'emprendimiento', semestre: 2, icon: '💡',
    nombre: 'Emprendimiento',
    desc: 'Conoce las bases para iniciar tu propio negocio y generar ingresos adicionales.',
    temario: ['Validación de ideas de negocio', 'Plan financiero inicial', 'Aspectos legales básicos']
  }
];

// PREGUNTAS CLAVE DEL DIAGNÓSTICO GRATUITO (SIN JUICIOS NI ETIQUETAS NEGATIVAS)
const DIAGNOSTICO_PREGUNTAS = [
  {
    id: 'gasto',
    dimension: 'Gasto',
    categoria: 'Hábitos de Gasto',
    icono: '🛒',
    pregunta: '¿De qué manera administras y das seguimiento a tus gastos cotidianos y mensuales?',
    ayuda: 'Identificar cómo fluye tu dinero día a día te permite tomar decisiones con mayor tranquilidad y libertad.',
    opciones: [
      {
        texto: 'Reviso mi saldo disponible conforme realizo pagos, sin llevar un registro formal de cada compra.',
        puntos: 1,
        enfoque: 'Enfoque Inicial',
        feedback: 'Excelente oportunidad para descubrir métodos sencillos de registro y ganar claridad total.'
      },
      {
        texto: 'Tengo presentes mis gastos fijos del mes, aunque a veces compras no planeadas o gastos variables alteran mi saldo.',
        puntos: 2,
        enfoque: 'Enfoque en Desarrollo',
        feedback: 'Muy buen avance; aprenderás a controlar imprevistos y proteger tus ahorros mensuales.'
      },
      {
        texto: 'Llevo un registro regular de mis compras (app, Excel o libreta) y diferencio claramente mis necesidades de mis gustos.',
        puntos: 3,
        enfoque: 'Enfoque Estructurado',
        feedback: '¡Gran disciplina! Cuentas con una sólida base para optimizar tu flujo de efectivo.'
      }
    ]
  },
  {
    id: 'ahorro',
    dimension: 'Ahorro',
    categoria: 'Hábitos de Ahorro',
    icono: '🐷',
    pregunta: '¿Cuál es tu método o situación actual respecto al ahorro y fondos para imprevistos?',
    ayuda: 'El ahorro constante es el motor que te respalda ante contingencias y financia tus proyectos.',
    opciones: [
      {
        texto: 'Ahorro cuando me sobra algo de dinero a fin de mes y busco adquirir el hábito de forma continua.',
        puntos: 1,
        enfoque: 'Enfoque Inicial',
        feedback: 'El método "págate a ti primero" transformará tu capacidad de ahorro desde el primer mes.'
      },
      {
        texto: 'Ahorro con cierta regularidad cuando tengo un objetivo en mente o cuento con un fondo inicial para emergencias menores.',
        puntos: 2,
        enfoque: 'Enfoque en Consolidación',
        feedback: 'Excelente base para formalizar un fondo de emergencia para 3 a 6 meses de gastos.'
      },
      {
        texto: 'Aparto sistemáticamente un porcentaje de mis ingresos en cuanto los recibo y ya dispongo de un fondo de emergencias establecido.',
        puntos: 3,
        enfoque: 'Enfoque Avanzado',
        feedback: '¡Impresionante constancia! Estás listo para hacer que ese capital genere rendimientos.'
      }
    ]
  },
  {
    id: 'deudas',
    dimension: 'Deudas',
    categoria: 'Manejo de Deudas',
    icono: '💳',
    pregunta: 'En relación con tus compromisos de pago (tarjetas, créditos o compras a plazos):',
    ayuda: 'Entender el crédito como una herramienta estratégica te ayuda a conservar siempre tu liquidez.',
    opciones: [
      {
        texto: 'Uso créditos o compras a plazos con regularidad y deseo aprender métodos prácticos para ordenarlos y liberar liquidez.',
        puntos: 1,
        enfoque: 'Enfoque Inicial',
        feedback: 'Aprenderás técnicas probadas como bola de nieve o avalancha para liquidar compromisos con calma.'
      },
      {
        texto: 'Pago puntualmente mis mensualidades y tarjetas cada mes, y busco estrategias para liquidar saldos más rápido y reducir intereses.',
        puntos: 2,
        enfoque: 'Enfoque en Consolidación',
        feedback: 'Muy buen historial de cumplimiento; te convendrá optimizar el costo financiero de tus productos.'
      },
      {
        texto: 'No tengo deudas pendientes o liquido el total de mi tarjeta de crédito cada mes (totalero) aprovechando beneficios sin pagar intereses.',
        puntos: 3,
        enfoque: 'Enfoque Estratégico',
        feedback: 'Manejo impecable del crédito; aprovechas las ventajas del sistema financiero a tu favor.'
      }
    ]
  },
  {
    id: 'metas',
    dimension: 'Metas',
    categoria: 'Metas Financieras',
    icono: '🎯',
    pregunta: '¿Cómo proyectas y planificas tus objetivos financieros a corto, mediano y largo plazo?',
    ayuda: 'Tener un rumbo financiero claro te motiva y convierte tus ilusiones en metas medibles y alcanzables.',
    opciones: [
      {
        texto: 'Tengo proyectos y sueños en mente, pero aún no he fijado metas con números concretos ni fechas estimadas.',
        puntos: 1,
        enfoque: 'Enfoque Inicial',
        feedback: 'Te guiaremos para convertir sueños en metas SMART con montos claros y fechas realistas.'
      },
      {
        texto: 'Tengo identificadas mis metas prioritarias con un plazo aproximado, y quiero diseñar un plan paso a paso para lograrlas.',
        puntos: 2,
        enfoque: 'Enfoque en Consolidación',
        feedback: 'Excelente claridad; sumarás herramientas de cálculo para asegurar el cumplimiento puntual.'
      },
      {
        texto: 'Tengo metas cuantificadas con montos y fechas específicas, asignación mensual de recursos y busco explorar inversión para impulsarlas.',
        puntos: 3,
        enfoque: 'Enfoque Estratégico',
        feedback: 'Visión financiera de alto nivel, ideal para diversificar instrumentos y crear patrimonio.'
      }
    ]
  }
];

// NIVELES DE RECOMENDACIÓN FORMATIVA (POSITIVOS, EMPÁTICOS Y SIN ETIQUETAS NEGATIVAS)
const DIAGNOSTICO_NIVELES = {
  basico: {
    clave: 'basico',
    nombre: 'Nivel Básico · Fundamentos y Hábitos Financieros',
    insignia: '🌱 Nivel Básico Recomendado',
    icono: '🌱',
    titulo: 'Construcción de Cimientos y Claridad Financiera',
    descripcion: '¡Felicidades por dar este paso! Estás en el momento perfecto para transformar tu relación con el dinero. Tu diagnóstico muestra una gran oportunidad para incorporar hábitos y herramientas prácticas que te darán tranquilidad inmediata, orden en tu presupuesto y una base sólida para tus metas, a tu propio ritmo.',
    puntosClave: [
      'Domina el presupuesto personal con la regla 50/30/20 de manera amigable.',
      'Aprende a identificar y frenar gastos invisibles (gasto hormiga) sin sacrificar tu bienestar.',
      'Crea tu primer fondo de ahorro para imprevistos con el método "págate a ti primero".',
      'Organiza tus compromisos crediticios para liberar flujo de efectivo mes con mes.'
    ],
    materiasSugeridas: [
      { id: 'finanzas-personales', nombre: 'Finanzas personales', icon: '🐷' },
      { id: 'presupuesto', nombre: 'Presupuesto', icon: '💰' },
      { id: 'gasto-hormiga', nombre: 'Gasto hormiga', icon: '🐜' }
    ],
    mensajeRuta: 'Te recomendamos iniciar inscribiéndote en Finanzas personales y Presupuesto en el Semestre 1 para consolidar tus cimientos financieros.'
  },
  intermedio: {
    clave: 'intermedio',
    nombre: 'Nivel Intermedio · Consolidación y Crecimiento',
    insignia: '🚀 Nivel Intermedio Recomendado',
    icono: '🚀',
    titulo: 'Optimización, Rendimiento y Multiplicación Patrimonial',
    descripcion: '¡Excelente desempeño en tu diagnóstico! Cuentas con hábitos consolidados y nociones claras en la administración de tus recursos. El nivel intermedio está diseñado para que des el siguiente gran salto: poner tu dinero a trabajar, aprovechar herramientas avanzadas de gestión y proyectar nuevas fuentes de ingresos.',
    puntosClave: [
      'Aprende a calcular y aprovechar el poder del interés compuesto para multiplicar tu ahorro.',
      'Domina calculadoras financieras, plantillas profesionales y herramientas de control automatizado.',
      'Conoce los principios de inversión, diversificación del riesgo y protección patrimonial.',
      'Explora las bases del emprendimiento para generar ingresos adicionales y validar proyectos.'
    ],
    materiasSugeridas: [
      { id: 'ahorro-inversion', nombre: 'Ahorro e inversión', icon: '📈' },
      { id: 'materiales-herramientas', nombre: 'Materiales y herramientas', icon: '🧰' },
      { id: 'emprendimiento', nombre: 'Emprendimiento', icon: '💡' }
    ],
    mensajeRuta: 'Cuentas con las bases para cursar las unidades del Semestre 1 con agilidad y avanzar hacia los temas de Ahorro e Inversión y Emprendimiento en el Semestre 2.'
  }
};

function getReticulaStorageKey() {
  const user = getCurrentUser();
  const who = (user && user.email) ? String(user.email).toLowerCase() : 'invitado';
  return RETICULA_ARRAY_KEY + who;
}

function getReticulaState() {
  try {
    const raw = localStorage.getItem(getReticulaStorageKey());
    const parsed = raw ? JSON.parse(raw) : null;
    if (parsed && Array.isArray(parsed.inscritas)) {
      if (!parsed.diagnostico) parsed.diagnostico = null;
      return parsed;
    }
  } catch (e) {}
  return { inscritas: [], diagnostico: null };
}

function saveReticulaState(state) {
  try {
    localStorage.setItem(getReticulaStorageKey(), JSON.stringify(state));
  } catch (e) {}
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

function semestreEstaBloqueado(state, semId) {
  const cfg = getSemestreConfig(semId);
  if (!cfg || cfg.requeridoPrevio <= 0) return false;
  const prev = RETICULA_SEMESTRES.find(function (s) { return s.id === semId - 1; });
  if (!prev) return false;
  return contarInscritasEnSemestre(state, prev.id) < cfg.requeridoPrevio;
}

function puedeInscribir(id) {
  const state = getReticulaState();
  const m = getMateriaPorId(id);
  if (!m) return { ok: false, motivo: 'error' };
  if (state.inscritas.indexOf(id) !== -1) return { ok: false, motivo: 'inscrita' };

  // REQUISITO: Debe responder el diagnóstico gratuito previo
  if (!state.diagnostico || !state.diagnostico.completado) {
    return { ok: false, motivo: 'diagnostico_pendiente' };
  }

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
  const m = getMateriaPorId(id);
  if (!state.diagnostico || !state.diagnostico.completado) {
    if (m && semestreEstaBloqueado(state, m.semestre)) return 'bloqueada';
    return 'pendiente-diag';
  }
  if (puedeInscribir(id).ok) return 'disponible';
  return 'bloqueada';
}

function renderReticula() {
  const grid = document.getElementById('reticulaGrid');
  if (!grid) return;

  const state = getReticulaState();
  const total = RETICULA_MATERIAS.length;
  const inscritas = state.inscritas.length;

  // 1. Renderizar la barra de progreso ordenada de todas las etapas
  renderEtapasStepper(state);

  // 2. Renderizar la Etapa 1 (Diagnóstico Gratuito)
  renderEtapaInicial(state);

  // 3. Resumen y orientación de la etapa actual
  const resumen = document.getElementById('reticulaResumen');
  if (resumen) {
    let hint;
    if (!state.diagnostico || !state.diagnostico.completado) {
      hint = '📍 Etapa 1 en curso: Responde el Diagnóstico Gratuito para desbloquear la Etapa 2';
    } else if (contarInscritasEnSemestre(state, 1) < 2) {
      const faltan = 2 - contarInscritasEnSemestre(state, 1);
      hint = '📍 Etapa 2 en curso: Inscríbete a ' + faltan + ' materia' + (faltan === 1 ? '' : 's') + ' más para avanzar a la Etapa 3';
    } else if (contarInscritasEnSemestre(state, 2) < 1) {
      hint = '📍 Etapa 3 desbloqueada: Selecciona 1 materia de especialización';
    } else {
      hint = '🏆 ¡Todas las etapas completadas con éxito! Sigue aprendiendo';
    }
    resumen.innerHTML =
      '<div class="reticula-resumen-num">' + inscritas + '<span> / ' + total + '</span></div>' +
      '<div class="reticula-resumen-txt">materias inscritas en tu retícula</div>' +
      '<div class="reticula-resumen-hint">🎯 ' + hint + '</div>';
  }

  // 4. Renderizar las etapas de semestres en orden secuencial
  grid.innerHTML = RETICULA_SEMESTRES.map(function (sem) {
    const cfg = sem;
    const materias = RETICULA_MATERIAS.filter(function (m) { return m.semestre === sem.id; });
    const inscritasSem = contarInscritasEnSemestre(state, sem.id);
    const bloqueado = semestreEstaBloqueado(state, sem.id);
    const pct = Math.min(100, Math.round((inscritasSem / cfg.limite) * 100));

    let chip;
    if (bloqueado) {
      chip = '<span class="reticula-semester-chip locked">🔒 Bloqueado</span>';
    } else if (!state.diagnostico || !state.diagnostico.completado) {
      chip = '<span class="reticula-semester-chip" style="background:rgba(250,187,21,0.18); color:#946400;">🔒 Requiere Etapa 1</span>';
    } else {
      chip = '<span class="reticula-semester-chip">' + inscritasSem + ' / ' + cfg.limite +
        (cfg.limite === 1 ? ' materia' : ' unidades') + '</span>';
    }

    const cards = materias.map(function (m) {
      const st = estadoMateria(m.id, state);
      let etiqueta = 'Disponible';
      if (st === 'inscrita') etiqueta = '✓ Inscrita';
      else if (st === 'pendiente-diag') etiqueta = '🔒 Requiere Etapa 1';
      else if (st === 'bloqueada') etiqueta = '🔒 Bloqueada';

      // Badge de materia recomendada según diagnóstico
      let sugeridaBadge = '';
      if (state.diagnostico && state.diagnostico.completado && state.diagnostico.materiasSugeridasIds) {
        if (state.diagnostico.materiasSugeridasIds.indexOf(m.id) !== -1) {
          sugeridaBadge = '<span class="reticula-materia-recom-chip">⭐ Recomendada</span>';
        }
      }

      return '' +
        '<div class="reticula-materia is-' + st + '" onclick="openReticulaModal(\'' + m.id + '\')">' +
          '<div class="reticula-materia-ico">' + m.icon + '</div>' +
          '<div class="reticula-materia-info">' +
            '<div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">' +
              '<h5>' + m.nombre + '</h5>' +
              sugeridaBadge +
            '</div>' +
            '<p>' + m.desc + '</p>' +
          '</div>' +
          '<div class="reticula-materia-estado">' + etiqueta + '</div>' +
        '</div>';
    }).join('');

    const reqTexto = cfg.id === 1 ? 'Requiere Etapa 1 completada' : 'Requiere Etapa 2 (2 materias)';

    return '' +
      '<div class="reticula-semester">' +
        '<div class="reticula-semester-head">' +
          '<div>' +
            '<div class="reticula-stage-badge-row">' +
              '<span class="reticula-stage-number-pill">' + cfg.etapaTag + '</span>' +
              '<span class="reticula-stage-req-pill">' + reqTexto + '</span>' +
            '</div>' +
            '<h4>' + (cfg.icono || '🎓') + ' ' + cfg.titulo + ' · ' + cfg.nombreEtapa + '</h4>' +
          '</div>' +
          chip +
        '</div>' +
        '<div class="reticula-semester-bar"><i style="width:' + pct + '%"></i></div>' +
        '<div class="reticula-materias">' + cards + '</div>' +
      '</div>';
  }).join('');
}

// ------------------------------------------------------------
// LÍNEA DE PROGRESO Y ORDEN DE ETAPAS (STEPPER)
// ------------------------------------------------------------
function renderEtapasStepper(state) {
  const stepper = document.getElementById('reticulaEtapasStepper');
  if (!stepper) return;

  const diagDone = !!(state.diagnostico && state.diagnostico.completado);
  const sem1Count = contarInscritasEnSemestre(state, 1);
  const sem1Done = sem1Count >= 2;
  const sem2Count = contarInscritasEnSemestre(state, 2);
  const sem2Done = sem2Count >= 1;

  // Estado Etapa 1
  const e1Class = diagDone ? 'completed' : 'active';
  const e1Badge = diagDone ? '✓ Completada' : 'En Curso';
  const e1Icon = diagDone ? '✓' : '1';

  // Estado Etapa 2
  const e2Class = !diagDone ? 'locked' : (sem1Done ? 'completed' : 'active');
  const e2Badge = !diagDone ? '🔒 Bloqueada' : (sem1Done ? '✓ Completada' : sem1Count + '/2 materias');
  const e2Icon = sem1Done ? '✓' : '2';

  // Estado Etapa 3
  const e3Class = !sem1Done ? 'locked' : (sem2Done ? 'completed' : 'active');
  const e3Badge = !sem1Done ? '🔒 Bloqueada' : (sem2Done ? '✓ Completada' : (sem2Count === 0 ? 'Disponible (0/1)' : '✓ Completada'));
  const e3Icon = sem2Done ? '✓' : '3';

  stepper.innerHTML = '' +
    '<div class="stepper-track">' +
      '<div class="stepper-step ' + e1Class + '" onclick="openDiagnosticoModal(' + (diagDone ? 'false' : 'true') + ')">' +
        '<div class="stepper-circle">' + e1Icon + '</div>' +
        '<div class="stepper-info">' +
          '<div class="stepper-label-row">' +
            '<span class="stepper-stage-tag">Etapa 1 de 3</span>' +
            '<span class="stepper-status-chip ' + e1Class + '">' + e1Badge + '</span>' +
          '</div>' +
          '<h5 class="stepper-title">Diagnóstico Gratuito</h5>' +
          '<span class="stepper-desc">Hábitos y recomendación de nivel</span>' +
        </div>' +
      '</div>' +

      '<div class="stepper-divider ' + (diagDone ? 'done' : '') + '">' +
        '<span class="stepper-arrow-icon">➔</span>' +
      '</div>' +

      '<div class="stepper-step ' + e2Class + '">' +
        '<div class="stepper-circle">' + e2Icon + '</div>' +
        '<div class="stepper-info">' +
          '<div class="stepper-label-row">' +
            '<span class="stepper-stage-tag">Etapa 2 de 3</span>' +
            '<span class="stepper-status-chip ' + e2Class + '">' + e2Badge + '</span>' +
          '</div>' +
          '<h5 class="stepper-title">Semestre 1: Fundamentos</h5>' +
          '<span class="stepper-desc">Inscripción a 2 materias base</span>' +
        </div>' +
      '</div>' +

      '<div class="stepper-divider ' + (sem1Done ? 'done' : '') + '">' +
        '<span class="stepper-arrow-icon">➔</span>' +
      '</div>' +

      '<div class="stepper-step ' + e3Class + '">' +
        '<div class="stepper-circle">' + e3Icon + '</div>' +
        '<div class="stepper-info">' +
          '<div class="stepper-label-row">' +
            '<span class="stepper-stage-tag">Etapa 3 de 3</span>' +
            '<span class="stepper-status-chip ' + e3Class + '">' + e3Badge + '</span>' +
          '</div>' +
          '<h5 class="stepper-title">Semestre 2: Crecimiento</h5>' +
          '<span class="stepper-desc">Inscripción a 1 materia avanzada</span>' +
        </div>' +
      '</div>' +
    '</div>';
}

// ------------------------------------------------------------
// RENDERIZADO DE LA ETAPA INICIAL (DIAGNÓSTICO GRATUITO)
// ------------------------------------------------------------
function renderEtapaInicial(state) {
  const container = document.getElementById('reticulaEtapaInicial');
  if (!container) return;

  const diag = state.diagnostico;
  const completado = diag && diag.completado;

  if (!completado) {
    // ESTADO PENDIENTE
    container.innerHTML = '' +
      '<div class="reticula-etapa-card pendiente">' +
        '<div class="reticula-etapa-header">' +
          '<div class="reticula-etapa-pill-row">' +
            '<span class="reticula-etapa-tag"><span class="tag-pulse"></span>Etapa 1 de 3 · Diagnóstico Gratuito</span>' +
            '<span class="reticula-etapa-status-chip pendiente">⏳ Etapa 1: Pendiente</span>' +
          '</div>' +
          '<span class="reticula-etapa-time">⏱️ 2 minutos · Paso inicial obligatorio</span>' +
        '</div>' +

        '<div class="reticula-etapa-body">' +
          '<div class="reticula-etapa-main-info">' +
            '<div class="reticula-etapa-icon-badge">🎯</div>' +
            '<div>' +
              '<h4 class="reticula-etapa-title">Etapa 1: Diagnóstico Financiero Gratuito</h4>' +
              '<p class="reticula-etapa-desc">' +
                'Este es el <strong>primer paso en orden</strong> de tu retícula académica. Responde 4 preguntas breves y prácticas sobre tus <strong>hábitos de gasto</strong>, <strong>ahorro</strong>, <strong>deudas</strong> y <strong>metas</strong>. ' +
                'Recibirás tu recomendación formativa de nivel <strong>básico</strong> o <strong>intermedio</strong> sin etiquetas negativas, habilitando tu avance a la <strong>Etapa 2 (Semestre 1)</strong>.' +
              '</p>' +
            '</div>' +
          '</div>' +

          '<div class="reticula-etapa-areas-grid">' +
            '<div class="etapa-area-pill">' +
              '<span class="area-ico">🛒</span>' +
              '<div>' +
                '<strong>1. Hábitos de Gasto</strong>' +
                '<small>Monitoreo y control diario</small>' +
              '</div>' +
            '</div>' +
            '<div class="etapa-area-pill">' +
              '<span class="area-ico">🐷</span>' +
              '<div>' +
                '<strong>2. Hábitos de Ahorro</strong>' +
                '<small>Constancia y fondo de emergencia</small>' +
              '</div>' +
            '</div>' +
            '<div class="etapa-area-pill">' +
              '<span class="area-ico">💳</span>' +
              '<div>' +
                '<strong>3. Manejo de Deudas</strong>' +
                '<small>Uso estratégico del crédito</small>' +
              '</div>' +
            '</div>' +
            '<div class="etapa-area-pill">' +
              '<span class="area-ico">🎯</span>' +
              '<div>' +
                '<strong>4. Metas Financieras</strong>' +
                '<small>Planificación SMART a futuro</small>' +
              '</div>' +
            '</div>' +
          '</div>' +

          '<div class="reticula-etapa-cta-banner">' +
            '<div class="etapa-cta-msg">' +
              '<span class="cta-alert-ico">💡</span>' +
              '<span><strong>Orden de avance:</strong> Al completar la Etapa 1 desbloquearás automáticamente la inscripción a tus 2 materias de la Etapa 2.</span>' +
            '</div>' +
            '<button class="btn-cta-yellow btn-etapa-iniciar" onclick="openDiagnosticoModal()">' +
              '<span>Iniciar Etapa 1: Diagnóstico Gratuito</span>' +
              '<span style="font-size: 16px;">🚀</span>' +
            '</button>' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div class="reticula-path-divider">' +
        '<span class="path-step active">1. Etapa 1: Diagnóstico (Actual)</span>' +
        '<span class="path-arrow">➔</span>' +
        '<span class="path-step">2. Etapa 2: Semestre 1</span>' +
        '<span class="path-arrow">➔</span>' +
        '<span class="path-step">3. Etapa 3: Semestre 2</span>' +
      '</div>';
  } else {
    // ESTADO COMPLETADO
    const nivelClave = diag.nivel || 'basico';
    const nivelInfo = DIAGNOSTICO_NIVELES[nivelClave] || DIAGNOSTICO_NIVELES.basico;
    const esBasico = nivelClave === 'basico';
    const badgeClass = esBasico ? 'nivel-basico' : 'nivel-intermedio';

    container.innerHTML = '' +
      '<div class="reticula-etapa-card completado">' +
        '<div class="reticula-etapa-header">' +
          '<div class="reticula-etapa-pill-row">' +
            '<span class="reticula-etapa-tag completado">✓ Etapa 1 de 3 · Completada</span>' +
            '<span class="reticula-etapa-status-chip completado">✅ Etapa 2 Desbloqueada</span>' +
          '</div>' +
          '<span class="reticula-etapa-date">Completado el ' + (diag.fecha || 'Recientemente') + '</span>' +
        '</div>' +

        '<div class="reticula-etapa-body">' +
          '<div class="reticula-etapa-completed-banner ' + badgeClass + '">' +
            '<div class="diag-result-badge-top">' +
              '<span class="diag-level-chip ' + badgeClass + '">' + nivelInfo.insignia + '</span>' +
              '<span class="diag-score-chip">Puntaje global: ' + (diag.puntaje || 8) + ' / 12 pts</span>' +
            '</div>' +
            '<h4 class="reticula-etapa-completed-title">Etapa 1 Superada: ' + nivelInfo.titulo + '</h4>' +
            '<p class="reticula-etapa-completed-desc">' + nivelInfo.descripcion + '</p>' +

            '<div class="diag-areas-summary-row">' +
              '<div class="diag-summary-chip">' +
                '<span>🛒 Gasto:</span> <strong>' + (diag.resumenAreas && diag.resumenAreas.gasto ? diag.resumenAreas.gasto : 'Evaluado') + '</strong>' +
              '</div>' +
              '<div class="diag-summary-chip">' +
                '<span>🐷 Ahorro:</span> <strong>' + (diag.resumenAreas && diag.resumenAreas.ahorro ? diag.resumenAreas.ahorro : 'Evaluado') + '</strong>' +
              '</div>' +
              '<div class="diag-summary-chip">' +
                '<span>💳 Deudas:</span> <strong>' + (diag.resumenAreas && diag.resumenAreas.deudas ? diag.resumenAreas.deudas : 'Evaluado') + '</strong>' +
              '</div>' +
              '<div class="diag-summary-chip">' +
                '<span>🎯 Metas:</span> <strong>' + (diag.resumenAreas && diag.resumenAreas.metas ? diag.resumenAreas.metas : 'Evaluado') + '</strong>' +
              '</div>' +
            '</div>' +

            '<div class="diag-completed-actions">' +
              '<button class="btn-cta-yellow btn-sm" onclick="verRecomendacionModal()">' +
                '<span>Ver Mi Recomendación Detallada</span> 📄' +
              '</button>' +
              '<button class="btn-cta-outline btn-sm" onclick="openDiagnosticoModal(true)">' +
                '<span>Repetir Diagnóstico</span> ↺' +
              '</button>' +
            '</div>' +
          '</div>' +

          '<div class="reticula-etapa-notice-unlocked">' +
            '🎉 <strong>¡Etapa 1 superada!</strong> Ahora estás en la <strong>Etapa 2 (Semestre 1)</strong>. Selecciona tus <strong>2 unidades</strong> base a continuación. Las materias con la etiqueta <span class="tag-sugerida-demo">⭐ Recomendada</span> coinciden de forma óptima con tu diagnóstico.' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div class="reticula-path-divider">' +
        '<span class="path-step completed">✓ 1. Etapa 1: Completada</span>' +
        '<span class="path-arrow active">➔</span>' +
        '<span class="path-step active">2. Etapa 2: Semestre 1 (En curso)</span>' +
        '<span class="path-arrow">➔</span>' +
        '<span class="path-step">3. Etapa 3: Semestre 2</span>' +
      '</div>';
  }
}

// ------------------------------------------------------------
// MODAL DE MATERIAS DE LA RETÍCULA
// ------------------------------------------------------------
let reticulaActualId = null;

function openReticulaModal(id) {
  const m = getMateriaPorId(id);
  if (!m) return;

  reticulaActualId = id;
  const state = getReticulaState();
  const cfg = getSemestreConfig(m.semestre);

  const levelEl = document.getElementById('reticulaModalLevel');
  const titleEl = document.getElementById('reticulaModalTitle');
  const descEl = document.getElementById('reticulaModalDesc');
  const temarioEl = document.getElementById('reticulaModalTemario');
  const estadoEl = document.getElementById('reticulaModalEstado');
  const actionEl = document.getElementById('reticulaModalAction');

  if (levelEl) {
    levelEl.textContent = (cfg ? (cfg.etapaTag + ' · ' + cfg.titulo + ' · ' + cfg.nombreEtapa) : ('Semestre ' + m.semestre)) + ' · ' + m.icon;
  }
  if (titleEl) titleEl.textContent = m.nombre;
  if (descEl) descEl.textContent = m.desc;
  if (temarioEl) {
    temarioEl.innerHTML = m.temario.map(function (t) { return '<li>' + t + '</li>'; }).join('');
  }

  let tipo = 'info';
  let texto = '';
  let label = 'Inscribirme';
  let deshabilitado = false;

  if (state.inscritas.indexOf(id) !== -1) {
    tipo = 'ok';
    texto = '✅ Ya estás inscrito en esta materia. ¡Continúa con tu formación!';
    label = '✓ Inscrito';
    deshabilitado = true;
  } else {
    const chk = puedeInscribir(id);
    if (chk.ok) {
      tipo = 'warn';
      texto = '🟡 Materia disponible. Puedes inscribirte ahora mismo en esta unidad de la ' + (cfg ? cfg.etapaTag : 'etapa') + '.';
      label = 'Inscribirme a esta materia';
    } else if (chk.motivo === 'diagnostico_pendiente') {
      tipo = 'warn';
      texto = '📋 Para poder inscribirte en materias de la Etapa 2, primero debes completar la Etapa 1 (Diagnóstico Gratuito). Te tomará solo 2 minutos y te recomendará tu nivel ideal (básico o intermedio).';
      label = 'Comenzar Etapa 1 (Diagnóstico Gratuito)';
      deshabilitado = false;
    } else if (chk.motivo === 'bloqueado') {
      tipo = 'info';
      texto = '🔒 Esta materia pertenece a la Etapa 3 y se desbloquea al inscribirte a las 2 materias de la Etapa 2 (Semestre 1).';
      label = 'Etapa 3 bloqueada';
      deshabilitado = true;
    } else if (chk.motivo === 'limite') {
      const limite = cfg ? cfg.limite : 1;
      tipo = 'info';
      texto = '⏳ Ya alcanzaste el cupo de ' + limite +
        (limite === 1 ? ' materia' : ' unidades') + ' en la ' + (cfg ? cfg.etapaTag : 'esta etapa') + '. Avanza a la siguiente etapa para continuar.';
      label = 'Cupo completo en esta etapa';
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
  const chk = puedeInscribir(id);

  if (!chk.ok) {
    if (chk.motivo === 'diagnostico_pendiente') {
      closeReticulaModal();
      openDiagnosticoModal();
      return;
    }
    openReticulaModal(id);
    return;
  }

  const state = getReticulaState();
  state.inscritas.push(id);
  saveReticulaState(state);

  renderReticula();
  openReticulaModal(id);
}

// ------------------------------------------------------------
// CONTROLADOR DEL MODAL DE DIAGNÓSTICO GRATUITO
// ------------------------------------------------------------
let diagPasoActual = 0;
let diagRespuestasTemp = {};

function openDiagnosticoModal(reiniciar) {
  const state = getReticulaState();
  if (reiniciar || !state.diagnostico || !state.diagnostico.completado) {
    diagPasoActual = 0;
    diagRespuestasTemp = {};
    // Pre-cargar respuestas si existían para facilitar edición
    if (state.diagnostico && state.diagnostico.respuestas) {
      DIAGNOSTICO_PREGUNTAS.forEach(function (q) {
        if (state.diagnostico.respuestas[q.id]) {
          const r = state.diagnostico.respuestas[q.id];
          const idx = q.opciones.findIndex(function (op) { return op.enfoque === r.enfoque; });
          if (idx !== -1) diagRespuestasTemp[q.id] = idx;
        }
      });
    }
    renderDiagnosticoModal();
  } else {
    // Si ya completó y solo quiere ver su recomendación
    diagPasoActual = DIAGNOSTICO_PREGUNTAS.length;
    renderDiagnosticoResultado(state.diagnostico);
  }

  const modal = document.getElementById('diagnosticoModal');
  if (modal) modal.classList.add('open');
}

function closeDiagnosticoModal() {
  const modal = document.getElementById('diagnosticoModal');
  if (modal) modal.classList.remove('open');
}

function verRecomendacionModal() {
  const state = getReticulaState();
  if (state.diagnostico && state.diagnostico.completado) {
    diagPasoActual = DIAGNOSTICO_PREGUNTAS.length;
    renderDiagnosticoResultado(state.diagnostico);
    const modal = document.getElementById('diagnosticoModal');
    if (modal) modal.classList.add('open');
  } else {
    openDiagnosticoModal();
  }
}

function renderDiagnosticoModal() {
  const card = document.getElementById('diagnosticoCard');
  if (!card) return;

  if (diagPasoActual >= DIAGNOSTICO_PREGUNTAS.length) {
    const resultado = calcularResultadoDiagnostico();
    renderDiagnosticoResultado(resultado);
    return;
  }

  const q = DIAGNOSTICO_PREGUNTAS[diagPasoActual];
  const total = DIAGNOSTICO_PREGUNTAS.length;
  const progresoPct = Math.round(((diagPasoActual + 1) / total) * 100);
  const seleccionActual = diagRespuestasTemp[q.id];
  const haySeleccion = typeof seleccionActual === 'number';

  const opcionesHtml = q.opciones.map(function (op, idx) {
    const isSelected = seleccionActual === idx;
    return '' +
      '<div class="diag-option-item ' + (isSelected ? 'selected' : '') + '" onclick="seleccionarOpcionDiagnostico(\'' + q.id + '\', ' + idx + ')">' +
        '<div class="diag-radio-indicator">' +
          '<span class="diag-radio-check">✓</span>' +
        '</div>' +
        '<div class="diag-option-content">' +
          '<div class="diag-option-badge">' + op.enfoque + '</div>' +
          '<div class="diag-option-text">' + op.texto + '</div>' +
        '</div>' +
      '</div>';
  }).join('');

  const esUltima = diagPasoActual === total - 1;
  const botonSigLabel = esUltima ? 'Finalizar y Ver Recomendación ✨' : 'Siguiente Pregunta →';

  card.innerHTML = '' +
    '<button class="modal-close-btn" onclick="closeDiagnosticoModal()" aria-label="Cerrar">×</button>' +
    
    '<div class="diag-modal-header">' +
      '<div class="diag-category-chip">' +
        '<span>' + q.icono + '</span>' +
        '<span>Etapa Inicial · ' + q.categoria + '</span>' +
      '</div>' +
      '<div class="diag-step-counter">Pregunta ' + (diagPasoActual + 1) + ' de ' + total + '</div>' +
    '</div>' +

    '<div class="diag-progress-bar">' +
      '<i style="width: ' + progresoPct + '%"></i>' +
    '</div>' +

    '<div class="diag-question-box">' +
      '<h3 class="diag-question-title">' + q.pregunta + '</h3>' +
      '<p class="diag-question-help">' + q.ayuda + '</p>' +
    '</div>' +

    '<div class="diag-options-container">' +
      opcionesHtml +
    '</div>' +

    '<div class="diag-footer-nav">' +
      '<button class="btn-cta-outline diag-btn-prev" onclick="anteriorPasoDiagnostico()" ' + (diagPasoActual === 0 ? 'disabled style="opacity:0.4; pointer-events:none;"' : '') + '>' +
        '← Anterior' +
      '</button>' +
      '<div class="diag-nav-hint">' +
        (haySeleccion ? '✅ Opción seleccionada' : 'Selecciona una respuesta para continuar') +
      '</div>' +
      '<button class="btn-cta-yellow diag-btn-next" onclick="siguientePasoDiagnostico()" ' + (!haySeleccion ? 'disabled style="opacity:0.45; pointer-events:none;"' : '') + '>' +
        botonSigLabel +
      '</button>' +
    '</div>';
}

function seleccionarOpcionDiagnostico(preguntaId, opcionIdx) {
  diagRespuestasTemp[preguntaId] = opcionIdx;
  renderDiagnosticoModal();
}

function siguientePasoDiagnostico() {
  const q = DIAGNOSTICO_PREGUNTAS[diagPasoActual];
  if (typeof diagRespuestasTemp[q.id] !== 'number') return;

  if (diagPasoActual < DIAGNOSTICO_PREGUNTAS.length - 1) {
    diagPasoActual++;
    renderDiagnosticoModal();
  } else {
    finalizarDiagnostico();
  }
}

function anteriorPasoDiagnostico() {
  if (diagPasoActual > 0) {
    diagPasoActual--;
    renderDiagnosticoModal();
  }
}

function calcularResultadoDiagnostico() {
  let puntajeTotal = 0;
  const respuestasDetalle = {};
  const resumenAreas = {};

  DIAGNOSTICO_PREGUNTAS.forEach(function (q) {
    const idx = typeof diagRespuestasTemp[q.id] === 'number' ? diagRespuestasTemp[q.id] : 0;
    const op = q.opciones[idx] || q.opciones[0];
    puntajeTotal += op.puntos;

    respuestasDetalle[q.id] = {
      preguntaId: q.id,
      categoria: q.categoria,
      enfoque: op.enfoque,
      texto: op.texto,
      puntos: op.puntos,
      feedback: op.feedback
    };

    resumenAreas[q.id] = op.enfoque;
  });

  // Nivel Básico (<= 7 puntos) o Nivel Intermedio (>= 8 puntos)
  const nivel = puntajeTotal <= 7 ? 'basico' : 'intermedio';
  const nivelInfo = DIAGNOSTICO_NIVELES[nivel];

  return {
    completado: true,
    fecha: new Date().toLocaleDateString('es-MX', { day: '2-digit', month: 'short', year: 'numeric' }),
    puntaje: puntajeTotal,
    nivel: nivel,
    nivelTitulo: nivelInfo.titulo,
    insignia: nivelInfo.insignia,
    respuestas: respuestasDetalle,
    resumenAreas: resumenAreas,
    materiasSugeridasIds: nivelInfo.materiasSugeridas.map(function (m) { return m.id; })
  };
}

function finalizarDiagnostico() {
  const resultado = calcularResultadoDiagnostico();
  const state = getReticulaState();
  state.diagnostico = resultado;
  saveReticulaState(state);

  diagPasoActual = DIAGNOSTICO_PREGUNTAS.length;
  renderDiagnosticoResultado(resultado);
  renderReticula();
}

function renderDiagnosticoResultado(resultado) {
  const card = document.getElementById('diagnosticoCard');
  if (!card || !resultado) return;

  const nivelClave = resultado.nivel || 'basico';
  const info = DIAGNOSTICO_NIVELES[nivelClave] || DIAGNOSTICO_NIVELES.basico;
  const esBasico = nivelClave === 'basico';
  const badgeClase = esBasico ? 'nivel-basico' : 'nivel-intermedio';

  const dimensiones = [
    { key: 'gasto', ico: '🛒', tit: 'Hábitos de Gasto' },
    { key: 'ahorro', ico: '🐷', tit: 'Hábitos de Ahorro' },
    { key: 'deudas', ico: '💳', tit: 'Manejo de Deudas' },
    { key: 'metas', ico: '🎯', tit: 'Metas Financieras' }
  ];

  const dimensionesHtml = dimensiones.map(function (d) {
    const r = resultado.respuestas ? resultado.respuestas[d.key] : null;
    const enfoque = r ? r.enfoque : 'Enfoque Inicial';
    const feedback = r ? r.feedback : 'Base formativa constructiva.';
    return '' +
      '<div class="diag-dim-result-card">' +
        '<div class="dim-res-header">' +
          '<span class="dim-res-ico">' + d.ico + '</span>' +
          '<div>' +
            '<strong>' + d.tit + '</strong>' +
            '<span class="dim-res-badge">' + enfoque + '</span>' +
          '</div>' +
        '</div>' +
        '<p class="dim-res-feedback">' + feedback + '</p>' +
      '</div>';
  }).join('');

  const materiasHtml = info.materiasSugeridas.map(function (m) {
    return '' +
      '<div class="diag-materia-pill">' +
        '<span>' + m.icon + '</span>' +
        '<strong>' + m.nombre + '</strong>' +
      '</div>';
  }).join('');

  const puntosClaveHtml = info.puntosClave.map(function (p) {
    return '<li>' + p + '</li>';
  }).join('');

  card.innerHTML = '' +
    '<button class="modal-close-btn" onclick="closeDiagnosticoModal()" aria-label="Cerrar">×</button>' +

    '<div class="diag-result-celebration">' +
      '<div class="celebration-ico">🎉</div>' +
      '<span class="celebration-tag">Diagnóstico Inicial Completado</span>' +
      '<h3 class="celebration-title">Tu Recomendación Formativa Personalizada</h3>' +
      '<p class="celebration-sub">' +
        'Evaluamos tus hábitos de gasto, ahorro, deudas y metas con un enfoque 100% constructivo y libre de etiquetas negativas. Este es tu punto de partida recomendado:' +
      '</p>' +
    '</div>' +

    '<div class="diag-result-hero-box ' + badgeClase + '">' +
      '<div class="res-hero-badge-row">' +
        '<span class="diag-level-chip ' + badgeClase + '">' + info.insignia + '</span>' +
        '<span class="diag-score-chip">Puntaje global: ' + (resultado.puntaje || 8) + ' / 12 pts</span>' +
      '</div>' +
      '<h4 class="res-hero-title">' + info.titulo + '</h4>' +
      '<p class="res-hero-desc">' + info.descripcion + '</p>' +

      '<div class="res-puntos-clave">' +
        '<h5>🌱 Lo que lograrás en esta ruta:</h5>' +
        '<ul>' + puntosClaveHtml + '</ul>' +
      '</div>' +

      '<div class="res-materias-sugeridas-box">' +
        '<h5>Materias recomendadas para tu inicio:</h5>' +
        '<div class="diag-materias-list">' + materiasHtml + '</div>' +
        '<p class="res-ruta-note">' + info.mensajeRuta + '</p>' +
      '</div>' +
    '</div>' +

    '<h4 style="font-size: 15px; font-weight: 800; color: var(--text-dark); margin: 20px 0 10px;">' +
      '🔍 Resumen de tus 4 dimensiones evaluadas:' +
    '</h4>' +
    '<div class="diag-dim-grid">' +
      dimensionesHtml +
    '</div>' +

    '<div class="diag-result-footer">' +
      '<button class="btn-cta-outline" onclick="openDiagnosticoModal(true)" style="padding: 10px 18px;">' +
        '↺ Repetir Diagnóstico' +
      '</button>' +
      '<button class="btn-cta-yellow" onclick="cerrarYContinuarReticula()" style="padding: 12px 26px; font-size: 15px;">' +
        '¡Comenzar mi Retícula e Inscribirme! 🎓' +
      '</button>' +
    '</div>';
}

function cerrarYContinuarReticula() {
  closeDiagnosticoModal();
  renderReticula();
  const grid = document.getElementById('reticulaGrid');
  if (grid) {
    grid.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
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

function handleProfileSubmit(e) {
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

  const users = getUsers();
  const duplicado = users.some(function (u) {
    return u.email.toLowerCase() === email && u.email.toLowerCase() !== user.email.toLowerCase();
  });
  if (duplicado) {
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Ese correo ya está registrado en otra cuenta.'; }
    return;
  }

  const idx = users.findIndex(function (u) {
    return u.email.toLowerCase() === user.email.toLowerCase();
  });
  if (idx !== -1) {
    users[idx].name = name;
    users[idx].email = email;
    saveUsers(users);
  }

  setCurrentUser({ name: name, email: email });
  updateAuthUI();

  if (msg) { msg.className = 'form-message success'; msg.textContent = '✅ Perfil actualizado correctamente.'; }
}

function handlePasswordSubmit(e) {
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

  const users = getUsers();
  const idx = users.findIndex(function (u) {
    return u.email.toLowerCase() === user.email.toLowerCase();
  });

  if (idx === -1 || users[idx].password !== current) {
    if (curEl) curEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Tu contraseña actual no es correcta.'; }
    return;
  }
  if (nueva.length < 6) {
    if (newEl) newEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'La nueva contraseña debe tener al menos 6 caracteres.'; }
    return;
  }
  if (nueva !== conf) {
    if (confEl) confEl.classList.add('input-invalid');
    if (msg) { msg.className = 'form-message error'; msg.textContent = 'Las contraseñas no coinciden.'; }
    return;
  }

  users[idx].password = nueva;
  saveUsers(users);

  const form = document.getElementById('configPasswordForm');
  if (form) form.reset();

  if (msg) { msg.className = 'form-message success'; msg.textContent = '✅ Contraseña actualizada correctamente.'; }
}

function togglePref(key, value) {
  const prefs = getPrefs();
  prefs[key] = value;
  savePrefs(prefs);
}

// ------------------------------------------------------------
// 17. ASISTENTE FINANCIERO "FIN" (local, por reglas)
// ------------------------------------------------------------
const FIN_CONOCIMIENTO = [
  {
    claves: ['ahorro', 'ahorrar', 'guardar dinero', 'fondo de emergencia', 'emergencia'],
    respuesta: 'El ahorro es la base de tu salud financiera: aparta primero una parte de tus ingresos y gasta después. Empieza con un fondo de emergencia de 3 a 6 meses de tus gastos fijos.',
    enlaces: [{ texto: 'Ver cursos de ahorro', href: 'cursos.html' }]
  },
  {
    claves: ['interes compuesto', 'interes', 'inversion', 'invertir', 'rendimiento', 'capital'],
    respuesta: 'El interés compuesto es ganar intereses sobre tus intereses. Con el tiempo, ese efecto hace crecer tu dinero de forma exponencial. Puedes probarlo en la calculadora de Recursos.',
    enlaces: [{ texto: 'Abrir calculadora', href: 'recursos.html' }]
  },
  {
    claves: ['presupuesto', '50/30/20', 'gastos', 'ingresos', 'planificar'],
    respuesta: 'La regla 50/30/20 sugiere destinar 50% de tus ingresos a necesidades, 30% a gustos y 20% a ahorro o deudas. Es una guía simple para ordenar tus finanzas cada mes.',
    enlaces: [{ texto: 'Ver curso de presupuesto', href: 'cursos.html' }]
  },
  {
    claves: ['deuda', 'deudas', 'tarjeta', 'tarjeta de credito', 'credito', 'prestamo'],
    respuesta: 'Para salir de deudas, prioriza las de mayor interés (método avalancha) o las más pequeñas para ganar impulso (método bola de nieve). Evita financiar gustos con tarjeta de crédito.',
    enlaces: [{ texto: 'Ver recursos', href: 'recursos.html' }]
  },
  {
    claves: ['reticula', 'inscribir', 'inscripcion', 'semestre', 'materia', 'materias', 'curso'],
    respuesta: 'En tu Retícula Académica te inscribes primero a 2 unidades y luego avanzas una materia por semestre. Entra y haz clic en cada materia para ver su temario.',
    enlaces: [{ texto: 'Ir a Retícula', href: 'reticula.html' }]
  },
  {
    claves: ['contrasena', 'contraseña', 'configuracion', 'configuraciones', 'perfil', 'cuenta', 'correo'],
    respuesta: 'Puedes actualizar tu perfil, cambiar tu contraseña y ajustar tus preferencias desde la página de Configuraciones.',
    enlaces: [{ texto: 'Ir a Configuraciones', href: 'configuraciones.html' }]
  },
  {
    claves: ['contacto', 'soporte', 'ayuda', 'duda', 'problema', 'correo de contacto'],
    respuesta: 'Estoy aquí para orientarte sobre finanzas y sobre cómo usar la plataforma. Si necesitas soporte, revisa la sección de Recursos.',
    enlaces: [{ texto: 'Ver Recursos', href: 'recursos.html' }]
  },
  {
    claves: ['hola', 'buenas', 'buenos dias', 'buenas tardes', 'hey', 'saludos', 'que tal'],
    respuesta: '¡Hola! Soy Fin 🪙. Puedo explicarte conceptos de finanzas o guiarte por la plataforma. ¿Qué necesitas?',
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

  const btn = document.createElement('button');
  btn.id = 'finToggle';
  btn.className = 'fin-btn';
  btn.setAttribute('type', 'button');
  btn.setAttribute('aria-label', 'Abrir asistente Fin');
  btn.innerHTML = '🪙<span class="fin-btn-ping"></span>';

  const panel = document.createElement('div');
  panel.id = 'finPanel';
  panel.className = 'fin-panel';
  panel.setAttribute('role', 'dialog');
  panel.setAttribute('aria-label', 'Asistente Fin');
  panel.innerHTML =
    '<div class="fin-header">' +
      '<div class="fin-avatar">🪙</div>' +
      '<div class="fin-header-text"><strong>Fin</strong><span>Tu asistente financiero</span></div>' +
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
    btn.setAttribute('aria-label', abrir ? 'Cerrar asistente Fin' : 'Abrir asistente Fin');
    if (abrir) {
      if (!yaSaludo) {
        yaSaludo = true;
        agregar('bot', '¡Hola! Soy <strong>Fin</strong> 🪙, tu asistente financiero. ¿En qué te ayudo hoy?');
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

// Llamada inicial (tras declarar los datos de la retícula y las preferencias)
updateAuthUI();
initAsistente();// ------------------------------------------------------------
// 18. WHATSAPP QUICK CONTACT
// ------------------------------------------------------------
const WHATSAPP_NUM = '5210000000000'; // Cambiar por n�mero real
const WHATSAPP_OPTS = [
  { label: 'Dudas de cursos', texto: 'Hola, tengo una duda sobre los cursos de Educaci�n Financiera.' },
  { label: 'Soporte t�cnico', texto: 'Hola, necesito soporte para acceder a la plataforma.' },
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
  panel.setAttribute('aria-label','Atenci�n por WhatsApp');
  panel.innerHTML =
    '<div class="wapp-header">' +
      '<div class="wapp-avatar">' +
        '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM20.52 3.449C12.831-3.984 0 1.407 0 11.251c0 2.05.549 4.052 1.596 5.828L0 24l6.242-1.636c1.746.954 3.719 1.461 5.725 1.461 9.72 0 15.52-10.556 8.553-20.376z"/></svg>' +
      '</div>' +
      '<div class="wapp-header-text"><strong>Atenci�n por WhatsApp</strong><span>En l�nea para ayudarte</span></div>' +
      '<button class="wapp-close" id="wappClose" type="button" aria-label="Cerrar">�</button>' +
    '</div>' +
    '<div class="wapp-body">' +
      '<div class="wapp-hint">�En qu� puedo ayudarte?</div>' +
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

// ============================================================
// 16. TUTORIALES PRÁCTICOS: GASTOS HORMIGA Y CÓMO EMPEZAR A AHORRAR
//     (Integrado a Finanzas Personales en cursos.html)
// ============================================================

const TUTORIALES_FINANZAS = [
  {
    id: 'gastos-hormiga-1',
    categoria: 'gastos-hormiga',
    badge: '🐜 Gastos Hormiga',
    badgeClass: 'tut-badge-hormiga',
    modalBadgeClass: 'badge-hormiga',
    icono: '🔍',
    tiempo: '5 min de lectura + Calculadora',
    nivel: 'Diagnóstico Rápido',
    titulo: '¿Qué son los Gastos Hormiga y cómo detectarlos en 24 horas?',
    subtitulo: 'Aprende a descubrir esas micro-fugas silenciosas que parecen inofensivas pero desangran más de $18,000 MXN al año.',
    descripcion: 'Descubre cómo pequeños desembolsos cotidianos ($25 a $60 diarios) en botanas, cafés o redondeos merman tu capacidad de ahorro sin que te des cuenta.',
    snippetEtiqueta: 'Calculadora en vivo',
    snippetPreview: 'Un café diario de $50 = <strong>$18,250 MXN / año</strong>',
    pasos: [
      {
        num: 1,
        titulo: 'Anatomía de una fuga silenciosa: ¿Qué califica como gasto hormiga?',
        desc: 'Un gasto hormiga es aquel desembolso de monto pequeño, no planificado y recurrente que realizas casi en piloto automático. Ejemplos habituales: el café de camino al trabajo ($45 - $70), botellas de agua en la calle ($20), propinas extras desmedidas, comisiones por retirar en cajeros que no son de tu banco ($35) y aplicaciones móviles con suscripciones olvidadas.',
        tip: '💡 Regla de oro: No importa si son $15 o $50; si ocurre varias veces por semana y no estaba presupuestado, es una fuga hormiga.'
      },
      {
        num: 2,
        titulo: 'El sesgo psicológico de la moneda: Por qué tu cerebro te engaña',
        desc: 'Psicológicamente, pagar con monedas o dar un "tap" rápido con la tarjeta por $30 no activa los centros de dolor financiero en el cerebro. Sentimos que gastar $30 "no nos hace ni más ricos ni más pobres". Sin embargo, las matemáticas del interés compuesto negativo demuestran que 4 gastos pequeños al día suman fácilmente $120 diarios = $3,600 al mes.',
        tip: '🧠 Clave mental: Cuando compres algo impulsivo, pregúntate: "¿Trabajaría 30 minutos de mi vida laboral para pagar este snack de 5 minutos?"'
      },
      {
        num: 3,
        titulo: 'El Reto de las 24 horas: Auditoría implacable en tiempo real',
        desc: 'Durante las próximas 24 horas consecutivas, no cambies tus hábitos. Únicamente abre una nota en tu teléfono titulada "Fugas de Hoy". Cada vez que entregues efectivo o uses tu tarjeta por cualquier importe (incluso $5 de propina o chicles), anota la hora exacta, el concepto y la cantidad. Al finalizar el día, suma el total.',
        tip: '📱 Herramienta recomendada: Una simple nota de WhatsApp contigo mismo o la app de notas nativa de tu celular.'
      },
      {
        num: 4,
        titulo: 'La multiplicación anual: El verdadero costo de oportunidad',
        desc: 'Toma la suma de tus gastos hormiga diarios y multiplícala por 365 días. Por ejemplo: $65 diarios = $23,725 MXN al año. Pregúntate: ¿Qué harías hoy con $23,700 en efectivo? Podrías cubrir 3 meses de renta, liquidar una tarjeta de crédito o dar el enganche de una meta importante.',
        tip: '📈 Potencial inversor: Si esos $65 diarios los inviertes mensualmente a una tasa conservadora del 10% anual, en 5 años tendrías más de $150,000 MXN.'
      }
    ],
    widget: 'hormiga',
    checklist: [
      'Crear una nota en mi teléfono para registrar todos mis gastos durante 24 horas.',
      'Identificar mis 2 gastos hormiga más frecuentes de la semana (ej. cafés y snacks).',
      'Calcular cuánto dinero anual representan y compararlo con un mes de mi salario.'
    ]
  },
  {
    id: 'gastos-hormiga-2',
    categoria: 'gastos-hormiga',
    badge: '🐜 Gastos Hormiga',
    badgeClass: 'tut-badge-hormiga',
    modalBadgeClass: 'badge-hormiga',
    icono: '🔄',
    tiempo: '6 min de lectura + Matriz',
    nivel: 'Estrategia de Sustitución',
    titulo: 'El Método de Sustitución Inteligente para erradicar Gastos Hormiga',
    subtitulo: 'Erradica las fugas sin sufrir ni privarte drásticamente gracias a la matriz de reemplazo y la regla de las 48 horas.',
    descripcion: 'La privación absoluta produce efecto rebote. Aprende a sustituir hábitos caros por alternativas inteligentes que rescatan hasta $3,000 MXN mensuales.',
    snippetEtiqueta: 'Matriz de Reemplazo',
    snippetPreview: 'Café de termo vs Cafetería = <strong>Rescata $1,512/mes</strong>',
    pasos: [
      {
        num: 1,
        titulo: 'El peligro del "Efecto Dieta": Por qué la privación radical fracasa',
        desc: 'Prohibirte tajantemente cualquier gusto provoca ansiedad financiera. Tras 10 días de negarte todo, es común que termines gastando el doble en una compra impulsiva desahogándote con la frase "para eso trabajo". La verdadera disciplina financiera no es abstinencia, es optimización de valor.',
        tip: '⚠️ Alerta de comportamiento: Cambia la pregunta "¿Cómo puedo no gastar nada?" por "¿Cómo obtengo el mismo bienestar por una fracción del costo?"'
      },
      {
        num: 2,
        titulo: 'La Matriz de Sustitución de Valor (Mismo placer, 70% menos costo)',
        desc: 'Analiza la necesidad real detrás del gasto. Si compras café de $75 por la mañana, usualmente buscas cafeína, un aroma delicioso y un momento de pausa. Comprar café de grano de especialidad ($250 el kilo) y prepararlo en casa te brinda mejor sabor y cuesta solo $12 por termo de 500ml. Ahorro mensual: más de $1,500 MXN.',
        tip: '🎯 Ejemplo cotidiano: Llevar un termo de agua de acero inoxidable ($250 pago único) evita comprar 2 botellas de $18 diarias ($1,080/mes de ahorro).'
      },
      {
        num: 3,
        titulo: 'La Regla de Enfriamiento de las 48 Horas para compras de impulso',
        desc: 'Cuando veas una oferta relámpago, un antojo o un accesorio no indispensable, aplícate una pausa obligatoria de 48 horas. Agrégalo al carrito o tómale una foto, pero aléjate. Si tras dos noches de sueño sigues considerando que aportará valor real y cabe en tu presupuesto, cómpralo. En el 85% de los casos, la dopamina se disipa y te das cuenta de que no lo necesitabas.',
        tip: '⏳ Truco digital: Desinstala las tarjetas bancarias guardadas en tus aplicaciones de comercio electrónico y delivery para agregar fricción saludable.'
      },
      {
        num: 4,
        titulo: 'Transferencia refleja: El dinero ahorrado debe aislarse de inmediato',
        desc: 'Cada vez que decidas no hacer un gasto hormiga (por ejemplo, resistir un antojo de $80 o cocinar en lugar de pedir a domicilio), abre la app de tu banco y transfiere esos $80 a una cuenta de ahorro o apartado. Si dejas el dinero en tu cuenta de débito, se diluirá en cualquier otra compra.',
        tip: '✨ Efecto gamificación: Sentirás la satisfacción tangible de ver crecer tu alcancía digital en tiempo real.'
      }
    ],
    widget: 'sustitucion',
    checklist: [
      'Elegir al menos 2 hábitos de la matriz de sustitución para aplicar esta semana.',
      'Esperar 48 horas obligatorias antes de realizar mi próxima compra no programada.',
      'Eliminar las tarjetas de crédito autoguardadas en apps de delivery o compras rápidas.'
    ]
  },
  {
    id: 'ahorro-1',
    categoria: 'ahorro',
    badge: '🌱 Cómo Empezar a Ahorrar',
    badgeClass: 'tut-badge-ahorro',
    modalBadgeClass: 'badge-ahorro',
    icono: '💰',
    tiempo: '6 min de lectura + Simulador',
    nivel: 'Hábito Fundamental',
    titulo: 'De $0 a tu primer ahorro: El método infalible "Págate a ti primero"',
    subtitulo: 'Deja de intentar ahorrar lo que sobra a fin de mes. Aprende a separar tu porcentaje el mismo día que entra tu ingreso.',
    descripcion: 'Si esperas a que termine el mes para ahorrar, nunca quedará nada. Invierte la ecuación financiera y automatiza tu ahorro sin fricción.',
    snippetEtiqueta: 'Simulador Progresivo',
    snippetPreview: '10% de ahorro automático = <strong>Garantiza tu tranquilidad</strong>',
    pasos: [
      {
        num: 1,
        titulo: 'La Ley de Parkinson del dinero: Por qué nunca sobra nada a fin de mes',
        desc: 'La Ley de Parkinson establece que "los gastos se expanden naturalmente hasta igualar el total de ingresos disponibles". Si ganas $8,000, te los gastas; si mañana te ascienden a $15,000, tu mente adapta tu estilo de vida para gastarse los $15,000. Por eso, el intento de "ahorrar lo que sobre" está condenado al fracaso.',
        tip: '💡 La trampa común: Ahorrar no es un evento de fin de mes; es la primera factura obligatoria de cada quincena.'
      },
      {
        num: 2,
        titulo: 'Invierte la fórmula financiera: De víctima a pagador prioritario',
        desc: 'La mayoría de las personas usan la fórmula perdedora: (Ingresos) - (Gastos y antojos) = (Ahorro que resulta ser $0). La fórmula de quienes construyen patrimonio es: (Ingresos) - (Ahorro fijo 10%) = (Presupuesto libre para vivir y gastar). Al apartar tu dinero de primero, ajustas tus decisiones cotidianas a la cantidad restante sin estrés.',
        tip: '🔑 Mentalidad: Tú eres el empleado más importante de tu vida; ¿por qué pagarle primero al casero, a la compañía telefónica o al supermercado antes que a tu propio futuro?'
      },
      {
        num: 3,
        titulo: 'La escalera del porcentaje: Cómo arrancar sin ahogarte',
        desc: 'No necesitas empezar ahorrando el 40% de tu sueldo. Empieza con un 5% o un 10%. Por ejemplo, en un salario de $12,000 al mes, apartar el 10% son solo $1,200 ($600 por quincena). Vivirás prácticamente igual con $10,800 que con $12,000, pero al cabo de un año tendrás $14,400 ahorrados en tu cuenta.',
        tip: '🌱 Regla de adaptación: Cada vez que recibas un aumento salarial o un ingreso extra, ahorra el 50% de ese aumento antes de subir tu nivel de gasto.'
      },
      {
        num: 4,
        titulo: 'Automatización invisible: Cero fuerza de voluntad',
        desc: 'La disciplina es un recurso limitado. El truco maestro de las finanzas personales es programar una transferencia automática para el mismo día de tu nómina hacia una cuenta secundaria (sin tarjeta plástica asociada), apartados bancarios o Cetesdirecto. El dinero desaparece de tu vista antes de que puedas tentarte a gastarlo.',
        tip: '🏦 Opciones recomendadas en México: Cajitas de ahorro a la vista (Nu, Klar, Mercado Pago) o Apartados automáticos BBVA / Banorte.'
      }
    ],
    widget: 'pagate-primero',
    checklist: [
      'Definir mi porcentaje o cuota inicial de ahorro (mínimo 5% o 10% de mis ingresos).',
      'Configurar una transferencia automática o apartado bancario para mi próximo día de pago.',
      'Comprometerme a no tocar ese fondo salvo que se trate de mi fondo de emergencia.'
    ]
  },
  {
    id: 'ahorro-2',
    categoria: 'ahorro',
    badge: '🌱 Cómo Empezar a Ahorrar',
    badgeClass: 'tut-badge-ahorro',
    modalBadgeClass: 'badge-ahorro',
    icono: '🛡️',
    tiempo: '7 min de lectura + Planificador',
    nivel: 'Seguridad Financiera',
    titulo: 'Cómo construir tu Fondo de Emergencia: Tu colchón de tranquilidad',
    subtitulo: 'Construye tu primer escudo protector de 1 a 3 meses de gastos para no volver a endeudarte jamás ante cualquier imprevisto.',
    descripcion: 'Una emergencia de salud o del auto puede destruir meses de progreso si recurres a tarjetas con altos intereses. Diseña tu escudo por etapas.',
    snippetEtiqueta: 'Planificador de Escudo',
    snippetPreview: 'Meta inicial de Choque = <strong>$3,000 a $5,000 MXN</strong>',
    pasos: [
      {
        num: 1,
        titulo: '¿Por qué el Fondo de Emergencia es el paso previo a invertir?',
        desc: 'Invertir en bolsa o fondos sin tener un colchón de emergencia es una trampa. Si surge un gasto urgente (reparación del auto, urgencia dental, desempleo), te verás obligado a malvender tus inversiones con pérdidas o a pedir préstamos con CAT de 60% a 100%. El fondo de emergencia no busca hacerte rico; busca evitar que vuelvas a caer en deudas.',
        tip: '🛡️ Concepto clave: Tu fondo de emergencia es el seguro de vida de tu tranquilidad mental.'
      },
      {
        num: 2,
        titulo: 'La estrategia por hitos: Divide una meta grande en victorias pequeñas',
        desc: 'Escuchar que debes juntar 3 meses de gastos puede parecer inalcanzable si estás en ceros. Por eso dividimos el objetivo en 3 etapas claras:\n• Hito 1 - Fondo de Choque: $3,000 a $5,000 MXN para imprevistos menores.\n• Hito 2 - Fondo Base: 1 mes completo de tus gastos fijos indispensables.\n• Hito 3 - Fondo Blindado: 3 a 6 meses de gastos fijos si eres empleado, o 6 a 12 meses si trabajas de forma independiente/freelance.',
        tip: '🎯 Enfoque: Celebra con orgullo cuando completes el Hito 1; desde ese instante, el 80% de los incidentes cotidianos ya no te quitarán el sueño.'
      },
      {
        num: 3,
        titulo: '¿Dónde debe estar guardado el dinero? (Las 3 condiciones)',
        desc: 'Un fondo de emergencia debe cumplir tres reglas estrictas:\n1. 100% Líquido: Puedes disponer de él en menos de 24 horas en días hábiles.\n2. Capital Seguro: Cero riesgo de volatilidad negativa (no acciones, no criptomonedas).\n3. Rendimiento contra inflación: Instrumentos de renta fija como Cetesdirecto (Bonddia) o cuentas a la vista con rendimiento anual garantizado.',
        tip: '🚫 Jamás en efectivo debajo del colchón: La inflación devalúa el efectivo y corres riesgo de robo o extravío.'
      },
      {
        num: 4,
        titulo: 'El Semáforo de Emergencia: Cuándo SÍ tocarlo y cuándo NO',
        desc: 'Para proteger tu fondo de falsas alarmas, somete cualquier gasto a 3 preguntas:\n1. ¿Es INESPERADO? (El mantenimiento anual del auto o regalos navideños no son emergencias; son gastos programables).\n2. ¿Es INDISPENSABLE para tu salud, vivienda o trabajo?\n3. ¿Es URGENTE y no puede postergarse?',
        tip: '🚦 Si responde SÍ a las 3 preguntas: úsalo con total tranquilidad y luego enfócate en reponerlo.'
      }
    ],
    widget: 'fondo-emergencia',
    checklist: [
      'Calcular el monto exacto de mis gastos fijos mensuales indispensables.',
      'Definir mi meta del Hito 1 (Choque inicial de $3,000 a $5,000 MXN).',
      'Elegir una cuenta líquida con rendimiento (ej. Cetesdirecto o cajita digital) para depositarlo.'
    ]
  }
];

// Almacenamiento de progreso en localStorage
function getTutorialsStorageKey() {
  const user = getCurrentUser();
  const email = (user && user.email) ? user.email.toLowerCase() : 'guest';
  return 'edu_fin_tutorials_v1_' + email;
}

function getTutorialsData() {
  try {
    const raw = localStorage.getItem(getTutorialsStorageKey());
    if (raw) return JSON.parse(raw);
  } catch (e) {
    console.error('Error al cargar progreso de tutoriales:', e);
  }
  return { completed: {}, checklist: {} };
}

function saveTutorialsData(data) {
  try {
    localStorage.setItem(getTutorialsStorageKey(), JSON.stringify(data));
  } catch (e) {
    console.error('Error al guardar progreso de tutoriales:', e);
  }
}

// Variables de estado local de la sección
let activeTutorialFilter = 'todos';
let currentOpenTutorialId = null;

// Renderizar las tarjetas de tutoriales en la cuadrícula
function renderTutoriales(filtro = activeTutorialFilter) {
  const grid = document.getElementById('tutorialsGrid');
  if (!grid) return;

  activeTutorialFilter = filtro;
  const data = getTutorialsData();
  const completedMap = data.completed || {};

  // Actualizar contadores en la cabecera y filtros
  const totalCount = TUTORIALES_FINANZAS.length;
  let completedCount = 0;
  let hormigaCount = 0;
  let ahorroCount = 0;

  TUTORIALES_FINANZAS.forEach(t => {
    if (completedMap[t.id]) completedCount++;
    if (t.categoria === 'gastos-hormiga') hormigaCount++;
    if (t.categoria === 'ahorro') ahorroCount++;
  });

  const tutCompletedCountEl = document.getElementById('tutCompletedCount');
  const tutTotalCountEl = document.getElementById('tutTotalCount');
  const tutProgressLabel = document.getElementById('tutProgressLabel');
  const tutStatCircle = document.getElementById('tutStatCircle');

  if (tutCompletedCountEl) tutCompletedCountEl.textContent = completedCount;
  if (tutTotalCountEl) tutTotalCountEl.textContent = totalCount;
  if (tutProgressLabel) {
    if (completedCount === 0) {
      tutProgressLabel.textContent = 'Comienza tu primer tutorial hoy';
    } else if (completedCount < totalCount) {
      tutProgressLabel.textContent = `¡Excelente! Llevas ${completedCount} de ${totalCount} completados`;
    } else {
      tutProgressLabel.textContent = '🎉 ¡Felicidades! Todos los tutoriales dominados';
    }
  }

  // Filtrar tutoriales a mostrar
  const filtered = TUTORIALES_FINANZAS.filter(t => {
    if (activeTutorialFilter === 'todos') return true;
    return t.categoria === activeTutorialFilter;
  });

  // Generar HTML de las tarjetas
  grid.innerHTML = filtered.map(t => {
    const isCompleted = !!completedMap[t.id];
    return `
      <article class="tutorial-card ${isCompleted ? 'completed' : ''}" id="card-tut-${t.id}">
        <div class="tut-card-top">
          <span class="tut-card-badge ${t.badgeClass}">
            <span>${t.icono}</span> ${t.badge}
          </span>
          <span class="tut-card-time">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            ${t.tiempo}
          </span>
        </div>

        <h3 class="tut-card-title">${t.titulo}</h3>
        <p class="tut-card-desc">${t.descripcion}</p>

        <div class="tut-card-snippet">
          <div class="tut-snippet-label">
            <span>✨</span> ${t.snippetEtiqueta}:
          </div>
          <div class="tut-snippet-calc-preview">
            <span>${t.snippetPreview}</span>
          </div>
        </div>

        <div class="tut-card-footer">
          <button class="tut-btn-open" type="button" onclick="openTutorialModal('${t.id}')">
            Abrir tutorial práctico <span>→</span>
          </button>
          <button class="tut-btn-mark ${isCompleted ? 'is-completed' : ''}" type="button" title="${isCompleted ? 'Marcar como pendiente' : 'Marcar como completado'}" onclick="toggleTutorialCompletado('${t.id}')">
            ${isCompleted ? '✓' : '○'}
          </button>
        </div>
      </article>
    `;
  }).join('');
}

// Filtrar tutoriales por pestaña
function filtrarTutoriales(filtro, btnEl) {
  activeTutorialFilter = filtro;
  document.querySelectorAll('.tut-filter-btn').forEach(b => {
    b.classList.remove('active');
    b.setAttribute('aria-selected', 'false');
  });
  if (btnEl) {
    btnEl.classList.add('active');
    btnEl.setAttribute('aria-selected', 'true');
  }
  renderTutoriales(filtro);
}

// Desplazamiento suave hasta la sección de tutoriales
function scrollToTutorials() {
  const sec = document.getElementById('tutoriales-finanzas');
  if (sec) {
    sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

// Abrir el modal con todo el contenido detallado e interactivo
function openTutorialModal(tutorialId) {
  if (!getCurrentUser()) {
    openLoginModal();
    if (loginMsg) {
      loginMsg.className = 'form-message error';
      loginMsg.textContent = '🔒 Inicia sesión o crea tu cuenta gratis para acceder a los tutoriales y calculadoras de Finanzas Personales.';
    }
    return;
  }

  const tutorial = TUTORIALES_FINANZAS.find(t => t.id === tutorialId);
  if (!tutorial) return;

  currentOpenTutorialId = tutorialId;
  const data = getTutorialsData();
  const isCompleted = !!(data.completed && data.completed[tutorialId]);
  const userChecks = (data.checklist && data.checklist[tutorialId]) || {};

  const modalContainer = document.getElementById('tutorialModalContent');
  const modalOverlay = document.getElementById('tutorialDetailModal');
  if (!modalContainer || !modalOverlay) return;

  // Generar HTML del widget interactivo correspondiente
  let widgetHTML = '';
  if (tutorial.widget === 'hormiga') {
    widgetHTML = `
      <div class="tut-interactive-card">
        <div class="tut-widget-title">
          <span>🧮</span> Calculadora Interactiva: Tu Fuga Hormiga en Tiempo Real
        </div>
        <p class="tut-widget-desc">
          Ingresa tus micro-gastos cotidianos aproximados y observa cuánto dinero se fuga al mes, al año y cuánto tendrías si lo invirtieras al 10% anual.
        </p>

        <div class="hormiga-inputs-grid">
          <div class="hormiga-input-group">
            <label for="inpCafe">Café o bebida diaria</label>
            <div class="input-with-symbol">
              <span>$</span>
              <input type="number" id="inpCafe" value="45" min="0" step="5" oninput="calcularFugaHormiga()">
            </div>
          </div>
          <div class="hormiga-input-group">
            <label for="inpSnack">Snacks / golosinas / botanas</label>
            <div class="input-with-symbol">
              <span>$</span>
              <input type="number" id="inpSnack" value="30" min="0" step="5" oninput="calcularFugaHormiga()">
            </div>
          </div>
          <div class="hormiga-input-group">
            <label for="inpStreaming">Suscripciones no usadas (mes)</label>
            <div class="input-with-symbol">
              <span>$</span>
              <input type="number" id="inpStreaming" value="199" min="0" step="10" oninput="calcularFugaHormiga()">
            </div>
          </div>
          <div class="hormiga-input-group">
            <label for="inpComisiones">Comisiones cajeros / otros (mes)</label>
            <div class="input-with-symbol">
              <span>$</span>
              <input type="number" id="inpComisiones" value="100" min="0" step="10" oninput="calcularFugaHormiga()">
            </div>
          </div>
        </div>

        <div class="hormiga-results-board">
          <div class="hormiga-res-item">
            <span>Fuga Diaria Promedio</span>
            <strong id="resHormigaDiario">$85 MXN</strong>
          </div>
          <div class="hormiga-res-item">
            <span>Fuga Mensual</span>
            <strong id="resHormigaMensual">$2,849 MXN</strong>
          </div>
          <div class="hormiga-res-item">
            <span>Fuga Anual Total</span>
            <strong id="resHormigaAnual">$34,188 MXN</strong>
          </div>
        </div>

        <div class="hormiga-compound-callout">
          <span style="font-size: 20px;">🚀</span>
          <div>
            <strong>Potencial a 5 años invertido al 10% anual:</strong>
            <span id="resHormigaInvertido" style="font-weight: 800; color: #00ba6d; font-size: 14px;"> $219,850 MXN</span>
            <p style="margin: 4px 0 0; font-size: 11.5px; color: #435b52;">Ese dinero ahorrado e invertido en renta fija (como Cetes) pagaría tu tranquilidad o un gran proyecto.</p>
          </div>
        </div>
      </div>
    `;
  } else if (tutorial.widget === 'sustitucion') {
    widgetHTML = `
      <div class="tut-interactive-card">
        <div class="tut-widget-title">
          <span>🔄</span> Matriz de Sustitución Inteligente: ¿Cuánto rescatarás al mes?
        </div>
        <p class="tut-widget-desc">
          Selecciona las alternativas que estás dispuesto a aplicar en tu día a día para calcular tu rescate mensual garantizado:
        </p>

        <table class="substitution-table">
          <thead>
            <tr>
              <th style="width: 36px;">Aplicar</th>
              <th>Hábito Costoso</th>
              <th>Sustituto Inteligente</th>
              <th style="text-align: right;">Ahorro Mensual</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" class="sub-checkbox" checked onchange="actualizarSustitucionMatriz()" data-ahorro="1512">
              </td>
              <td><span class="sub-before">Cafetería ($75/día)</span></td>
              <td><span class="sub-after">Café de grano en termo ($12/día)</span></td>
              <td style="text-align: right;"><span class="sub-save">+$1,512 MXN</span></td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" class="sub-checkbox" checked onchange="actualizarSustitucionMatriz()" data-ahorro="2400">
              </td>
              <td><span class="sub-before">Comida rápida por flojera ($160/día)</span></td>
              <td><span class="sub-after">Meal prep / cocina rápida ($40/día)</span></td>
              <td style="text-align: right;"><span class="sub-save">+$2,400 MXN</span></td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" class="sub-checkbox" checked onchange="actualizarSustitucionMatriz()" data-ahorro="480">
              </td>
              <td><span class="sub-before">Botellas de agua desechables ($20/día)</span></td>
              <td><span class="sub-after">Termo reutilizable de agua ($0)</span></td>
              <td style="text-align: right;"><span class="sub-save">+$480 MXN</span></td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" class="sub-checkbox" checked onchange="actualizarSustitucionMatriz()" data-ahorro="199">
              </td>
              <td><span class="sub-before">1 Streaming que casi no ves</span></td>
              <td><span class="sub-after">Cancelar y alternar meses</span></td>
              <td style="text-align: right;"><span class="sub-save">+$199 MXN</span></td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" class="sub-checkbox" checked onchange="actualizarSustitucionMatriz()" data-ahorro="140">
              </td>
              <td><span class="sub-before">Retiros en cajeros ajenos (4 al mes)</span></td>
              <td><span class="sub-after">Retirar en cajero de tu banco o súper</span></td>
              <td style="text-align: right;"><span class="sub-save">+$140 MXN</span></td>
            </tr>
          </tbody>
        </table>

        <div class="sub-summary-banner">
          <span>Rescate financiero total al mes:</span>
          <strong id="resSubMensual">+$4,731 MXN / mes</strong>
        </div>
      </div>
    `;
  } else if (tutorial.widget === 'pagate-primero') {
    widgetHTML = `
      <div class="tut-interactive-card">
        <div class="tut-widget-title">
          <span>📊</span> Simulador Progresivo: El Método "Págate a ti primero"
        </div>
        <p class="tut-widget-desc">
          Introduce tu ingreso mensual estimado y elige el porcentaje con el que te comprometerás a empezar el próximo día de pago:
        </p>

        <div class="pagate-controls">
          <div class="hormiga-input-group" style="max-width: 300px;">
            <label for="inpSueldoMensual">Tu ingreso mensual aproximado</label>
            <div class="input-with-symbol">
              <span>$</span>
              <input type="number" id="inpSueldoMensual" value="14000" min="1000" step="500" oninput="calcularSimuladorAhorro()">
            </div>
          </div>

          <div>
            <label style="font-size: 12px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; display: block;">
              Porcentaje que separarás de inmediato:
            </label>
            <div class="pagate-percent-btns">
              <button type="button" class="btn-percent-opt" onclick="seleccionarPorcentajeAhorro(this, 5)">5% (Suave)</button>
              <button type="button" class="btn-percent-opt active" onclick="seleccionarPorcentajeAhorro(this, 10)">10% (Recomendado)</button>
              <button type="button" class="btn-percent-opt" onclick="seleccionarPorcentajeAhorro(this, 15)">15% (Avanzado)</button>
              <button type="button" class="btn-percent-opt" onclick="seleccionarPorcentajeAhorro(this, 20)">20% (Acelerado)</button>
            </div>
          </div>
        </div>

        <div class="pagate-cards-grid">
          <div class="pagate-res-card">
            <span>Ahorro por Quincena</span>
            <strong id="resPagateQuincena">$700 MXN</strong>
          </div>
          <div class="pagate-res-card">
            <span>Ahorro Mensual</span>
            <strong id="resPagateMes">$1,400 MXN</strong>
          </div>
          <div class="pagate-res-card">
            <span>En 6 Meses</span>
            <strong id="resPagateSemestre">$8,400 MXN</strong>
          </div>
          <div class="pagate-res-card">
            <span>En 1 Año (sin estrés)</span>
            <strong id="resPagateAnio" style="color: #06402d;">$16,800 MXN</strong>
          </div>
        </div>

        <div class="pagate-recommendation-chips">
          <div class="bank-tool-chip">
            <strong>Apartados automáticos BBVA / Banorte</strong>
            <span>Aparta la cantidad el mismo día sin comisiones.</span>
          </div>
          <div class="bank-tool-chip">
            <strong>Cajitas Nu / Klar / Mercado Pago</strong>
            <span>Generan rendimientos diarios líquidos arriba del 10% anual.</span>
          </div>
          <div class="bank-tool-chip">
            <strong>Cetesdirecto (Ahorro recurrente)</strong>
            <span>Cargo automático a tu cuenta respaldado por el gobierno.</span>
          </div>
        </div>
      </div>
    `;
  } else if (tutorial.widget === 'fondo-emergencia') {
    widgetHTML = `
      <div class="tut-interactive-card">
        <div class="tut-widget-title">
          <span>🛡️</span> Calculadora de Colchón de Emergencia Personalizado
        </div>
        <p class="tut-widget-desc">
          Introduce la suma de tus gastos mensuales INDISPENSABLES (renta, servicios, comida esencial y transporte):
        </p>

        <div class="hormiga-input-group" style="max-width: 320px; margin-bottom: 14px;">
          <label for="inpGastosIndispensables">Tus gastos fijos mínimos al mes</label>
          <div class="input-with-symbol">
            <span>$</span>
            <input type="number" id="inpGastosIndispensables" value="9500" min="1000" step="500" oninput="calcularFondoEmergencia()">
          </div>
        </div>

        <label style="font-size: 12px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; display: block;">
          Selecciona tu objetivo de cobertura:
        </label>
        <div class="emergency-selector-row">
          <button type="button" class="btn-months-pill" onclick="seleccionarMesesEmergencia(this, 1)">1 Mes (Base)</button>
          <button type="button" class="btn-months-pill active" onclick="seleccionarMesesEmergencia(this, 3)">3 Meses (Recomendado)</button>
          <button type="button" class="btn-months-pill" onclick="seleccionarMesesEmergencia(this, 6)">6 Meses (Blindado)</button>
        </div>

        <div class="emergency-goal-card">
          <div class="emergency-goal-left">
            <span>Tu Objetivo de Fondo de Emergencia:</span>
            <strong id="resFondoTotal">$28,500 MXN</strong>
          </div>
          <div class="emergency-goal-right">
            <div>Ritmo sugerido: <strong id="resFondoQuincena" style="color: #cbf63e;">$1,188 / quincena</strong></div>
            <div style="font-size: 11px; opacity: 0.9;">para completarlo en 12 meses</div>
          </div>
        </div>

        <div class="emergency-semaphore-grid">
          <div class="sema-card sema-green">
            <strong>✅ SÍ es una emergencia:</strong>
            Urgencia médica repentina, reparación urgente del coche para ir a trabajar, desempleo temporal o rotura de tubería esencial del hogar.
          </div>
          <div class="sema-card sema-red">
            <strong>❌ NO es una emergencia:</strong>
            Boletos para un concierto, promociones de Hot Sale / Buen Fin, regalos de cumpleaños o vacaciones no presupuestadas.
          </div>
        </div>
      </div>
    `;
  }

  // Generar pasos
  const stepsHTML = tutorial.pasos.map(p => `
    <div class="tut-step-item">
      <div class="tut-step-num">${p.num}</div>
      <div class="tut-step-content">
        <h4 class="tut-step-title">${p.titulo}</h4>
        <p class="tut-step-desc">${p.desc.replace(/\n/g, '<br>')}</p>
        <div class="tut-step-tip">${p.tip}</div>
      </div>
    </div>
  `).join('');

  // Generar checklist
  const checklistHTML = tutorial.checklist.map((item, idx) => {
    const isDone = !!userChecks[idx];
    return `
      <label class="tut-check-item ${isDone ? 'done' : ''}" id="check-item-${tutorial.id}-${idx}">
        <input type="checkbox" ${isDone ? 'checked' : ''} onchange="toggleTutorialChecklist('${tutorial.id}', ${idx}, this.checked)">
        <span>${item}</span>
      </label>
    `;
  }).join('');

  // Ensamble final del contenido modal
  modalContainer.innerHTML = `
    <div class="tut-modal-header">
      <div class="tut-modal-tags">
        <span class="tut-modal-badge ${tutorial.modalBadgeClass}">
          ${tutorial.icono} ${tutorial.badge}
        </span>
        <span class="tut-modal-time">⏱️ ${tutorial.tiempo} • Nivel: ${tutorial.nivel}</span>
      </div>
      <h2 class="tut-modal-title" id="tutDetailHeading">${tutorial.titulo}</h2>
      <p class="tut-modal-sub">${tutorial.subtitulo}</p>
    </div>

    <div class="tut-steps-container">
      ${stepsHTML}
    </div>

    ${widgetHTML}

    <div class="tut-checklist-box">
      <h4><span>📋</span> Lista de Acción Rápida (Marca tus avances):</h4>
      <div class="tut-checklist-list">
        ${checklistHTML}
      </div>
    </div>

    <div class="tut-modal-footer">
      <button class="btn-complete-tut ${isCompleted ? 'is-completed' : ''}" id="btnModalComplete" type="button" onclick="toggleTutorialCompletado('${tutorial.id}')">
        <span>${isCompleted ? '✓ Tutorial Completado' : 'Marcar como Completado'}</span>
      </button>
      <button class="btn-tut-close" type="button" onclick="closeTutorialModal()">
        Cerrar tutorial
      </button>
    </div>
  `;

  modalOverlay.classList.add('open');

  // Inicializar cálculos si corresponde
  if (tutorial.widget === 'hormiga') calcularFugaHormiga();
  if (tutorial.widget === 'sustitucion') actualizarSustitucionMatriz();
  if (tutorial.widget === 'pagate-primero') calcularSimuladorAhorro();
  if (tutorial.widget === 'fondo-emergencia') calcularFondoEmergencia();
}

// Cerrar modal de tutorial
function closeTutorialModal() {
  const modalOverlay = document.getElementById('tutorialDetailModal');
  if (modalOverlay) modalOverlay.classList.remove('open');
  currentOpenTutorialId = null;
}

// Alternar estado completado de un tutorial
function toggleTutorialCompletado(tutorialId) {
  if (!getCurrentUser()) {
    openLoginModal();
    return;
  }
  const data = getTutorialsData();
  data.completed = data.completed || {};
  data.completed[tutorialId] = !data.completed[tutorialId];
  saveTutorialsData(data);

  // Refrescar cuadrícula y botón del modal
  renderTutoriales();

  const btnModalComplete = document.getElementById('btnModalComplete');
  if (btnModalComplete && currentOpenTutorialId === tutorialId) {
    const isNow = !!data.completed[tutorialId];
    btnModalComplete.className = `btn-complete-tut ${isNow ? 'is-completed' : ''}`;
    btnModalComplete.innerHTML = `<span>${isNow ? '✓ Tutorial Completado' : 'Marcar como Completado'}</span>`;
  }
}

// Alternar checklist interactivo
function toggleTutorialChecklist(tutorialId, index, isChecked) {
  const data = getTutorialsData();
  data.checklist = data.checklist || {};
  data.checklist[tutorialId] = data.checklist[tutorialId] || {};
  data.checklist[tutorialId][index] = isChecked;
  saveTutorialsData(data);

  const itemEl = document.getElementById(`check-item-${tutorialId}-${index}`);
  if (itemEl) {
    if (isChecked) itemEl.classList.add('done');
    else itemEl.classList.remove('done');
  }
}

// ------------------------------------------------------------
// CALCULADORAS INTERACTIVAS DE LOS TUTORIALES
// ------------------------------------------------------------

// 1. Calculadora de Fuga Hormiga
function calcularFugaHormiga() {
  const cafe = parseFloat(document.getElementById('inpCafe')?.value) || 0;
  const snack = parseFloat(document.getElementById('inpSnack')?.value) || 0;
  const streaming = parseFloat(document.getElementById('inpStreaming')?.value) || 0;
  const comisiones = parseFloat(document.getElementById('inpComisiones')?.value) || 0;

  const diarioDirecto = cafe + snack;
  const mensualIndirecto = streaming + comisiones;
  const mensualTotal = (diarioDirecto * 30) + mensualIndirecto;
  const diarioTotal = mensualTotal / 30;
  const anualTotal = mensualTotal * 12;

  // Interés compuesto a 5 años aportando el ahorro mensual al 10% anual
  // FV = PMT * [((1 + r)^n - 1) / r]
  const r = 0.10 / 12;
  const n = 5 * 12;
  let proyectado = 0;
  if (r > 0 && mensualTotal > 0) {
    proyectado = mensualTotal * ((Math.pow(1 + r, n) - 1) / r);
  }

  const resDiario = document.getElementById('resHormigaDiario');
  const resMensual = document.getElementById('resHormigaMensual');
  const resAnual = document.getElementById('resHormigaAnual');
  const resInvertido = document.getElementById('resHormigaInvertido');

  if (resDiario) resDiario.textContent = '$' + Math.round(diarioTotal).toLocaleString('es-MX') + ' MXN';
  if (resMensual) resMensual.textContent = '$' + Math.round(mensualTotal).toLocaleString('es-MX') + ' MXN';
  if (resAnual) resAnual.textContent = '$' + Math.round(anualTotal).toLocaleString('es-MX') + ' MXN';
  if (resInvertido) resInvertido.textContent = '$' + Math.round(proyectado).toLocaleString('es-MX') + ' MXN';
}

// 2. Matriz de Sustitución
function actualizarSustitucionMatriz() {
  const checkboxes = document.querySelectorAll('.sub-checkbox:checked');
  let sumaMensual = 0;
  checkboxes.forEach(cb => {
    sumaMensual += parseFloat(cb.getAttribute('data-ahorro')) || 0;
  });

  const res = document.getElementById('resSubMensual');
  if (res) {
    res.textContent = '+$' + Math.round(sumaMensual).toLocaleString('es-MX') + ' MXN / mes';
  }
}

// 3. Simulador Págate a ti primero
let selectedAhorroPct = 10;
function seleccionarPorcentajeAhorro(btn, pct) {
  selectedAhorroPct = pct;
  document.querySelectorAll('.btn-percent-opt').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');
  calcularSimuladorAhorro();
}

function calcularSimuladorAhorro() {
  const sueldo = parseFloat(document.getElementById('inpSueldoMensual')?.value) || 0;
  const ahorroMes = sueldo * (selectedAhorroPct / 100);
  const ahorroQuincena = ahorroMes / 2;
  const ahorroSemestre = ahorroMes * 6;
  const ahorroAnio = ahorroMes * 12;

  const resQ = document.getElementById('resPagateQuincena');
  const resM = document.getElementById('resPagateMes');
  const resS = document.getElementById('resPagateSemestre');
  const resA = document.getElementById('resPagateAnio');

  if (resQ) resQ.textContent = '$' + Math.round(ahorroQuincena).toLocaleString('es-MX') + ' MXN';
  if (resM) resM.textContent = '$' + Math.round(ahorroMes).toLocaleString('es-MX') + ' MXN';
  if (resS) resS.textContent = '$' + Math.round(ahorroSemestre).toLocaleString('es-MX') + ' MXN';
  if (resA) resA.textContent = '$' + Math.round(ahorroAnio).toLocaleString('es-MX') + ' MXN';
}

// 4. Calculadora Fondo de Emergencia
let selectedMesesEmergencia = 3;
function seleccionarMesesEmergencia(btn, meses) {
  selectedMesesEmergencia = meses;
  document.querySelectorAll('.btn-months-pill').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');
  calcularFondoEmergencia();
}

function calcularFondoEmergencia() {
  const gastosMinimos = parseFloat(document.getElementById('inpGastosIndispensables')?.value) || 0;
  const totalMeta = gastosMinimos * selectedMesesEmergencia;
  // Aportación por quincena para lograrlo en 24 quincenas (1 año)
  const porQuincena = totalMeta / 24;

  const resTotal = document.getElementById('resFondoTotal');
  const resQ = document.getElementById('resFondoQuincena');

  if (resTotal) resTotal.textContent = '$' + Math.round(totalMeta).toLocaleString('es-MX') + ' MXN';
  if (resQ) resQ.textContent = '$' + Math.round(porQuincena).toLocaleString('es-MX') + ' / quincena';
}

// Cerrar modal al hacer clic en el backdrop
document.addEventListener('DOMContentLoaded', () => {
  const tutModal = document.getElementById('tutorialDetailModal');
  if (tutModal) {
    tutModal.addEventListener('click', (e) => {
      if (e.target === tutModal) {
        closeTutorialModal();
      }
    });
  }
  renderTutoriales();
});

// Renderizar inmediatamente por si el DOM ya estaba listo
if (document.readyState === 'complete' || document.readyState === 'interactive') {
  renderTutoriales();
}

