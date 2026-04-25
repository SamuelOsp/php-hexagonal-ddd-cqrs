<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Lista de usuarios</h2>

<?php if (!empty($success)): ?>
    <div class="alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>
<?php if (!empty($message)): ?>
    <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="?route=users.show&id=<?= urlencode($user->id) ?>" class="btn btn-sm btn-primary">Ver</a>
                    <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="?route=users.delete" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layouts/footer.php'; ?>