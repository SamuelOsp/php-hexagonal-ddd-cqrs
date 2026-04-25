<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$pageTitle = isset($pageTitle) && is_string($pageTitle) && $pageTitle !== ''
    ? $pageTitle
    : 'CRUD Usuarios';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --primary: #1d4ed8;
            --success: #15803d;
            --danger: #b91c1c;
            --text-muted: #6b7280;
            --border-color: #d1d5db;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
        }
        .nav-links a,
        .nav-user a {
            color: #111827;
            text-decoration: none;
            margin-right: 10px;
        }
        .nav-user span {
            margin-right: 10px;
        }
        .main-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 16px 24px;
        }
        .card,
        .content-card,
        .auth-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 16px;
        }
        .content-card {
            max-width: 100%;
        }
        .auth-box {
            max-width: 560px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 12px;
        }
        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 8px;
        }
        .btn {
            display: inline-block;
            border: 1px solid #111827;
            background: #111827;
            color: #ffffff;
            border-radius: 4px;
            padding: 8px 12px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-secondary {
            background: #ffffff;
            color: #111827;
        }
        .btn-block {
            width: 100%;
        }
        .alert {
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 12px;
        }
        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
        }
        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
        }
        .field-error {
            display: block;
            margin-top: 4px;
            color: var(--danger);
            font-size: 12px;
        }
        .auth-footer {
            margin-top: 12px;
        }
        .form-group-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            border: 1px solid var(--border-color);
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<?php require_once __DIR__ . '/menu.php'; ?>
<div class="main-container">
