<?php
$message = isset($message) && is_string($message) ? $message : '';
$success = isset($success) && is_string($success) ? $success : '';
$old = isset($old) && is_array($old) ? $old : [];
$errors = isset($errors) && is_array($errors) ? $errors : [];
$roleOptions = isset($roleOptions) && is_array($roleOptions) ? $roleOptions : [];
$pageTitle = isset($pageTitle) && is_string($pageTitle) ? $pageTitle : 'Registrar usuario';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="auth-box">
    <h2>Crear usuario</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="?route=users.store" method="POST">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre completo">
            <?php if (!empty($errors['name'])): ?><span class="field-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Correo">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" placeholder="Contraseña">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select id="role" name="role">
                <option value="">Selecciona un rol</option>
                <?php foreach ($roleOptions as $role): ?>
                    <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? '') === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['role'])): ?><span class="field-error"><?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-block">Guardar usuario</button>
    </form>

    <?php if (!isset($_SESSION['auth']['id'])): ?>
    <div class="auth-footer">
        ¿Ya tienes cuenta? <a href="?route=auth.login">Iniciar sesión</a>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
