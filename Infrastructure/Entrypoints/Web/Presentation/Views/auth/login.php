<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box <?= !empty($errors) ? 'shake' : '' ?>">
    <div class="auth-avatar">
        <i class="fas fa-fingerprint"></i>
    </div>
    <h2>Iniciar Sesión</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="?route=auth.authenticate" method="POST">
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="usuario@dominio.com">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Acceder al Dashboard</button>
    </form>
    
    <div class="text-center mt-4" style="display: flex; flex-direction: column; gap: 12px; font-size: 0.9em;">
        <a href="?route=auth.forgot">¿Olvidaste tu contraseña?</a>
        <span style="color: var(--text-muted);">¿No tienes una cuenta? <a href="?route=users.create">Regístrate ahora</a></span>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>