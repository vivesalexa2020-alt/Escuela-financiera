// ============================================================
// SISTEMA DE INTERNACIONALIZACIÓN (i18n)
// ============================================================

const translations = {
  es: {
    // Navegación
    nav_home: 'Inicio',
    nav_courses: 'Cursos',
    nav_resources: 'Recursos',
    nav_goals: 'Metas',
    nav_settings: 'Configuración',
    
    // Autenticación
    auth_login: 'Iniciar sesión',
    auth_register: 'Crear cuenta',
    auth_logout: 'Cerrar sesión',
    auth_email: 'Correo electrónico',
    auth_password: 'Contraseña',
    auth_forgot_password: '¿Olvidaste tu contraseña?',
    auth_remember_me: 'Recordarme',
    
    // Mensajes
    msg_login_success: 'Inicio de sesión exitoso',
    msg_login_error: 'Correo o contraseña incorrectos',
    msg_register_success: 'Cuenta creada exitosamente',
    msg_register_error: 'Error al crear la cuenta',
    msg_profile_updated: 'Perfil actualizado correctamente',
    msg_password_changed: 'Contraseña actualizada correctamente',
    
    // Cursos
    courses_title: 'Cursos',
    courses_enroll: 'Inscribirse',
    courses_continue: 'Continuar',
    courses_completed: 'Completado',
    courses_progress: 'Progreso',
    
    // Errores
    error_connection: 'Error de conexión',
    error_server: 'Error del servidor',
    error_unauthorized: 'No autorizado',
    error_not_found: 'No encontrado',
    
    // General
    loading: 'Cargando...',
    save: 'Guardar',
    cancel: 'Cancelar',
    delete: 'Eliminar',
    edit: 'Editar',
    close: 'Cerrar',
    search: 'Buscar',
    filter: 'Filtrar'
  },
  en: {
    // Navigation
    nav_home: 'Home',
    nav_courses: 'Courses',
    nav_resources: 'Resources',
    nav_goals: 'Goals',
    nav_settings: 'Settings',
    
    // Authentication
    auth_login: 'Login',
    auth_register: 'Sign up',
    auth_logout: 'Logout',
    auth_email: 'Email',
    auth_password: 'Password',
    auth_forgot_password: 'Forgot password?',
    auth_remember_me: 'Remember me',
    
    // Messages
    msg_login_success: 'Login successful',
    msg_login_error: 'Invalid email or password',
    msg_register_success: 'Account created successfully',
    msg_register_error: 'Error creating account',
    msg_profile_updated: 'Profile updated successfully',
    msg_password_changed: 'Password changed successfully',
    
    // Courses
    courses_title: 'Courses',
    courses_enroll: 'Enroll',
    courses_continue: 'Continue',
    courses_completed: 'Completed',
    courses_progress: 'Progress',
    
    // Errors
    error_connection: 'Connection error',
    error_server: 'Server error',
    error_unauthorized: 'Unauthorized',
    error_not_found: 'Not found',
    
    // General
    loading: 'Loading...',
    save: 'Save',
    cancel: 'Cancel',
    delete: 'Delete',
    edit: 'Edit',
    close: 'Close',
    search: 'Search',
    filter: 'Filter'
  }
};

class I18n {
  constructor() {
    this.currentLang = this.detectLanguage();
  }
  
  detectLanguage() {
    // Primero verificar localStorage
    const saved = localStorage.getItem('app_language');
    if (saved && translations[saved]) {
      return saved;
    }
    
    // Luego verificar idioma del navegador
    const browserLang = navigator.language.split('-')[0];
    if (translations[browserLang]) {
      return browserLang;
    }
    
    // Por defecto español
    return 'es';
  }
  
  setLanguage(lang) {
    if (translations[lang]) {
      this.currentLang = lang;
      localStorage.setItem('app_language', lang);
      this.updatePage();
    }
  }
  
  t(key, params = {}) {
    const keys = key.split('.');
    let value = translations[this.currentLang];
    
    for (const k of keys) {
      value = value?.[k];
      if (value === undefined) break;
    }
    
    if (value === undefined) {
      console.warn(`Translation missing for key: ${key}`);
      return key;
    }
    
    // Reemplazar parámetros
    Object.keys(params).forEach(param => {
      value = value.replace(`{${param}}`, params[param]);
    });
    
    return value;
  }
  
  updatePage() {
    // Actualizar todos los elementos con data-i18n
    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.getAttribute('data-i18n');
      el.textContent = this.t(key);
    });
    
    // Actualizar placeholders
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
      const key = el.getAttribute('data-i18n-placeholder');
      el.placeholder = this.t(key);
    });
  }
}

// Instancia global
const i18n = new I18n();

// Hacer disponible globalmente
window.i18n = i18n;
window.t = (key, params) => i18n.t(key, params);

// Inicializar al cargar el DOM
document.addEventListener('DOMContentLoaded', () => {
  i18n.updatePage();
});
