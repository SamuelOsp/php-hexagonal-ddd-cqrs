<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'EUMS - Management' ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700&family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
        extend: {
            "colors": {
                    "surface-variant": "#2d3449",
                    "primary-fixed": "#c4e7ff",
                    "tertiary-fixed": "#d8e3fb",
                    "surface-container-highest": "#2d3449",
                    "outline-variant": "#3e484f",
                    "error": "#ffb4ab",
                    "on-tertiary": "#263143",
                    "surface-container-lowest": "#060e20",
                    "on-surface-variant": "#bdc8d1",
                    "on-secondary-container": "#a7b6cc",
                    "error-container": "#93000a",
                    "secondary-fixed": "#d4e4fa",
                    "on-tertiary-container": "#394458",
                    "on-error": "#690005",
                    "inverse-on-surface": "#283044",
                    "on-secondary-fixed-variant": "#39485a",
                    "on-secondary-fixed": "#0d1c2d",
                    "inverse-primary": "#00668a",
                    "tertiary-container": "#a7b2c9",
                    "surface-container-high": "#222a3d",
                    "on-surface": "#dae2fd",
                    "primary": "#8ed5ff",
                    "on-background": "#dae2fd",
                    "inverse-surface": "#dae2fd",
                    "on-tertiary-fixed": "#111c2d",
                    "on-primary": "#00354a",
                    "surface-dim": "#0b1326",
                    "surface": "#0b1326",
                    "surface-tint": "#7bd0ff",
                    "background": "#0b1326",
                    "on-secondary": "#233143",
                    "on-error-container": "#ffdad6",
                    "primary-container": "#38bdf8",
                    "on-primary-fixed": "#001e2c",
                    "tertiary": "#c2cde5",
                    "on-primary-fixed-variant": "#004c69",
                    "secondary": "#b9c8de",
                    "tertiary-fixed-dim": "#bcc7de",
                    "secondary-fixed-dim": "#b9c8de",
                    "on-tertiary-fixed-variant": "#3c475a",
                    "surface-container-low": "#131b2e",
                    "surface-container": "#171f33",
                    "outline": "#87929a",
                    "surface-bright": "#31394d",
                    "secondary-container": "#39485a",
                    "on-primary-container": "#004965",
                    "primary-fixed-dim": "#7bd0ff"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline-lg": ["Barlow Condensed"],
                    "label-sm": ["JetBrains Mono"],
                    "headline-md": ["Barlow Condensed"],
                    "label-md": ["JetBrains Mono"],
                    "body-sm": ["Geist"],
                    "headline-sm": ["Barlow Condensed"],
                    "code": ["JetBrains Mono"],
                    "body-lg": ["Geist"],
                    "body-md": ["Geist"]
            }
        },
        },
    }
    </script>
    <style>
        .material-symbols-outlined { 
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal;
            font-style: normal;
            font-size: 20px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
            width: 24px;
            height: 24px;
            overflow: hidden;
            vertical-align: middle;
        }
        .active-link { border-left-width: 4px; border-color: #8ed5ff; background-color: #2d3449; color: #dae2fd; font-weight: 600; }
        
        /* Estilos Globales para Formularios */
        input, select, textarea {
            background-color: rgba(45, 52, 73, 0.5) !important;
            border: 1px solid rgba(62, 72, 79, 0.5) !important;
            color: #dae2fd !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem 1rem 0.75rem 3rem !important; /* Espacio extra para el icono */
            outline: none !important;
            transition: all 0.2s ease !important;
            width: 100%;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #8ed5ff !important;
            box-shadow: 0 0 0 1px #8ed5ff !important;
            background-color: rgba(45, 52, 73, 0.8) !important;
        }
        label {
            display: block;
            font-size: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #bdc8d1;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }
        select option {
            background-color: #171f33;
            color: #dae2fd;
        }

        /* Prevenir que el texto del icono se vea gigante antes de cargar */
        .material-symbols-outlined { font-size: inherit; }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased overflow-hidden flex h-screen">
    <!-- Sidebar (Condicional) -->
    <?php if (!isset($hideLayout) || !$hideLayout): ?>
    <nav class="fixed left-0 top-0 h-full w-[280px] flex flex-col z-40 bg-surface-container-low border-r border-outline-variant/30">
        <div class="flex items-center gap-4 px-6 py-8">
            <div class="w-10 h-10 rounded bg-primary-container flex items-center justify-center text-on-primary-container shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">admin_panel_settings</span>
            </div>
            <div>
                <h2 class="font-headline-md text-xl text-on-surface leading-tight">EUMS Admin</h2>
                <p class="font-label-md text-xs text-on-surface-variant">Hexagonal System</p>
            </div>
        </div>
        
        <div class="flex flex-col gap-1 px-3 py-2 flex-1 overflow-y-auto">
            <a class="flex items-center gap-3 px-4 py-3 rounded text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all <?= (!isset($_GET['route']) || $_GET['route'] === 'home') ? 'active-link' : '' ?>" href="?route=home">
                <span class="material-symbols-outlined">dashboard</span>
                Menú Principal
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all <?= (isset($_GET['route']) && str_starts_with($_GET['route'], 'users')) ? 'active-link' : '' ?>" href="?route=users.index">
                <span class="material-symbols-outlined">group</span>
                Gestión de Usuarios
            </a>
        </div>

        <?php if (isset($_SESSION['auth'])): ?>
        <div class="mt-auto px-3 py-6 border-t border-outline-variant/30 flex flex-col gap-1">
            <div class="px-4 py-2 mb-2">
                <p class="text-xs font-label-md text-on-surface-variant uppercase tracking-wider">Sesión Actual</p>
                <p class="text-sm font-medium text-primary truncate"><?= htmlspecialchars($_SESSION['auth']['name']) ?></p>
            </div>
            <a class="flex items-center gap-3 px-4 py-3 rounded text-error hover:bg-error-container/20 transition-all" href="?route=auth.logout">
                <span class="material-symbols-outlined">logout</span>
                Cerrar Sesión
            </a>
        </div>
        <?php else: ?>
        <div class="mt-auto px-3 py-6 border-t border-outline-variant/30 flex flex-col gap-2">
            <a href="?route=auth.login" class="flex items-center justify-center gap-2 bg-primary text-on-primary px-4 py-2 rounded font-semibold hover:bg-primary-fixed transition-colors">
                <span class="material-symbols-outlined text-sm">login</span> Iniciar Sesión
            </a>
        </div>
        <?php endif; ?>
    </nav>
    <?php endif; ?>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col <?= (!isset($hideLayout) || !$hideLayout) ? 'ml-[280px]' : '' ?> h-full overflow-hidden bg-background">
        <?php if (!isset($hideLayout) || !$hideLayout): ?>
        <header class="flex justify-between items-center w-full px-8 h-16 z-50 bg-surface-container border-b border-outline-variant/30 flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="font-headline-md text-2xl font-bold text-primary tracking-tighter">EUMS</span>
                <span class="px-2 py-0.5 rounded bg-surface-variant text-[10px] font-bold text-on-surface-variant uppercase border border-outline-variant/50">v1.0.0</span>
            </div>
            
            <div class="flex items-center gap-6">
                <?php if (isset($_SESSION['auth'])): ?>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-on-surface"><?= htmlspecialchars($_SESSION['auth']['name']) ?></p>
                        <p class="text-[10px] font-label-md text-on-surface-variant uppercase"><?= htmlspecialchars($_SESSION['auth']['role']) ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-primary/30 p-0.5">
                        <div class="w-full h-full rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                            <?= strtoupper(substr($_SESSION['auth']['name'], 0, 1)) ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </header>
        <?php endif; ?>

        <main class="flex-1 overflow-y-auto p-8 bg-background flex flex-col gap-8">
