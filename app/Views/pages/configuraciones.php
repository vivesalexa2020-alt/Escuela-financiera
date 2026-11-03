<?php
/**
 * Vista: Configuración de Cuenta y Perfil
 * Variables disponibles: $pageTitle, $user
 */
?>
<section style="background: #06402d; color: #fff; padding: 50px 0;">
  <div class="container">
    <h1 style="font-size: 32px; font-weight: 800; margin-bottom: 8px;">Configuración de Perfil</h1>
    <p style="color: #d1fae5; font-size: 15px;">Gestiona tus datos personales, credenciales y seguridad de tu cuenta.</p>
  </div>
</section>

<section style="padding: 60px 0; background: #f8fafc;">
  <div class="container" style="max-width: 800px;">
    
    <!-- Actualizar Datos Básicos -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
      <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Información Personal</h2>
      <div id="perfilMsg" class="form-message" style="display: none; margin-bottom: 16px;"></div>
      
      <form id="formPerfil" onsubmit="if(typeof handleUpdateProfile==='function'){handleUpdateProfile(event);}return false;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px;">Nombre completo</label>
          <input type="text" id="cfgNombre" required value="<?= htmlspecialchars($user['name'] ?? '') ?>" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px;">Correo electrónico</label>
          <input type="email" id="cfgEmail" required value="<?= htmlspecialchars($user['email'] ?? '') ?>" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
        </div>
        <button type="submit" style="background: #00703C; color: #fff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer;">
          Guardar Cambios
        </button>
      </form>
    </div>

    <!-- Cambiar Contraseña -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
      <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Seguridad y Contraseña</h2>
      <div id="passwordMsg" class="form-message" style="display: none; margin-bottom: 16px;"></div>
      
      <form id="formPassword" onsubmit="if(typeof handleChangePassword==='function'){handleChangePassword(event);}return false;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px;">Contraseña actual</label>
          <input type="password" id="cfgPassActual" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px;">Nueva contraseña (mínimo 8 caracteres, números y símbolos)</label>
          <input type="password" id="cfgPassNueva" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
        </div>
        <button type="submit" style="background: #06402d; color: #fff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer;">
          Actualizar Contraseña
        </button>
      </form>
    </div>

    <!-- Eliminar Cuenta -->
    <div style="background: #fff; border: 1px solid #fee2e2; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
      <h2 style="font-size: 18px; font-weight: 700; color: #b91c1c; margin-bottom: 10px;">Zona de Peligro</h2>
      <p style="font-size: 13.5px; color: #64748b; margin-bottom: 16px;">Una vez eliminada tu cuenta, se realizará un borrado lógico y tus datos se conservarán por 30 días para auditoría de seguridad.</p>
      <button onclick="if(typeof handleDeleteAccount==='function')handleDeleteAccount();" style="background: #ef4444; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;">
        Eliminar Mi Cuenta
      </button>
    </div>

  </div>
</section>
