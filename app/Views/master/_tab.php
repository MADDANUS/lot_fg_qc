<div class="tab-header-row" data-type="<?= esc($type) ?>" data-manual-id="<?= $manualId ? '1' : '0' ?>">
    <h4 class="tab-header-title">
        <?= esc($label) ?>
    </h4>
    <button type="button"
            class="canva-btn-add"
            onclick="openMasterModal('<?= esc($type) ?>', '<?= esc($label) ?>', <?= $manualId ? 'true' : 'false' ?>)">
        <i class="bi bi-plus-lg"></i> Tambah
    </button>
</div>

<div class="master-table-wrapper">
    <div class="table-responsive">
        <table class="table table-borderless master-table" data-type="<?= esc($type) ?>">
            <thead>
            <tr>
                <th style="width:120px">ID</th>
                <th><?= esc($label) ?></th>
                <th style="width:120px; text-align:center;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <!-- diisi via AJAX -->
            </tbody>
        </table>
    </div>
</div>