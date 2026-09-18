$(function () {
    const dtInstances = {};

    /* ------------------------------------------------------------------
     * Load data tabel untuk 1 tab menggunakan DataTables
     * ------------------------------------------------------------------ */
    window.loadTable = function(type) {
        const $table = $('.master-table[data-type="' + type + '"]');
        
        if (dtInstances[type]) {
            dtInstances[type].ajax.reload(null, false);
            return;
        }

        dtInstances[type] = $table.DataTable({
            ajax: {
                url: BASE_URL + 'master/list/' + type,
                dataSrc: function(json) {
                    return json.success ? json.data : [];
                }
            },
            columns: [
                { data: 'id' },
                { 
                    data: null, 
                    render: function(data, type, row) {
                        // Find the dynamic name field
                        const nameField = Object.keys(row).find(k => k !== 'id' && k !== 'created_at' && k !== 'updated_at');
                        return row[nameField];
                    }
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center text-nowrap',
                    render: function(data, type, row) {
                        const nameField = Object.keys(row).find(k => k !== 'id' && k !== 'created_at' && k !== 'updated_at');
                        const safeRow = encodeURIComponent(JSON.stringify(row));
                        return `
                            <div class="d-flex flex-nowrap justify-content-center gap-2">
                                <button type="button" class="btn-icon-action btn-icon-edit" onclick="editMasterRow('${row.id}', '${row[nameField]}')" title="Edit"><i class="bi bi-pencil-fill"></i></button>
                                <button type="button" class="btn-icon-action btn-icon-delete" onclick="deleteMasterRow('${row.id}')" title="Hapus"><i class="bi bi-trash3-fill"></i></button>
                            </div>
                        `;
                    }
                }
            ],
            pageLength: 25,
            lengthMenu: [[25, 50, 100], [25, 50, 100]]
        });
    };

    /* ------------------------------------------------------------------
     * Modal interactions for Master Data
     * ------------------------------------------------------------------ */
    window.openMasterModal = function(type, label, manualId) {
        $('#masterInputType').val(type);
        $('#masterInputManualIdFlag').val(manualId ? '1' : '0');
        $('#masterInputEditId').val('');
        
        $('#masterInputId').val('').prop('disabled', false);
        $('#masterInputName').val('');
        
        $('#masterModalTitle').text('Tambah ' + label);
        $('#masterNameLabel').html(label + ' <span style="color:#ef4444;">*</span>');
        
        if (manualId) {
            $('#masterIdGroup').show();
            $('#masterInputId').prop('required', true);
        } else {
            $('#masterIdGroup').hide();
            $('#masterInputId').prop('required', false);
        }
        
        $('#masterDataModal').fadeIn(150);
    };

    window.editMasterRow = function(id, name) {
        const type = $('.master-tabs .nav-link.active').data('type');
        const manualId = $('.master-table[data-type="'+type+'"]').closest('.tab-pane').find('button[onclick*="true"]').length > 0;
        
        $('#masterInputType').val(type);
        $('#masterInputEditId').val(id);
        $('#masterInputManualIdFlag').val(manualId ? '1' : '0');
        
        $('#masterInputId').val(id).prop('disabled', true);
        $('#masterInputName').val(name);
        
        $('#masterModalTitle').text('Edit Data');
        
        if (manualId) {
            $('#masterIdGroup').show();
            $('#masterInputId').prop('required', true);
        } else {
            $('#masterIdGroup').hide();
            $('#masterInputId').prop('required', false);
        }
        
        $('#masterDataModal').fadeIn(150);
    };

    window.deleteMasterRow = function(id) {
        const type = $('.master-tabs .nav-link.active').data('type');
        
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'master/delete/' + type + '/' + id)
                    .done(function (res) {
                        if (res.success) {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            loadTable(type);
                        } else {
                            Swal.fire('Gagal!', res.message || 'Gagal menghapus.', 'error');
                        }
                    });
            }
        });
    };

    $('#masterDataForm').on('submit', function (e) {
        e.preventDefault();
        const type = $('#masterInputType').val();
        const manualId = $('#masterInputManualIdFlag').val() == '1';
        const editId = $('#masterInputEditId').val();
        const name = $('#masterInputName').val().trim();

        const fieldMap = {
            shift: 'shift_name',
            line: 'line_name',
            mold: 'mold_name',
            cavity: 'cavity_name',
        };

        const payload = { id: editId };
        payload[fieldMap[type]] = name;

        if (manualId) {
            const idVal = $('#masterInputId').val().trim();
            if (!idVal) {
                Swal.fire('Peringatan', 'ID wajib diisi.', 'warning');
                return;
            }
            payload.id = idVal;
            if (!editId) {
                payload.is_new_manual = 1;
            }
        }

        const btn = $('#btnMasterSave');
        const oldText = btn.html();
        btn.html('Menyimpan...').prop('disabled', true);

        $.post(BASE_URL + 'master/save/' + type, payload)
            .done(function (res) {
                if (res.success) {
                    $('#masterDataModal').fadeOut(150);
                    Swal.fire('Berhasil!', 'Data tersimpan.', 'success');
                    loadTable(type);
                } else {
                    Swal.fire('Gagal!', res.message || 'Gagal menyimpan data.', 'error');
                }
            })
            .fail(function () {
                Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
            })
            .always(function () {
                btn.html(oldText).prop('disabled', false);
            });
    });

    // Inisialisasi tab aktif saat ini
    const activeType = $('.master-tabs .nav-link.active').data('type');
    if(activeType && activeType !== 'user') {
        loadTable(activeType);
    }

    // Load table when tab is switched
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const type = $(e.target).data('type');
        if(type && type !== 'user') {
            loadTable(type);
        }
    });
});
