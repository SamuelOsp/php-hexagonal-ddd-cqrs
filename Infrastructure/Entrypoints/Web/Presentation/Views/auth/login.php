<?php 
$hideLayout = true;
require __DIR__ . '/../layouts/header.php'; 
?>

<div class="flex-1 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Brand/Logo Area -->
        <div class="text-center mb-8">
            <div class="inline-flex p-4 rounded-2xl bg-primary/10 text-primary shadow-2xl shadow-primary/20 mb-4 border border-primary/20">
                <span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">fingerprint</span>
            </div>
            <h1 class="font-headline-lg text-4xl text-on-surface tracking-tight">Acceso al Sistema</h1>
            <p class="text-on-surface-variant text-sm mt-2">Introduce tus credenciales para continuar al panel.</p>
        </div>

        <!-- Login Card -->
        <div class="bg-surface-container border border-outline-variant/30 rounded-3xl p-8 shadow-2xl shadow-primary/5">
            <?php if (!empty($message)): ?>
                <div class="mb-6 p-4 rounded-xl bg-error-container/20 border border-error/30 text-error flex items-center gap-3">
                    <span class="material-symbols-outlined">report</span>
                    <p class="text-sm"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="?route=auth.authenticate" class="space-y-6">
                <!-- Email Input -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-md text-on-surface-variant uppercase tracking-wider ml-1">Correo Electrónico</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                        <input type="email" name="email" 
                               placeholder="admin@eums.local"
                               class="w-full pl-12 pr-4 py-3.5 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface placeholder:text-on-surface-variant/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                               value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required autofocus>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="block text-xs font-label-md text-on-surface-variant uppercase tracking-wider">Contraseña</label>
                        <a href="?route=auth.forgot" class="text-[10px] font-label-md text-primary hover:underline uppercase tracking-tighter">¿Olvidaste la clave?</a>
                    </div>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                        <input type="password" name="password" 
                               placeholder="••••••••••••"
                               class="w-full pl-12 pr-4 py-3.5 bg-surface-variant/50 border border-outline-variant/50 rounded-xl text-on-surface placeholder:text-on-surface-variant/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                               required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-on-primary py-4 rounded-xl font-bold hover:bg-primary-fixed transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-2 group">
                    <span>AUTENTICAR</span>
                    <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1">login</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
                <p class="text-xs text-on-surface-variant">
                    ¿No tienes acceso? 
                    <a href="?route=users.create" class="text-primary font-bold hover:underline">Solicitar Registro</a>
                </p>
            </div>
        </div>

        <!-- Footer Info -->
        <p class="text-center mt-8 text-[10px] font-label-md text-on-surface-variant uppercase tracking-[0.2em] opacity-50">
            Encrypted Session · Hexagonal Core · EUMS v1.0.0
        </p>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
