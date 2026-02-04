<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
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
        }

        .layout {
            display: grid;
            grid-template-columns: 270px 1fr;
            min-height: 100vh;
            height: 100vh;
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
            overflow: hidden;
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
            height: 100vh;
            overflow: hidden;
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
            min-height: 0;
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

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }

            aside {
                flex-direction: row;
                align-items: center;
                overflow-x: auto;
            }

            .nav {
                grid-auto-flow: column;
                grid-auto-columns: max-content;
            }

            .stat-grid {
                grid-template-columns: 1fr;
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
                    <span>BX</span>
                </div>
                <div>
                    Bitmax Admin
                    <small>Control Center</small>
                </div>
            </div>
            <nav class="nav">
                <a class="{{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <div class="section">Management</div>
                <a class="{{ request()->is('agent-chat-evaluations*') ? 'active' : '' }}" href="{{ route('agent-chat-evaluations.index') }}">Agent Evaluation</a>
                <a class="{{ request()->is('center-visit-evaluations*') ? 'active' : '' }}" href="{{ route('center-visit-evaluations.index') }}">Center Evaluation</a>
                <a class="{{ request()->is('admin/chart-view') ? 'active' : '' }}" href="{{ route('admin.chart.view') }}">Chart View</a>
                @if (auth('admin')->check() && (int) auth('admin')->id() === 1)
                    <a class="{{ request()->is('admin/manage-admins*') ? 'active' : '' }}" href="{{ route('admin.management.index') }}">Manage Admin</a>
                @endif
                <div class="section">System</div>
                <a class="{{ request()->is('admin/settings') ? 'active' : '' }}" href="{{ url('/admin/settings') }}">Settings</a>
            </nav>
            <div class="aside-card">
                <div class="label">Totals</div>
                <div class="value">{{ $agentEvalCount }} Agent</div>
                <div class="sub">{{ $centerEvalCount }} Center</div>
            </div>
        </aside>

        <div class="content">
            <header>
                <div class="title">@yield('header', 'Dashboard')</div>
                <div style="display:flex;align-items:center;gap:10px;">
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
    @stack('scripts')
</body>
</html>
