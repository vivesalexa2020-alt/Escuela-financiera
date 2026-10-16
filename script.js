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
      { name: 'Guía de ahorro descargable en PDF', type: 'Recurso', link: 'recursos.html' },
      { name: 'Nuestra misión y valores', type: 'Nosotros', link: 'nosotros.html' }
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
  if (path.includes('cursos.html') || path.includes('recursos.html') || path.includes('nosotros.html')) {
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
  } else {
    // USUARIO VISITANTE (SIN SESIÓN):
    document.body.classList.add('not-logged-in');
    document.body.classList.remove('user-logged-in');

    if (protectedSection) protectedSection.style.display = 'none';
    if (lockedBanner) lockedBanner.style.display = 'block';

    // En index.html: mostrar portada pública y ocultar panel privado
    if (studentDashboard) studentDashboard.style.display = 'none';
    if (guestLanding) guestLanding.style.display = 'block';

    // Cerrar sidebar si estaba abierto en responsive
    if (sidebar) sidebar.classList.remove('open');
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
  const link = e.target.closest('a[href="cursos.html"], a[href="recursos.html"], a[href="nosotros.html"]');
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
  calculateCompoundInterest();
});
updateAuthUI();
