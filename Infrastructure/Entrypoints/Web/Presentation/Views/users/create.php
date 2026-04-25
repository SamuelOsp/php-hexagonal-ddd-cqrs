<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Registrar usuario</h2>

<?php if (!empty($message)): ?>
    <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<form action="?route=users.store" method="POST" class="auth-box">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['name'])): ?><span class="field-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Correo:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Contraseña:</label>
        <input type="password" name="password">
        <?php if (!empty($errors['password'])): ?><span class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Rol:</label>
        <select name="role">
            <option value="">Seleccione</option>
            <?php foreach ($roleOptions as $role): ?>
                <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? '') === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['role'])): ?><span class="field-error"><?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>