<?php
require 'vendor/autoload.php';
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;

try {
    $result = Builder::create()
        ->writer(new PngWriter())
        ->data('ITEM-001-XYZ|015269071EZ890|500|ZABK2M4FU0EMRNHJ|')
        ->encoding(new Encoding('UTF-8'))
        ->size(65)
        ->margin(2)
        ->build();
    echo 'OK length: ' . strlen($result->getDataUri());
} catch (\Throwable $e) {
    echo 'ERR: ' . $e->getMessage();
}
