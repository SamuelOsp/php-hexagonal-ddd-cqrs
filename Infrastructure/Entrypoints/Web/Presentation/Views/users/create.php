<?php
$message = isset($message) && is_string($message) ? $message : '';
$success = isset($success) && is_string($success) ? $success : '';
$old = isset($old) && is_array($old) ? $old : [];
$errors = isset($errors) && is_array($errors) ? $errors : [];
$roleOptions = isset($roleOptions) && is_array($roleOptions) ? $roleOptions : [];

$hideLayout = !isset($_SESSION['auth']['id']); // Ocultar layout si no está logueado (página de registro público)
require __DIR__ . '/../layouts/header.php';
?>

<!-- Header & Breadcrumbs (Solo si está logueado) -->
<?php if (!$hideLayout): ?>
<div class="flex flex-col gap-2 max-w-2xl mx-auto w-full">
    <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
        <a class="hover:text-primary transition-colors" href="?route=home">Admin</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="?route=users.index">Gestión de Usuarios</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Nuevo Registro</span>
    </div>
    <div>
        <h1 class="font-headline-lg text-3xl text-on-surface">Alta de Usuario</h1>
        <p class="text-sm text-on-surface-variant mt-1">Registra una nueva entidad en el sistema con permisos definidos.</p>
    </div>
</div>
<?php else: ?>
<div class="text-center mb-8 max-w-md mx-auto">
    <div class="inline-flex p-4 rounded-2xl bg-primary/10 text-primary shadow-2xl shadow-primary/20 mb-4 border border-primary/20">
        <span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">person_add</span>
    </div>
    <h1 class="font-headline-lg text-4xl text-on-surface tracking-tight">Crear Cuenta</h1>
    <p class="text-on-surface-variant text-sm mt-2">Regístrate para obtener acceso al sistema EUMS.</p>
</div>
<?php endif; ?>

<!-- Form Card -->
<div class="bg-surface-container border border-outline-variant/30 rounded-3xl p-8 shadow-2xl shadow-primary/5 max-w-2xl mx-auto w-full mt-6">
    <?php if (!empty($message)): ?>
        <div class="mb-6 p-4 rounded-xl bg-error-container/20 border border-error/30 text-error flex items-center gap-3">
            <span class="material-symbols-outlined">report</span>
            <p class="text-sm"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="mb-6 p-4 rounded-xl bg-primary/10 border border-primary/30 text-primary flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="text-sm"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    <?php endif; ?>

    <form action="?route=users.store" method="POST" class="space-y-6">
        <!-- Name Input -->
        <div class="space-y-1">
            <label>Nombre Completo</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">badge</span>
                <input type="text" name="name" placeholder="Ej: Juan Pérez"
                       class="w-full pl-12 pr-4 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <?php if (!empty($errors['name'])): ?>
                <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Email Input -->
        <div class="space-y-1">
            <label>Correo Electrónico</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                <input type="email" name="email" placeholder="usuario@eums.local"
                       class="w-full pl-12 pr-4 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <?php if (!empty($errors['email'])): ?>
                <p class="text-error text-[10px] font-label-md mt-1 ml-1 uppercase tracking-wider flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">error</span> <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Password Input -->
        <div class="space-y-1">
            <label>Contraseña de Acceso</label>
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
        
        <!-- Role Selection -->
        <div class="space-y-1">
            <label>Asignación de Rol</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">shield_person</span>
                <select name="role" class="w-full pl-12 pr-10 py-3 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface appearance-none focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    <option value="">Selecciona un rol</option>
                    <?php foreach ($roleOptions as $role): ?>
                        <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['role'] ?? '') === $role ? 'selected' : '' ?>><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></option>
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

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <button type="submit" class="flex-1 bg-primary text-on-primary py-3.5 rounded-xl font-bold hover:bg-primary-fixed transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-2 group">
                <span class="material-symbols-outlined text-xl transition-transform group-hover:scale-110">how_to_reg</span>
                GUARDAR REGISTRO
            </button>
            <?php if (!$hideLayout): ?>
            <a href="?route=users.index" class="flex-1 bg-surface-variant text-on-surface py-3.5 rounded-xl font-bold hover:bg-surface-container-high transition-all border border-outline-variant/30 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-xl">close</span>
                CANCELAR
            </a>
            <?php endif; ?>
        </div>
    </form>

    <?php if ($hideLayout): ?>
    <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
        <p class="text-xs text-on-surface-variant">
            ¿Ya tienes una cuenta? 
            <a href="?route=auth.login" class="text-primary font-bold hover:underline">Iniciar Sesión</a>
        </p>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
