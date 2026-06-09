<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>បង្កើតគណនីថ្មី — R-BookStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #6c63ff;
            --accent-soft: rgba(108,99,255,0.1);
            --accent-glow: rgba(108,99,255,0.2);
            --sidebar-bg: #0f1117;
            --border: #e8eaf0;
            --text-main: #1a1d2e;
            --text-muted: #7b7f96;
            --page-bg: #f5f6fa;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Kantumruy Pro', 'Segoe UI', sans-serif;
            background: var(--page-bg);
            min-height: 100vh;
            display: flex;
        }

        /* Left panel */
        .login-panel-left {
            width: 420px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: var(--accent);
            opacity: 0.06;
            top: -80px; left: -60px;
        }

        .login-panel-left::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: var(--accent);
            opacity: 0.05;
            bottom: -40px; right: -40px;
        }

        .brand-mark {
            width: 60px; height: 60px;
            background: var(--accent);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .brand-mark i { font-size: 26px; color: #fff; }

        .panel-title {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            text-align: center;
            margin-bottom: 8px;
        }

        .panel-sub {
            font-size: 13px;
            color: rgba(168,173,192,0.7);
            text-align: center;
            line-height: 1.6;
        }

        .panel-features {
            margin-top: 40px;
            width: 100%;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .feature-item:last-child { border-bottom: none; }

        .feature-icon {
            width: 34px; height: 34px;
            border-radius: 8px;
            background: rgba(108,99,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i { font-size: 14px; color: var(--accent); }

        .feature-text {
            font-size: 13px;
            color: rgba(168,173,192,0.8);
            line-height: 1.4;
        }

        /* Right panel / form */
        .login-panel-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }

        .login-form-wrap {
            width: 100%;
            max-width: 440px;
        }

        .form-eyebrow {
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
        }

        .form-heading {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-sub {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 36px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Kantumruy Pro', sans-serif;
            color: var(--text-main);
            background: #fff;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Kantumruy Pro', sans-serif;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.15s, transform 0.1s;
        }

        .submit-btn:hover { background: #5a52d5; }
        .submit-btn:active { transform: scale(0.99); }

        .alert-custom {
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-danger-custom {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.25);
            color: #dc2626;
        }

        @media (max-width: 680px) {
            .login-panel-left { display: none; }
        }
    </style>
</head>
<body>
    <div class="login-panel-left">
        <div class="brand-mark">
            <i class="fa-solid fa-book-open"></i>
        </div>
        <div class="panel-title">R-BookStore</div>
        <div class="panel-sub">ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ<br>ទំនើបសម្រាប់ជំនាន់ថ្មី</div>

        <div class="panel-features">
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="feature-text">គ្រប់គ្រងសៀវភៅទាំងអស់<br>នៅកន្លែងតែមួយ</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-tags"></i></div>
                <div class="feature-text">ចាត់ថ្នាក់ប្រភេទ<br>ដោយងាយស្រួល</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-pen-nib"></i></div>
                <div class="feature-text">ព័ត៌មានអ្នកនិពន្ធ<br>លម្អិតគ្រប់ជ្រុងជ្រោយ</div>
            </div>
        </div>
    </div>

    <div class="login-panel-right">
        <div class="login-form-wrap">
            <div class="form-eyebrow">User Registration</div>
            <h1 class="form-heading">ចុះឈ្មោះគណនី</h1>
            <p class="form-sub">បំពេញព័ត៌មានខាងក្រោមដើម្បីបង្កើតគណនីថ្មី</p>

            @if($errors->any())
                <div class="alert-custom alert-danger-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('register.perform') }}" method="POST">
                @csrf

                <div class="input-group-custom">
                    <label class="input-label">ឈ្មោះអ្នកប្រើប្រាស់</label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="text" name="name" class="form-input" placeholder="ឧទាហរណ៍៖ សុខា" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="input-group-custom">
                    <label class="input-label">អ៊ីមែលគណនី</label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-input" placeholder="example@gmail.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group-custom">
                            <label class="input-label">លេខសម្ងាត់</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group-custom">
                            <label class="input-label">បញ្ជាក់លេខសម្ងាត់</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-shield-halved input-icon"></i>
                                <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-user-plus me-2"></i>បង្កើតគណនី
                </button>

                <div class="text-center mt-4 small" style="color: var(--text-muted);">
                    មានគណនីរួចហើយមែនទេ? <a href="{{ route('login') }}" style="color: var(--accent); text-decoration: none; font-weight: 600;">ចូលប្រើប្រាស់នៅទីនេះ</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>