<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login — Lot FG Label System' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0; padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.12;
            animation: blobPulse 8s ease-in-out infinite alternate;
        }
        .bg-blob-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #3b82f6, transparent);
            top: -150px; left: -100px;
        }
        .bg-blob-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #6366f1, transparent);
            bottom: -100px; right: -80px;
            animation-delay: 3s;
        }
        .bg-blob-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, #06b6d4, transparent);
            top: 40%; left: 60%;
            animation-delay: 6s;
        }
        @keyframes blobPulse {
            0%   { transform: scale(1) translateY(0); }
            100% { transform: scale(1.15) translateY(-20px); }
        }

        /* Grid lines decoration */
        .bg-grid {
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        /* Login card */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(99,102,241,0.15);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow:
                0 0 0 1px rgba(99,102,241,0.08),
                0 25px 60px rgba(99,102,241,0.12),
                0 4px 20px rgba(0,0,0,0.08);
            animation: cardIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 16px rgba(99,102,241,0.4);
            flex-shrink: 0;
        }
        .brand-text h1 {
            font-size: 16px;
            font-weight: 700;
            color: #1a2332;
            letter-spacing: -0.3px;
            margin: 0;
        }
        .brand-text p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: rgba(99,102,241,0.12);
            margin-bottom: 28px;
        }

        /* Alert */
        .alert {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-error {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.2);
            color: #dc2626;
        }
        .alert-success {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.2);
            color: #16a34a;
        }

        /* Form */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.15s;
        }
        .form-control {
            width: 100%;
            background: #f8faff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px 11px 40px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1a2332;
            transition: all 0.2s;
            outline: none;
        }
        .form-control::placeholder { color: #b0bec5; }
        .form-control:focus {
            border-color: rgba(99,102,241,0.5);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }
        .form-control:focus + .input-icon,
        .input-wrap:focus-within .input-icon { color: #6366f1; }

        /* Password toggle */
        .toggle-pass {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 15px;
            padding: 2px;
            transition: color 0.15s;
        }
        .toggle-pass:hover { color: #6366f1; }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(99,102,241,0.3);
            margin-top: 8px;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.45);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login.loading { opacity: 0.75; pointer-events: none; }

        /* Footer */
        .login-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 11.5px;
            color: #94a3b8;
        }

        /* Shimmer on button */
        .btn-login::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
            transition: left 0.4s;
        }
        .btn-login:hover::after { left: 140%; }
    </style>
