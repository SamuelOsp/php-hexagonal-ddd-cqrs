<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box" style="max-width: 650px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="margin: 0; text-align: left;">Ficha de Usuario</h2>
        <a href="?route=users.index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Directorio</a>
    </div>

    <div style="background: rgba(0,0,0,0.2); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
        <div class="data-list">
            <p><strong>Hash ID</strong> <span style="font-family: monospace; color: var(--primary);"><?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?></span></p>
            <p><strong>Nombre</strong> <span style="font-weight: 500;"><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></span></p>
            <p><strong>Contacto</strong> <span><a href="mailto:<?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></a></span></p>
            <p>
                <strong>Privilegios</strong> 
                <?php 
                $roleClass = 'badge-purple';
                if ($user->role === 'ADMIN') $roleClass = 'badge-danger';
                if ($user->role === 'MEMBER') $roleClass = 'badge-success';
                ?>
                <span class="badge <?= $roleClass ?>"><i class="fas fa-shield-alt" style="font-size: 0.8em;"></i> <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?></span>
            </p>
            <p>
                <strong>Condición</strong> 
                <?php 
                $statusClass = 'badge-warning';
                $icon = 'fa-clock';
                if ($user->status === 'ACTIVE') { $statusClass = 'badge-success'; $icon = 'fa-check'; }
                if ($user->status === 'INACTIVE') { $statusClass = 'badge-danger'; $icon = 'fa-ban'; }
                if ($user->status === 'BLOCKED') { $statusClass = 'badge-danger'; $icon = 'fa-lock'; }
                ?>
                <span class="badge <?= $statusClass ?>"><i class="fas <?= $icon ?>"></i> <?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?></span>
            </p>
        </div>
    </div>
    
    <div style="margin-top: 30px; text-align: right;">
        <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="btn btn-primary"><i class="fas fa-sliders-h"></i> Configurar Perfil</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>