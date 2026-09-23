<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login — Lot FG Label System' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0; padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #3b82f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Subtle animated background elements to mimic Canva's playful style */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            pointer-events: none;
            animation: float 20s infinite alternate ease-in-out;
        }
        .bg-blob-1 {
            width: 600px; height: 600px;
            background: #1d4ed8;
            top: -200px; left: -150px;
        }
        .bg-blob-2 {
            width: 500px; height: 500px;
            background: #60a5fa;
            bottom: -150px; right: -100px;
            animation-delay: -10s;
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        /* Login card */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            margin: 20px;
            background: #ffffff;
            border-radius: 20px;
            padding: 48px 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.05);
            animation: cardIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 36px;
        }
        .brand-icon {
            width: 48px; height: 48px;
            background: #3b82f6;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(139,61,255,0.3);
            color: white;
        }
        .brand-text h1 {
            font-size: 17px;
            font-weight: 800;
            color: #0e1318;
            letter-spacing: -0.3px;
            margin: 0;
        }
        .brand-text p {
            font-size: 13px;
            color: #5e6d7d;
            font-weight: 500;
            margin: 4px 0 0;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: #e0e4e8;
            margin-bottom: 30px;
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-error {
            background: #fceae9;
            color: #e2293f;
        }
        .alert-success {
            background: #e8f5ed;
            color: #1b8755;
        }

        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #5e6d7d;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9baec8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.15s;
        }
        .form-control {
            width: 100%;
            background: #ffffff;
            border: 2px solid #e0e4e8;
            border-radius: 10px;
            padding: 12px 14px 12px 40px;
            font-size: 14.5px;
            font-family: 'Inter', sans-serif;
            color: #0e1318;
            font-weight: 500;
            transition: all 0.2s;
            outline: none;
        }
        .form-control::placeholder { color: #8a99a8; font-weight: 400; }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px #eff6ff;
        }
        .form-control:focus + .input-icon,
        .input-wrap:focus-within .input-icon { color: #3b82f6; }

        /* Password toggle */
        .toggle-pass {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8a99a8;
            cursor: pointer;
            font-size: 16px;
            padding: 2px;
            transition: color 0.2s;
        }
        .toggle-pass:hover { color: #3b82f6; }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #3b82f6;
            border: none;
            border-radius: 500px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(139,61,255,0.25);
            margin-top: 12px;
        }
        .btn-login:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(139,61,255,0.35);
        }
        .btn-login:active { transform: translateY(0) scale(0.98); }
        .btn-login.loading { opacity: 0.75; pointer-events: none; }

        /* Footer */
        .login-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 11.5px;
            color: #9baec8;
        }

        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 16px;
                padding: 32px 24px;
                border-radius: 16px;
            }
            .brand {
                flex-direction: column;
                text-align: center;
                gap: 8px;
                margin-bottom: 24px;
            }
            .brand-text h1 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <!-- Canva style gradient blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="login-card">
        <!-- Brand -->
        <div class="brand">
            <div class="brand-icon">🏷️</div>
            <div class="brand-text">
                <h1>LOT FINISH GOOD</h1>
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
                <label class="form-label" for="username">Username</label>
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
                    <i class="bi bi-person input-icon" style="left:12px;"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
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
                    <i class="bi bi-lock input-icon" style="left:12px;"></i>
                    <button type="button" class="toggle-pass" id="togglePass" title="Tampilkan/Sembunyikan">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login" id="btnLogin">
                <i class="bi bi-box-arrow-in-right"></i>
                &nbsp; Login
            </button>
        </form>

        <div class="login-footer">
            &copy; <?= date('Y') ?> PT. Nihon Seiki Indonesia &mdash; IT Department
        </div>
    </div>

    <script>
        // Toggle password visibility
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

        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="bi bi-arrow-clockwise" style="animation:spin 0.8s linear infinite;display:inline-block;"></i> &nbsp;Memproses...';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#ffffff" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.6, "random": false },
                "size": { "value": 5, "random": true },
                "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 },
                "move": { "enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": { "enable": true, "mode": "repel" },
                    "onclick": { "enable": true, "mode": "push" },
                    "resize": true
                },
                "modes": {
                    "repel": { "distance": 120, "duration": 0.4 },
                    "push": { "particles_nb": 4 }
                }
            },
            "retina_detect": true
        });

        // Batasi klik animasi maksimal 7 kali untuk mencegah crash
        let particleClickCount = 0;
        document.getElementById('particles-js').addEventListener('click', function(e) {
            particleClickCount++;
            if (particleClickCount > 20) {
                e.stopPropagation();
            }
        }, true);
    </script>
</body>
</html>
