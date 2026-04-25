<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box <?= !empty($errors) ? 'shake' : '' ?>" style="max-width: 550px;">
    <h2 style="text-align: left; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 25px;">Configuración de Cuenta</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="?route=users.update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
        
        <div class="form-group">
            <label>Identidad</label>
            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? $user->name, ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['name'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Acceso Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? $user->email, ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Seguridad <span style="text-transform: none; color: var(--text-muted); font-weight: normal; font-size: 0.9em;">(En blanco mantiene la actual)</span></label>
            <input type="password" name="password" placeholder="••••••••">
            <?php if (!empty($errors['password'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        
        <div style="display: flex; gap: 20px;">
            <div class="form-group" style="flex: 1;">
                <label>Permisos</label>
                <select name="role">
                    <?php foreach ($roleOptions as $role): ?>
                        <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? $user->role) === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['role'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
            </div>
            
            <div class="form-group" style="flex: 1;">
                <label>Estado Activo</label>
                <select name="status">
                    <?php foreach ($statusOptions as $status): ?>
                        <option value="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['status'] ?? $user->status) === $status ? 'selected' : '' ?>><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['status'])): ?><span class="field-error"><i class="fas fa-asterisk"></i> <?= htmlspecialchars($errors['status'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="flex: 2;"><i class="fas fa-save"></i> Actualizar Registro</button>
            <a href="?route=users.index" class="btn btn-secondary" style="flex: 1;"><i class="fas fa-times"></i> Cancelar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>