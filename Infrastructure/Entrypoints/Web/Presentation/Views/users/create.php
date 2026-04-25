<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box <?= !empty($errors) ? 'shake' : '' ?>" style="max-width: 500px;">
    <div class="auth-avatar">
        <i class="fas fa-user-astronaut"></i>
    </div>
    <h2>Crear Cuenta</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="?route=users.store" method="POST">
        <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Juan Pérez">
            <?php if (!empty($errors['name'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="juan@ejemplo.com">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Mínimo 8 caracteres">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label>Permisos de la Cuenta</label>
            <select name="role">
                <option value="">Selecciona un rol</option>
                <?php foreach ($roleOptions as $role): ?>
                    <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? '') === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['role'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-bolt"></i> Registrar Usuario</button>
    </form>

    <?php if (!isset($_SESSION['auth']['id'])): ?>
    <div class="text-center mt-4">
        <span style="color: var(--text-muted); font-size: 0.9em;">¿Ya tienes una cuenta? <a href="?route=auth.login">Inicia Sesión</a></span>
    </div>
    <?php else: ?>
    <div class="text-center mt-4">
        <a href="?route=users.index" style="color: var(--text-muted); font-size: 0.9em;"><i class="fas fa-arrow-left"></i> Volver al listado</a>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>