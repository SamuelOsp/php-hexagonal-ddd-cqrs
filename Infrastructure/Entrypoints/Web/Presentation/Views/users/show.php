<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Detalle del usuario</h2>

<?php if (!empty($message)): ?>
    <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<div style="background: #fff; padding: 20px; border: 1px solid #ddd;">
    <p><strong>ID:</strong> <?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Estado:</strong> <?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?></p>
    
    <div style="margin-top: 20px;">
        <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="btn btn-warning">Editar</a>
        <a href="?route=users.index" class="btn btn-primary">Volver al listado</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>