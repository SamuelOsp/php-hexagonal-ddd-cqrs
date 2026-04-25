<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'CRUD Usuarios', ENT_QUOTES, 'UTF-8') ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-base: #0f172a;
            --bg-surface: rgba(30, 41, 59, 0.7);
            --bg-surface-hover: rgba(30, 41, 59, 0.9);
            --border-color: rgba(255, 255, 255, 0.1);
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --secondary: #8b5cf6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glow-color: rgba(99, 102, 241, 0.4);
            --font-family: 'Inter', system-ui, sans-serif;
        }

        * { box-sizing: border-box; }

        body { 
            font-family: var(--font-family);
            background-color: var(--bg-base);
            color: var(--text-main);
            margin: 0; 
            padding: 0; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background gradient circles */
        .bg-circles {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.5;
            animation: float 20s infinite ease-in-out alternate;
        }
        .circle-1 {
            width: 40vw; height: 40vw;
            background: var(--primary);
            top: -10vw; left: -10vw;
        }
        .circle-2 {
            width: 50vw; height: 50vw;
            background: var(--secondary);
            bottom: -20vw; right: -10vw;
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(5vw, 5vw) scale(1.1); }
            100% { transform: translate(-5vw, 2vw) scale(0.9); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        .shake { animation: shake 0.5s; }

        .main-container {
            flex: 1;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Nav styling */
        nav { 
            background: rgba(15, 23, 42, 0.8); 
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 30px; 
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-links a { 
            color: var(--text-main); 
            text-decoration: none; 
            margin-right: 25px; 
            font-weight: 500;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .nav-links a:hover { color: var(--primary); }
        
        .nav-user { color: var(--text-main); font-weight: 500; display: flex; align-items: center; gap: 20px; }
        .nav-user a { color: var(--danger); text-decoration: none; transition: color 0.3s; display: inline-flex; align-items: center; gap: 8px;}
        .nav-user a:hover { color: #f87171; }

        /* Card (Glassmorphism) */
        .card, .auth-box { 
            background: var(--bg-surface); 
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            width: 100%;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .auth-box { max-width: 420px; margin: 40px auto; }
        .content-card { width: 100%; }

        /* Forms */
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-muted); font-size: 0.9em; text-transform: uppercase; letter-spacing: 0.5px;}
        input[type="text"], input[type="email"], input[type="password"], select { 
            width: 100%; 
            padding: 14px 16px; 
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: rgba(0,0,0,0.2);
            color: var(--text-main);
            font-size: 1em;
            transition: all 0.3s;
            font-family: var(--font-family);
        }
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--glow-color);
            background: rgba(0,0,0,0.4);
        }
        input::placeholder { color: #475569; }
        select option { background: var(--bg-base); color: var(--text-main); }

        /* Buttons */
        .btn { 
            padding: 14px 24px; 
            text-decoration: none; 
            border: none; 
            border-radius: 10px;
            cursor: pointer; 
            display: inline-flex; 
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            font-size: 1em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            font-family: var(--font-family);
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.3); }
        .btn:active { transform: translateY(0); }
        .btn-primary { 
            background: linear-gradient(135deg, var(--primary), var(--secondary)); 
            color: white; 
            box-shadow: 0 4px 15px var(--glow-color);
        }
        .btn-primary:hover { box-shadow: 0 8px 25px var(--glow-color); }
        .btn-warning { background: linear-gradient(135deg, var(--warning), #d97706); color: white; }
        .btn-danger { background: linear-gradient(135deg, var(--danger), #dc2626); color: white; }
        .btn-info { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; }
        .btn-secondary { background: rgba(255,255,255,0.1); color: var(--text-main); border: 1px solid var(--border-color); }
        .btn-secondary:hover { background: rgba(255,255,255,0.15); }
        .btn-sm { padding: 8px 14px; font-size: 0.85em; border-radius: 8px; }
        .btn-block { width: 100%; }

        /* Tables */
        .table-container { overflow-x: auto; border-radius: 12px; border: 1px solid var(--border-color); background: rgba(0,0,0,0.2); }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid var(--border-color); padding: 16px 20px; text-align: left; }
        th { background: rgba(255,255,255,0.02); font-weight: 600; color: var(--text-muted); text-transform: uppercase; font-size: 0.8em; letter-spacing: 0.5px; }
        tbody tr { transition: background 0.2s; }
        tbody tr:hover { background: rgba(255,255,255,0.03); }
        tbody tr:last-child td { border-bottom: none; }

        /* Alerts */
        .alert { padding: 16px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; animation: fadeInUp 0.4s ease-out; border: 1px solid transparent; }
        .alert-error { background: rgba(239, 68, 68, 0.1); color: #fca5a5; border-color: rgba(239, 68, 68, 0.2); }
        .alert-success { background: rgba(16, 185, 129, 0.1); color: #6ee7b7; border-color: rgba(16, 185, 129, 0.2); }
        .field-error { color: #fca5a5; font-size: 0.85em; margin-top: 8px; display: flex; align-items: center; gap: 5px; font-weight: 500; }
        
        /* Typography */
        h1, h2, h3 { margin-top: 0; color: var(--text-main); font-weight: 600; }
        h2 { font-size: 1.8em; margin-bottom: 24px; text-align: center; }
        .text-center { text-align: center; }
        .mt-4 { margin-top: 24px; }
        .mb-4 { margin-bottom: 24px; }
        
        /* Link styling */
        a { color: var(--primary); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        a:hover { color: #818cf8; }

        /* Avatar */
        .auth-avatar {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 32px;
            margin: 0 auto 24px;
            box-shadow: 0 10px 25px var(--glow-color);
            transform: rotate(-5deg);
        }
        
        /* Badges */
        .badge { padding: 6px 12px; border-radius: 6px; font-size: 0.75em; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: 0.5px;}
        .badge-success { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-warning { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-danger { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .badge-info { background: rgba(14, 165, 233, 0.15); color: #38bdf8; border: 1px solid rgba(14, 165, 233, 0.3); }
        .badge-purple { background: rgba(139, 92, 246, 0.15); color: #a78bfa; border: 1px solid rgba(139, 92, 246, 0.3); }
        
        /* Dashboard grids */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }
        .dashboard-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 30px;
            text-align: left;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: var(--text-main);
            position: relative;
            overflow: hidden;
        }
        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0; transition: opacity 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            background: var(--bg-surface-hover);
            border-color: rgba(255,255,255,0.2);
        }
        .dashboard-card:hover::before { opacity: 1; }
        .dashboard-icon {
            width: 50px; height: 50px;
            border-radius: 12px;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .dashboard-card h3 { margin: 0 0 10px 0; font-size: 1.3em; }
        .dashboard-card p { margin: 0; color: var(--text-muted); font-size: 0.95em; line-height: 1.5; }

        .data-list p { margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px; }
        .data-list strong { color: var(--text-muted); font-size: 0.85em; text-transform: uppercase; width: 120px; }
        .data-list span { font-size: 1.1em; }
    </style>
</head>
<body>
<div class="bg-circles">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
</div>
<?php require __DIR__ . '/menu.php'; ?>
<div class="main-container">