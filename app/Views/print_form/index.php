<?= $this->include('templates/header') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

/* --- Premium Modern Desktop Styles --- */
body {
    background-color: #f1f5f9 !important; /* Soft slate background */
}
.desktop-app {
    background-color: #ffffff;
    color: #334155;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
    min-width: 950px;
    margin: 20px auto;
    border: 1px solid #e2e8f0;
}
.desktop-title {
    font-size: 26px;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 24px;
    letter-spacing: -0.5px;
}
fieldset.groupbox {
    border: 1px solid #cbd5e1;
    padding: 20px 20px 15px 20px;
    margin-bottom: 24px;
    border-radius: 12px;
    background-color: #f8fafc;
    position: relative;
    box-shadow: inset 0 2px 4px 0 rgba(0,0,0,0.01);
}
legend.groupbox-legend {
    font-size: 13px;
    font-weight: 600;
    color: #3b82f6;
    background-color: #e0f2fe;
    padding: 4px 12px;
    border-radius: 20px;
    width: auto;
    margin-bottom: 0;
    float: none;
    line-height: 1.2;
    border: 1px solid #bae6fd;
}
.row-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}
.lbl-width {
    width: 110px;
    text-align: right;
    margin-right: 12px;
    font-weight: 500;
    color: #475569;
}
.lbl-omron {
    width: 140px;
    text-align: right;
    margin-right: 12px;
    font-weight: 500;
    color: #475569;
}
.lbl-width-long {
    width: 200px;
    text-align: right;
    margin-right: 12px;
    font-weight: 500;
    color: #475569;
}
.form-control-desktop, .form-select-desktop {
    height: 32px;
    padding: 4px 12px;
    font-size: 13px;
    color: #0f172a;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    background-color: #ffffff;
    transition: all 0.2s ease;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.form-control-desktop:focus, .form-select-desktop:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}
.form-control-desktop:disabled, .form-select-desktop:disabled {
    background-color: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
}
.form-check-input {
    width: 16px;
    height: 16px;
    cursor: pointer;
}
.form-check-input:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}
.form-check-label {
    margin-left: 6px;
    font-weight: 500;
    color: #475569;
    cursor: pointer;
}
.radio-lbl {
    font-weight: 500;
    color: #475569;
}
.grid-container {
    height: 220px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background-color: #ffffff;
    overflow-y: scroll;
    margin-bottom: 24px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}
