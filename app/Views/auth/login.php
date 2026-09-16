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
        // ── Static Background Grid with Cursor Repulsion ─────────────────────────
        (function() {
            const canvas = document.getElementById('codeCanvas');
            const ctx    = canvas.getContext('2d');

            const chars    = '01';
            const fontSize = 28;
            const REPEL_RADIUS = 30;  // radius pengaruh kursor (px)
            const REPEL_FORCE  = 30;   // kekuatan dorong
            let cols, rows, grid;
            let time = 0; // Waktu/offset untuk efek scrolling
            let snakes = []; // Ular yang memakan angka
            let dragons = []; // Naga raksasa

            let currentFormIdx = 0;
            const formations = ['grid', 'triangle', 'box', 'star'];

            function pointInPolygon(point, vs) {
                let x = point[0], y = point[1];
                let inside = false;
                for (let i = 0, j = vs.length - 1; i < vs.length; j = i++) {
                    let xi = vs[i][0], yi = vs[i][1];
                    let xj = vs[j][0], yj = vs[j][1];
                    let intersect = ((yi > y) != (yj > y)) && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                    if (intersect) inside = !inside;
                }
                return inside;
            }

            function getPolygon(form, cx, cy, R) {
                let vs = [];
                if (form === 'triangle') {
                    vs = [ [cx, cy - R], [cx + R, cy + R*0.8], [cx - R, cy + R*0.8] ];
                } else if (form === 'box') {
                    vs = [ [cx - R, cy - R], [cx + R, cy - R], [cx + R, cy + R], [cx - R, cy + R] ];
                } else if (form === 'star') {
                    for(let i = 0; i < 10; i++) {
                        let r = (i % 2 === 0) ? R : R * 0.4;
                        let a = (i * Math.PI / 5) - Math.PI / 2;
                        vs.push([cx + r * Math.cos(a), cy + r * Math.sin(a)]);
                    }
                }
                return vs;
            }

            function changeFormation() {
                if (!grid) return;
                currentFormIdx = (currentFormIdx + 1) % formations.length;
                const form = formations[currentFormIdx];
                let N = cols * rows; 
                
                if (form === 'grid') {
                    for (let x = 0; x < cols; x++) {
                        for (let y = 0; y < rows; y++) {
                            grid[x][y].baseX = grid[x][y].origBaseX;
                            grid[x][y].baseY = grid[x][y].origBaseY;
                        }
                    }
                    return;
                }

                let R = 75; // Ukuran setiap bentuk
                let spacing = 220; // Jarak antar bentuk (berjejer)
                let shapes = [];
                
                for (let cx = spacing/2; cx < canvas.width + spacing; cx += spacing) {
                    for (let cy = spacing/2; cy < canvas.height + spacing; cy += spacing) {
                        shapes.push(getPolygon(form, cx, cy, R));
                    }
                }

                let tempSlots = [];
                // Estimasi kepadatan titik agar pas
                let d = (R * 2) / Math.sqrt((N * 1.5) / shapes.length); 
                if (d < 5) d = 5;

                shapes.forEach(vs => {
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {
                        if (v[0] < minX) minX = v[0];
                        if (v[0] > maxX) maxX = v[0];
                        if (v[1] < minY) minY = v[1];
                        if (v[1] > maxY) maxY = v[1];
                    });
                    
                    for (let yy = minY; yy <= maxY; yy += d) {
                        for (let xx = minX; xx <= maxX; xx += d) {
                            if (pointInPolygon([xx, yy], vs)) tempSlots.push({x: xx, y: yy});
                        }
                    }
                });

                // Jika kurang, tambahkan random point ke shape secara acak
                while (tempSlots.length < N) {
                    let vs = shapes[Math.floor(Math.random() * shapes.length)];
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {
                        if (v[0] < minX) minX = v[0];
                        if (v[0] > maxX) maxX = v[0];
                        if (v[1] < minY) minY = v[1];
                        if (v[1] > maxY) maxY = v[1];
                    });
                    let xx = minX + Math.random() * (maxX - minX);
                    let yy = minY + Math.random() * (maxY - minY);
                    if (pointInPolygon([xx, yy], vs)) tempSlots.push({x: xx, y: yy});
                }
                
                for (let i = tempSlots.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    [tempSlots[i], tempSlots[j]] = [tempSlots[j], tempSlots[i]];
                }

                let slotIndex = 0;
                for (let x = 0; x < cols; x++) {
                    for (let y = 0; y < rows; y++) {
                        grid[x][y].baseX = tempSlots[slotIndex].x;
                        grid[x][y].baseY = tempSlots[slotIndex].y;
                        slotIndex++;
                    }
                }
            }

            let mouseX = -9999, mouseY = -9999;
            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });
            document.addEventListener('mouseleave', function() {
                mouseX = -9999;
                mouseY = -9999;
            });

            // Mencegah context menu klik kanan
            window.addEventListener('contextmenu', function(e) { e.preventDefault(); });

            // Ledakan & Formasi saat klik pada background (canvas)
            canvas.addEventListener('mousedown', function(e) {
                if (!grid) return;
                const explosionForce = 1200; // Kekuatan ledakan
                for (let x = 0; x < cols; x++) {
                    for (let y = 0; y < rows; y++) {
                        grid[x][y].vx = (Math.random() - 0.5) * explosionForce;
                        grid[x][y].vy = (Math.random() - 0.5) * explosionForce;
                    }
                }
                changeFormation();
            });


            // Warna yang lebih jelas untuk background (tidak terlalu transparan)
            const colors = [
                'rgba(1, 6, 20, 1)', 'rgba(3, 1, 22, 1)', 
                'rgba(4, 2, 26, 1)', 'rgba(2, 7, 22, 1)'
            ];

            function resize() {
                canvas.width  = window.innerWidth;
                canvas.height = window.innerHeight;
                cols = Math.ceil(canvas.width / fontSize);
                // Tambahkan 2 baris ekstra agar saat di-scroll dan wrap tidak terlihat kosong di ujung
                rows = Math.ceil(canvas.height / fontSize) + 2;
                
                currentFormIdx = 0;
                grid = [];
                for (let x = 0; x < cols; x++) {
                    grid[x] = [];
                    for (let y = 0; y < rows; y++) {
                        grid[x][y] = {
                            char: chars[Math.floor(Math.random() * chars.length)],
                            color: colors[Math.floor(Math.random() * colors.length)],
                            baseX: x * fontSize + (fontSize/2),
                            baseY: y * fontSize + (fontSize/2),
                            origBaseX: x * fontSize + (fontSize/2),
                            origBaseY: y * fontSize + (fontSize/2),
                            offsetX: 0,
                            offsetY: 0,
                            vx: 0,
                            vy: 0,
                            hidden: 0 // Timer angka hilang karena dimakan
                        };
                    }
                }

                // Inisialisasi Ular (3 ekor)
                snakes = [];
                for(let i = 0; i < 3; i++) {
                    snakes.push({
                        segments: [],
                        length: 20 + Math.random() * 30,
                        speed: 3 + Math.random() * 2,
                        angle: Math.random() * Math.PI * 2,
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height
                    });
                }

                // Inisialisasi Naga (1 ekor raksasa)
                dragons = [];
                for(let i = 0; i < 1; i++) {
                    dragons.push({
                        segments: [],
                        length: 60 + Math.random() * 20, // Lebih panjang
                        speed: 4 + Math.random() * 1.5, // Sedikit lebih cepat
                        angle: Math.random() * Math.PI * 2,
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height,
                        wingPhase: Math.random() * Math.PI * 2
                    });
                }
            }

            function draw() {
                // Bersihkan canvas
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.font = (fontSize - 6) + 'px "Courier New", monospace';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                
                time += 0.5; // Kecepatan gerak scrolling

                for (let x = 0; x < cols; x++) {
                    // Kolom genap ke atas (-1), ganjil ke bawah (1)
                    const direction = (x % 2 === 0) ? -1 : 1;
                    const scrollOffset = (currentFormIdx === 0) ? (time * direction) : 0;
                    const gridHeight = rows * fontSize;

                    for (let y = 0; y < rows; y++) {
                        const cell = grid[x][y];
                        
                        // Kalkulasi pergeseran ke atas/bawah
                        let currentBaseY = cell.baseY + scrollOffset;
                        
                        // Infinite wrap-around (gulungan tak berujung)
                        if (currentFormIdx === 0) {
                            currentBaseY = ((currentBaseY + fontSize) % gridHeight + gridHeight) % gridHeight - fontSize;
                        }
                        
                        const dx = cell.baseX - mouseX;
                        const dy = currentBaseY - mouseY;
                        const dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < REPEL_RADIUS && dist > 0) {
                            // Menghindar dari kursor (menambah kecepatan)
                            const force = Math.pow(1 - dist / REPEL_RADIUS, 2) * REPEL_FORCE;
                            cell.vx += (dx / dist) * force;
                            cell.vy += (dy / dist) * force;
                            
                            // Highlight warna saat dekat kursor
                            ctx.fillStyle = 'rgba(30, 58, 138, 0.6)';
                        } else {
                            ctx.fillStyle = cell.color;
                        }

                        // Fisika Pegas (Spring & Friction) untuk efek Slow-Mo
                        const spring = 0.003;   // Tarikan kembali sangat lemah (lambat)
                        const friction = 0.92;  // Gesekan rendah agar melayang lebih lama

                        // Tarik perlahan ke posisi awal (0 offset)
                        cell.vx -= cell.offsetX * spring;
                        cell.vy -= cell.offsetY * spring;

                        // Terapkan gesekan
                        cell.vx *= friction;
                        cell.vy *= friction;
                        
                        // Update posisi offset lenturan
                        cell.offsetX += cell.vx;
                        cell.offsetY += cell.vy;

                        const realX = cell.baseX + cell.offsetX;
                        const realY = currentBaseY + cell.offsetY;

                        // Deteksi interaksi dimakan ular
                        for (let s of snakes) {
                            if (s.segments.length === 0) continue;
                            const head = s.segments[s.segments.length - 1];
                            const d = Math.hypot(realX - head.x, realY - head.y);
                            if (d < 25) { // Radius gigitan ular
                                cell.hidden = 150 + Math.random() * 150; 
                                if (s.length < 150) s.length += 0.3; 
                                break;
                            }
                        }

                        // Deteksi interaksi dimakan naga
                        for (let d of dragons) {
                            if (d.segments.length === 0) continue;
                            const head = d.segments[d.segments.length - 1];
                            const dist = Math.hypot(realX - head.x, realY - head.y);
                            if (dist < 45) { // Radius gigitan naga (jauh lebih besar)
                                cell.hidden = 250 + Math.random() * 200; // Hilang lebih lama
                                if (d.length < 250) d.length += 0.5; // Naga memanjang
                                break;
                            }
                        }

                        // Jika dimakan, lewati proses render karakter
                        if (cell.hidden > 0) {
                            cell.hidden--;
                            continue;
                        }

                        // Ubah karakter secara acak sesekali agar terlihat hidup
                        if (Math.random() < 0.005) {
                            cell.char = chars[Math.floor(Math.random() * chars.length)];
                        }

                        // Gambar teks di posisi dasar + scroll + efek lenturan
                        ctx.fillText(cell.char, realX, realY);
                    }
                }

                // --- UPDATE & RENDER ULAR ---
                ctx.lineWidth = 4;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                
                for (let s of snakes) {
                    // Ular berbelok acak
                    s.angle += (Math.random() - 0.5) * 0.4;
                    s.x += Math.cos(s.angle) * s.speed;
                    s.y += Math.sin(s.angle) * s.speed;
                    
                    // Wrapping ular di pinggir layar
                    if (s.x < 0) s.x += canvas.width;
                    if (s.x > canvas.width) s.x -= canvas.width;
                    if (s.y < 0) s.y += canvas.height;
                    if (s.y > canvas.height) s.y -= canvas.height;
                    
                    s.segments.push({x: s.x, y: s.y});
                    if (s.segments.length > s.length) {
                        s.segments.shift(); // Hapus ekor
                    }
                    
                    // --- RENDER CYBER SNAKE ---
                    if (s.segments.length < 2) continue;
                    
                    // Tulang Punggung (Spine) tipis dan transparan
                    ctx.beginPath();
                    for (let i = 0; i < s.segments.length; i++) {
                        const pt = s.segments[i];
                        if (i === 0) {
                            ctx.moveTo(pt.x, pt.y);
                        } else {
                            const prev = s.segments[i-1];
                            if (Math.hypot(pt.x - prev.x, pt.y - prev.y) > 100) {
                                ctx.moveTo(pt.x, pt.y);
                            } else {
                                ctx.lineTo(pt.x, pt.y);
                            }
                        }
                    }
                    ctx.strokeStyle = 'rgba(16, 185, 129, 0.2)';
                    ctx.lineWidth = 1;
                    ctx.stroke();

                    // Sisik/Segmen Cyber
                    for (let i = 0; i < s.segments.length; i++) {
                        const pt = s.segments[i];
                        const ratio = i / s.segments.length; // 0 = ekor, 1 = kepala
                        
                        // Cegah bug gambar pada garis potong warp layar
                        if (i > 0 && Math.hypot(pt.x - s.segments[i-1].x, pt.y - s.segments[i-1].y) > 100) continue;

                        if (i === s.segments.length - 1) {
                            // --- KEPALA SCI-FI ---
                            ctx.save();
                            ctx.translate(pt.x, pt.y);
                            ctx.rotate(s.angle); // Arah pandang ular
                            
                            // Bentuk mirip pesawat tempur futuristik
                            ctx.beginPath();
                            ctx.moveTo(12, 0);   // Moncong depan
                            ctx.lineTo(-8, -8);  // Sayap kiri
                            ctx.lineTo(-4, 0);   // Bagian belakang
                            ctx.lineTo(-8, 8);   // Sayap kanan
                            ctx.closePath();
                            
                            ctx.fillStyle = '#10b981'; // Emerald 500
                            ctx.shadowColor = '#10b981';
                            ctx.shadowBlur = 15;
                            ctx.fill();
                            
                            // Mata Laser Cybernetic
                            ctx.beginPath();
                            ctx.arc(4, 0, 2.5, 0, Math.PI*2);
                            ctx.fillStyle = '#fff';
                            ctx.shadowColor = '#fff';
                            ctx.shadowBlur = 8;
                            ctx.fill();
                            
                            ctx.restore();
                        } else {
                            // --- BADAN CYBER ---
                            // Gambar sisik selang-seling agar bertekstur
                            if (i % 2 !== 0) continue;

                            const size = 1.5 + (ratio * 4.5); // Membesar dari ekor ke leher
                            
                            ctx.save();
                            ctx.translate(pt.x, pt.y);
                            ctx.rotate(Math.PI / 4); // Putar 45 derajat -> diamond
                            
                            ctx.beginPath();
                            ctx.rect(-size/2, -size/2, size, size);
                            
                            // Opasitas berkurang semakin ke ujung ekor
                            ctx.fillStyle = `rgba(16, 185, 129, ${ratio})`;
                            ctx.fill();
                            
                            ctx.restore();
                        }
                    }
                }

                // --- UPDATE & RENDER NAGA (DRAGON) ---
                for (let d of dragons) {
                    // Naga berbelok acak
                    d.angle += (Math.random() - 0.5) * 0.3;
                    d.x += Math.cos(d.angle) * d.speed;
                    d.y += Math.sin(d.angle) * d.speed;
                    d.wingPhase += 0.25; // Kecepatan kepak sayap
                    
                    // Wrapping layar
                    if (d.x < 0) d.x += canvas.width;
                    if (d.x > canvas.width) d.x -= canvas.width;
                    if (d.y < 0) d.y += canvas.height;
                    if (d.y > canvas.height) d.y -= canvas.height;
                    
                    d.segments.push({x: d.x, y: d.y});
                    if (d.segments.length > d.length) d.segments.shift();
                    
                    if (d.segments.length < 2) continue;

                    // Tulang Punggung Naga
                    ctx.beginPath();
                    for (let i = 0; i < d.segments.length; i++) {
                        const pt = d.segments[i];
                        if (i === 0) {
                            ctx.moveTo(pt.x, pt.y);
                        } else {
                            const prev = d.segments[i-1];
                            if (Math.hypot(pt.x - prev.x, pt.y - prev.y) > 100) {
                                ctx.moveTo(pt.x, pt.y);
                            } else {
                                ctx.lineTo(pt.x, pt.y);
                            }
                        }
                    }
                    ctx.strokeStyle = 'rgba(239, 68, 68, 0.3)'; // Merah transparan
                    ctx.lineWidth = 3;
                    ctx.stroke();

                    // Segmen Tubuh Naga
                    for (let i = 0; i < d.segments.length; i++) {
                        const pt = d.segments[i];
                        const ratio = i / d.segments.length;
                        
                        if (i > 0 && Math.hypot(pt.x - d.segments[i-1].x, pt.y - d.segments[i-1].y) > 100) continue;

                        if (i === d.segments.length - 1) {
                            // --- KEPALA NAGA ---
                            ctx.save();
                            ctx.translate(pt.x, pt.y);
                            ctx.rotate(d.angle);
                            
                            // Kepala bertanduk lebar
                            ctx.beginPath();
                            ctx.moveTo(18, 0);   // Moncong depan
                            ctx.lineTo(0, -10);  // Rahang kiri
                            ctx.lineTo(-6, -18); // Tanduk kiri luar
                            ctx.lineTo(-2, -4);  // Pangkal tanduk kiri
                            ctx.lineTo(-8, 0);   // Leher/belakang
                            ctx.lineTo(-2, 4);   // Pangkal tanduk kanan
                            ctx.lineTo(-6, 18);  // Tanduk kanan luar
                            ctx.lineTo(0, 10);   // Rahang kanan
                            ctx.closePath();
                            
                            ctx.fillStyle = '#ef4444'; // Merah Api (Red-500)
                            ctx.shadowColor = '#ef4444';
                            ctx.shadowBlur = 25;
                            ctx.fill();
                            
                            // Dua Mata Api
                            ctx.beginPath();
                            ctx.arc(4, -5, 2.5, 0, Math.PI*2); // Mata Kiri
                            ctx.arc(4, 5, 2.5, 0, Math.PI*2);  // Mata Kanan
                            ctx.fillStyle = '#fef08a'; // Kuning menyala
                            ctx.shadowColor = '#fef08a';
                            ctx.shadowBlur = 10;
                            ctx.fill();
                            
                            ctx.restore();
                        } else {
                            // --- BADAN NAGA & SAYAP ---
                            if (i % 2 !== 0) continue; // Selang-seling
                            
                            const size = 3 + (ratio * 7); // Tubuh jauh lebih besar dari ular
                            
                            ctx.save();
                            ctx.translate(pt.x, pt.y);
                            ctx.rotate(Math.PI / 4);
                            
                            // Gambar Sayap (Hanya di sepertiga tubuh bagian depan/tengah)
                            if (ratio > 0.4 && ratio < 0.8 && i % 4 === 0) {
                                // Mengepak menggunakan sinus
                                const wingSpan = 15 + Math.sin(d.wingPhase) * 12;
                                ctx.beginPath();
                                ctx.moveTo(0, 0);
                                ctx.lineTo(-wingSpan, -wingSpan); // Sayap kiri atas
                                ctx.moveTo(0, 0);
                                ctx.lineTo(wingSpan, wingSpan); // Sayap kanan bawah
                                ctx.strokeStyle = `rgba(249, 115, 22, ${ratio})`; // Oranye menyala
                                ctx.lineWidth = 3;
                                ctx.stroke();
                            }

                            // Gambar Sisik Punggung
                            ctx.beginPath();
                            ctx.rect(-size/2, -size/2, size, size);
                            ctx.fillStyle = `rgba(239, 68, 68, ${ratio})`;
                            ctx.fill();
                            
                            ctx.restore();
                        }
                    }
                }
                
                requestAnimationFrame(draw);
            }

            resize();
            window.addEventListener('resize', resize);
            requestAnimationFrame(draw);
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
