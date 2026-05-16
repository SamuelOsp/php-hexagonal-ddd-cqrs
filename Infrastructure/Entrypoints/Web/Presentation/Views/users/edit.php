<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- Header & Breadcrumbs -->
<div class="flex flex-col gap-2 max-w-2xl mx-auto w-full">
    <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
        <a class="hover:text-primary transition-colors" href="?route=home">Admin</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="?route=users.index">Gestión de Usuarios</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Editar Usuario</span>
    </div>
    <div>
        <h1 class="font-headline-lg text-3xl text-on-surface">Configuración de Cuenta</h1>
        <p class="text-sm text-on-surface-variant mt-1">Actualiza los permisos y la información de identidad del usuario.</p>
    </div>
</div>

<!-- Form Card -->
<div class="bg-surface-container border border-outline-variant/30 rounded-3xl p-8 shadow-2xl shadow-primary/5 max-w-2xl mx-auto w-full mt-6">
    <?php if (!empty($message)): ?>
        <div class="mb-6 p-4 rounded-xl bg-error-container/20 border border-error/30 text-error flex items-center gap-3">
            <span class="material-symbols-outlined">report</span>
            <p class="text-sm"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    <?php endif; ?>

    <form action="?route=users.update" method="POST" class="space-y-6">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
        
        <!-- Name Input -->
        <div class="space-y-1">
            <label>Nombre de Identidad</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">badge</span>
                <input type="text" name="name" 
                       class="w-full pl-12 pr-4 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       value="<?= htmlspecialchars($old['name'] ?? $user->name, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <?php if (!empty($errors['name'])): ?>
                <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Email Input -->
        <div class="space-y-1">
            <label>Acceso Email</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                <input type="email" name="email" 
                       class="w-full pl-12 pr-4 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       value="<?= htmlspecialchars($old['email'] ?? $user->email, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <?php if (!empty($errors['email'])): ?>
                <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Password Input -->
        <div class="space-y-1">
            <label>Seguridad <span class="normal-case text-[10px] text-on-surface-variant">(En blanco mantiene la actual)</span></label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                <input type="password" name="password" placeholder="••••••••"
                       class="w-full pl-12 pr-4 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
            </div>
            <?php if (!empty($errors['password'])): ?>
                <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Role & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <label>Nivel de Permisos</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">shield_person</span>
                    <select name="role" class="w-full pl-12 pr-10 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface appearance-none focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        <?php foreach ($roleOptions as $role): ?>
                            <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? $user->role) === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                </div>
                <?php if (!empty($errors['role'])): ?>
                    <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <div class="space-y-1">
                <label>Estado del Sistema</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">toggle_on</span>
                    <select name="status" class="w-full pl-12 pr-10 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface appearance-none focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        <?php foreach ($statusOptions as $status): ?>
                            <option value="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['status'] ?? $user->status) === $status ? 'selected' : '' ?>><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                </div>
                <?php if (!empty($errors['status'])): ?>
                    <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['status'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <button type="submit" class="flex-1 bg-primary text-on-primary py-3.5 rounded-xl font-bold hover:bg-primary-fixed transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-2 group">
                <span class="material-symbols-outlined text-xl transition-transform group-hover:scale-110">save</span>
                ACTUALIZAR REGISTRO
            </button>
            <a href="?route=users.index" class="flex-1 bg-surface-variant text-on-surface py-3.5 rounded-xl font-bold hover:bg-surface-container-high transition-all border border-outline-variant/30 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-xl">close</span>
                CANCELAR
            </a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>