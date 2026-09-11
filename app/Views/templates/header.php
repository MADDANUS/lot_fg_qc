<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Form Print QR Code Label' ?></title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Global App CSS (cache-busted) -->
    <link href="<?= base_url('assets/css/app.css') ?>?v=<?= time() ?>" rel="stylesheet">
</head>

<!-- body background set inline to bypass any Bootstrap override -->
<body style="background-color: #e8ecf2 !important; margin: 0; padding: 0;">

<!-- ── App Navbar ──────────────────────────────────────────────────────── -->
<nav style="
    height: 52px;
    background: #12192b;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    font-family: 'Inter', sans-serif;
">
    <a href="<?= base_url('print-form') ?>" style="
        display: flex; align-items: center; gap: 10px;
        text-decoration: none; color: #f1f5f9;
        font-size: 14px; font-weight: 700; letter-spacing: -0.2px;
    ">
        <span style="
            width: 28px; height: 28px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            box-shadow: 0 2px 6px rgba(99,102,241,0.4);
            flex-shrink: 0;
        ">🏷️</span>
        <span style="white-space:nowrap;">Lot FG Label System</span>
    </a>

    <div style="display:flex; align-items:center; gap:4px; flex-wrap: nowrap;">
        <a href="<?= base_url('print-form') ?>" class="nav-pill">
            <i class="bi bi-printer"></i>
            <span class="pill-text">Form Print</span>
        </a>
        <a href="<?= base_url('master') ?>" class="nav-pill">
            <i class="bi bi-database"></i>
            <span class="pill-text">Master Data</span>
        </a>
        <a href="<?= base_url('omron') ?>" class="nav-pill nav-pill-amber">
            🔖 <span class="pill-text">History Omron</span>
        </a>
        <a href="<?= base_url('mitsuba') ?>" class="nav-pill nav-pill-green">
            🔖 <span class="pill-text">History Mitsuba</span>
        </a>
    </div>
</nav>

<style>
.nav-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px;
    font-family: 'Inter', sans-serif;
    font-size: 12.5px; font-weight: 500;
    color: #94a3b8;
    text-decoration: none;
    border-radius: 6px;
    border: 1px solid transparent;
    transition: all 0.15s;
    white-space: nowrap;
}
.nav-pill:hover { color: #e2e8f0; background: rgba(255,255,255,0.08); text-decoration: none; }
.nav-pill-amber { color: #fbbf24; background: rgba(251,191,36,0.1); border-color: rgba(251,191,36,0.2); }
.nav-pill-amber:hover { color: #fef3c7; background: rgba(251,191,36,0.18); }
.nav-pill-green { color: #34d399; background: rgba(52,211,153,0.1); border-color: rgba(52,211,153,0.2); }
.nav-pill-green:hover { color: #d1fae5; background: rgba(52,211,153,0.18); }
</style>

<!-- page content goes here, NO wrapper div so each page controls its own layout -->
