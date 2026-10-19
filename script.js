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
});

// ------------------------------------------------------------
// 15. RETÍCULA ACADÉMICA INTERACTIVA
// ------------------------------------------------------------
const RETICULA_ARRAY_KEY = 'edu_fin_reticula_';

const RETICULA_SEMESTRES = [
  { id: 1, titulo: 'Semestre 1', limite: 2, requeridoPrevio: 0 },
  { id: 2, titulo: 'Semestre 2', limite: 1, requeridoPrevio: 2 }
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
    if (contarInscritasEnSemestre(state, 1) < 2) {
      const faltan = 2 - contarInscritasEnSemestre(state, 1);
      hint = 'Inscríbete a ' + faltan + ' unidad' + (faltan === 1 ? '' : 'es') + ' más del Semestre 1';
    } else if (contarInscritasEnSemestre(state, 2) < 1) {
      hint = '¡Semestre 2 desbloqueado! Elige 1 materia';
    } else {
      hint = '¡Retícula en curso! Sigue avanzando';
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
    const pct = Math.min(100, Math.round((inscritasSem / cfg.limite) * 100));

    const chip = bloqueado
      ? '<span class="reticula-semester-chip locked">🔒 Bloqueado</span>'
      : '<span class="reticula-semester-chip">' + inscritasSem + ' / ' + cfg.limite +
        (cfg.limite === 1 ? ' materia' : ' unidades') + '</span>';

    const cards = materias.map(function (m) {
      const st = estadoMateria(m.id, state);
      let etiqueta = 'Disponible';
      if (st === 'inscrita') etiqueta = '✓ Inscrita';
      else if (st === 'bloqueada') etiqueta = '🔒 Bloqueada';
      return '' +
        '<div class="reticula-materia is-' + st + '" onclick="openReticulaModal(\'' + m.id + '\')">' +
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

  if (levelEl) levelEl.textContent = (cfg ? cfg.titulo : 'Semestre ' + m.semestre) + ' · ' + m.icon;
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
      texto = '🟡 Materia disponible. Puedes inscribirte ahora mismo.';
      label = 'Inscribirme a esta materia';
    } else if (chk.motivo === 'bloqueado') {
      tipo = 'info';
      texto = '🔒 Esta materia se desbloquea cuando completes las 2 unidades iniciales del Semestre 1.';
      label = 'Materia bloqueada';
      deshabilitado = true;
    } else if (chk.motivo === 'limite') {
      const limite = cfg ? cfg.limite : 1;
      tipo = 'info';
      texto = '⏳ Ya alcanzaste el límite de ' + limite +
        (limite === 1 ? ' materia' : ' unidades') + ' en este semestre. Avanza para desbloquear más.';
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
  const chk = puedeInscribir(id);
  if (!chk.ok) { openReticulaModal(id); return; }

  const state = getReticulaState();
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
