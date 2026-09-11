<?= $this->include('templates/header') ?>

<div class="page-wrapper">
<div class="global-container">

    <!-- ── Card Header ─────────────────────────────────────────────────── -->
    <div class="card-header-bar">
        <div>
            <div class="page-title">
                <span class="title-icon">🖨️</span>
                Form Print QR Code Label
            </div>
            <div class="page-subtitle">Cari dokumen SAP, isi data, lalu cetak label.</div>
        </div>
    </div>

    <div class="card-body-pad">
    <form id="formPrint">

        <!-- ── Search Panel ──────────────────────────────────────────── -->
        <div class="search-panel">
            <div class="search-panel-left">
                <span class="fl">Doc Number</span>
                <input type="text" class="fi" id="doc_number" name="doc_number" style="width:220px;" placeholder="Ketik nomor dokumen...">
                <button type="button" class="btn-desktop btn-primary-glow" id="btnSearchDoc">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="<?= base_url('print-form') ?>" class="btn-desktop btn-outline-modern">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
            <div class="search-panel-right">
                <span class="fl">Customer</span>
                <select class="fi" id="customer" name="customer" style="width:260px;">
                    <option value="">-- Pilih Customer --</option>
                </select>
            </div>
            <input type="hidden" id="doc_date" name="doc_date" value="">
        </div>

        <!-- ── Main Form ─────────────────────────────────────────────── -->
        <div class="row g-0" style="margin-bottom:14px;">
            <!-- Left Col -->
            <div class="col-4" style="padding-right:16px;">

                <div class="row-item omron-only" style="display:none;">
                    <span class="lbl-width" style="font-weight:700;">Omron Label</span>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input omron-label-type" type="radio" name="omron_label_type" id="omron_inner" value="inner" checked>
                            <label class="form-check-label" for="omron_inner">Inner</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input omron-label-type" type="radio" name="omron_label_type" id="omron_outer" value="outer">
                            <label class="form-check-label" for="omron_outer">Outer</label>
                        </div>
                    </div>
                </div>

                <div class="row-item user-initial-container" style="display:flex;">
                    <span class="lbl-width-long" style="line-height:1.3;">
                        User Initial Name<br>
                        <span style="font-size:11px; color:#6b7280; font-weight:400;">(3 Digit Char)</span>
                    </span>
                    <input type="text" class="fi upper-input" id="user_initial" name="user_initial" maxlength="3" style="width:60px;">
                </div>

                <div class="row-item omron-extra-fields" style="display:none;">
                    <span class="lbl-width-long">Notification</span>
                    <select class="fi" id="notification" name="notification" style="width:160px;">
                        <option value="RE-DELIVERY">RE-DELIVERY</option>
                        <option value="DESIGN CHANGE">DESIGN CHANGE</option>
                        <option value="FIRST RUN">FIRST RUN</option>
                        <option value="IFC">IFC</option>
                        <option value="PROCESS CHANGE">PROCESS CHANGE</option>
                        <option value="SAMPLE">SAMPLE</option>
                        <option value="SAR">SAR</option>
                    </select>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span class="lbl-width">Product Name</span>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_name" id="product_ijp" value="IJP" checked>
                            <label class="form-check-label" for="product_ijp">IJP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_name" id="product_bs" value="BS">
                            <label class="form-check-label" for="product_bs">BS</label>
                        </div>
                    </div>
                </div>

                <div class="row-item production-date-container" style="display:none;">
                    <span style="width:110px; text-align:right; margin-right:10px;" class="radio-lbl">
                        <input class="form-check-input date-mode-radio me-1" type="radio" name="date_mode" value="production_date" checked>
                        Production Date
                    </span>
                    <input type="date" class="fi" id="production_date" name="production_date" style="flex:1;">
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span class="lbl-width">Shift</span>
                    <input type="text" class="fi" id="shift_id" name="shift_id" list="epson_shift_list" style="flex:1;" autocomplete="off" placeholder="Pilih / Ketik">
                    <datalist id="epson_shift_list">
                        <?php foreach ($shifts as $s): ?>
                            <option value="<?= esc($s['id']) ?> - <?= esc($s['shift_name']) ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span style="width:110px; text-align:right; margin-right:10px;" class="radio-lbl">
                        <input class="form-check-input line-mode-radio me-1" type="radio" name="line_mode" value="line" checked>
                        Line
                    </span>
                    <input type="text" class="fi" id="line_id" name="line_id" list="epson_line_list" style="flex:1;" autocomplete="off" placeholder="Pilih">
                    <datalist id="epson_line_list">
                        <?php foreach ($lines as $l): ?>
                            <option value="<?= esc($l['id']) ?> - <?= esc($l['line_name']) ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span class="lbl-width">From Series</span>
                    <input type="text" class="fi upper-input" id="from_series" name="from_series" maxlength="4" style="flex:1;">
                </div>
            </div>

            <!-- Middle Col -->
            <div class="col-5" style="padding-right:16px;">

                <div class="row-item epson-only" style="display:none;">
                    <span style="width:100px; text-align:right; margin-right:10px;" class="radio-lbl">
                        <input class="form-check-input date-mode-radio me-1" type="radio" name="date_mode" value="job_order">
                        Job Order
                    </span>
                    <input type="text" class="fi" id="job_order" name="job_order" disabled style="width:200px;">
                </div>

                <div class="row-item epson-only" style="margin-top:26px; display:none;">
                    <span style="width:100px; text-align:right; margin-right:10px;" class="radio-lbl">
                        <input class="form-check-input line-mode-radio me-1" type="radio" name="line_mode" value="mold_cavity">
                        Mold-Cavity
                    </span>
                    <input type="text" class="fi me-2" id="mold_id" name="mold_id" list="epson_mold_list" disabled style="width:95px;" autocomplete="off" placeholder="Pilih">
                    <datalist id="epson_mold_list">
                        <?php foreach ($molds as $m): ?>
                            <option value="<?= esc($m['id']) ?> - <?= esc($m['mold_name']) ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                    <span class="mx-1 fl">-</span>
                    <input type="text" class="fi" id="cavity_id" name="cavity_id" list="epson_cavity_list" disabled style="width:95px;" autocomplete="off" placeholder="Pilih">
                    <datalist id="epson_cavity_list">
                        <?php foreach ($cavities as $c): ?>
                            <option value="<?= esc($c['id']) ?> - <?= esc($c['cavity_name']) ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span style="width:100px; text-align:right; margin-right:10px;" class="radio-lbl">Remark</span>
                    <input type="text" class="fi" id="remark" name="remark" style="width:200px;">
                </div>

                <div class="omron-extra-fields" style="display:none; flex-direction:column;">
                    <div class="row-item">
                        <span style="width:60px; margin-right:10px;" class="radio-lbl">Cavity</span>
                        <input type="text" class="fi" id="omron_cavity" name="omron_cavity" list="omron_cavity_list" style="width:150px;" autocomplete="off">
                        <datalist id="omron_cavity_list">
                            <?php foreach ($cavities as $c): ?>
                                <option value="<?= esc($c['cavity_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item">
                        <span style="width:60px; margin-right:10px;" class="radio-lbl">Machine</span>
                        <input type="text" class="fi" id="machine" name="machine" list="omron_machine_list" style="width:150px;" autocomplete="off">
                        <datalist id="omron_machine_list">
                            <?php foreach ($lines as $l): ?>
                                <option value="<?= esc($l['line_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item">
                        <span style="width:60px; margin-right:10px;" class="radio-lbl">Shift</span>
                        <input type="text" class="fi" id="omron_shift" name="omron_shift" list="omron_shift_list" style="width:150px;" autocomplete="off">
                        <datalist id="omron_shift_list">
                            <?php foreach ($shifts as $s): ?>
                                <option value="<?= esc($s['shift_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
            </div>

            <!-- Right Col -->
            <div class="col-3">
                <div class="epson-only" style="display:none; flex-direction:column; height:100%;">
                    <fieldset class="groupbox h-100" style="margin-bottom:0;">
                        <legend class="groupbox-legend">Additional</legend>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="lot_guarantee" name="lot_guarantee" value="1">
                            <label class="form-check-label" for="lot_guarantee">Lot Guarantee</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="lot_sa" name="lot_sa" value="1">
                            <label class="form-check-label" for="lot_sa">Lot SA</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flag_4m" name="flag_4m" value="1">
                            <label class="form-check-label" for="flag_4m">4M</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <!-- ── Omron Outer Form ─────────────────────────────────────── -->
        <div id="omronOuterForm" style="display:none;">
            <div class="row">
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Omron</label>
                        <select class="fi flex-grow-1" id="omron_item_code"></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Vendor</label>
                        <input type="text" class="fi flex-grow-1" id="omron_item_vendor" readonly style="background:#f3f4f6;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row-item">
                        <label class="lbl-omron">Item Name</label>
                        <input type="text" class="fi flex-grow-1" id="omron_item_name" readonly style="background:#f3f4f6;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron">Material No</label><input type="text" class="fi flex-grow-1" id="omron_material_no" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Material Name</label><input type="text" class="fi flex-grow-1" id="omron_material_name" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Unit</label><input type="text" class="fi flex-grow-1" id="omron_unit" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron">Std. Packing</label><input type="text" class="fi flex-grow-1" id="omron_std_packing" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Cavity</label><input type="text" class="fi flex-grow-1" id="omron_outer_cavity" list="omron_cavity_list" autocomplete="off"></div>
                </div>
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron">Production Date</label><input type="date" class="fi flex-grow-1" id="omron_production_date"></div>
                    <div class="row-item"><label class="lbl-omron">DWG No.</label><input type="text" class="fi flex-grow-1" id="omron_dwg_no" readonly style="background:#f3f4f6;"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Shift</label><input type="text" class="fi flex-grow-1" id="omron_outer_shift" list="omron_shift_list" autocomplete="off"></div>
                    <div class="row-item"><label class="lbl-omron">Machine</label><input type="text" class="fi flex-grow-1" id="omron_machine" list="omron_machine_list" autocomplete="off"></div>
                    <div class="row-item"><label class="lbl-omron">Qty in Carton</label><input type="text" class="fi flex-grow-1" id="omron_qty_carton" readonly style="background:#f3f4f6;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><div class="row-item"><label class="lbl-omron">Remark</label><input type="text" class="fi flex-grow-1" id="omron_remark" readonly style="background:#f3f4f6;"></div></div>
                <div class="col-md-12"><div class="row-item"><label class="lbl-omron">Maker</label><input type="text" class="fi flex-grow-1" id="omron_maker" readonly style="background:#f3f4f6;"></div></div>
            </div>
            <div class="d-flex align-items-center gap-4 mt-2" style="margin-left:140px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="omron_lot_guarantee">
                    <label class="form-check-label fw-bold" for="omron_lot_guarantee">Lot Guarantee</label>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="fl fw-bold">Die No</label>
                    <select class="fi" style="width:70px;" id="omron_die_no">
                        <option value="-">-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="row-item"><label class="lbl-omron fw-bold">Lot No</label><input type="text" class="fi flex-grow-1" id="omron_lot_no"></div>
                    <div class="row-item"><label class="lbl-omron fw-bold">Quantity</label><input type="text" class="fi flex-grow-1" id="omron_quantity"></div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Notification</label>
                        <select class="fi flex-grow-1" id="omron_notification">
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
        </div>

        <!-- ── Data Grid ─────────────────────────────────────────────── -->
        <div class="grid-container" id="dataGridContainer">
            <table class="grid-table" id="tableItems">
                <thead>
                    <tr>
                        <th style="width:36px; text-align:center;">
                            <input type="checkbox" id="checkAllRows">
                        </th>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th style="width:80px;">Quantity</th>
                        <th>Lotno</th>
                        <th class="col-whs">Warehouse</th>
                        <th class="col-backno">Back No</th>
                        <th class="col-stdpack">Standard Pack</th>
                        <th class="col-operator">Operator</th>
                        <th class="col-postingdate" style="display:none;">Posting Date</th>
                        <th style="width:28px;"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- ── Bottom Action Bar ─────────────────────────────────────── -->
        <div class="bottom-bar">
            <div class="d-flex align-items-center gap-2">
                <span class="fl">Size Mode</span>
                <select class="fi" id="size_mode" name="size_mode" style="width:160px;">
                    <option value="Small">Small</option>
                    <option value="Medium/Epson">Medium/Epson</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="Large">Large</option>
                    <option value="Yamaha">Yamaha</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn-desktop btn-outline-modern" id="btnDirectPrint">
                    <i class="bi bi-printer"></i> Print Label
                </button>
                <button type="button" class="btn-desktop btn-success-modern" id="btnSaveToDb" style="display:none;">
                    <i class="bi bi-floppy"></i> Save
                </button>
            </div>
        </div>

    </form>
    </div><!-- /card-body-pad -->
