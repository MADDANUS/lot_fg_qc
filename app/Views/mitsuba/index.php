<?= $this->include('templates/header', ['title' => 'Mitsuba Saved Labels']) ?>

<style>
.mitsuba-container { max-width: 1200px; margin: 20px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; }
.mitsuba-title { font-size: 24px; font-weight: 700; color: #0f172a; margin-bottom: 5px; }
.mitsuba-subtitle { font-size: 14px; color: #64748b; margin-bottom: 20px; }
.action-bar { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
.btn-print-selected { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(59,130,246,0.3); }
.btn-print-selected:hover { background: linear-gradient(135deg, #1e3a8a, #2563eb); transform: translateY(-1px); color: white; }
.btn-delete-selected { background: white; color: #ef4444; border: 1px solid #fca5a5; padding: 8px 20px; border-radius: 6px; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; margin-left: 10px; }
.btn-delete-selected:hover { background: #fef2f2; border-color: #ef4444; color: #dc2626; }
.selected-info { font-size: 14px; color: #64748b; font-weight: 500; }
table.dataTable thead th { font-weight: 600; font-size: 13px; }
table.dataTable td { font-size: 13px; vertical-align: middle; }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div class="mitsuba-container">
    <div class="mitsuba-title">🔖 Mitsuba Saved Labels</div>
    <div class="mitsuba-subtitle">Kelola dan cetak massal dokumen Mitsuba yang telah disimpan.</div>

    <div class="action-bar">
        <div>
            <button class="btn-print-selected" id="btnPrintMitsuba" onclick="batchPrint()">
                👁️ Preview Selected
            </button>
            <button class="btn-delete-selected" id="btnDeleteMitsuba" onclick="deleteSelected()">
                🗑️ Delete Selected
            </button>
        </div>
        <span class="selected-info" id="infoMitsuba">0 dipilih</span>
    </div>

    <table id="tableMitsuba" class="table table-hover table-bordered w-100" style="font-size:13px;">
        <thead class="table-info">
            <tr>
                <th style="width:30px;"><input type="checkbox" id="chkAllMitsuba" onchange="toggleAll()"></th>
                <th>Nomor Transaksi</th>
                <th>Part No</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Lot No</th>
                <th>Disimpan</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?= $this->include('templates/footer') ?>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
const BASE_URL = '<?= base_url() ?>';

const dtMitsuba = $('#tableMitsuba').DataTable({
    ajax: { url: BASE_URL + 'mitsuba/data', type: 'POST', dataSrc: 'data' },
    columns: [
        {
            data: 'id',
            render: (d) => `<input type="checkbox" class="chk-mitsuba" value="${d}" onchange="updateInfo()">`
        },
        { data: 'doc_number' },
        { data: 'item_code' },
        { data: 'description' },
        { data: 'quantity' },
        { data: 'lotno' },
        { data: 'created_at' },
    ],
    order: [[6, 'desc']],
    pageLength: 25,
    language: { search: 'Cari:', lengthMenu: 'Tampilkan _MENU_ data' },
});

function toggleAll() {
    const isChecked = $('#chkAllMitsuba').is(':checked');
    $('.chk-mitsuba').prop('checked', isChecked);
    updateInfo();
}

function updateInfo() {
    const total = $('.chk-mitsuba:checked').length;
    $('#infoMitsuba').text(`${total} dipilih`);
    
    // Uncheck select all if not all selected
    if (total === 0 || total < $('.chk-mitsuba').length) {
        $('#chkAllMitsuba').prop('checked', false);
    }
}

function getSelectedIds() {
    return $('.chk-mitsuba:checked').map(function() { return $(this).val(); }).get();
}

function batchPrint() {
    const ids = getSelectedIds();
    if (ids.length === 0) return alert('Pilih minimal 1 baris untuk dicetak!');

    $('#btnPrintMitsuba').prop('disabled', true).text('Processing...');
    
    $.post(BASE_URL + 'mitsuba/batch-print', { ids: ids })
        .done(function(res) {
            if (res.success) {
                window.open(BASE_URL + 'mitsuba/render-pdf/' + res.session_key, '_blank');
                dtMitsuba.ajax.reload(null, false);
                $('.chk-mitsuba, #chkAllMitsuba').prop('checked', false);
                updateInfo();
            } else {
                alert(res.message || 'Gagal memproses.');
            }
        })
        .fail(function() { alert('Gagal menghubungi server.'); })
        .always(function() {
            $('#btnPrintMitsuba').prop('disabled', false).html('👁️ Preview Selected');
        });
}

function deleteSelected() {
    const ids = getSelectedIds();
    if (ids.length === 0) return alert('Pilih minimal 1 baris untuk dihapus!');
    if (!confirm(`Hapus ${ids.length} data terpilih secara permanen?`)) return;

    $('#btnDeleteMitsuba').prop('disabled', true);
    
    $.post(BASE_URL + 'mitsuba/delete-rows', { ids: ids })
        .done(function(res) {
            if (res.success) {
                dtMitsuba.ajax.reload(null, false);
                $('.chk-mitsuba, #chkAllMitsuba').prop('checked', false);
                updateInfo();
                alert('Data berhasil dihapus!');
            } else {
                alert(res.message || 'Gagal menghapus data.');
            }
        })
        .fail(function() { alert('Gagal menghubungi server.'); })
        .always(function() {
            $('#btnDeleteMitsuba').prop('disabled', false);
        });
}
</script>
