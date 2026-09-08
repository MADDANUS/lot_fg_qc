$(function () {
    /* ------------------------------------------------------------------
     * Lookup map: ItemCode → [ {CardCode, CardName}, ... ]
     * Diisi saat halaman load dari endpoint get-customers.
     * ------------------------------------------------------------------ */
    let customerMap = {};    // { 'ITEM-001': [{CardCode:'C1', CardName:'PT. A'},...] }
    let allCustomers = [];   // [ {CardCode, CardName}, ... ] unik, untuk reset dropdown

    /* ------------------------------------------------------------------
     * Load semua customer dari SAP B1 saat halaman pertama kali dibuka
     * ------------------------------------------------------------------ */
    function loadCustomers() {
        const $sel = $('#customer');
        $sel.html('<option value="">-- Memuat customer... --</option>').prop('disabled', true);

        $.get(BASE_URL + 'print-form/get-customers')
            .done(function (res) {
                if (!res.success || !res.data || res.data.length === 0) {
                    $sel.html('<option value="">-- Tidak ada customer --</option>').prop('disabled', false);
                    return;
                }

                // Bangun lookup map: ItemCode → [{CardCode, CardName}]
                customerMap = {};
                const uniqueCustomers = {};

                res.data.forEach(function (row) {
                    const ic  = row.ItemCode;
                    const cc  = row.CardCode;
                    const cn  = row.CardName;

                    if (!customerMap[ic]) customerMap[ic] = [];

                    // Hindari duplikat per ItemCode
                    const alreadyIn = customerMap[ic].some(c => c.CardCode === cc);
                    if (!alreadyIn) customerMap[ic].push({ CardCode: cc, CardName: cn });

                    // Kumpulkan semua customer unik (untuk populate dropdown penuh)
                    if (!uniqueCustomers[cc]) uniqueCustomers[cc] = cn;
                });

                allCustomers = Object.entries(uniqueCustomers)
                    .map(([code, name]) => ({ CardCode: code, CardName: name }))
                    .sort((a, b) => a.CardName.localeCompare(b.CardName));

                // Isi dropdown dengan semua customer
                populateCustomerDropdown(allCustomers);
                $sel.prop('disabled', false);
            })
            .fail(function () {
                $sel.html('<option value="">-- Gagal memuat customer --</option>').prop('disabled', false);
            });
    }

    /** Isi ulang <select #customer> dengan daftar customer yang diberikan */
    function populateCustomerDropdown(customers) {
        const $sel = $('#customer');
        const currentVal = $sel.val();

        let html = '<option value="">-- Pilih Customer --</option>';
        customers.forEach(function (c) {
            const sel = c.CardCode === currentVal ? ' selected' : '';
            html += `<option value="${escHtml(c.CardCode)}"${sel}>${escHtml(c.CardName)}</option>`;
        });
        $sel.html(html);
    }

    /** Escape HTML sederhana untuk nilai option */
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // Jalankan load saat halaman siap
    loadCustomers();

    /* ------------------------------------------------------------------
     * Toggle: Production Date <-> Job Order (hanya salah satu yang aktif)
     * ------------------------------------------------------------------ */
    $('.date-mode-radio').on('change', function () {
        const mode = $('input[name="date_mode"]:checked').val();
        $('#production_date').prop('disabled', mode !== 'production_date');
        $('#job_order').prop('disabled', mode !== 'job_order');
    });

    /* ------------------------------------------------------------------
     * Toggle: Line <-> Mold + Cavity (hanya salah satu yang aktif)
     * ------------------------------------------------------------------ */
    $('.line-mode-radio').on('change', function () {
        const mode = $('input[name="line_mode"]:checked').val();
        $('#line_id').prop('disabled', mode !== 'line');
        $('#mold_id, #cavity_id').prop('disabled', mode !== 'mold_cavity');
    });

    /* ------------------------------------------------------------------
     * Auto uppercase untuk From Series & User Initial Name
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
    function addRow(data, isLocked = false) {
        data = data || {};
        const tpl = document.getElementById('rowTemplate');
        const clone = tpl.content.cloneNode(true);
        const $row = $(clone).find('tr');

        $row.addClass('selected-row');
        $row.find('.row-checkbox').prop('checked', true);

        $row.find('[data-field]').each(function () {
            const field = $(this).data('field');
            if (data[field] !== undefined) {
                $(this).val(data[field]);
            }
            
            // Lock fields except qty and standard pack if populated from SAP
            if (isLocked && field !== 'quantity' && field !== 'standard_pack') {
                $(this).prop('readonly', true).addClass('locked-field');
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
            if (!$(this).find('.row-checkbox').is(':checked')) return;
            const row = {};
            $(this).find('[data-field]').each(function () {
                row[$(this).data('field')] = $(this).val();
            });
            rows.push(row);
        });
        return rows;
    }

    /* ------------------------------------------------------------------
     * Cari data ke SAP B1 berdasarkan Doc Number (read-only)
     * Setelah dapat hasil:
     *  1. Auto-fill Production Date dari DocDate
     *  2. Filter dropdown Customer dari ItemCode yang ada di hasil
     *  3. Isi grid dengan item-item dari OIGN
     * ------------------------------------------------------------------ */
    $('#doc_number').on('keypress', function (e) {
        if (e.which === 13) {
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
                    // Reset customer dropdown ke semua customer
                    populateCustomerDropdown(allCustomers);
                    return;
                }

                // 1. Simpan DocDate SAP ke hidden field (untuk ditampilkan di PDF DATE)
                // Production Date di form tetap sebagai tanggal cetak (tidak di-overwrite)
                if (res.doc_date) {
                    $('#doc_date').val(res.doc_date);
                    $('#production_date').val(res.doc_date);
                }

                // 2. Filter dropdown Customer berdasarkan ItemCode yang ditemukan
                const itemCodes = res.item_codes || [];
                if (itemCodes.length > 0 && Object.keys(customerMap).length > 0) {
                    // Kumpulkan semua customer yang relevan dengan ItemCode-ItemCode ini
                    const relevantMap = {};
                    itemCodes.forEach(function (ic) {
                        const customers = customerMap[ic] || [];
                        customers.forEach(function (c) {
                            if (!relevantMap[c.CardCode]) relevantMap[c.CardCode] = c.CardName;
                        });
                    });

                    const filteredCustomers = Object.entries(relevantMap)
                        .map(([code, name]) => ({ CardCode: code, CardName: name }))
                        .sort((a, b) => a.CardName.localeCompare(b.CardName));

                    if (filteredCustomers.length > 0) {
                        populateCustomerDropdown(filteredCustomers);
                        // Auto-select jika hanya 1 customer
                        if (filteredCustomers.length === 1) {
                            $('#customer').val(filteredCustomers[0].CardCode);
                        }
                    } else {
                        // Tidak ada match di lookup — tampilkan semua
                        populateCustomerDropdown(allCustomers);
                    }
                }

                // 3. Isi grid dengan items dari OIGN
                clearRows();
                (res.items || []).forEach(function (item) {
                    // Buang trailing zeros dari SAP (misal 400.000000 -> 400)
                    let qty = parseFloat(item.Quantity) || 0;
                    let stdPack = parseFloat(item.U_MIS_StdPacking) || 0;

                    // Map nama kolom SAP B1 ke nama field di grid
                    addRow({
                        item_code    : item.ItemCode,
                        description  : item.Dscription,
                        quantity     : qty,
                        lotno        : item.U_MIS_LotNo,
                        warehouse    : item.WhsCode,
                        back_no      : item.U_MIS_BackNo,
                        standard_pack: stdPack,
                        operator     : item.U_MIS_Operator,
                    }, true); // parameter `true` untuk mengunci kolom selain qty & stdPack
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
        }, function () {}, function () {
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
        }, function () {}, function () {
            $btn.prop('disabled', false).text('Simpan & Print');
        });
    });

    /* ------------------------------------------------------------------
     * Fungsi internal: kirim form ke server (store)
     * ------------------------------------------------------------------ */
    function saveForm(onSuccess, onError, onAlways) {
        const payload = {
            doc_number:      $('#doc_number').val(),
            customer:        $('#customer option:selected').text() || '',  // CardName (nama PT)
            doc_date:        $('#doc_date').val(),          // DocDate dari SAP (untuk label DATE)
            product_name:    $('input[name="product_name"]:checked').val(),
            date_mode:       $('input[name="date_mode"]:checked').val(),
            production_date: $('#production_date').val(),
            job_order:       $('#job_order').val(),
            shift_id:        $('#shift_id').val(),
            line_mode:       $('input[name="line_mode"]:checked').val(),
            line_id:         $('#line_id').val(),
            mold_id:         $('#mold_id').val(),
            cavity_id:       $('#cavity_id').val(),
            from_series:     $('#from_series').val(),
            remark:          $('#remark').val(),
            user_initial:    $('#user_initial').val(),
            lot_guarantee:   $('#lot_guarantee').is(':checked') ? 1 : 0,
            lot_sa:          $('#lot_sa').is(':checked') ? 1 : 0,
            flag_4m:         $('#flag_4m').is(':checked') ? 1 : 0,
            size_mode:       $('#size_mode').val(),
            items:           JSON.stringify(collectRows()),
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
                    if (res.errors) msg += '\n' + Object.values(res.errors).join('\n');
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
