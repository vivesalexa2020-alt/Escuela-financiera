// ============================================================
// MÓDULO DE AUTENTICACIÓN
// ============================================================

const SESSION_KEY = 'edu_fin_session';
const API_BASE = 'api';

/**
 * Obtener usuario actual desde localStorage
 */
export function getCurrentUser() {
  try {
    const session = localStorage.getItem(SESSION_KEY);
    return session ? JSON.parse(session) : null;
  } catch (e) {
    console.error('Error al obtener sesión:', e);
    return null;
  }
}

/**
 * Guardar usuario en localStorage
 */
export function setCurrentUser(user) {
  try {
    localStorage.setItem(SESSION_KEY, JSON.stringify(user));
  } catch (e) {
    console.error('Error al guardar sesión:', e);
  }
}

/**
 * Eliminar sesión
 */
export function clearSession() {
  try {
    localStorage.removeItem(SESSION_KEY);
  } catch (e) {
    console.error('Error al eliminar sesión:', e);
  }
}

/**
 * Verificar si hay sesión activa
 */
export function isLoggedIn() {
  return getCurrentUser() !== null;
}

/**
 * Iniciar sesión
 */
export async function login(email, password) {
  try {
    const res = await fetch(`${API_BASE}/login.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ email, password })
    });
    const data = await res.json();
    
    if (data.success) {
      setCurrentUser(data.user);
      return { success: true, user: data.user };
    }
    return { success: false, message: data.message };
  } catch (err) {
    return { success: false, message: 'Error de conexión' };
  }
}

/**
 * Cerrar sesión
 */
export async function logout() {
  try {
    await fetch(`${API_BASE}/logout.php`, {
      method: 'POST',
      credentials: 'include'
    });
  } catch (err) {
    console.error('Error al cerrar sesión:', err);
  } finally {
    clearSession();
    window.location.href = 'index.html';
  }
}

/**
 * Registrar usuario
 */
export async function register(nombre, email, password) {
  try {
    const res = await fetch(`${API_BASE}/registro.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ nombre, email, password })
    });
    const data = await res.json();
    
    if (data.success) {
      setCurrentUser(data.user);
      return { success: true, user: data.user };
    }
    return { success: false, message: data.message };
  } catch (err) {
    return { success: false, message: 'Error de conexión' };
  }
}
