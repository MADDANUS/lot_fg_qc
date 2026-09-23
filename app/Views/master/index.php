<?= $this->include('templates/header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<style>
/* ── Canva Master Data Tabs ── */
.master-tabs {
    border-bottom: none;
    gap: 8px;
    margin-bottom: 0;
}
.master-tabs .nav-link {
    border: none;
    border-radius: 500px;
    background: transparent;
    color: #000000;
    font-weight: 600;
    font-size: 13.5px;
    padding: 8px 16px;
    transition: all 0.2s ease;
}
.master-tabs .nav-link:hover {
    background: #e2e8f0;
    color: #000000;
}
.master-tabs .nav-link.active {
    background: #eff6ff;
    color: #3b82f6;
    box-shadow: none;
}

.tab-stripe-container {
    background: transparent;
    padding: 24px 0 0 0;
}

/* Table Wrapper */
.master-table-wrapper {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #e6ebf1;
    margin-top: 20px;
}
.master-table { margin-bottom: 0; }
.master-table thead th {
    background: #fafbfc;
    color: #6b7c93;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 0.6px;
    border-bottom: 1px solid #e6ebf1;
    border-top: none;
    padding: 12px 16px;
}
.master-table tbody td {
    padding: 13px 16px;
    vertical-align: middle;
    color: #1a1f36;
    font-size: 13.5px;
    border-bottom: 1px solid #f1f5f9;
}
.master-table tbody tr:last-child td { border-bottom: none; }
.master-table tbody tr:hover td { background: #f8f9fc; }



/* ── Header area with button ── */
.tab-header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}
.tab-header-title {
    font-size: 14px;
    font-weight: 600;
    color: #1a1f36;
    margin: 0;
}
.canva-btn-add {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    padding: 0 18px;
    border: none;
    border-radius: 500px;
    background: linear-gradient(135deg, #3b82f6 0%, #00c4cc 100%);
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 700;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}
.canva-btn-add:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3); 
}
</style>

<div class="page-wrapper">
<div class="global-container">
    <div class="card-header-bar">
        <div>
            <div class="page-title"><span class="title-icon"><i class="bi bi-database"></i></span> Master Data</div>
            <div class="page-subtitle">Kelola data Shift, Line/Machine, Mold, dan Cavity secara terpusat.</div>
        </div>
    </div>
    
    <div class="card-body-pad">
        <ul class="nav nav-pills master-tabs" id="masterTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-type="shift" data-bs-toggle="tab" data-bs-target="#tab-shift" type="button"><i class="bi bi-clock-history me-2"></i>Shift</button></li>
            <li class="nav-item"><button class="nav-link" data-type="line" data-bs-toggle="tab" data-bs-target="#tab-line" type="button"><i class="bi bi-hdd-network me-2"></i>Line / Machine</button></li>
            <li class="nav-item"><button class="nav-link" data-type="mold" data-bs-toggle="tab" data-bs-target="#tab-mold" type="button"><i class="bi bi-box me-2"></i>Mold</button></li>
            <li class="nav-item"><button class="nav-link" data-type="cavity" data-bs-toggle="tab" data-bs-target="#tab-cavity" type="button"><i class="bi bi-grid-3x3-gap me-2"></i>Cavity</button></li>
            <?php if (session()->get('role') === 'admin'): ?>
            <li class="nav-item"><button class="nav-link" data-type="user" data-bs-toggle="tab" data-bs-target="#tab-user" type="button"><i class="bi bi-people me-2"></i>User Management</button></li>
            <?php endif; ?>
        </ul>

        <div class="tab-content tab-stripe-container">
            <!-- Shift -->
            <div class="tab-pane fade show active" id="tab-shift">
                <?= view('master/_tab', ['type' => 'shift', 'label' => 'Nama Shift', 'manualId' => false]) ?>
            </div>
            <!-- Line -->
            <div class="tab-pane fade" id="tab-line">
                <?= view('master/_tab', ['type' => 'line', 'label' => 'Nama Line / Machine', 'manualId' => true]) ?>
            </div>
            <!-- Mold -->
            <div class="tab-pane fade" id="tab-mold">
                <?= view('master/_tab', ['type' => 'mold', 'label' => 'Nama Mold', 'manualId' => false]) ?>
            </div>
            <!-- Cavity -->
            <div class="tab-pane fade" id="tab-cavity">
                <?= view('master/_tab', ['type' => 'cavity', 'label' => 'Nama Cavity', 'manualId' => false]) ?>
            </div>
            <!-- User -->
            <?php if (session()->get('role') === 'admin'): ?>
            <div class="tab-pane fade" id="tab-user">
                <?= view('master/_tab_user', ['users' => $users ?? []]) ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-end mt-4">
            <a href="<?= base_url('print-form') ?>" class="btn-desktop btn-outline-modern">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Form Print
            </a>
        </div>
    </div><!-- /card-body-pad -->
