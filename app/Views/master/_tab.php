<div class="row g-2 align-items-end mb-3 master-form" data-type="<?= esc($type) ?>" data-manual-id="<?= $manualId ? '1' : '0' ?>">
    <?php if ($manualId): ?>
        <div class="col-md-2">
            <label class="form-label">ID</label>
            <input type="text" class="form-control form-control-sm input-id" maxlength="5" placeholder="mis. CG">
        </div>
    <?php endif; ?>
    <div class="col-md-4">
        <label class="form-label"><?= esc($label) ?></label>
        <input type="text" class="form-control form-control-sm input-name" placeholder="<?= esc($label) ?>">
    </div>
    <div class="col-md-3">
        <input type="hidden" class="input-edit-id" value="">
        <button type="button" class="btn btn-sm btn-primary btn-save-row">Save</button>
        <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel-edit d-none">Batal Edit</button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover master-table" data-type="<?= esc($type) ?>">
        <thead class="table-light">
        <tr>
            <th style="width:100px">ID</th>
            <th><?= esc($label) ?></th>
            <th style="width:120px">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <!-- diisi via AJAX -->
        </tbody>
    </table>
</div>
