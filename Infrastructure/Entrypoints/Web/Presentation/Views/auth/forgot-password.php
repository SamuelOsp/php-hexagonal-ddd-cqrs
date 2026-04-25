<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box <?= !empty($errors) ? 'shake' : '' ?>">
    <div class="auth-avatar">
        <i class="fas fa-key"></i>
    </div>
    <h2>Recuperar Acceso</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-envelope-open-text"></i> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <p class="text-center mb-4" style="color: var(--text-muted); font-size: 0.95em;">
        Ingresa tu correo asociado y enviaremos una clave temporal a tu bandeja de entrada.
    </p>
    
    <form action="?route=auth.forgot.send" method="POST">
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="usuario@dominio.com">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Enviar Instrucciones</button>
    </form>
    
    <div class="text-center mt-4">
        <a href="?route=auth.login" style="color: var(--text-muted);"><i class="fas fa-arrow-left"></i> Volver al Login</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>