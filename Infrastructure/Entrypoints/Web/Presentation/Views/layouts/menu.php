<?php
declare(strict_types=1);
$authUser = $_SESSION['auth'] ?? null;
?>
<nav>
    <a href="?route=home" class="brand">⚡ CRUD Usuarios</a>
    <?php if ($authUser): ?>
        <a href="?route=users.index">📋 Listar usuarios</a>
        <a href="?route=users.create">➕ Nuevo usuario</a>
        <div class="user-info">
            <span>👤 <?= htmlspecialchars($authUser['name'], ENT_QUOTES, 'UTF-8') ?></span>
            <a href="?route=auth.logout" class="logout">Cerrar sesión</a>
        </div>
    <?php else: ?>
        <a href="?route=auth.login">🔐 Iniciar sesión</a>
    <?php endif; ?>
</nav>
