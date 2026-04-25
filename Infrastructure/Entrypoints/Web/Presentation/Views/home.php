<?php require __DIR__ . '/layouts/header.php'; ?>

<h1>Bienvenido al sistema CRUD</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<p>Este es un sistema completo de CRUD de Usuarios.</p>

<?php require __DIR__ . '/layouts/footer.php'; ?>