<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- Header & Breadcrumbs -->
<div class="flex flex-col gap-2 max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
        <a class="hover:text-primary transition-colors" href="?route=home">Admin</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="?route=users.index">Gestión de Usuarios</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Ficha Técnica</span>
    </div>
    <div class="flex justify-between items-end">
        <div>
            <h1 class="font-headline-lg text-3xl text-on-surface">Detalle de Entidad</h1>
            <p class="text-sm text-on-surface-variant mt-1">Información de auditoría y estado del registro.</p>
        </div>
        <a href="?route=users.index" class="bg-surface-variant text-on-surface px-4 py-2 rounded font-semibold hover:bg-surface-container-high transition-colors flex items-center gap-2 text-sm border border-outline-variant/30">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Volver
        </a>
    </div>
</div>

<!-- Detail Card -->
<div class="bg-surface-container border border-outline-variant/30 rounded-3xl p-8 shadow-2xl shadow-primary/5 max-w-3xl mx-auto w-full mt-6">
    <div class="space-y-8">
        <!-- UUID -->
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-label-md text-on-surface-variant uppercase tracking-[0.2em]">Identificador Único (UUID)</span>
            <div class="p-4 bg-surface-dim border border-outline-variant/30 rounded-xl font-code text-primary text-sm flex items-center gap-3">
                <span class="material-symbols-outlined text-lg opacity-50">fingerprint</span>
                <?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-label-md text-on-surface-variant uppercase tracking-wider block mb-1">Nombre de Usuario</span>
                    <p class="text-xl font-medium text-on-surface"><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div>
                    <span class="text-[10px] font-label-md text-on-surface-variant uppercase tracking-wider block mb-1">Correo Electrónico</span>
                    <a href="mailto:<?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>" class="text-lg text-secondary hover:underline flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">mail</span>
                        <?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-label-md text-on-surface-variant uppercase tracking-wider block mb-1">Nivel de Privilegios</span>
                    <?php 
                    $roleStyles = 'bg-surface-variant text-on-surface-variant border-outline-variant/50';
                    if ($user->role === 'ADMIN') $roleStyles = 'bg-primary-container/20 text-primary border-primary/20';
                    if ($user->role === 'MEMBER') $roleStyles = 'bg-secondary-container/20 text-secondary border-secondary/20';
                    ?>
                    <span class="inline-flex items-center px-3 py-1 rounded border <?= $roleStyles ?> font-label-md text-xs font-bold uppercase tracking-wider gap-2 mt-1">
                        <span class="material-symbols-outlined text-sm">shield</span>
                        <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?>
                    </span>
                </div>
                <div>
                    <span class="text-[10px] font-label-md text-on-surface-variant uppercase tracking-wider block mb-1">Estado de la Entidad</span>
                    <?php 
                    $statusColor = '#94a3b8'; // default
                    if ($user->status === 'ACTIVE') $statusColor = '#34D399';
                    if ($user->status === 'INACTIVE' || $user->status === 'BLOCKED') $statusColor = '#f87171';
                    ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-variant/30 text-on-surface-variant font-label-md text-xs border border-outline-variant/30 gap-2 mt-1">
                        <div class="w-2 h-2 rounded-full" style="background-color: <?= $statusColor ?>; box-shadow: 0 0 10px <?= $statusColor ?>;"></div>
                        <?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="pt-8 border-t border-outline-variant/30 flex justify-end">
            <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold hover:bg-primary-fixed transition-all shadow-xl shadow-primary/20 flex items-center gap-2 group">
                <span class="material-symbols-outlined transition-transform group-hover:rotate-12">settings</span>
                CONFIGURAR PERFIL
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/header.php'; ?>