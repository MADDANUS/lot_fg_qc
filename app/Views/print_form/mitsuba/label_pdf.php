<?php
/**
 * Layout Mitsuba Label
 * Ukuran: 9.5 cm x 5.5 cm
 */

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

$qrCodeImg = function (string $data, int $sizePx = 150, string $displayMm = '25mm', int $margin = 2): string {
    if ($data === '') return '';
    try {
        $qrCode = new QrCode(
            $data,
            new Encoding('UTF-8'),
            ErrorCorrectionLevel::Medium,
            $sizePx,
            $margin,
            \Endroid\QrCode\RoundBlockSizeMode::Enlarge,
            new Color(0, 0, 0),
            new Color(255, 255, 255)
        );
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        return '<img src="' . $result->getDataUri() . '" width="' . $sizePx . '" height="' . $sizePx . '" style="width:' . $displayMm . ';height:' . $displayMm . ';" alt="QR">';
    } catch (\Throwable $e) {
        return '<div style="width:' . $displayMm . ';height:' . $displayMm . ';border:0.1mm solid #000;font-size:6pt;text-align:center;padding-top:5px;">QR ERR</div>';
    }
};
?>

<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri','dejavusans',Arial,sans-serif; font-size:10pt; color:#000; line-height:1; }
.mitsuba-label { width:95mm; height:55mm; overflow:hidden; border:1px solid #000; padding:2mm; }
table.layout-table { width:195mm; border-collapse:collapse; border:none; margin-bottom:5mm; }
table.layout-table td { border:none; padding:0; vertical-align:top; }
</style>
</head><body>

<?php
$pages = array_chunk($lots, 10); // 5 baris × 2 kolom = 10 lot per halaman
foreach ($pages as $pgIdx => $pageLots):
    if ($pgIdx > 0): ?><pagebreak><?php endif;
    
    $rows = array_chunk($pageLots, 2);
    foreach ($rows as $rIdx => $rowLots):
?>
<table class="layout-table">
  <tr>
    <?php foreach ($rowLots as $colIdx => $lot): 
        $itemCode = $lot['item_code'] ?? '';
        $lotno    = $lot['lotno'] ?? '';
        $qrData   = implode(',', ['1001000', $itemCode, $lotno]);
    ?>
    <td style="width:95mm; padding-bottom:5mm;">
        <table style="width:95mm; height:55mm; border-collapse:collapse; border: 1px solid #000; font-size:12pt; margin: 0; table-layout:fixed;">
            <tr>
                <!-- Top margin for QR is 18mm, so this row is 18mm high -->
                <td colspan="3" style="height:18mm; vertical-align:top; text-align:center; font-weight:bold; font-size:18pt; padding-top:5mm; padding-bottom:0; margin:0;">
                    LOT CARD
                </td>
            </tr>
            <tr>
                <!-- Left margin 5mm (0.5cm) -->
                <td style="width:5mm; height:25mm; padding:0; margin:0;"></td>
                <!-- QR Code 25x25mm (margin 0 inside image so it fits exactly) -->
                <td style="width:25mm; height:25mm; vertical-align:top; padding:0; margin:0;">
                    <?= $qrCodeImg($qrData, 150, '25mm', 0) ?>
                </td>
                <!-- Right space 65mm. -->
                <td style="width:65mm; vertical-align:top; padding:0; padding-top:2mm; padding-left:5mm; margin:0; line-height:1;">
                    <div style="padding-bottom:7mm;">Suplier : 1001000</div>
                    <div style="padding-bottom:7mm;">Part No : <?= esc($itemCode) ?></div>
                    <div>Lot No &nbsp;: <?= esc($lotno) ?></div>
                </td>
            </tr>
            <tr>
                <!-- Bottom margin: adjusted to 9mm so total height remains exactly 55mm -->
                <td colspan="3" style="height:9mm; padding:0; margin:0;"></td>
            </tr>
        </table>
    </td>
    
    <?php if ($colIdx === 0 && count($rowLots) === 2): ?>
        <td style="width:5mm;"></td> <!-- Gap between columns -->
    <?php endif; ?>
    
    <?php endforeach; ?>
    
    <?php if (count($rowLots) === 1): ?>
        <td style="width:5mm;"></td>
        <td style="width:95mm;"></td>
    <?php endif; ?>
  </tr>
</table>
<?php
    endforeach; // end rows
endforeach; // end pages
?>

</body></html>
