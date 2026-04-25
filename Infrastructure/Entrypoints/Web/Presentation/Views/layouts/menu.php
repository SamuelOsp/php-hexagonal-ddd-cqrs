<nav>
    <div class="nav-links">
    <?php if (isset($_SESSION['auth']['id'])): ?>
        <a href="?route=home"><i class="fas fa-cube"></i> Dashboard</a>
        <a href="?route=users.create"><i class="fas fa-user-plus"></i> Registrar usuario</a>
        <a href="?route=users.index"><i class="fas fa-users"></i> Directorio</a>
    <?php endif; ?>
    </div>
    
    <div class="nav-user">
    <?php if (isset($_SESSION['auth']['id'])): ?>
        <span><i class="fas fa-user-astronaut"></i> <?= htmlspecialchars($_SESSION['auth']['name'], ENT_QUOTES, 'UTF-8') ?></span>
        <a href="?route=auth.logout"><i class="fas fa-power-off"></i> Salir</a>
    <?php else: ?>
        <a href="?route=auth.login" style="color: var(--primary);"><i class="fas fa-sign-in-alt"></i> Entrar</a>
    <?php endif; ?>
    </div>
</nav>