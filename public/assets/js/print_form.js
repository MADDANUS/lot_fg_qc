$(function () {
    /* ------------------------------------------------------------------
     * Toggle: Production Date  <->  Job Order  (hanya salah satu yang aktif)
     * ------------------------------------------------------------------ */
    $('.date-mode-radio').on('change', function () {
        const mode = $('input[name="date_mode"]:checked').val();
        $('#production_date').prop('disabled', mode !== 'production_date');
        $('#job_order').prop('disabled', mode !== 'job_order');
    });

    /* ------------------------------------------------------------------
     * Toggle: Line  <->  Mold + Cavity  (hanya salah satu yang aktif)
     * ------------------------------------------------------------------ */
    $('.line-mode-radio').on('change', function () {
        const mode = $('input[name="line_mode"]:checked').val();
        $('#line_id').prop('disabled', mode !== 'line');
        $('#mold_id, #cavity_id').prop('disabled', mode !== 'mold_cavity');
    });

    /* ------------------------------------------------------------------
     * Auto uppercase untuk From Series & User Initial Name
     * (boleh angka maupun huruf, tapi selalu di-uppercase)
     * ------------------------------------------------------------------ */
    $(document).on('input', '.upper-input', function () {
        const start = this.selectionStart;
        const end = this.selectionEnd;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(start, end);
    });

    /* ------------------------------------------------------------------
     * Grid item: tambah baris kosong manual
     * ------------------------------------------------------------------ */
    function addRow(data) {
        data = data || {};
        const tpl = document.getElementById('rowTemplate');
        const clone = tpl.content.cloneNode(true);
        const $row = $(clone).find('tr');

        // Secara default centang baris baru dan beri warna highlight
        $row.addClass('selected-row');
        $row.find('.row-checkbox').prop('checked', true);

        $row.find('[data-field]').each(function () {
            const field = $(this).data('field');
            if (data[field] !== undefined) {
                $(this).val(data[field]);
            }
        });

        $('#tableItems tbody').append($row);
    }

    $('#btnAddRow').on('click', function () {
        addRow();
    });

    $(document).on('click', '.btnRemoveRow', function () {
        $(this).closest('tr').remove();
        updateCheckAllState();
    });

    /* ------------------------------------------------------------------
     * Row Selection Logic
     * ------------------------------------------------------------------ */
    $(document).on('change', '.row-checkbox', function () {
        $(this).closest('tr').toggleClass('selected-row', this.checked);
        updateCheckAllState();
    });

    $('#checkAllRows').on('change', function () {
        const isChecked = this.checked;
        $('.row-checkbox').prop('checked', isChecked).trigger('change');
    });

    function updateCheckAllState() {
        const total = $('.row-checkbox').length;
        const checked = $('.row-checkbox:checked').length;
        $('#checkAllRows').prop('checked', total > 0 && total === checked);
    }

    function clearRows() {
        $('#tableItems tbody').empty();
        $('#checkAllRows').prop('checked', false);
    }

    function collectRows() {
        const rows = [];
        $('#tableItems tbody tr').each(function () {
            // Hanya ambil baris yang dicentang
            if (!$(this).find('.row-checkbox').is(':checked')) {
                return;
            }

            const row = {};
            $(this).find('[data-field]').each(function () {
                row[$(this).data('field')] = $(this).val();
            });
            rows.push(row);
        });
        return rows;
    }

    /* ------------------------------------------------------------------
     * Cari data ke database server PUSAT berdasarkan Doc Number (read-only)
     * ------------------------------------------------------------------ */
    $('#doc_number').on('keypress', function (e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
            $('#btnSearchDoc').click();
        }
    });

    $('#btnSearchDoc').on('click', function () {
        const docNumber = $('#doc_number').val().trim();
        if (!docNumber) {
            alert('Doc Number wajib diisi.');
            return;
        }

        const $btn = $(this).prop('disabled', true).text('Mencari...');

        $.post(BASE_URL + 'print-form/search-doc', { doc_number: docNumber }, null, 'json')
            .done(function (res) {
                if (!res.success) {
                    alert(res.message || 'Doc Number tidak ditemukan.');
                    return;
                }

                $('#customer').val(res.customer || '');
                clearRows();
                (res.items || []).forEach(function (item) {
                    addRow(item);
                });
            })
            .fail(function () {
                alert('Gagal menghubungi server. Cek koneksi / konfigurasi database pusat.');
            })
            .always(function () {
                $btn.prop('disabled', false).text('Cari');
            });
    });

    /* ------------------------------------------------------------------
     * Preview: simpan form ke DB, lalu buka PDF preview di tab baru
     * ------------------------------------------------------------------ */
    $('#btnPreview').on('click', function () {
        const $btn = $(this).prop('disabled', true).text('Menyimpan...');

        saveForm(function (headerId) {
            window.open(BASE_URL + 'print-form/preview/' + headerId, '_blank');
        }, function () {
            // error sudah ditampilkan di dalam saveForm
        }, function () {
            $btn.prop('disabled', false).text('Preview');
        });
    });

    /* ------------------------------------------------------------------
     * Simpan & Print: simpan form ke DB, lalu buka PDF print di tab baru
     * ------------------------------------------------------------------ */
    $('#formPrint').on('submit', function (e) {
        e.preventDefault();

        const $btn = $('#btnSave').prop('disabled', true).text('Menyimpan...');

        saveForm(function (headerId) {
            window.open(BASE_URL + 'print-form/print/' + headerId, '_blank');
        }, function () {
            // error sudah ditampilkan di dalam saveForm
        }, function () {
            $btn.prop('disabled', false).text('Simpan & Print');
        });
    });

    /* ------------------------------------------------------------------
     * Fungsi internal: kirim form ke server (store), panggil callback
     * dengan header_id jika sukses.
     * ------------------------------------------------------------------ */
    function saveForm(onSuccess, onError, onAlways) {
        const payload = {
            doc_number:    $('#doc_number').val(),
            customer:      $('#customer').val(),
            product_name:  $('input[name="product_name"]:checked').val(),
            date_mode:     $('input[name="date_mode"]:checked').val(),
            production_date: $('#production_date').val(),
            job_order:     $('#job_order').val(),
            shift_id:      $('#shift_id').val(),
            line_mode:     $('input[name="line_mode"]:checked').val(),
            line_id:       $('#line_id').val(),
            mold_id:       $('#mold_id').val(),
            cavity_id:     $('#cavity_id').val(),
            from_series:   $('#from_series').val(),
            remark:        $('#remark').val(),
            user_initial:  $('#user_initial').val(),
            lot_guarantee: $('#lot_guarantee').is(':checked') ? 1 : 0,
            lot_sa:        $('#lot_sa').is(':checked') ? 1 : 0,
            flag_4m:       $('#flag_4m').is(':checked') ? 1 : 0,
            size_mode:     $('#size_mode').val(),
            items:         JSON.stringify(collectRows()),
        };

        const parsedItems = JSON.parse(payload.items);
        if (parsedItems.length === 0) {
            alert('Silakan centang minimal 1 baris data yang ingin dicetak.');
            if (typeof onAlways === 'function') onAlways();
            return;
        }

        $.post(BASE_URL + 'print-form/store', payload)
            .done(function (res) {
                if (!res.success) {
                    let msg = res.message || 'Gagal menyimpan.';
                    if (res.errors) {
                        msg += '\n' + Object.values(res.errors).join('\n');
                    }
                    alert(msg);
                    if (typeof onError === 'function') onError();
                    return;
                }
                if (typeof onSuccess === 'function') onSuccess(res.header_id);
            })
            .fail(function () {
                alert('Gagal menghubungi server.');
                if (typeof onError === 'function') onError();
            })
            .always(function () {
                if (typeof onAlways === 'function') onAlways();
            });
    }
});
