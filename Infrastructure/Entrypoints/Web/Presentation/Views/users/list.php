<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- Header Section -->
<div class="flex flex-col gap-2">
    <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
        <a class="hover:text-primary transition-colors" href="?route=home">Admin</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Gestión de Usuarios</span>
    </div>
    <div class="flex justify-between items-end">
        <div>
            <h1 class="font-headline-lg text-3xl text-on-surface">Directorio de Usuarios</h1>
            <p class="text-sm text-on-surface-variant mt-1">Administra el acceso al sistema, roles y auditoría de identidades.</p>
        </div>
        <a href="?route=users.create" class="bg-primary text-on-primary px-6 py-2.5 rounded font-semibold hover:bg-primary-fixed transition-colors flex items-center gap-2 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">person_add</span>
            Crear Nuevo Usuario
        </a>
    </div>
</div>

<!-- Alerts -->
<?php if (!empty($success)): ?>
    <div class="bg-surface-container-highest border-l-4 border-primary p-4 flex items-center gap-3 text-on-surface animate-pulse">
        <span class="material-symbols-outlined text-primary">check_circle</span>
        <p class="text-sm"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
<?php endif; ?>
<?php if (!empty($message)): ?>
    <div class="bg-error-container/20 border-l-4 border-error p-4 flex items-center gap-3 text-error">
        <span class="material-symbols-outlined">report</span>
        <p class="text-sm"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
<?php endif; ?>

<!-- Data Table Card -->
<div class="bg-surface-container rounded-xl border border-outline-variant/30 flex flex-col flex-1 overflow-hidden shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-high border-b border-outline-variant/30 font-label-md text-xs text-on-surface-variant uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4 font-semibold">UUID</th>
                    <th class="px-6 py-4 font-semibold">Usuario</th>
                    <th class="px-6 py-4 font-semibold">Contacto</th>
                    <th class="px-6 py-4 font-semibold">Nivel</th>
                    <th class="px-6 py-4 font-semibold">Estado</th>
                    <th class="px-6 py-4 font-semibold text-right">Operaciones</th>
                </tr>
            </thead>
            <tbody class="text-sm text-on-surface divide-y divide-outline-variant/20">
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl mb-2 opacity-20 block">folder_open</span>
                            No hay usuarios registrados en el sistema.
                        </td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-surface-container-highest transition-colors group">
                        <td class="px-6 py-4 font-code text-secondary text-xs"><?= substr(htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'), 0, 8) ?>...</td>
                        <td class="px-6 py-4 font-medium"><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="px-6 py-4 text-on-surface-variant"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="px-6 py-4">
                            <?php 
                            $roleStyles = 'bg-surface-variant text-on-surface-variant border-outline-variant/50';
                            if ($user->role === 'ADMIN') $roleStyles = 'bg-primary-container/20 text-primary border-primary/20';
                            if ($user->role === 'MEMBER') $roleStyles = 'bg-secondary-container/20 text-secondary border-secondary/20';
                            ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded border <?= $roleStyles ?> font-label-md text-[10px] font-bold uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[12px] mr-1">shield</span>
                                <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <?php 
                            $statusColor = '#94a3b8'; // default
                            if ($user->status === 'ACTIVE') $statusColor = '#34D399';
                            if ($user->status === 'INACTIVE' || $user->status === 'BLOCKED') $statusColor = '#f87171';
                            ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-surface-variant/30 text-on-surface-variant font-label-md text-[10px] border border-outline-variant/30 gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full" style="background-color: <?= $statusColor ?>; box-shadow: 0 0 8px <?= $statusColor ?>;"></div>
                                <?= htmlspecialchars($user->status, ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1 opacity-40 group-hover:opacity-100 transition-opacity">
                                <a href="?route=users.show&id=<?= urlencode($user->id) ?>" class="p-2 text-on-surface-variant hover:text-primary transition-colors" title="Detalles">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                </a>
                                <a href="?route=users.edit&id=<?= urlencode($user->id) ?>" class="p-2 text-on-surface-variant hover:text-primary transition-colors" title="Editar">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </a>
                                <form action="?route=users.delete" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario permanentemente?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Footer Audit Info -->
    <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant/30 flex justify-between items-center text-[10px] font-label-md text-on-surface-variant uppercase tracking-widest">
        <span>Sistema de Auditoría Hexagonal Activo</span>
        <span>Total: <?= count($users) ?> Entidades</span>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>