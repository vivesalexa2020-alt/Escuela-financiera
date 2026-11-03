<!-- ============================================================
     MODAL DE AUTENTICACIÓN (LOGIN Y REGISTRO)
     ============================================================ -->
<div id="authModal" class="modal-overlay" style="display: none;">
  <div class="modal-card">
    <button class="modal-close-btn" onclick="if(typeof closeAuthModal==='function')closeAuthModal();" aria-label="Cerrar modal">&times;</button>
    
    <div class="auth-tabs" style="display: flex; gap: 12px; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
      <button id="tabLogin" class="tab-btn active" onclick="switchAuthTab('login')" style="font-weight: 600; padding: 6px 12px; border: none; background: none; cursor: pointer; color: #00703C; border-bottom: 2px solid #00703C;">Iniciar Sesión</button>
      <button id="tabRegister" class="tab-btn" onclick="switchAuthTab('register')" style="font-weight: 600; padding: 6px 12px; border: none; background: none; cursor: pointer; color: #64748b;">Registrarse</button>
    </div>

    <!-- Formulario de Login -->
    <form id="formLogin" onsubmit="if(typeof handleLogin==='function'){handleLogin(event);}return false;">
      <div id="loginMsg" class="form-message" style="margin-bottom: 12px; display: none;"></div>
      <div class="form-group" style="margin-bottom: 14px;">
        <label for="loginEmail" style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px;">Correo electrónico</label>
        <input type="email" id="loginEmail" name="email" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
      </div>
      <div class="form-group" style="margin-bottom: 18px;">
        <label for="loginPassword" style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px;">Contraseña</label>
        <div style="position: relative;">
          <input type="password" id="loginPassword" name="password" required placeholder="••••••••" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
          <button type="button" class="btn-eye" onclick="togglePasswordVisibility('loginPassword', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b;" aria-label="Mostrar contraseña">👁</button>
        </div>
      </div>
      <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; background: #00703C; color: #fff; font-weight: 600; border: none; border-radius: 8px; cursor: pointer;">Entrar</button>
    </form>

    <!-- Formulario de Registro -->
    <form id="formRegister" onsubmit="if(typeof handleRegister==='function'){handleRegister(event);}return false;" style="display: none;">
      <div id="registerMsg" class="form-message" style="margin-bottom: 12px; display: none;"></div>
      <div class="form-group" style="margin-bottom: 14px;">
        <label for="regNombre" style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px;">Nombre completo</label>
        <input type="text" id="regNombre" name="nombre" required placeholder="Tu Nombre" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
      </div>
      <div class="form-group" style="margin-bottom: 14px;">
        <label for="regEmail" style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px;">Correo electrónico</label>
        <input type="email" id="regEmail" name="email" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
      </div>
      <div class="form-group" style="margin-bottom: 18px;">
        <label for="regPassword" style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px;">Contraseña (mínimo 8 caracteres, número y símbolo)</label>
        <div style="position: relative;">
          <input type="password" id="regPassword" name="password" required placeholder="••••••••" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
          <button type="button" class="btn-eye" onclick="togglePasswordVisibility('regPassword', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b;" aria-label="Mostrar contraseña">👁</button>
        </div>
      </div>
      <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; background: #28C76F; color: #fff; font-weight: 600; border: none; border-radius: 8px; cursor: pointer;">Crear Cuenta</button>
    </form>
  </div>
</div>
