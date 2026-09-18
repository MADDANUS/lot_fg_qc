<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Form Print QR Code Label' ?></title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Global App CSS (cache-busted) -->
    <link href="<?= base_url('assets/css/app.css') ?>?v=<?= time() ?>" rel="stylesheet">
    <!-- Stripe Theme -->
    <link href="<?= base_url('assets/css/glass.css') ?>?v=<?= time() ?>" rel="stylesheet">
</head>

<body style="margin: 0; padding: 0; position: relative;">
<div id="particles-js-inner"></div>
<?php 
$uri = uri_string();
$isPrintForm = (strpos($uri, 'print-form') !== false) || $uri === '' || $uri === '/';
$isMaster = strpos($uri, 'master') !== false;
$isOmron = strpos($uri, 'omron') !== false;
$isMitsuba = strpos($uri, 'mitsuba') !== false;
?>

<style>
#particles-js-inner {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
}

/* ── Canva Navbar Styles ── */
.canva-navbar {
    height: 60px;
    background: #ffffff;
    border-bottom: 1px solid #e0e4e8;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(14, 19, 24, 0.04);
}
.canva-nav-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #000000;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: -0.3px;
}
.canva-nav-brand:hover { color: #000000; text-decoration: none; }
.canva-brand-icon {
    width: 32px; height: 32px;
    background: #3b82f6;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
    color: white;
}
.canva-nav-links {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: nowrap;
}
.canva-nav-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    font-family: 'Inter', sans-serif;
    font-size: 13.5px;
    font-weight: 600;
    color: #000000;
    text-decoration: none;
    border-radius: 500px;
    border: none;
    transition: all 0.2s ease;
    white-space: nowrap;
}
.canva-nav-link:hover {
    background: #e2e8f0;
    color: #000000;
    text-decoration: none;
    transform: translateY(-1px);
}
.canva-nav-link.canva-active {
    background: #eff6ff;
    color: #3b82f6;
}
.canva-nav-link-logout {
    background: #dc2626 !important;
    color: #ffffff !important;
}
.canva-nav-link-logout:hover {
    background: #b91c1c !important;
    color: #ffffff !important;
}


.canva-divider {
    width: 2px;
    height: 24px;
    background: #e0e4e8;
    margin: 0 10px;
    flex-shrink: 0;
    border-radius: 2px;
}
.canva-user-pill {
    display: flex;
    align-items: center;
    gap: 10px;
}
.canva-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800;
    color: #fff;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(14,19,24,0.1);
}
.canva-user-name {
    font-size: 13.5px;
    font-weight: 700;
    color: #0e1318;
    white-space: nowrap;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.2;
}
.canva-user-role {
    font-size: 11px;
    color: #8a99a8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
</style>

<!-- ── Canva Navbar ── -->
<nav class="canva-navbar">
    <a href="<?= base_url('print-form') ?>" class="canva-nav-brand">
        <div class="canva-brand-icon">🏷️</div>
        <span>LOT FINISHED GOOD</span>
    </a>

    <div class="canva-nav-links">
        <a href="<?= base_url('print-form') ?>" class="canva-nav-link <?= $isPrintForm ? 'canva-active' : '' ?>">
            <i class="bi bi-printer"></i>
            <span>Form Print</span>
        </a>

        <?php if (session()->get('role') === 'admin'): ?>
        <a href="<?= base_url('master') ?>" class="canva-nav-link <?= $isMaster ? 'canva-active' : '' ?>">
            <i class="bi bi-database"></i>
            <span>Master Data</span>
        </a>
        <?php endif; ?>

        <a href="<?= base_url('omron') ?>" class="canva-nav-link <?= $isOmron ? 'canva-active' : '' ?>">
            <i class="bi bi-tags"></i> <span>Multi-Print Omron</span>
        </a>
        <a href="<?= base_url('mitsuba') ?>" class="canva-nav-link <?= $isMitsuba ? 'canva-active' : '' ?>">
            <i class="bi bi-tags"></i> <span>Multi-Print Mitsuba</span>
        </a>

        <div class="canva-divider"></div>

        <!-- User Info + Logout -->
        <div class="canva-user-pill">
            <div class="canva-avatar" style="background: <?= session()->get('role') === 'admin' ? '#3b82f6' : '#1b8755' ?>;">
                <?= strtoupper(substr(session()->get('username') ?? 'U', 0, 1)) ?>
            </div>
            <div style="line-height: 1.2;">
                <div class="canva-user-name">
                    <?= esc(session()->get('full_name') ?? session()->get('username') ?? 'User') ?>
                </div>
                <div class="canva-user-role">
                    <?= esc(session()->get('role') ?? 'user') ?>
                </div>
            </div>
            <a href="javascript:void(0)" onclick="confirmLogout()" class="canva-nav-link canva-nav-link-logout" title="Logout" style="padding: 6px 12px; margin-left: 4px; font-weight: 700;">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan keluar dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url('logout') ?>';
                    }
                });
            }
            </script>
        </div>
    </div>
</nav>

<!-- page content goes here -->
