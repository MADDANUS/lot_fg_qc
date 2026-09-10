<?= $this->include('templates/header') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body { background-color: #f1f5f9 !important; }

.omron-container {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
    padding: 30px;
    margin: 20px auto;
    font-family: 'Inter', sans-serif;
    max-width: 1200px;
}

.omron-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}

.omron-subtitle {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 24px;
}

.tab-btn {
    padding: 10px 28px;
    border-radius: 8px 8px 0 0;
    font-weight: 600;
    font-size: 14px;
    border: 2px solid #e2e8f0;
    border-bottom: none;
    cursor: pointer;
    background: #f8fafc;
    color: #64748b;
    transition: all 0.2s;
    margin-right: 4px;
}

.tab-btn.active-inner {
    background: #1e40af;
    color: #fff;
    border-color: #1e40af;
}

.tab-btn.active-outer {
    background: #d97706;
    color: #fff;
    border-color: #d97706;
}

.tab-content-pane { display: none; }
.tab-content-pane.active { display: block; }

.action-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    padding: 12px 16px;
    background: #f8fafc;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}

.btn-print-selected {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    color: #fff;
    border: none;
    padding: 9px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}
.btn-print-selected:hover { background: linear-gradient(135deg, #1e3a8a, #2563eb); transform: translateY(-1px); }

.btn-delete-selected {
    background: #fff;
    color: #dc2626;
    border: 1.5px solid #dc2626;
    padding: 9px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-delete-selected:hover { background: #fef2f2; }

.selected-info {
    font-size: 14px;
    color: #64748b;
    margin-left: auto;
    font-weight: 500;
}

table.dataTable thead th { font-weight: 600; font-size: 13px; }
table.dataTable td { font-size: 13px; vertical-align: middle; }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div class="omron-container">
    <div class="omron-title">🔖 Omron Saved Labels</div>
    <div class="omron-subtitle">Kelola dan cetak massal dokumen Omron Inner & Outer yang telah disimpan.</div>

    <!-- Tabs -->
    <div style="border-bottom: 2px solid #e2e8f0; margin-bottom: 0;">
        <button class="tab-btn active-inner" id="btnTabInner" onclick="switchTab('inner')">
            📋 Inner Labels
        </button>
        <button class="tab-btn" id="btnTabOuter" onclick="switchTab('outer')">
            📦 Outer Labels
        </button>
    </div>

    <!-- Tab Inner -->
    <div class="tab-content-pane active" id="pane-inner" style="border: 2px solid #1e40af; border-top: none; border-radius: 0 8px 8px 8px; padding: 20px;">
        <div class="action-bar">
            <button class="btn-print-selected" id="btnPrintInner" onclick="batchPrint('inner')">
                👁️ Preview Selected
            </button>
            <button class="btn-delete-selected" id="btnDeleteInner" onclick="deleteSelected('inner')">
                🗑️ Delete Selected
            </button>
            <span class="selected-info" id="infoInner">0 dipilih</span>
        </div>
        <table id="tableInner" class="table table-hover table-bordered w-100" style="font-size:13px;">
            <thead class="table-primary">
                <tr>
                    <th style="width:30px;"><input type="checkbox" id="chkAllInner" onchange="toggleAll('inner')"></th>
                    <th>Nomor Transaksi</th>
                    <th>Part No</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Std Pack</th>
                    <th>Lot No</th>
                    <th>Disimpan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Tab Outer -->
    <div class="tab-content-pane" id="pane-outer" style="border: 2px solid #d97706; border-top: none; border-radius: 0 8px 8px 8px; padding: 20px; display:none;">
        <div class="action-bar">
            <button class="btn-print-selected" id="btnPrintOuter" onclick="batchPrint('outer')" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                👁️ Preview Selected
            </button>
            <button class="btn-delete-selected" id="btnDeleteOuter" onclick="deleteSelected('outer')">
                🗑️ Delete Selected
            </button>
            <span class="selected-info" id="infoOuter">0 dipilih</span>
        </div>
        <table id="tableOuter" class="table table-hover table-bordered w-100" style="font-size:13px;">
            <thead class="table-warning">
                <tr>
                    <th style="width:30px;"><input type="checkbox" id="chkAllOuter" onchange="toggleAll('outer')"></th>
                    <th>Doc Number</th>
                    <th>Production Date</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Lot No</th>
                    <th>Machine</th>
                    <th>Disimpan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
const BASE_URL = '<?= base_url() ?>';

// Tab switching
function switchTab(type) {
    document.getElementById('pane-inner').style.display = type === 'inner' ? 'block' : 'none';
    document.getElementById('pane-outer').style.display = type === 'outer' ? 'block' : 'none';
    document.getElementById('btnTabInner').className = 'tab-btn' + (type === 'inner' ? ' active-inner' : '');
    document.getElementById('btnTabOuter').className = 'tab-btn' + (type === 'outer' ? ' active-outer' : '');
    if (type === 'outer' && !window.outerLoaded) {
        loadOuter();
        window.outerLoaded = true;
    }
}

// Toggle all checkboxes
function toggleAll(type) {
    const allChk = document.getElementById(`chkAll${type.charAt(0).toUpperCase() + type.slice(1)}`);
    document.querySelectorAll(`.chk-${type}`).forEach(c => c.checked = allChk.checked);
    updateInfo(type);
}

function updateInfo(type) {
    const count = document.querySelectorAll(`.chk-${type}:checked`).length;
    document.getElementById(`info${type.charAt(0).toUpperCase() + type.slice(1)}`).textContent = `${count} dipilih`;
}

function getSelectedIds(type) {
    return Array.from(document.querySelectorAll(`.chk-${type}:checked`)).map(c => c.value);
}

// Batch Print
function batchPrint(type) {
    const ids = getSelectedIds(type);
    if (ids.length === 0) { alert('Pilih minimal 1 data terlebih dahulu!'); return; }

    if (!confirm(`Cetak ${ids.length} dokumen Omron ${type.charAt(0).toUpperCase() + type.slice(1)}?`)) return;

    $.post(BASE_URL + 'omron/batch-print', { type, ids })
        .done(function(res) {
            if (!res.success) { alert(res.message || 'Gagal.'); return; }
            window.open(BASE_URL + 'omron/render-pdf/' + res.session_key, '_blank');
        })
        .fail(function() { alert('Gagal menghubungi server.'); });
}

// Delete selected
function deleteSelected(type) {
    const ids = getSelectedIds(type);
    if (ids.length === 0) { alert('Pilih minimal 1 data terlebih dahulu!'); return; }
    if (!confirm(`Hapus ${ids.length} data terpilih? Tindakan ini tidak bisa dibatalkan.`)) return;

    $.post(BASE_URL + 'omron/delete', { type, ids })
        .done(function(res) {
            if (!res.success) { alert(res.message || 'Gagal.'); return; }
            if (type === 'inner') { dtInner.ajax.reload(); }
            else { dtOuter.ajax.reload(); }
            alert('Data berhasil dihapus!');
        })
        .fail(function() { alert('Gagal menghubungi server.'); });
}

function statusBadge(val) {
    return val ? '<span class="badge bg-success">Sudah</span>' : '<span class="badge bg-secondary">Belum</span>';
}

// DataTable Inner
const dtInner = $('#tableInner').DataTable({
    ajax: { url: BASE_URL + 'omron/data/inner', dataSrc: 'data' },
    columns: [
        {
            data: 'id',
            render: (d) => `<input type="checkbox" class="chk-inner" value="${d}" onchange="updateInfo('inner')">`
        },
        { data: 'doc_number' },
        { data: 'item_code' },
        { data: 'description' },
        { data: 'quantity' },
        { data: 'standard_pack' },
        { data: 'lotno' },
        { data: 'created_at' },
    ],
    order: [[7, 'desc']],
    pageLength: 25,
    language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
});

// DataTable Outer — lazy load
let dtOuter;
window.outerLoaded = false;
function loadOuter() {
    dtOuter = $('#tableOuter').DataTable({
        ajax: { url: BASE_URL + 'omron/data/outer', dataSrc: 'data' },
        columns: [
            {
                data: 'id',
                render: (d) => `<input type="checkbox" class="chk-outer" value="${d}" onchange="updateInfo('outer')">`
            },
            { data: 'doc_number' },
            { data: 'production_date' },
            { data: 'item_code' },
            { data: 'description' },
            { data: 'quantity' },
            { data: 'lotno' },
            { data: 'machine' },
            { data: 'created_at' },
        ],
        order: [[8, 'desc']],
        pageLength: 25,
        language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
    });
}
</script>
