<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Editar usuario</h2>

<?php if (!empty($message)): ?>
    <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<form action="?route=users.update" method="POST" class="auth-box">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? $user->name, ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['name'])): ?><span class="field-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Correo:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? $user->email, ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Contraseña (déjala en blanco para no cambiarla):</label>
        <input type="password" name="password" placeholder="déjala en blanco">
        <?php if (!empty($errors['password'])): ?><span class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Rol:</label>
        <select name="role">
            <option value="">Seleccione</option>
            <?php foreach ($roleOptions as $role): ?>
                <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? $user->role) === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['role'])): ?><span class="field-error"><?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Estado:</label>
        <select name="status">
            <option value="">Seleccione</option>
            <?php foreach ($statusOptions as $status): ?>
                <option value="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['status'] ?? $user->status) === $status ? 'selected' : '' ?>><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['status'])): ?><span class="field-error"><?= htmlspecialchars($errors['status'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
    </div>
    <button type="submit" class="btn btn-warning">Actualizar</button>
    <a href="?route=users.index" class="btn btn-primary" style="margin-left: 10px;">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>