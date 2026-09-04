$(function () {
    /* ------------------------------------------------------------------
     * Load data tabel untuk 1 tab
     * ------------------------------------------------------------------ */
    function loadTable(type) {
        const $table = $('.master-table[data-type="' + type + '"]');
        const $tbody = $table.find('tbody');

        $.get(BASE_URL + 'master/list/' + type)
            .done(function (res) {
                $tbody.empty();
                if (!res.success || !res.data.length) {
                    $tbody.append('<tr><td colspan="3" class="text-center text-muted">Belum ada data</td></tr>');
                    return;
                }
                res.data.forEach(function (row) {
                    const nameField = Object.keys(row).find(k => k !== 'id' && k !== 'created_at' && k !== 'updated_at');
                    const $tr = $('<tr>');
                    $tr.append($('<td>').text(row.id));
                    $tr.append($('<td>').text(row[nameField]));
                    const $actions = $('<td>');
                    $actions.append(
                        $('<button type="button" class="btn btn-sm btn-outline-primary me-1">Edit</button>')
                            .on('click', function () {
                                editRow(type, row, nameField);
                            })
                    );
                    $actions.append(
                        $('<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>')
                            .on('click', function () {
                                deleteRow(type, row.id);
                            })
                    );
                    $tr.append($actions);
                    $tbody.append($tr);
                });
            })
            .fail(function () {
                $tbody.html('<tr><td colspan="3" class="text-center text-danger">Gagal memuat data</td></tr>');
            });
    }

    function editRow(type, row, nameField) {
        const $form = $('.master-form[data-type="' + type + '"]');
        $form.find('.input-id').val(row.id).prop('disabled', true);
        $form.find('.input-name').val(row[nameField]);
        $form.find('.input-edit-id').val(row.id);
        $form.find('.btn-cancel-edit').removeClass('d-none');
    }

    function resetForm($form) {
        $form.find('.input-id').val('').prop('disabled', false);
        $form.find('.input-name').val('');
        $form.find('.input-edit-id').val('');
        $form.find('.btn-cancel-edit').addClass('d-none');
    }

    function deleteRow(type, id) {
        if (!confirm('Hapus data ini?')) return;
        $.post(BASE_URL + 'master/delete/' + type + '/' + id)
            .done(function (res) {
                if (res.success) {
                    loadTable(type);
                } else {
                    alert(res.message || 'Gagal menghapus.');
                }
            });
    }

    /* ------------------------------------------------------------------
     * Save (insert atau update tergantung ada input-edit-id atau tidak)
     * ------------------------------------------------------------------ */
    $(document).on('click', '.btn-save-row', function () {
        const $form = $(this).closest('.master-form');
        const type = $form.data('type');
        const manualId = $form.data('manual-id') == 1;
        const editId = $form.find('.input-edit-id').val();
        const name = $form.find('.input-name').val().trim();

        if (!name) {
            alert('Nama wajib diisi.');
            return;
        }

        // nama field kolom ditentukan dari label, dikirim generik sbg "name" lalu
        // di-map ulang di sisi controller lewat nameField masing-masing tipe.
        // Supaya sederhana, kirim dengan nama field standar per type:
        const fieldMap = {
            shift: 'shift_name',
            line: 'line_name',
            mold: 'mold_name',
            cavity: 'cavity_name',
        };

        const payload = { id: editId };
        payload[fieldMap[type]] = name;

        if (manualId) {
            const idVal = $form.find('.input-id').val().trim();
            if (!idVal) {
                alert('ID wajib diisi.');
                return;
            }
            payload.id = editId || idVal;
        }

        $.post(BASE_URL + 'master/save/' + type, payload)
            .done(function (res) {
                if (!res.success) {
                    let msg = res.message || 'Gagal menyimpan.';
                    if (res.errors) msg += '\n' + Object.values(res.errors).join('\n');
                    alert(msg);
                    return;
                }
                resetForm($form);
                loadTable(type);
            })
            .fail(function () {
                alert('Gagal menghubungi server.');
            });
    });

    $(document).on('click', '.btn-cancel-edit', function () {
        resetForm($(this).closest('.master-form'));
    });

    /* ------------------------------------------------------------------
     * Load tab pertama saat halaman dibuka, lalu load tab lain saat diklik
     * ------------------------------------------------------------------ */
    loadTable('shift');

    $('#masterTabs button').on('shown.bs.tab', function (e) {
        loadTable($(e.target).data('type'));
    });
});
