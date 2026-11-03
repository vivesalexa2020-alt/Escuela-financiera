// ============================================================
// EDUCACIÓN FINANCIERA - JAVASCRIPT PRINCIPAL
// Estructura modular para mejor mantenimiento
// ============================================================

// Importar módulos (para browsers que soportan ES6 modules)
// Para compatibilidad, el código existente en script.js se mantiene
// y se migrará gradualmente a estos módulos

import * as Auth from './modules/auth.js';
import * as UI from './modules/ui.js';

// Hacer disponibles globalmente para compatibilidad con código existente
window.Auth = Auth;
window.UI = UI;

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
  UI.updateAuthUI();
  
  // Asignar funciones globales para compatibilidad
  window.getCurrentUser = Auth.getCurrentUser;
  window.setCurrentUser = Auth.setCurrentUser;
  window.togglePasswordVisibility = UI.togglePasswordVisibility;
  window.toggleSidebar = UI.toggleSidebar;
  window.showToast = UI.showToast;
  window.updateAuthUI = UI.updateAuthUI;
});
