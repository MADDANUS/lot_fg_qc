<?= $this->include('templates/header') ?>

<style>
/* Omron-specific overrides only */
.page-title-badge-inner { color: #1e40af; }
.page-title-badge-outer { color: #d97706; }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div class="page-wrapper">
<div class="global-container">

    <div class="card-header-bar">
        <div>
            <div class="page-title"><span class="title-icon">🔖</span> Omron Saved Labels</div>
            <div class="page-subtitle">Kelola dan cetak massal dokumen Omron Inner &amp; Outer yang telah disimpan.</div>
        </div>
    </div>

    <div class="card-body-pad">
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
                🖨️ Print Label
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
                    <th>Posting Date</th>
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
                🖨️ Print Label
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
    </div><!-- /tab pane outer -->
    </div><!-- /card-body-pad -->
</div><!-- /global-container -->
</div><!-- /page-wrapper -->

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
        { data: 'doc_number', defaultContent: '-' },
        { data: 'doc_date', defaultContent: '-' },
        { data: 'item_code', defaultContent: '-' },
        { data: 'description', defaultContent: '-' },
        { data: 'quantity', defaultContent: '0' },
        { data: 'standard_pack', defaultContent: '0' },
        { data: 'lotno', defaultContent: '-' },
        { data: 'created_at', defaultContent: '-' },
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
            { data: 'doc_number', defaultContent: '-' },
            { data: 'production_date', defaultContent: '-' },
            { data: 'item_code', defaultContent: '-' },
            { data: 'description', defaultContent: '-' },
            { data: 'quantity', defaultContent: '0' },
            { data: 'lotno', defaultContent: '-' },
            { data: 'machine', defaultContent: '-' },
            { data: 'created_at', defaultContent: '-' },
        ],
        order: [[8, 'desc']],
        pageLength: 25,
        language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
    });
}
</script>
