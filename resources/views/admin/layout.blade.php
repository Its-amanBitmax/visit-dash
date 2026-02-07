<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('yello.ico') }}?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --bg: #f3f6ff;
            --panel: #ffffff;
            --ink: #121826;
            --muted: #606776;
            --accent: #2563eb;
            --accent-2: #60a5fa;
            --accent-dark: #1d4ed8;
            --line: #e5e7eb;
            --shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
            --glass: rgba(255, 255, 255, 0.75);
        }

        * { box-sizing: border-box; }

        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: "Urbanist", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(900px 520px at 8% 10%, #dbeafe, transparent 62%),
                radial-gradient(900px 620px at 92% 18%, #bfdbfe, transparent 60%),
                linear-gradient(120deg, #f8fafc 0%, #edf2ff 48%, #f2f5ff 100%),
                var(--bg);
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .layout {
            display: grid;
            grid-template-columns: 270px 1fr;
            min-height: 100vh;
            height: auto;
            position: relative;
        }

        .layout.collapsed {
            grid-template-columns: 78px 1fr;
        }

        aside {
            background:
                radial-gradient(220px 260px at 20% 10%, rgba(96, 165, 250, 0.35), transparent 70%),
                linear-gradient(160deg, #0f172a 0%, #0b1b33 45%, #0b254a 100%);
            color: #e5edff;
            padding: 30px 22px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            position: relative;
            overflow-y: auto;
            overflow-x: hidden;
            height: 100vh;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        aside::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        aside::after {
            content: "";
            position: absolute;
            inset: auto -40% -30% -40%;
            height: 240px;
            background:
                radial-gradient(240px 140px at 50% 50%, rgba(59, 130, 246, 0.25), transparent 70%);
            pointer-events: none;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: "Space Grotesk", "Urbanist", sans-serif;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: 0.6px;
        }

        .brand .logo {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, #60a5fa, #2563eb);
            display: grid;
            place-items: center;
            overflow: hidden;
            color: #0b1f1a;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .brand .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 6px;
        }


        .brand small {
            display: block;
            color: rgba(229, 237, 255, 0.72);
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .collapse-toggle {
            margin-left: auto;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            color: #e5edff;
            display: inline-grid;
            place-items: center;
            cursor: pointer;
            transition: background 140ms ease, transform 140ms ease, border-color 140ms ease;
        }

        .collapse-toggle:hover {
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.24);
            transform: translateY(-1px);
        }

        .mobile-toggle {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #1f2937;
            place-items: center;
            cursor: pointer;
            transition: background 140ms ease, transform 140ms ease, border-color 140ms ease;
            box-shadow: 0 10px 18px rgba(15, 23, 42, 0.08);
        }

        .mobile-toggle:hover {
            transform: translateY(-1px);
            border-color: #d1d5db;
        }

        .layout.collapsed aside {
            width: 78px;
            overflow: hidden;
        }

        .layout.collapsed .brand > div:nth-child(2),
        .layout.collapsed .nav .section,
        .layout.collapsed .nav a span,
        .layout.collapsed .aside-card {
            display: none;
        }

        .layout.collapsed .nav a {
            padding: 11px;
            text-align: center;
            justify-content: center;
            gap: 0;
        }

        .layout.collapsed .brand {
            width: 100%;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
        }

        .layout.collapsed .collapse-toggle {
            margin-left: 0;
        }

        .layout.collapsed .brand .logo {
            width: 42px;
            height: 42px;
        }

        .layout.collapsed .collapse-toggle {
            width: 32px;
            height: 32px;
            border-radius: 9px;
        }

        .nav {
            display: grid;
            gap: 8px;
        }

        .nav a {
            color: #cbd5f5;
            text-decoration: none;
            padding: 11px 14px;
            border-radius: 12px;
            font-size: 14px;
            transition: background 140ms ease, color 140ms ease, transform 140ms ease;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .nav a i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .nav a.active,
        .nav a:hover {
            background: rgba(96, 165, 250, 0.18);
            color: #eef3ff;
            border-color: rgba(96, 165, 250, 0.35);
            transform: translateX(2px);
        }

        .logout-btn {
            background: #ffffff;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 13px;
            cursor: pointer;
            transition: background 140ms ease, color 140ms ease, transform 140ms ease, border-color 140ms ease, box-shadow 140ms ease;
            box-shadow: 0 10px 18px rgba(15, 23, 42, 0.1);
        }

        .logout-btn:hover {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
            transform: translateY(-1px);
        }

        .nav .section {
            margin-top: 14px;
            font-size: 11px;
            color: rgba(229, 237, 255, 0.6);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .aside-card {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 14px;
            display: grid;
            gap: 10px;
            backdrop-filter: blur(8px);
        }

        .aside-card .label {
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(229, 237, 255, 0.7);
        }

        .aside-card .value {
            font-size: 20px;
            font-weight: 700;
        }

        .aside-card .sub {
            font-size: 12px;
            color: rgba(229, 237, 255, 0.65);
        }

        .content {
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            height: auto;
            overflow: hidden;
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease;
            z-index: 30;
        }

        header {
            background: var(--glass);
            border-bottom: 1px solid var(--line);
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        header .title {
            font-size: 20px;
            font-weight: 700;
            font-family: "Space Grotesk", "Urbanist", sans-serif;
        }

        .main {
            padding: 28px;
            display: grid;
            gap: 20px;
            align-content: start;
            overflow-y: auto;
            overflow-x: hidden;
            min-height: 0;
            padding-bottom: 48px;
            scroll-padding-bottom: 48px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .stat {
            background: var(--panel);
            border-radius: 16px;
            padding: 18px 20px;
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
        }

        .stat .label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .stat .value {
            font-size: 22px;
            font-weight: 700;
            margin-top: 8px;
        }

        .card {
            background: var(--panel);
            border-radius: 16px;
            padding: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
        }

        .page-card {
            background: var(--panel);
            border-radius: 16px;
            padding: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid transparent;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: transform 140ms ease, box-shadow 140ms ease, background 140ms ease;
            box-shadow: 0 12px 20px rgba(37, 99, 235, 0.25);
        }

        .btn:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #1f2937;
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .btn-toggle {
            background: #f8fafc;
            color: #1f2937;
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .btn-toggle.active {
            background: var(--accent);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 12px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-danger {
            background: #ef4444;
            box-shadow: 0 12px 20px rgba(239, 68, 68, 0.2);
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .table-wrap {
            width: 100%;
            overflow: auto;
            border-radius: 14px;
            border: 1px solid var(--line);
            -webkit-overflow-scrolling: touch;
        }

        table.table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
            background: #ffffff;
        }

        .table th,
        .table td {
            padding: 12px 14px;
            border-bottom: 1px solid #eef2f7;
            text-align: left;
            font-size: 14px;
        }

        .table thead th {
            font-size: 12px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            background: #f8fafc;
        }

        .table tr:hover td {
            background: #f8fafc;
        }

        .form-grid {
            display: grid;
            gap: 16px;
        }

        .form-section {
            display: grid;
            gap: 12px;
            padding: 18px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #ffffff;
        }

        .form-section h3 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
        }

        .form-row {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .form-group label {
            display: block;
            font-size: 12px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            font-family: inherit;
            background: #ffffff;
        }

        .form-group select {
            appearance: none;
            background-image:
                linear-gradient(45deg, transparent 50%, #94a3b8 50%),
                linear-gradient(135deg, #94a3b8 50%, transparent 50%);
            background-position:
                calc(100% - 18px) 50%,
                calc(100% - 12px) 50%;
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        @media (max-width: 980px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: var(--accent-dark);
            font-size: 12px;
            font-weight: 600;
        }

        footer {
            background: var(--panel);
            border-top: 1px solid var(--line);
            padding: 14px 28px;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 1200px) {
            .layout {
                grid-template-columns: 240px 1fr;
            }
        }

        @media (max-width: 1100px) {
            .layout {
                grid-template-columns: 220px 1fr;
            }
        }

        @media (max-width: 1024px) {
            .layout {
                grid-template-columns: 200px 1fr;
            }
        }

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }

            aside {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 260px;
                z-index: 40;
                padding: 18px 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 14px;
                overflow-y: auto;
                overflow-x: hidden;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 180ms ease;
            }

            .layout.collapsed {
                grid-template-columns: 1fr;
            }

            .layout.collapsed aside {
                width: 260px;
                overflow: auto;
            }

            .layout.collapsed .brand > div:nth-child(2),
            .layout.collapsed .nav .section,
            .layout.collapsed .aside-card {
                display: block;
            }

            .layout.collapsed .nav a span {
                display: inline;
            }

            .layout.collapsed .nav a {
                justify-content: flex-start;
                gap: 10px;
            }

            .layout.mobile-open aside {
                transform: translateX(0);
            }

            .layout.mobile-open .overlay {
                opacity: 1;
                pointer-events: auto;
            }

            .nav {
                grid-auto-flow: row;
                grid-auto-columns: unset;
                gap: 10px;
            }

            .brand {
                flex: 0 0 auto;
                white-space: nowrap;
            }

            .aside-card {
                flex: 0 0 auto;
                min-width: 200px;
            }

            .collapse-toggle {
                display: none;
            }

            .mobile-toggle {
                display: grid;
            }

            .page-card,
            .card {
                min-width: 0;
            }

            .page-card div[style*="grid-template-columns:repeat(2"],
            .page-card div[style*="grid-template-columns:repeat(3"] {
                grid-template-columns: 1fr !important;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .layout {
                height: auto;
            }

            .content {
                min-height: 0;
                height: auto;
            }

            header {
                padding: 16px 18px;
                flex-wrap: wrap;
                gap: 12px;
            }

            header .title {
                font-size: 18px;
                flex: 1 1 100%;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .main {
                padding: 18px;
                overflow-y: auto;
                overflow-x: hidden;
                padding-bottom: 40px;
                scroll-padding-bottom: 40px;
            }

            .card,
            .page-card {
                padding: 18px;
            }

            .table-wrap {
                border-radius: 12px;
            }

            table.table {
                min-width: 560px;
            }

            .btn,
            .btn-secondary,
            .btn-danger,
            .btn-toggle {
                padding: 10px 12px;
            }

            .aside-card {
                display: none;
            }
        }

        @media (max-width: 520px) {
            aside {
                padding: 12px;
            }

            .brand {
                font-size: 16px;
            }

            .collapse-toggle {
                width: 34px;
                height: 34px;
            }

            .brand .logo {
                width: 40px;
                height: 40px;
            }

            .nav a {
                padding: 10px 12px;
                font-size: 13px;
            }

            .aside-card {
                min-width: 180px;
            }

            .main {
                padding: 14px;
            }

            footer {
                padding: 12px 16px;
                font-size: 12px;
            }

            table.table {
                min-width: 520px;
            }
        }
    </style>
</head>
<body>
    @php
        $agentEvalCount = \App\Models\AgentChatEvaluation::count();
        $centerEvalCount = \App\Models\CenterVisitEvaluation::count();
        $agentAvgScore = round((float) \App\Models\AgentChatEvaluation::avg('overall_score'), 1);
    @endphp
    <div class="layout">
        <aside>
            <div class="brand">
                <div class="logo">
                    <span>GP</span>
                </div>
                <div>
                    Global Projects
                    <small>Control Center</small>
                </div>
                <button type="button" class="collapse-toggle" aria-label="Toggle sidebar" title="Toggle sidebar">≡</button>
            </div>
            <nav class="nav">
                <a class="{{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                <div class="section">Management</div>
                <a class="{{ request()->is('agent-chat-evaluations*') ? 'active' : '' }}" href="{{ route('agent-chat-evaluations.index') }}"><i class="fa-solid fa-headset"></i><span>Agent Evaluation</span></a>
                <a class="{{ request()->is('center-visit-evaluations*') ? 'active' : '' }}" href="{{ route('center-visit-evaluations.index') }}"><i class="fa-solid fa-building"></i><span>Center Evaluation</span></a>
                <a class="{{ request()->is('qa-evaluation-reports*') ? 'active' : '' }}" href="{{ route('qa-evaluation-reports.index') }}"><i class="fa-solid fa-clipboard-check"></i><span>QA Evaluation</span></a>
                <a class="{{ request()->is('tl-evaluation-reports*') ? 'active' : '' }}" href="{{ route('tl-evaluation-reports.index') }}"><i class="fa-solid fa-user-shield"></i><span>TL Evaluation</span></a>
                <a class="{{ request()->is('admin/chart-view') ? 'active' : '' }}" href="{{ route('admin.chart.view') }}"><i class="fa-solid fa-chart-line"></i><span>Chart View</span></a>
                @if (auth('admin')->check() && (int) auth('admin')->id() === 1)
                    <a class="{{ request()->is('admin/manage-admins*') ? 'active' : '' }}" href="{{ route('admin.management.index') }}"><i class="fa-solid fa-users-gear"></i><span>Manage Admin</span></a>
                @endif
                <div class="section">System</div>
                <a class="{{ request()->is('admin/settings') ? 'active' : '' }}" href="{{ url('/admin/settings') }}"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
            </nav>
            <div class="aside-card">
                <div class="label">Totals</div>
                <div class="value">{{ $agentEvalCount }} Agent</div>
                <div class="sub">{{ $centerEvalCount }} Center</div>
            </div>
        </aside>
        <div class="overlay" aria-hidden="true"></div>

        <div class="content">
            <header>
                <button type="button" class="mobile-toggle" aria-label="Open menu" title="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="title">@yield('header', 'Dashboard')</div>
                <div class="header-actions" style="display:flex;align-items:center;gap:10px;">
                    <div class="user chip">{{ auth('admin')->user()->name ?? 'Admin' }}</div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </header>

            <main class="main">
                <div class="stat-grid">
                    <div class="stat">
                        <div class="label">Agent Evaluations</div>
                        <div class="value">{{ $agentEvalCount }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Center Evaluations</div>
                        <div class="value">{{ $centerEvalCount }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Agent Avg Score</div>
                        <div class="value">{{ $agentAvgScore }}</div>
                    </div>
                </div>
                @yield('content')
            </main>

            <footer>
                &copy; {{ date('Y') }} Bitmax. All rights reserved.
            </footer>
        </div>
    </div>
    <script>
        (function () {
            var layout = document.querySelector('.layout');
            var toggle = document.querySelector('.collapse-toggle');
            var mobileToggle = document.querySelector('.mobile-toggle');
            var overlay = document.querySelector('.overlay');
            if (!layout) return;
            if (toggle) {
                toggle.addEventListener('click', function () {
                    layout.classList.toggle('collapsed');
                });
            }
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function () {
                    layout.classList.add('mobile-open');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', function () {
                    layout.classList.remove('mobile-open');
                });
            }
            var navLinks = document.querySelectorAll('.nav a');
            if (navLinks.length) {
                navLinks.forEach(function (link) {
                    link.addEventListener('click', function () {
                        layout.classList.remove('mobile-open');
                    });
                });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
