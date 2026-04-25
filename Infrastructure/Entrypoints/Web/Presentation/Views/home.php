<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="content-card card">
    <div style="text-align: center; margin-bottom: 40px;">
        <div class="auth-avatar" style="margin: 0 auto 20px; width: 100px; height: 100px; font-size: 40px; transform: none; box-shadow: 0 10px 30px var(--glow-color);">
            <i class="fas fa-rocket"></i>
        </div>
        <?php if (isset($_SESSION['auth']['name'])): ?>
            <h1 style="font-size: 2.8em; margin-bottom: 10px;">¡Bienvenido de vuelta, <span style="color: var(--primary);"><?= htmlspecialchars($_SESSION['auth']['name'], ENT_QUOTES, 'UTF-8') ?></span>!</h1>
        <?php else: ?>
            <h1 style="font-size: 2.8em; margin-bottom: 10px;">Sistema de <span style="color: var(--primary);">Identidad</span></h1>
        <?php endif; ?>
        
        <p style="color: var(--text-muted); font-size: 1.1em; max-width: 600px; margin: 0 auto; line-height: 1.6;">
            Plataforma centralizada de gestión de usuarios implementando Arquitectura Hexagonal y CQRS en un entorno puro de PHP.
        </p>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['auth']['id'])): ?>
        <div class="dashboard-grid">
            <a href="?route=users.index" class="dashboard-card">
                <div class="dashboard-icon"><i class="fas fa-address-book"></i></div>
                <h3>Directorio Activo</h3>
                <p>Visualiza todos los usuarios, audita roles y gestiona accesos en tiempo real.</p>
            </a>
            <a href="?route=users.create" class="dashboard-card">
                <div class="dashboard-icon" style="color: var(--success); background: rgba(16, 185, 129, 0.1);"><i class="fas fa-user-plus"></i></div>
                <h3>Añadir Entidad</h3>
                <p>Provee de acceso a nuevos miembros con asignación estricta de permisos.</p>
            </a>
            <a href="?route=auth.logout" class="dashboard-card">
                <div class="dashboard-icon" style="color: var(--danger); background: rgba(239, 68, 68, 0.1);"><i class="fas fa-power-off"></i></div>
                <h3>Cerrar Sesión</h3>
                <p>Termina tu sesión actual de forma segura y destruye el rastro local.</p>
            </a>
        </div>
    <?php else: ?>
        <div style="margin-top: 40px; text-align: center; display: flex; gap: 20px; justify-content: center;">
            <a href="?route=auth.login" class="btn btn-primary" style="padding: 16px 35px; font-size: 1.1em;"><i class="fas fa-fingerprint"></i> Iniciar Sesión</a>
            <a href="?route=users.create" class="btn btn-secondary" style="padding: 16px 35px; font-size: 1.1em;"><i class="fas fa-user-plus"></i> Crear Cuenta</a>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>