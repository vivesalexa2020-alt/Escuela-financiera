// ============================================================
// MÓDULO DE API CON CACHING
// ============================================================

const API_BASE = 'api';

class APICache {
  constructor() {
    this.cache = new Map();
    this.defaultTTL = 5 * 60 * 1000; // 5 minutos por defecto
  }
  
  set(key, data, ttl = this.defaultTTL) {
    this.cache.set(key, {
      data,
      expires: Date.now() + ttl
    });
  }
  
  get(key) {
    const item = this.cache.get(key);
    if (!item) return null;
    
    if (Date.now() > item.expires) {
      this.cache.delete(key);
      return null;
    }
    
    return item.data;
  }
  
  clear() {
    this.cache.clear();
  }
  
  clearPattern(pattern) {
    for (const key of this.cache.keys()) {
      if (key.includes(pattern)) {
        this.cache.delete(key);
      }
    }
  }
}

const apiCache = new APICache();

/**
 * Realizar petición fetch con caching
 */
export async function fetchWithCache(endpoint, options = {}, ttl = null) {
  const cacheKey = `${endpoint}_${JSON.stringify(options)}`;
  
  // Solo cachear peticiones GET
  if (options.method === 'GET' || !options.method) {
    const cached = apiCache.get(cacheKey);
    if (cached) {
      return cached;
    }
  }
  
  try {
    const response = await fetch(`${API_BASE}/${endpoint}`, {
      ...options,
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        ...options.headers
      }
    });
    
    const data = await response.json();
    
    // Cachear respuestas exitosas de GET
    if ((options.method === 'GET' || !options.method) && data.success) {
      apiCache.set(cacheKey, data, ttl);
    }
    
    return data;
  } catch (error) {
    console.error('API Error:', error);
    return { success: false, message: 'Error de conexión' };
  }
}

/**
 * Limpiar caché de sesión de usuario
 */
export function clearUserCache() {
  apiCache.clearPattern('session');
  apiCache.clearPattern('membresia');
  apiCache.clearPattern('inscripciones');
}

/**
 * Limpiar caché de cursos
 */
export function clearCoursesCache() {
  apiCache.clearPattern('cursos');
}

/**
 * Limpiar todo el caché
 */
export function clearAllCache() {
  apiCache.clear();
}

/**
 * Obtener sesión actual
 */
export async function getSession() {
  return fetchWithCache('session.php', { method: 'GET' }, 60000); // 1 minuto
}

/**
 * Obtener membresía
 */
export async function getMembresia() {
  return fetchWithCache('membresia.php', { method: 'GET' }, 300000); // 5 minutos
}

/**
 * Obtener inscripciones
 */
export async function getInscripciones() {
  return fetchWithCache('inscripciones.php', { method: 'GET' }, 300000); // 5 minutos
}

/**
 * Obtener cursos
 */
export async function getCursos(cursoId = null) {
  const endpoint = cursoId ? `cursos.php?id=${cursoId}` : 'cursos.php';
  return fetchWithCache(endpoint, { method: 'GET' }, 600000); // 10 minutos
}

/**
 * Obtener progreso
 */
export async function getProgreso(cursoId = null) {
  const endpoint = cursoId ? `progreso.php?curso_id=${cursoId}` : 'progreso.php';
  return fetchWithCache(endpoint, { method: 'GET' }, 120000); // 2 minutos
}

/**
 * Obtener logros
 */
export async function getLogros() {
  return fetchWithCache('logros.php', { method: 'GET' }, 300000); // 5 minutos
}

// Exportar para uso global
window.API = {
  fetchWithCache,
  clearUserCache,
  clearCoursesCache,
  clearAllCache,
  getSession,
  getMembresia,
  getInscripciones,
  getCursos,
  getProgreso,
  getLogros
};
