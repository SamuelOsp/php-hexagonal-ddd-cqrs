<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="content-card card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="margin: 0; text-align: left;">Directorio de Usuarios</h2>
            <p style="color: var(--text-muted); margin: 5px 0 0 0; font-size: 0.9em;">Gestiona los accesos y roles del sistema</p>
        </div>
        <a href="?route=users.create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nuevo Usuario</a>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Corto</th>
                    <th>Usuario</th>
                    <th>Contacto</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th style="text-align: right;">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 40px; color: var(--text-muted);"><i class="fas fa-folder-open" style="font-size: 2em; margin-bottom: 10px; display: block; opacity: 0.5;"></i>No hay usuarios registrados en el sistema.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td style="font-family: monospace; color: var(--text-muted);"><?= substr(htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'), 0, 8) ?>...</td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="color: var(--text-muted);"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <?php 
                            $roleClass = 'badge-purple';
                            if ($user->role === 'ADMIN') $roleClass = 'badge-danger';
                            if ($user->role === 'MEMBER') $roleClass = 'badge-success';
                            ?>
                            <span class="badge <?= $roleClass ?>"><i class="fas fa-shield-alt" style="font-size: 0.8em;"></i> <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?></span>
                        </td>
                        <td>
                            <?php 
                            $statusClass = 'badge-warning';
                            $icon = 'fa-clock';
                            if ($user->status === 'ACTIVE') { $statusClass = 'badge-success'; $icon = 'fa-check'; }
                            if ($user->status === 'INACTIVE') { $statusClass = 'badge-danger'; $icon = 'fa-ban'; }
                            if ($user->status === 'BLOCKED') { $statusClass = 'badge-danger'; $icon = 'fa-lock'; }
                            ?>
                            <span class="badge <?= $statusClass ?>"><i class="fas <?= $icon ?>"></i> <?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?></span>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="?route=users.show&id=<?= urlencode($user->id) ?>" class="btn btn-sm btn-secondary" title="Detalles"><i class="fas fa-eye"></i></a>
                            <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="btn btn-sm btn-info" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="?route=users.delete" method="POST" style="display:inline;" onsubmit="return confirm('ATENCIÓN: ¿Seguro que deseas eliminar este usuario permanentemente?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>