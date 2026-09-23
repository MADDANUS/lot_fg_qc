<?= $this->include('templates/header') ?>
<?php
$isPpic = (session()->get('username') === 'ppic');
$isQc   = (strpos(strtolower(session()->get('username') ?? ''), 'qc') !== false);
?>

<style>
/* Omron-specific overrides only */
.page-title-badge-inner { color: #1e40af; }
.page-title-badge-outer { color: #3b82f6; }
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
        <?php if (!$isPpic): ?>
        <button class="tab-btn active-inner" id="btnTabInner" onclick="switchTab('inner')">
            📋 Cetak QR Inner
        </button>
        <?php endif; ?>
        <?php if (!$isQc): ?>
        <button class="tab-btn <?= $isPpic ? 'active-outer' : '' ?>" id="btnTabFormOuter" onclick="switchTab('form-outer')">
            📝 Tambah Data Outer
        </button>
        <button class="tab-btn" id="btnTabOuter" onclick="switchTab('outer')">
            📦 Cetak QR Outer
        </button>
        <?php endif; ?>
    </div>

    <!-- Tab Inner -->
    <?php if (!$isPpic): ?>
    <div class="tab-content-pane active" id="pane-inner" style="border: 2px solid #1e40af; border-top: none; border-radius: 0 8px 8px 8px; padding: 20px;">
        <div class="action-bar d-flex justify-content-end align-items-center gap-2">
            <span class="selected-info" id="infoInner">0 dipilih</span>
            <button class="btn-print-selected" id="btnPrintInner" onclick="batchPrint('inner')">
                🖨️ Print
            </button>
            <button class="btn-delete-selected" id="btnDeleteInner" onclick="deleteSelected('inner')">
                🗑️ Delete
            </button>
        </div>
        <div class="table-responsive">
        <table id="tableInner" class="table table-hover table-bordered w-100" style="font-size:13px;">
            <thead class="table-primary">
                <tr>
                    <th style="width:30px; text-align:center;">No</th>
                    <th>Nomor Transaksi</th>
                    <th>Posting Date</th>
                    <th>Part No</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Std Pack</th>
                    <th>Lot No</th>
                    <th>Disimpan</th>
                    <th style="width:30px;"><input type="checkbox" id="chkAllInner" onchange="toggleAll('inner')"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!$isQc): ?>
    <!-- Tab Outer -->
    <div class="tab-content-pane" id="pane-outer" style="border: 2px solid #3b82f6; border-top: none; border-radius: 0 8px 8px 8px; padding: 20px; display:none;">
        <div class="action-bar d-flex justify-content-end align-items-center gap-2">
            <span class="selected-info" id="infoOuter">0 dipilih</span>
            <button class="btn-print-selected" id="btnPrintOuter" onclick="batchPrint('outer')" style="background: #3b82f6;">
                🖨️ Print
            </button>
            <button class="btn-delete-selected" id="btnDeleteOuter" onclick="deleteSelected('outer')">
                🗑️ Delete
            </button>
        </div>
        <div class="table-responsive">
        <table id="tableOuter" class="table table-hover table-bordered w-100" style="font-size:13px;">
            <thead class="table-primary">
                <tr>
                    <th style="width:30px; text-align:center;">No</th>
                    <th>Production Date</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Lot No</th>
                    <th>Machine</th>
                    <th>Disimpan</th>
                    <th style="width:30px;"><input type="checkbox" id="chkAllOuter" onchange="toggleAll('outer')"></th>
                </tr>
            </thead>
        <tbody></tbody>
        </table>
        </div>
    </div><!-- /tab pane outer -->

    <!-- Tab Form Outer -->
    <div class="tab-content-pane <?= $isPpic ? 'active' : '' ?>" id="pane-form-outer" style="border: 2px solid #3b82f6; border-top: none; border-radius: 0 8px 8px 8px; padding: 20px; <?= $isPpic ? '' : 'display:none;' ?>">
        <form id="formAddOuter" onsubmit="saveOuterLabel(event)">
            <div class="row">
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Omron</label>
                        <select class="fi flex-grow-1" id="form_item_code" name="item_code" onchange="updateItemName()" required>
                            <option value="">-- Pilih Item No --</option>
                            <?php foreach ($omron_items as $item): ?>
                                <option value="<?= esc($item['item_code']) ?>" data-name="<?= esc($item['description']) ?>"><?= esc($item['item_code']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Vendor</label>
                        <input type="text" class="fi flex-grow-1" id="form_item_vendor" readonly style="background:#f3f4f6;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row-item">
                        <label class="lbl-omron">Item Name</label>
                        <input type="text" class="fi flex-grow-1" id="form_description" name="description" readonly style="background:#f3f4f6;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron">Material No</label><input type="text" class="fi flex-grow-1" id="form_material_no" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Material Name</label><input type="text" class="fi flex-grow-1" id="form_material_name" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Unit</label><input type="text" class="fi flex-grow-1" id="form_unit" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Std. Packing</label><input type="text" class="fi flex-grow-1" id="form_std_packing" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Cavity</label><input type="text" class="fi flex-grow-1" id="form_cavity" name="cavity" list="omron_cavity_list" autocomplete="off">
                        <datalist id="omron_cavity_list">
                            <?php foreach ($cavities as $c): ?>
                                <option value="<?= esc($c['cavity_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron">Production Date</label><input type="date" class="fi flex-grow-1" id="form_production_date" name="production_date"></div>
                    <div class="row-item"><label class="lbl-omron">DWG No.</label><input type="text" class="fi flex-grow-1" id="form_dwg_no" name="dwg_no" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Shift</label><input type="text" class="fi flex-grow-1" id="form_shift" name="shift" list="omron_shift_list" value="1" autocomplete="off">
                        <datalist id="omron_shift_list">
                            <?php foreach ($shifts as $s): ?>
                                <option value="<?= esc($s['shift_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item"><label class="lbl-omron">Machine</label><input type="text" class="fi flex-grow-1" id="form_machine" name="machine" list="omron_machine_list" autocomplete="off">
                        <datalist id="omron_machine_list">
                            <?php foreach ($lines as $l): ?>
                                <option value="<?= esc($l['line_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item"><label class="lbl-omron">Qty in Carton</label><input type="text" class="fi flex-grow-1" id="form_qty_carton" value="10000" readonly style="background:#f3f4f6;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><div class="row-item"><label class="lbl-omron">Remark</label><input type="text" class="fi flex-grow-1" id="form_remark" name="remark" readonly style="background:#f3f4f6;"></div></div>
                <div class="col-md-12"><div class="row-item"><label class="lbl-omron">Maker</label><input type="text" class="fi flex-grow-1" id="form_maker" readonly style="background:#f3f4f6;"></div></div>
            </div>
            <div class="d-flex align-items-center gap-4 mt-2" style="margin-left:140px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="form_lot_guarantee" disabled style="cursor: not-allowed;">
                    <label class="form-check-label fw-bold" for="form_lot_guarantee" style="cursor: not-allowed;">Lot Guarantee</label>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="fl fw-bold">Die No</label>
                    <select class="fi" style="width:70px;" id="form_die_no" name="die_no">
                        <option value="-">-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron fw-bold">Lot No</label><input type="text" class="fi flex-grow-1" id="form_lotno" name="lotno"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Quantity</label><input type="text" class="fi flex-grow-1" id="form_quantity" name="quantity"></div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Notification</label>
                        <select class="fi flex-grow-1" id="form_notification" name="notification">
                            <option value="RE-DELIVERY">RE-DELIVERY</option>
                            <option value="DESIGN CHANGE">DESIGN CHANGE</option>
                            <option value="FIRST RUN">FIRST RUN</option>
                            <option value="IFC">IFC</option>
                            <option value="PROCESS CHANGE">PROCESS CHANGE</option>
                            <option value="SAMPLE">SAMPLE</option>
                            <option value="SAR">SAR</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary" id="btnSaveOuter" style="background:#3b82f6; border-color:#3b82f6; font-weight:600; min-width: 150px;">
                    <i class="bi bi-save me-2"></i> Simpan Label
                </button>
            </div>
        </form>
    </div><!-- /tab pane form outer -->
    <?php endif; ?>
    </div><!-- /card-body-pad -->
</div><!-- /global-container -->
</div><!-- /page-wrapper -->

<?= $this->include('templates/footer') ?>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
const BASE_URL = '<?= base_url('/') ?>';

// Tab switching
function switchTab(type) {
    const paneInner = document.getElementById('pane-inner');
    if (paneInner) paneInner.style.display = type === 'inner' ? 'block' : 'none';
    
    document.getElementById('pane-outer').style.display = type === 'outer' ? 'block' : 'none';
    document.getElementById('pane-form-outer').style.display = type === 'form-outer' ? 'block' : 'none';
    
    const btnInner = document.getElementById('btnTabInner');
    if (btnInner) btnInner.className = 'tab-btn' + (type === 'inner' ? ' active-inner' : '');
    
    document.getElementById('btnTabOuter').className = 'tab-btn' + (type === 'outer' ? ' active-outer' : '');
    document.getElementById('btnTabFormOuter').className = 'tab-btn' + (type === 'form-outer' ? ' active-outer' : '');
    if (type === 'outer' && !window.outerLoaded) {
        loadOuter();
        window.outerLoaded = true;
    }
}

// Auto-fill Item Name
function updateItemName() {
    const sel = document.getElementById('form_item_code');
    const opt = sel.options[sel.selectedIndex];
    document.getElementById('form_description').value = opt ? (opt.dataset.name || '') : '';
}

// Save Outer Label
function saveOuterLabel(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSaveOuter');
    btn.disabled = true;
    btn.innerHTML = 'Menyimpan...';

    const payload = {
        item_code: document.getElementById('form_item_code').value,
        description: document.getElementById('form_description').value,
        production_date: document.getElementById('form_production_date').value,
        quantity: document.getElementById('form_quantity').value,
        lotno: document.getElementById('form_lotno').value,
        cavity: document.getElementById('form_cavity').value,
        shift: document.getElementById('form_shift').value,
        machine: document.getElementById('form_machine').value,
        remark: document.getElementById('form_remark').value,
        die_no: document.getElementById('form_die_no').value,
        dwg_no: document.getElementById('form_dwg_no').value,
        notification: document.getElementById('form_notification').value
    };

    $.post(BASE_URL + 'omron/saveOuter', payload)
        .done(function(res) {
            if (!res.success) {
                alert(res.message || 'Gagal menyimpan data.');
                return;
            }
            alert('Data berhasil disimpan!');
            document.getElementById('formAddOuter').reset();
            updateItemName();
            if (window.outerLoaded && dtOuter) {
                dtOuter.ajax.reload();
            }
            switchTab('outer');
        })
        .fail(function() {
            alert('Terjadi kesalahan koneksi ke server.');
        })
        .always(function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-save me-2"></i> Simpan Label';
        });
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

    $.post(BASE_URL + 'omron/delete-rows', { type, ids })
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
<?php if (!$isPpic): ?>
const dtInner = $('#tableInner').DataTable({
    processing: true,
    serverSide: true,
    ajax: { url: BASE_URL + 'omron/data/inner', type: 'GET', dataSrc: 'data' },
    columns: [
        {
            data: null,
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { data: 'doc_number', defaultContent: '-' },
        { data: 'doc_date', defaultContent: '-' },
        { data: 'item_code', defaultContent: '-' },
        { data: 'description', defaultContent: '-' },
        { data: 'quantity', defaultContent: '0' },
        { data: 'standard_pack', defaultContent: '0' },
        { data: 'lotno', defaultContent: '-' },
        { data: 'created_at', defaultContent: '-' },
        {
            data: 'id',
            orderable: false,
            searchable: false,
            render: (d) => `<input type="checkbox" class="chk-inner" value="${d}" onchange="updateInfo('inner')">`
        }
    ],
    order: [[8, 'desc']],
    pageLength: 25,
    language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
});
<?php endif; ?>

// DataTable Outer — lazy load
let dtOuter;
window.outerLoaded = false;
function loadOuter() {
    dtOuter = $('#tableOuter').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url: BASE_URL + 'omron/data/outer', type: 'GET', dataSrc: 'data' },
        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'production_date', defaultContent: '-' },
            { data: 'item_code', defaultContent: '-' },
            { data: 'description', defaultContent: '-' },
            { data: 'quantity', defaultContent: '0' },
            { data: 'lotno', defaultContent: '-' },
            { data: 'machine', defaultContent: '-' },
            { data: 'created_at', defaultContent: '-' },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: (d) => `<input type="checkbox" class="chk-outer" value="${d}" onchange="updateInfo('outer')">`
            }
        ],
        order: [[7, 'desc']],
        pageLength: 25,
        language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
    });
}



</script>
