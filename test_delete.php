<?php
require 'public/index.php'; // Boot CI4
$model = new \App\Models\MitsubaLabelModel();
try {
    $model->whereIn('id', [99999])->delete();
    echo "Delete successful\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
