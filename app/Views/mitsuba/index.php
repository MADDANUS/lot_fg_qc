<?= $this->include('templates/header', ['title' => 'Mitsuba Saved Labels']) ?>

<div class="page-wrapper">
<div class="global-container">

    <div class="card-header-bar">
        <div>
            <div class="page-title"><span class="title-icon">🔖</span> Mitsuba Saved Labels</div>
            <div class="page-subtitle">Kelola dan cetak massal dokumen Mitsuba yang telah disimpan.</div>
        </div>
    </div>

    <div class="card-body-pad">
        <div class="action-bar">
            <button class="btn-print-selected" id="btnPrintMitsuba" onclick="batchPrint()">🖨️ Print Label</button>
            <button class="btn-delete-selected" id="btnDeleteMitsuba" onclick="deleteSelected()">🗑️ Delete</button>
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
    </div><!-- /card-body-pad -->
</div><!-- /global-container -->
</div><!-- /page-wrapper -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<?= $this->include('templates/footer') ?>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
const BASE_URL = '<?= base_url() ?>';

const dtMitsuba = $('#tableMitsuba').DataTable({
    ajax: { url: BASE_URL + 'mitsuba/data', dataSrc: 'data' },
    columns: [
        {
            data: 'id',
            render: (d) => `<input type="checkbox" class="chk-mitsuba" value="${d}" onchange="updateInfo()">`
        },
        { data: 'doc_number', defaultContent: '-' },
        { data: 'item_code', defaultContent: '-' },
        { data: 'description', defaultContent: '-' },
        { data: 'quantity', defaultContent: '0' },
        { data: 'lotno', defaultContent: '-' },
        { data: 'created_at', defaultContent: '-' },
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
            $('#btnPrintMitsuba').prop('disabled', false).html('Print Label');
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