</div><!-- /global-container -->
</div><!-- /page-wrapper -->

<!-- ══════════════════════════════════════════════════════════════════════
     STRIPE-STYLE MODAL: Add / Edit Master Data
     Referenced by master.js via: $('#masterDataModal').fadeIn(150)
     ══════════════════════════════════════════════════════════════════════ -->
<div id="masterDataModal" class="stripe-modal-overlay" style="display:none;">
    <div class="stripe-modal-box">
        <!-- Header -->
        <div class="stripe-modal-header">
            <h3 class="stripe-modal-title" id="masterModalTitle">Tambah Data</h3>
            <button type="button" class="stripe-modal-close" onclick="$('#masterDataModal').fadeOut(150)">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <!-- Body -->
        <form id="masterDataForm" autocomplete="off">
            <input type="hidden" id="masterInputType" value="">
            <input type="hidden" id="masterInputEditId" value="">
            <input type="hidden" id="masterInputManualIdFlag" value="0">

            <div class="stripe-modal-body">
                <!-- ID field (only for Line/Machine with manualId) -->
                <div class="stripe-form-group" id="masterIdGroup" style="display:none;">
                    <label class="stripe-form-label" for="masterInputId">
                        KODE ID <span style="color:#df1b41;">*</span>
                    </label>
                    <input type="text"
                           id="masterInputId"
                           class="stripe-form-input"
                           placeholder="mis. CG01"
                           maxlength="10">
                    <p style="margin:5px 0 0; font-size:11.5px; color:#9baec8;">Kode unik yang digunakan sebagai ID data.</p>
                </div>

                <!-- Name field -->
                <div class="stripe-form-group">
                    <label class="stripe-form-label" id="masterNameLabel" for="masterInputName">
                        NAMA <span style="color:#df1b41;">*</span>
                    </label>
                    <input type="text"
                           id="masterInputName"
                           class="stripe-form-input"
                           placeholder="Masukkan nama..."
                           required>
                </div>
            </div>

            <!-- Footer -->
            <div class="stripe-modal-footer">
                <button type="button" class="stripe-btn-cancel" onclick="$('#masterDataModal').fadeOut(150)">
                    Batal
                </button>
                <button type="submit" class="stripe-btn-save" id="btnMasterSave">
                    <i class="bi bi-check2-circle me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts (jQuery must load before master.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    if(document.getElementById('particles-js-inner')){
        particlesJS("particles-js-inner", {
            "particles": {
                "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#3b82f6" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.4, "random": false },
                "size": { "value": 5, "random": true },
                "line_linked": { "enable": true, "distance": 150, "color": "#3b82f6", "opacity": 0.2, "width": 1 },
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
    }
</script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url('assets/js/master.js') ?>?v=<?= time() ?>"></script>
<script>
/* Close masterDataModal on overlay click (needs jQuery from above) */
document.getElementById('masterDataModal').addEventListener('click', function(e) {
    if (e.target === this) { $(this).fadeOut(150); }
});
</script>
<script>
/* Remember active tab on reload */
document.addEventListener("DOMContentLoaded", function() {
    var activeTab = sessionStorage.getItem('activeMasterTab');
    if (activeTab) {
        var tabElement = document.querySelector('button[data-bs-target="' + activeTab + '"]');
        if (tabElement) {
            var tab = new bootstrap.Tab(tabElement);
            tab.show();
        }
    }
    
    var tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(function(el) {
        el.addEventListener('shown.bs.tab', function (event) {
            sessionStorage.setItem('activeMasterTab', event.target.getAttribute('data-bs-target'));
        });
    });
});
</script>
</body>
</html>
