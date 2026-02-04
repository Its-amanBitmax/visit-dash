<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        :root {
            --bg: #eef3ff;
            --card: #ffffff;
            --ink: #0f172a;
            --muted: #556070;
            --accent: #2563eb;
            --accent-dark: #1d4ed8;
            --accent-soft: #dbeafe;
            --shadow: 0 20px 50px rgba(2, 8, 23, 0.18);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Space Grotesk", "Segoe UI", sans-serif;
            background:
                radial-gradient(800px 480px at 10% 10%, #dbeafe, transparent 65%),
                radial-gradient(900px 600px at 90% 20%, #bfdbfe, transparent 60%),
                var(--bg);
            color: var(--ink);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
        }

        .login-wrap {
            width: 100%;
            max-width: 920px;
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            background: var(--card);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid #dbeafe;
        }

        .login-hero {
            padding: 44px 38px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 64, 175, 0.95)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='320' height='200' viewBox='0 0 320 200'%3E%3Cpath d='M0 140 C40 120, 80 160, 120 140 C160 120, 200 160, 240 140 C280 120, 320 160, 360 140' fill='none' stroke='%23ffffff' stroke-opacity='0.12' stroke-width='6'/%3E%3C/svg%3E");
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 16px;
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .brand img {
            width: 180px;
            height: 100px;
            object-fit: contain;
            border-radius: 0;
            background: transparent;
            padding: 0;
            box-shadow: none;
        }

        .login-hero h1 {
            margin: 0;
            font-size: 30px;
            letter-spacing: 0.4px;
        }

        .login-hero p {
            margin: 0;
            color: #e2e8f0;
            line-height: 1.7;
            font-size: 15px;
        }

        .login-card {
            padding: 42px 38px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .login-card h2 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.2px;
        }

        .hint {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
        }

        .field input {
            padding: 12px 14px;
            border: 1px solid #c7d2fe;
            border-radius: 12px;
            font-size: 15px;
            font-family: inherit;
            background: #f8fafc;
        }

        .field input:focus {
            outline: 2px solid #bfdbfe;
            border-color: #60a5fa;
            background: #ffffff;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 15px;
            cursor: pointer;
            transition: transform 120ms ease, background 120ms ease, box-shadow 120ms ease;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.35);
        }

        .btn:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--muted);
        }

        .errors {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e3a8a;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
        }

        @media (max-width: 840px) {
            .login-wrap {
                grid-template-columns: 1fr;
            }

            .login-hero {
                padding: 28px 24px;
            }

            .login-card {
                padding: 28px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <section class="login-hero">
            <div class="brand">
                <img src="{{ asset('yello.png') }}" alt="Bitmax logo">
                <h1>Welcome Back</h1>
            </div>
            <p>Secure access for evaluation dashboards and admin tools. Please sign in using your admin credentials.</p>
        </section>

        <section class="login-card">
            <h2>Sign In</h2>
            <p class="hint">Use your admin email and password.</p>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="actions">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <button class="btn" type="submit">Login</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