</div><!-- /global-container -->
</div><!-- /page-wrapper -->

<template id="rowTemplate">
    <tr>
        <td style="text-align:center; padding-top:6px;">
            <input type="checkbox" class="row-checkbox">
        </td>
        <td><input type="text" data-field="item_code"></td>
        <td><input type="text" data-field="description"></td>
        <td><input type="text" data-field="quantity"></td>
        <td><input type="text" data-field="lotno"></td>
        <td class="col-whs"><input type="text" data-field="warehouse"></td>
        <td class="col-backno"><input type="text" data-field="back_no"></td>
        <td class="col-stdpack"><input type="text" data-field="standard_pack"></td>
        <td class="col-operator"><input type="text" data-field="operator"></td>
        <td class="col-postingdate" style="display:none;"><input type="text" data-field="doc_date" readonly class="locked-field"></td>
        <td style="text-align:center; padding:4px;">
            <button type="button" class="btn-desktop btn-danger-modern btnRemoveRow" style="min-width:auto;">&times;</button>
        </td>
    </tr>
</template>

<?= $this->include('templates/footer') ?>

<script>
    const BASE_URL = <?= json_encode(base_url()) ?>;
</script>
<script src="<?= base_url('assets/js/print_form.js?v=' . time()) ?>"></script>
