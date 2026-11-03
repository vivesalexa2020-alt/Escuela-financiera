// ============================================================
// MÓDULO DE UI - Componentes de interfaz
// ============================================================

/**
 * Alternar visibilidad de contraseña (ojo)
 */
export function togglePasswordVisibility(inputId, btn) {
  const input = document.getElementById(inputId);
  if (!input) return;
  const isPass = input.type === 'password';
  input.type = isPass ? 'text' : 'password';

  if (isPass) {
    btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
      <line x1="1" y1="1" x2="23" y2="23"></line>
    </svg>`;
    btn.setAttribute('aria-label', 'Ocultar contraseña');
    btn.setAttribute('title', 'Ocultar contraseña');
  } else {
    btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
      <circle cx="12" cy="12" r="3"></circle>
    </svg>`;
    btn.setAttribute('aria-label', 'Mostrar contraseña');
    btn.setAttribute('title', 'Mostrar contraseña');
  }
}

/**
 * Toggle sidebar móvil
 */
export function toggleSidebar(forceState) {
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

/**
 * Mostrar notificación toast
 */
export function showToast(message, type = 'success', duration = 3000) {
  // Crear elemento toast si no existe
  let toastContainer = document.getElementById('toastContainer');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.id = 'toastContainer';
    toastContainer.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 10000;
      display: flex;
      flex-direction: column;
      gap: 10px;
    `;
    document.body.appendChild(toastContainer);
  }

  const toast = document.createElement('div');
  const bgColor = type === 'success' ? '#28C76F' : type === 'error' ? '#DC3545' : '#00703C';
  
  toast.style.cssText = `
    background: ${bgColor};
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease;
    max-width: 300px;
    font-size: 14px;
  `;
  
  toast.textContent = message;
  toastContainer.appendChild(toast);

  // Agregar animación
  if (!document.getElementById('toastStyles')) {
    const style = document.createElement('style');
    style.id = 'toastStyles';
    style.textContent = `
      @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
      @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
      }
    `;
    document.head.appendChild(style);
  }

  setTimeout(() => {
    toast.style.animation = 'slideOut 0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, duration);
}

/**
 * Actualizar UI según estado de autenticación
 */
export function updateAuthUI() {
  const user = getCurrentUser();
  const authElements = document.querySelectorAll('[data-auth]');
  
  authElements.forEach(el => {
    const authState = el.getAttribute('data-auth');
    if (authState === 'logged-in' && user) {
      el.style.display = '';
    } else if (authState === 'logged-out' && !user) {
      el.style.display = '';
    } else {
      el.style.display = 'none';
    }
  });
}
