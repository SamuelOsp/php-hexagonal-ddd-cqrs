<?php
$message = isset($message) && is_string($message) ? $message : '';
$success = isset($success) && is_string($success) ? $success : '';
$old = isset($old) && is_array($old) ? $old : [];
$errors = isset($errors) && is_array($errors) ? $errors : [];
$pageTitle = isset($pageTitle) && is_string($pageTitle) ? $pageTitle : 'Iniciar sesión';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="auth-box">
    <h2>Iniciar sesión</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="?route=auth.authenticate" method="POST">
        <div class="form-group">
            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Correo">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <div class="form-group-header">
                <label for="password">Contraseña</label>
                <a href="?route=auth.forgot">¿Olvidaste tu contraseña?</a>
            </div>
            <input id="password" type="password" name="password" placeholder="Contraseña">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-block">Entrar</button>
    </form>

    <div class="auth-footer">
        ¿No tienes cuenta? <a href="?route=users.create">Registrarse</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
