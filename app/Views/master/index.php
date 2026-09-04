<?= $this->include('templates/header') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="card-title mb-4">Master Data</h4>

        <ul class="nav nav-tabs" id="masterTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-type="shift" data-bs-toggle="tab" data-bs-target="#tab-shift" type="button">Shift</button></li>
            <li class="nav-item"><button class="nav-link" data-type="line" data-bs-toggle="tab" data-bs-target="#tab-line" type="button">Line</button></li>
            <li class="nav-item"><button class="nav-link" data-type="mold" data-bs-toggle="tab" data-bs-target="#tab-mold" type="button">Mold</button></li>
            <li class="nav-item"><button class="nav-link" data-type="cavity" data-bs-toggle="tab" data-bs-target="#tab-cavity" type="button">Cavity</button></li>
        </ul>

        <div class="tab-content border border-top-0 p-3">
            <!-- Shift -->
            <div class="tab-pane fade show active" id="tab-shift">
                <?= view('master/_tab', ['type' => 'shift', 'label' => 'Shift Name', 'manualId' => false]) ?>
            </div>
            <!-- Line -->
            <div class="tab-pane fade" id="tab-line">
                <?= view('master/_tab', ['type' => 'line', 'label' => 'Line Name', 'manualId' => true]) ?>
            </div>
            <!-- Mold -->
            <div class="tab-pane fade" id="tab-mold">
                <?= view('master/_tab', ['type' => 'mold', 'label' => 'Mold Name', 'manualId' => false]) ?>
            </div>
            <!-- Cavity -->
            <div class="tab-pane fade" id="tab-cavity">
                <?= view('master/_tab', ['type' => 'cavity', 'label' => 'Cavity Name', 'manualId' => false]) ?>
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="<?= base_url('print-form') ?>" class="btn btn-outline-dark">Close</a>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<script>
    const BASE_URL = <?= json_encode(base_url()) ?>;
</script>
<script src="<?= base_url('assets/js/master.js') ?>"></script>
