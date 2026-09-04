<?php
require 'vendor/autoload.php';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load('TEMPLATE lot fg qc OKE.xlsx');
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
$writer->save('test_excel.html');
echo "Saved!";