</head>
<body>
    <!-- Matrix code rain canvas -->
    <canvas id="codeCanvas" style="position:fixed;inset:0;z-index:0;opacity:0.35;"></canvas>
    <!-- Subtle light overlay on top of canvas -->
    <div style="position:fixed;inset:0;z-index:1;background:radial-gradient(ellipse at center, rgba(240,244,255,0.4) 0%, rgba(240,244,255,0.75) 100%);pointer-events:none;"></div>

    <div class="login-card">
        <!-- Brand -->
        <div class="brand">
            <div class="brand-icon">🏷️</div>
            <div class="brand-text">
                <h1>LOT FINISHED GOOD</h1>
                <p>PT. NIHON SEIKI INDONESIA</p>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Alert -->
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <!-- Form -->
        <form id="loginForm" action="<?= base_url('login') ?>" method="POST">

            <div class="form-group">
                <label class="form-label" for="username">USERNAME</label>
                <div class="input-wrap">
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username..."
                        value="<?= old('username') ?>"
                        autocomplete="username"
                        autofocus
                        required
                    >
                    <i class="bi bi-person input-icon" style="left:13px;"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">PASSWORD</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password..."
                        autocomplete="current-password"
                        required
                    >
                    <i class="bi bi-lock input-icon" style="left:13px;"></i>
                    <button type="button" class="toggle-pass" id="togglePass" title="Tampilkan/Sembunyikan">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login" id="btnLogin">
                <i class="bi bi-box-arrow-in-right"></i>
                &nbsp; Masuk ke Sistem
            </button>
        </form>

        <div class="login-footer">
            &copy; <?= date('Y') ?> PT. Nihon Seiki Indonesia &mdash; v1.0
        </div>
    </div>

    <script>
        // ── Matrix Code Rain with Cursor Repulsion ────────────────────────────
        (function() {
            const canvas = document.getElementById('codeCanvas');
            const ctx    = canvas.getContext('2d');

            const chars    = '01';
            const fontSize = 30;
            const REPEL_RADIUS = 200;  // radius pengaruh kursor (px)
            const REPEL_FORCE  = 50;  // kekuatan dorong
            let cols, drops, offsets; // offsets = horizontal displacement per column

            // Track mouse position
            let mouseX = -9999, mouseY = -9999;
            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });
            document.addEventListener('mouseleave', function() {
                mouseX = -9999;
                mouseY = -9999;
            });

            function resize() {
                canvas.width  = window.innerWidth;
                canvas.height = window.innerHeight;
                cols    = Math.floor(canvas.width / fontSize);
                // Spread drops randomly across the full screen height from the start
                // so every column is already mid-stream — no waiting for drops to start
                drops   = Array(cols).fill(0).map(() => Math.random() * (canvas.height / fontSize));
                offsets = Array(cols).fill(0);
            }

            const colors = [
                '#1e3a8a', '#3730a3', '#4338ca', '#1d4ed8',
                '#0369a1', '#0e7490', '#065f46', '#6366f1',
            ];

            function draw() {
                // Fade trail — lower = longer trail (light bg)
                ctx.fillStyle = 'rgba(240, 244, 255, 0.06)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.font = fontSize + 'px "Courier New", monospace';

                for (let i = 0; i < drops.length; i++) {
                    const baseX = i * fontSize;
                    const y     = drops[i] * fontSize;

                    // ── Cursor repulsion calculation ──
                    const dx   = baseX - mouseX;
                    const dy   = y - mouseY;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < REPEL_RADIUS && dist > 0) {
                        // Smooth falloff: stronger when closer
                        const force = (1 - dist / REPEL_RADIUS) * REPEL_FORCE;
                        offsets[i] += (dx / dist) * force;
                    }

                    // Smoothly return offset to 0 (spring back)
                    offsets[i] *= 0.88;

                    const x = baseX + offsets[i];

                    const char  = chars[Math.floor(Math.random() * chars.length)];
                    const color = colors[Math.floor(Math.random() * colors.length)];

                    // Head character — dark on light bg
                    if (y > 0) {
                        // Glow effect near cursor
                        if (dist < REPEL_RADIUS) {
                            ctx.fillStyle = 'rgba(30, 58, 138, 1)';
                            ctx.shadowColor = '#6366f1';
                            ctx.shadowBlur = 8;
                        } else {
                            ctx.fillStyle = 'rgba(30, 58, 138, 0.85)';
                            ctx.shadowBlur = 0;
                        }
                        ctx.fillText(char, x, y);
                        ctx.shadowBlur = 0;

                        // Trailing char slightly dimmer
                        ctx.fillStyle = color;
                        ctx.fillText(
                            chars[Math.floor(Math.random() * chars.length)],
                            x, y - fontSize
                        );
                    }

                    // Reset drop immediately — no random delay — for continuous flow
                    if (y > canvas.height) {
                        drops[i] = 0;
                    }
                    drops[i] += 0.2 + Math.random() * 0.1;
                }
            }

            resize();
            window.addEventListener('resize', resize);
            setInterval(draw, 80);
        })();

        // ── Toggle password visibility ─────────────────────────────────────
        document.getElementById('togglePass').addEventListener('click', function () {
            const pwd  = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                pwd.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });

        // ── Loading state on submit ────────────────────────────────────────
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="bi bi-arrow-clockwise" style="animation:spin 0.8s linear infinite;display:inline-block;"></i> &nbsp;Memproses...';
        });
    </script>
    <style>
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
</body>
</html>
