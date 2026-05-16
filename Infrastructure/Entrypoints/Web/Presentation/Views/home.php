<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="flex flex-col gap-12 max-w-5xl mx-auto py-10">
    <!-- Hero Section -->
    <div class="text-center space-y-6">
        <div class="inline-flex p-4 rounded-2xl bg-primary/10 text-primary shadow-2xl shadow-primary/20 mb-4 border border-primary/20">
            <span class="material-symbols-outlined text-6xl" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
        </div>
        
        <?php if (isset($_SESSION['auth']['name'])): ?>
            <h1 class="font-headline-lg text-6xl text-on-surface tracking-tight">¡Bienvenido, <span class="text-primary"><?= htmlspecialchars($_SESSION['auth']['name'], ENT_QUOTES, 'UTF-8') ?></span>!</h1>
        <?php else: ?>
            <h1 class="font-headline-lg text-6xl text-on-surface tracking-tight">Sistema de <span class="text-primary">Identidad</span></h1>
        <?php endif; ?>
        
        <p class="text-on-surface-variant text-lg max-w-2xl mx-auto leading-relaxed">
            Gestión centralizada de identidades bajo arquitectura <span class="text-secondary font-code text-base">Hexagonal + CQRS</span>. 
            Seguridad y escalabilidad en un entorno puro de PHP.
        </p>
    </div>

    <!-- Dashboard Cards -->
    <?php if (isset($_SESSION['auth']['id'])): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="?route=users.index" class="group bg-surface-container border border-outline-variant/30 p-8 rounded-2xl hover:bg-surface-container-high transition-all hover:scale-[1.02] hover:shadow-2xl shadow-primary/5">
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                    <span class="material-symbols-outlined text-2xl">contact_page</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Directorio Activo</h3>
                <p class="text-sm text-on-surface-variant">Audita roles y gestiona accesos en tiempo real desde el core de identidades.</p>
            </a>

            <a href="?route=users.create" class="group bg-surface-container border border-outline-variant/30 p-8 rounded-2xl hover:bg-surface-container-high transition-all hover:scale-[1.02] hover:shadow-2xl shadow-secondary/5">
                <div class="w-12 h-12 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                    <span class="material-symbols-outlined text-2xl">person_add</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Añadir Entidad</h3>
                <p class="text-sm text-on-surface-variant">Provee acceso a nuevos miembros con asignación estricta de permisos de dominio.</p>
            </a>

            <a href="?route=auth.logout" class="group bg-surface-container border border-outline-variant/30 p-8 rounded-2xl hover:bg-surface-container-high transition-all hover:scale-[1.02] hover:shadow-2xl shadow-error/5">
                <div class="w-12 h-12 rounded-xl bg-error/10 text-error flex items-center justify-center mb-6 group-hover:bg-error group-hover:text-on-error transition-colors">
                    <span class="material-symbols-outlined text-2xl">power_settings_new</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Cerrar Sesión</h3>
                <p class="text-sm text-on-surface-variant">Finaliza tu sesión de forma segura y destruye el rastro de la entidad actual.</p>
            </a>
        </div>
    <?php else: ?>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <a href="?route=auth.login" class="bg-primary text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:bg-primary-fixed transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
                <span class="material-symbols-outlined">fingerprint</span> Iniciar Sesión
            </a>
            <a href="?route=users.create" class="bg-surface-variant text-on-surface px-10 py-4 rounded-xl font-bold text-lg hover:bg-surface-container-high transition-all border border-outline-variant/30 flex items-center gap-3">
                <span class="material-symbols-outlined">person_add</span> Crear Cuenta
            </a>
        </div>
    <?php endif; ?>

    <!-- Tech Badges -->
    <div class="flex flex-wrap justify-center gap-3 opacity-50 mt-8">
        <span class="px-3 py-1 rounded bg-surface-variant text-[10px] font-bold tracking-widest uppercase">PHP 8.2</span>
        <span class="px-3 py-1 rounded bg-surface-variant text-[10px] font-bold tracking-widest uppercase">Hexagonal</span>
        <span class="px-3 py-1 rounded bg-surface-variant text-[10px] font-bold tracking-widest uppercase">MySQL</span>
        <span class="px-3 py-1 rounded bg-surface-variant text-[10px] font-bold tracking-widest uppercase">Tailwind</span>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>