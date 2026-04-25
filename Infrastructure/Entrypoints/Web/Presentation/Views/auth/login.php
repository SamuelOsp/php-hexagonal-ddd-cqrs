<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box" style="margin-top: 50px;">
    <h2 style="text-align: center;">Iniciar sesión</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="?route=auth.authenticate" method="POST">
        <div class="form-group">
            <label>Correo electrónico:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Ingresar</button>
    </form>
    
    <div style="text-align: center; margin-top: 15px;">
        <a href="?route=auth.forgot">¿Olvidaste tu contraseña?</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>