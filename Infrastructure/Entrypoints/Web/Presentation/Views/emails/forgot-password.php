<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hola, <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></h2>
    <p>Se ha solicitado la recuperación de tu contraseña.</p>
    <p>Tu nueva contraseña temporal es: <strong><?= htmlspecialchars($tempPassword, ENT_QUOTES, 'UTF-8') ?></strong></p>
    <p>Te recomendamos cambiarla una vez ingreses al sistema.</p>
    <br>
    <p>Saludos,</p>
    <p>El equipo de soporte.</p>
</body>
</html>