.grid-table {
    width: 100%;
    border-collapse: collapse;
}
.grid-table th {
    background-color: #f8fafc;
    color: #334155;
    border-right: 1px solid #e2e8f0;
    border-bottom: 1px solid #cbd5e1;
    padding: 8px 12px;
    font-weight: 600;
    font-size: 13px;
    text-align: left;
    position: sticky;
    top: 0;
    z-index: 1;
    box-shadow: 0 1px 0 #cbd5e1;
}
.grid-table td {
    border-right: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    padding: 0;
    transition: background-color 0.15s;
}
.grid-table td input {
    width: 100%;
    border: none;
    height: 32px;
    padding: 4px 12px;
    background-color: transparent;
    outline: none;
    font-size: 13px;
    color: #1e293b;
}
.grid-table tr:hover td {
    background-color: #f1f5f9;
}
.grid-table tr:focus-within td {
    background-color: #e0f2fe;
}
.grid-table tr.selected-row td {
    background-color: #dbeafe; /* highlight color for selected row */
}
.grid-table tr.selected-row td input[type="text"] {
    color: #0369a1;
    font-weight: 500;
}
.grid-table tr:focus-within td input[type="text"] {
    color: #0369a1;
    font-weight: 500;
}
/* Beautiful Buttons */
.btn-desktop {
    padding: 6px 20px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    min-width: 90px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-primary-glow {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white !important;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    border: none;
}
.btn-primary-glow:hover {
    background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
    box-shadow: 0 6px 14px rgba(37, 99, 235, 0.4);
    transform: translateY(-1px);
}
.btn-outline-modern {
    background-color: #ffffff;
    color: #475569 !important;
    border: 1px solid #cbd5e1;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.btn-outline-modern:hover {
    background-color: #f8fafc;
    color: #0f172a !important;
    border-color: #94a3b8;
}
.btn-danger-modern {
    background-color: #fef2f2;
    color: #ef4444;
    border: 1px solid #fecaca;
    border-radius: 4px;
}
.btn-danger-modern:hover {
    background-color: #fee2e2;
    color: #b91c1c;
    border-color: #fca5a5;
}
.locked-field {
    background-color: #f1f5f9 !important;
    color: #64748b !important;
    cursor: not-allowed !important;
}
</style>

<div class="desktop-app">
    <div class="desktop-title">Form Print QR Code Label</div>

    <form id="formPrint">
        <!-- Search Box -->
        <fieldset class="groupbox">
            <legend class="groupbox-legend">Search</legend>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <label class="me-3 radio-lbl">Doc Number :</label>
                    <input type="text" class="form-control-desktop me-3" id="doc_number" name="doc_number" style="width: 250px;" placeholder="Ketik lalu cari...">
                    <button type="button" class="btn-desktop btn-primary-glow" id="btnSearchDoc">Cari</button>
                </div>
                <div class="d-flex align-items-center">
                    <label class="me-3 radio-lbl">Customer :</label>
                    <select class="form-select-desktop" id="customer" name="customer" style="width: 280px;">
                        <option value="">-- Memuat customer... --</option>
                    </select>
                </div>
            </div>
            <!-- DocDate dari SAP B1 (disimpan saat klik Cari, dikirim ke PDF sebagai DATE) -->
            <input type="hidden" id="doc_date" name="doc_date" value="">
        </fieldset>

        <!-- Main Form -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-4">
                <div class="row-item omron-only" style="display:none; margin-bottom: 15px;">
                    <span class="lbl-width" style="font-weight:bold;">Omron Label</span>
                    <div class="form-check form-check-inline mb-0">
                        <input class="form-check-input omron-label-type" type="radio" name="omron_label_type" id="omron_inner" value="inner" checked>
                        <label class="form-check-label" for="omron_inner">Inner</label>
                    </div>
                    <div class="form-check form-check-inline mb-0">
                        <input class="form-check-input omron-label-type" type="radio" name="omron_label_type" id="omron_outer" value="outer">
                        <label class="form-check-label" for="omron_outer">Outer</label>
                    </div>
                </div>

                <div class="row-item user-initial-container" style="display:flex; margin-bottom: 15px;">
                    <span class="lbl-width-long" style="width: 140px; margin-right: 12px; text-align: right;">User Initial Name (3 Digit Char)</span>
                    <input type="text" class="form-control-desktop upper-input" id="user_initial" name="user_initial" maxlength="3" style="width: 60px;">
                </div>

                <div class="row-item omron-extra-fields" style="display:none; margin-bottom: 15px;">
                    <span class="lbl-width-long" style="width: 140px; margin-right: 12px; text-align: right;">Notification</span>
                    <select class="form-select-desktop" id="notification" name="notification" style="width: 150px;">
                        <option value="RE-DELIVERY" selected>RE-DELIVERY</option>
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
                    <div class="form-check form-check-inline mb-0">
                        <input class="form-check-input" type="radio" name="product_name" id="product_ijp" value="IJP" checked>
                        <label class="form-check-label" for="product_ijp">IJP</label>
                    </div>
                    <div class="form-check form-check-inline mb-0">
                        <input class="form-check-input" type="radio" name="product_name" id="product_bs" value="BS">
                        <label class="form-check-label" for="product_bs">BS</label>
                    </div>
                </div>
                
                <div class="row-item production-date-container" style="display:none;">
                    <span style="width: 110px; text-align: right; margin-right: 12px;" class="radio-lbl">
                        <input class="form-check-input date-mode-radio me-2" type="radio" name="date_mode" value="production_date" checked>
                        Production Date
                    </span>
                    <input type="date" class="form-control-desktop" id="production_date" name="production_date" style="flex:1;">
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span class="lbl-width">Shift</span>
                    <select class="form-select-desktop" id="shift_id" name="shift_id" style="flex:1;">
                        <option value=""></option>
                        <?php foreach ($shifts as $s): ?>
                            <option value="<?= esc($s['id']) ?>"><?= esc($s['shift_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span style="width: 110px; text-align: right; margin-right: 12px;" class="radio-lbl">
                        <input class="form-check-input line-mode-radio me-2" type="radio" name="line_mode" value="line" checked>
                        Line
                    </span>
                    <select class="form-select-desktop" id="line_id" name="line_id" style="flex:1;">
                        <option value=""></option>
                        <?php foreach ($lines as $l): ?>
                            <option value="<?= esc($l['id']) ?>"><?= esc($l['id']) ?> - <?= esc($l['line_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span class="lbl-width">From Series</span>
                    <input type="text" class="form-control-desktop upper-input" id="from_series" name="from_series" maxlength="4" style="flex:1;">
                </div>
            </div>

            <!-- Middle Column -->
            <div class="col-5">
                <div class="row-item epson-only" style="display:none;">
                    <span style="width: 100px; text-align: right; margin-right: 12px;" class="radio-lbl">
                        <input class="form-check-input date-mode-radio me-2" type="radio" name="date_mode" value="job_order">
                        Job Order
                    </span>
                    <input type="text" class="form-control-desktop" id="job_order" name="job_order" disabled style="width: 210px;">
                </div>

                <div class="row-item epson-only" style="margin-top:28px; display:none;"> <!-- spacing for alignment -->
                    <span style="width: 100px; text-align: right; margin-right: 12px;" class="radio-lbl">
                        <input class="form-check-input line-mode-radio me-2" type="radio" name="line_mode" value="mold_cavity">
                        Mold-Cavity
                    </span>
                    <select class="form-select-desktop me-2" id="mold_id" name="mold_id" disabled style="width: 100px;">
                        <option value=""></option>
                        <?php foreach ($molds as $m): ?>
                            <option value="<?= esc($m['id']) ?>"><?= esc($m['mold_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    -
                    <select class="form-select-desktop ms-1" id="cavity_id" name="cavity_id" disabled style="width: 100px;">
                        <option value=""></option>
                        <?php foreach ($cavities as $c): ?>
                            <option value="<?= esc($c['id']) ?>"><?= esc($c['cavity_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row-item epson-only" style="display:none;">
                    <span style="width: 100px; text-align: right; margin-right: 12px;" class="radio-lbl">Remark</span>
                    <input type="text" class="form-control-desktop" id="remark" name="remark" style="width: 210px;">
                </div>

                <div class="omron-extra-fields" style="display:none; flex-direction:column;">
                    <div class="row-item mb-2">
                        <span style="width: 60px; text-align: left; margin-right: 12px;" class="radio-lbl">Cavity</span>
                        <input type="text" class="form-control-desktop" id="omron_cavity" name="omron_cavity" list="omron_cavity_list" style="width: 150px;" autocomplete="off">
                        <datalist id="omron_cavity_list">
                            <?php foreach ($cavities as $c): ?>
                                <option value="<?= esc($c['cavity_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item mb-2">
                        <span style="width: 60px; text-align: left; margin-right: 12px;" class="radio-lbl">Machine</span>
                        <input type="text" class="form-control-desktop" id="machine" name="machine" list="omron_machine_list" style="width: 150px;" autocomplete="off">
                        <datalist id="omron_machine_list">
                            <?php foreach ($lines as $l): ?>
                                <option value="<?= esc($l['line_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="row-item mb-2">
                        <span style="width: 60px; text-align: left; margin-right: 12px;" class="radio-lbl">Shift</span>
                        <input type="text" class="form-control-desktop" id="omron_shift" name="omron_shift" list="omron_shift_list" style="width: 150px;" autocomplete="off">
                        <datalist id="omron_shift_list">
                            <?php foreach ($shifts as $s): ?>
                                <option value="<?= esc($s['shift_name']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
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


        <!-- OMRON OUTER FORM (Hidden by default) -->
        <div id="omronOuterForm" style="display: none; padding: 20px; background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Omron :</label>
                        <select class="form-select-desktop flex-grow-1" id="omron_item_code"></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Item No Vendor :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_item_vendor" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="row-item">
                        <label class="lbl-omron">Item Name :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_item_name" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Material No :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_material_no" readonly>
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">Material Name :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_material_name" readonly>
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">Unit :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_unit" readonly>
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">Std. Packing :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_std_packing" readonly>
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Cavity :</label>
                        <input type="text" class="form-control-desktop flex-grow-1" id="omron_outer_cavity" list="omron_cavity_list" autocomplete="off">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron">Production Date :</label>
                        <input type="date" class="form-control-desktop flex-grow-1" id="omron_production_date">
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">DWG No. :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_dwg_no" readonly>
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Shift :</label>
                        <input type="text" class="form-control-desktop flex-grow-1" id="omron_outer_shift" list="omron_shift_list" autocomplete="off">
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">Machine :</label>
                        <input type="text" class="form-control-desktop flex-grow-1" id="omron_machine" list="omron_machine_list" autocomplete="off">
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron">Qty in Carton :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_qty_carton" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row-item">
                        <label class="lbl-omron">Remark :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_remark" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row-item">
                        <label class="lbl-omron">Maker :</label>
                        <input type="text" class="form-control-desktop flex-grow-1 bg-light" id="omron_maker" readonly>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="form-check" style="margin-left: 152px;">
                        <input class="form-check-input" type="checkbox" id="omron_lot_guarantee">
                        <label class="form-check-label fw-bold" for="omron_lot_guarantee">Lot Guarantee</label>
                    </div>
                    <div class="d-flex align-items-center ms-5">
                        <label class="fw-bold me-2">Die No :</label>
                        <select class="form-select-desktop" style="width: 80px;" id="omron_die_no">
                            <option value="-">-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Lot No :</label>
                        <input type="text" class="form-control-desktop flex-grow-1" id="omron_lot_no">
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Quantity :</label>
                        <input type="text" class="form-control-desktop flex-grow-1" id="omron_quantity">
                    </div>
                    <div class="row-item">
                        <label class="lbl-omron fw-bold">Notification :</label>
                        <select class="form-select-desktop flex-grow-1" id="omron_notification">
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

        <!-- Data Grid -->
        <div class="grid-container" id="dataGridContainer">
            <table class="grid-table" id="tableItems">
                <thead>
                    <tr>
                        <th style="width: 35px; text-align:center;">
                            <input type="checkbox" class="form-check-input" id="checkAllRows">
                        </th>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th style="width: 80px;">Quantity</th>
                        <th>Lotno</th>
                        <th class="col-whs">Warehouse</th>
                        <th class="col-backno">Back No</th>
                        <th class="col-stdpack">Standard Pack</th>
                        <th class="col-operator">Operator</th>
                        <th style="width:25px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- rows via js -->
                </tbody>
            </table>
        </div>

        <!-- Bottom Action Bar -->
        <div class="d-flex justify-content-between align-items-center pt-2">
            <div class="d-flex align-items-center">
                <label class="me-3 radio-lbl">Size Mode :</label>
                <select class="form-select-desktop" id="size_mode" name="size_mode" style="width: 180px;">
                    <option value="Small">Small</option>
                    <option value="Medium/Epson">Medium/Epson</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="Large">Large</option>
                    <option value="Yamaha">Yamaha</option>
                </select>
            </div>
            
            <div class="d-flex gap-3">
                <button type="button" class="btn-desktop btn-outline-modern" id="btnDirectPrint">
                    <i class="bi bi-printer me-2"></i> Print Label
                </button>
                <button type="button" class="btn-desktop btn-primary-glow" id="btnSaveToDb" style="display:none;">
                    <i class="bi bi-save me-2"></i> Save
                </button>
                <a href="<?= base_url('print-form') ?>" class="btn-desktop btn-outline-modern text-decoration-none text-center">Close</a>
            </div>
        </div>
    </form>
</div>

<template id="rowTemplate">
    <tr>
        <td style="text-align:center; padding-top:6px;">
            <input type="checkbox" class="form-check-input row-checkbox">
        </td>
        <td><input type="text" data-field="item_code"></td>
        <td><input type="text" data-field="description"></td>
        <td><input type="text" data-field="quantity"></td>
        <td><input type="text" data-field="lotno"></td>
        <td class="col-whs"><input type="text" data-field="warehouse"></td>
        <td class="col-backno"><input type="text" data-field="back_no"></td>
        <td class="col-stdpack"><input type="text" data-field="standard_pack"></td>
        <td class="col-operator"><input type="text" data-field="operator"></td>
        <td class="text-center" style="padding: 4px;"><button type="button" class="btn-desktop btn-danger-modern btnRemoveRow" style="min-width:auto; padding:2px 8px; font-weight:bold;">&times;</button></td>
    </tr>
</template>

<?= $this->include('templates/footer') ?>

<script>
    const BASE_URL = <?= json_encode(base_url()) ?>;
</script>
<script src="<?= base_url('assets/js/print_form.js?v=' . time()) ?>"></script>
