//dashboard layout
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore — ប្រព័ន្ធគ្រប់គ្រង</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f1117;
            --sidebar-width: 260px;
            --accent: #6c63ff;
            --accent-soft: rgba(108, 99, 255, 0.12);
            --accent-glow: rgba(108, 99, 255, 0.25);
            --surface: #ffffff;
            --page-bg: #f5f6fa;
            --text-main: #1a1d2e;
            --text-muted: #7b7f96;
            --border: #e8eaf0;
            --nav-text: #a8adc0;
            --nav-hover: #ffffff;
            --success: #22c55e;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Kantumruy Pro', 'Segoe UI', sans-serif;
            background: var(--page-bg);
            color: var(--text-main);
            margin: 0;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-brand .brand-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .sidebar-brand .brand-name {
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.02em;
        }

        .sidebar-brand .brand-sub {
            font-size: 11px;
            color: var(--nav-text);
            margin-top: 2px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 10px;
            color: rgba(168,173,192,0.5);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 8px 12px 6px;
            margin-top: 4px;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--nav-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }

        .nav-item-link i {
            font-size: 15px;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-item-link:hover {
            background: rgba(255,255,255,0.06);
            color: var(--nav-hover);
        }

        .nav-item-link.active {
            background: var(--accent-soft);
            color: #fff;
            font-weight: 500;
            box-shadow: inset 3px 0 0 var(--accent);
        }

        .nav-item-link.active i {
            color: var(--accent);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-footer .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            background: rgba(239,68,68,0.1);
            border: none;
            border-radius: 8px;
            color: #fca5a5;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.15s;
        }

        .sidebar-footer .logout-btn:hover {
            background: rgba(239,68,68,0.2);
        }

        /* ── Main ── */
        .main-wrap {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 34px; height: 34px;
            background: var(--accent-soft);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-main);
        }

        .page-content {
            flex: 1;
            padding: 28px 32px;
        }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--border) !important;
            border-radius: 14px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
        }

        .card-header {
            border-bottom: 1px solid var(--border) !important;
            border-radius: 14px 14px 0 0 !important;
            padding: 18px 24px !important;
        }

        /* ── Alert ── */
        .alert-success {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: 10px;
            color: #15803d;
            padding: 12px 16px;
            font-size: 14px;
        }

        /* ── Forms ── */
        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Kantumruy Pro', sans-serif;
            padding: 9px 12px;
            color: var(--text-main);
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
            outline: none;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        /* ── Buttons ── */
        .btn {
            font-family: 'Kantumruy Pro', sans-serif;
            font-weight: 500;
            border-radius: 8px;
            font-size: 14px;
            padding: 9px 18px;
            transition: all 0.15s;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .btn-primary:hover { background: #5a52d5; border-color: #5a52d5; }

        .btn-success {
            background: #22c55e;
            border-color: #22c55e;
            color: #fff;
        }
        .btn-success:hover { background: #16a34a; border-color: #16a34a; }

        .btn-warning {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #fff;
        }
        .btn-warning:hover { background: #d97706; border-color: #d97706; color: #fff; }

        .btn-info {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: #fff;
        }
        .btn-info:hover { background: #0284c7; border-color: #0284c7; color: #fff; }

        .btn-light {
            background: var(--page-bg);
            border: 1px solid var(--border);
            color: var(--text-main);
        }
        .btn-light:hover { background: var(--border); }

        .btn-outline-warning { color: #d97706; border-color: #f59e0b; }
        .btn-outline-warning:hover { background: #fef3c7; color: #92400e; border-color: #f59e0b; }

        .btn-outline-danger { color: #dc2626; border-color: #fca5a5; }
        .btn-outline-danger:hover { background: #fef2f2; color: #991b1b; }

        .btn-outline-info { color: #0284c7; border-color: #7dd3fc; }
        .btn-outline-info:hover { background: #f0f9ff; }

        /* ── Table ── */
        .table { font-size: 14px; }
        .table th { font-weight: 600; font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.04em; }
        .table-light { background: #fafbfc; }
        .table > :not(caption) > * > * { padding: 14px 16px; }

        /* ── Stat Cards ── */
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 24px;
        }

        .stat-card .stat-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .stat-card .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
        }

        .stat-card .stat-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center">
            <div class="brand-icon">
                <i class="fa-solid fa-book-open" style="color:#fff; font-size:15px;"></i>
            </div>
            <div>
                <div class="brand-name">R-BookStore</div>
                <div class="brand-sub">Management System</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">ការគ្រប់គ្រង</div>

        <a href="{{ route('books.ui') }}" class="nav-item-link {{ Route::is('books.ui') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>បញ្ជីសៀវភៅ</span>
        </a>
        @if(Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('books.ui.create') }}" class="nav-item-link {{ Route::is('books.ui.create') ? 'active' : '' }}">
                <i class="fa-solid fa-plus"></i>
                <span>បន្ថែមសៀវភៅ</span>
            </a>
        @endif

        {{-- 🌟 ប្រើប្រាស់ @if ឆែកបង្ហាញ Menu ទាំងនេះសម្រាប់តែគណនី Admin ប៉ុណ្ណោះ --}}
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="nav-label" style="margin-top:12px;">ប្រភេទ & អ្នកនិពន្ធ (សម្រាប់ Admin)</div>

            <a href="{{ route('categories.ui.create') }}" class="nav-item-link {{ Route::is('categories.ui.create') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i>
                <span>បង្កើត Category</span>
            </a>

            <a href="{{ route('authors.ui.create') }}" class="nav-item-link {{ Route::is('authors.ui.create') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-nib"></i>
                <span>បន្ថែមអ្នកនិពន្ធ</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" class="btn btn-link text-danger text-decoration-none d-flex align-items-center gap-2 w-100 px-3 py-2" data-bs-toggle="modal" data-bs-target="#adminLogoutModal">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>ចាកចេញ</span>
            </button>
        </form>
    </div>
</div>

<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-title">ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ</div>
        <div class="topbar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
    </header>

    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<div class="modal fade" id="adminLogoutModal" tabindex="-1" aria-labelledby="adminLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 380px;">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); padding: 24px; background: #fff;">
            <div class="modal-body text-center p-0">
                <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; border: 6px solid #fff; outline: 1px solid #fecaca; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <i class="fa-solid fa-right-from-bracket" style="color: #dc2626; font-size: 18px;"></i>
                </div>

                <h5 class="fw-bold text-dark mb-2" style="font-size: 18px; font-family: 'Kantumruy Pro', sans-serif;">ចាកចេញពីប្រព័ន្ធរដ្ឋបាល?</h5>
                <p class="text-muted small mb-4" style="font-family: 'Kantumruy Pro', sans-serif;">តើអ្នកពិតជាចង់ចាកចេញពីគណនី Admin <strong class="text-dark">"{{ Auth::check() ? Auth::user()->name : '' }}"</strong> មែនទេ?</p>

                <div class="d-flex gap-2 justify-content-between">
                    <button type="button" class="btn btn-light grow py-2 fw-semibold" data-bs-dismiss="modal" style="border-radius: 10px; font-size: 14px; font-family: 'Kantumruy Pro', sans-serif;">
                        បោះបង់
                    </button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="grow">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold" style="border-radius: 10px; font-size: 14px; background: #dc2626; font-family: 'Kantumruy Pro', sans-serif;">
                            យល់ព្រម
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>