<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'CRUD Usuarios', ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        nav { background: #333; color: #fff; padding: 10px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 15px; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
        .field-error { color: red; font-size: 0.9em; margin-top: 5px; display: block; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"], select { width: 100%; padding: 8px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .btn { padding: 8px 15px; text-decoration: none; border: none; cursor: pointer; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-sm { padding: 4px 8px; font-size: 0.8em; }
        .auth-box { max-width: 400px; margin: 0 auto; background: #fff; padding: 20px; border: 1px solid #ddd; }
    </style>
</head>
<body>
<?php require __DIR__ . '/menu.php'; ?>