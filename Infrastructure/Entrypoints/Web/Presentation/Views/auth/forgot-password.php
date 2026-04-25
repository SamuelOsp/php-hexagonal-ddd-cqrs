<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box" style="margin-top: 50px;">
    <h2 style="text-align: center;">Recuperar contraseña</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="?route=auth.forgot.send" method="POST">
        <div class="form-group">
            <label>Correo electrónico registrado:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Enviar correo</button>
    </form>
    
    <div style="text-align: center; margin-top: 15px;">
        <a href="?route=auth.login">Volver al login</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>