<nav>
    <?php if (isset($_SESSION['auth']['id'])): ?>
        <a href="?route=home">Inicio</a>
        <a href="?route=users.create">Registrar usuario</a>
        <a href="?route=users.index">Listar usuarios</a>
        <span style="margin-right: 15px;">Hola, <?= htmlspecialchars($_SESSION['auth']['name'], ENT_QUOTES, 'UTF-8') ?></span>
        <a href="?route=auth.logout" style="float: right;">Cerrar sesión</a>
    <?php else: ?>
        <a href="?route=auth.login">Iniciar sesión</a>
        <a href="?route=auth.forgot">Recuperar contraseña</a>
    <?php endif; ?>
</nav>