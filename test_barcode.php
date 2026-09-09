<?php
require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorSVG;

$generator = new BarcodeGeneratorSVG();
$svg = $generator->getBarcode('12345678', BarcodeGeneratorSVG::TYPE_CODE_128, 1.3, 10 * 3.78);
echo $svg;
