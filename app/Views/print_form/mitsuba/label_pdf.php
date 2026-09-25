<?php
/**
 * Layout Mitsuba Label (Gabungan Kiri Kanban Mitsuba, Kanan Default Medium)
 */

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Picqer\Barcode\BarcodeGeneratorSVG;

$barcodeSvg = function (string $value, float $heightMm = 5, float $widthFactor = 1.0): string {
    if ($value === '') return '';
    $generator = new BarcodeGeneratorSVG();
    $svg = $generator->getBarcode($value, BarcodeGeneratorSVG::TYPE_CODE_128, $widthFactor, $heightMm * 3.78);
    $encoded = 'data:image/svg+xml;base64,' . base64_encode($svg);
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm;max-width:100%;display:block;" alt="' . htmlspecialchars($value) . '">';
};

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

// ── Variabel Default Medium ──────────────────────────────────────────────────
$fmtDate = function($d) {
    if (empty($d)) return '';
    $ts = strtotime($d);
    return $ts ? date('d-M-y', $ts) : '';
};

$qrSize       = 65; // Untuk Medium

$dtWib         = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
$now           = $dtWib->format('d/m/Y H:i');
$printDateLong = $dtWib->format('d-M-Y');

$leftTpl  = __DIR__ . '/label_card.php'; // Kanban Mitsuba
$rightTpl = __DIR__ . '/omron_right.php'; // Omron Kanan (Independent)
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri','dejavusans',Arial,sans-serif; font-size:9pt; color:#000; line-height:1; }
table { border-collapse:collapse; line-height:1; }
td { vertical-align:middle; line-height:1; }
</style>
</head><body>

<?php
// Bagi lots menjadi grup @3 per halaman (Epson style)
$groups = array_chunk($lots, 3);
foreach ($groups as $gi => $group):
?>
<?php if ($gi > 0): ?><pagebreak><?php endif; ?>
<div style="margin:0;padding:0;">
<?php foreach ($group as $pi => $lot):
    // Variabel untuk Mitsuba Kanban
    $itemCode      = $lot['item_code']       ?? '';
    $description   = $lot['description']     ?? '';
    $lotno         = $lot['lotno']           ?? '';
    $qrData        = implode('', ['1001000', $itemCode, $lotno]);

    $lotNoCombined = $lot['lot_no_combined'] ?? '';
    $refNo         = $lot['ref_no']          ?? '';
    $lotQty        = (string)($lot['lot_qty'] ?? ($lot['standard_pack'] ?? ''));
    $warehouse     = $lot['warehouse']       ?? '';
    $backNo        = $lot['back_no']         ?? '';
    $operator      = $lot['operator']        ?? '';

    // Variabel Header (dengan fallback ke $lot untuk cetak batch)
    $productName  = $header['product_name'] ?? $lot['product_name'] ?? '';
    $dateMode     = $header['date_mode'] ?? 'production_date';
    $docDateVal   = $header['doc_date'] ?? $lot['doc_date'] ?? null;
    $prodDateVal  = $header['production_date'] ?? $lot['production_date'] ?? null;
    $displayDate  = !empty($docDateVal) 
        ? $fmtDate($docDateVal) 
        : ($dateMode === 'production_date' 
            ? $fmtDate($prodDateVal) 
            : ($header['job_order'] ?? $lot['job_order'] ?? ''));
    
    $customer     = $header['customer'] ?? $lot['customer'] ?? '';
    $userInitial  = $header['user_initial'] ?? $lot['user_initial'] ?? '';
    $remark       = $header['remark'] ?? $lot['remark'] ?? '';
    $lotGuarantee = !empty($header['lot_guarantee']) || !empty($lot['lot_guarantee']);
    $lotSa        = !empty($header['lot_sa']) || !empty($lot['lot_sa']);
    $is4m         = !empty($header['flag_4m']) || !empty($lot['flag_4m']);
    $rohsFree     = true;
    $docNumber    = $header['doc_number'] ?? $lot['doc_number'] ?? '';
    $weight       = $lot['weight'] ?? $header['weight'] ?? null;

    $qrRight = implode(',', [$customer, $itemCode, $lotno, $lotQty, $refNo]);
?>
<table style="width:193mm; border-collapse:collapse; border:none; padding:0; margin:0;">
  <tr>
    <td style="width:93mm; vertical-align:top; padding:0;">
      <?php include $leftTpl; ?>
    </td>
    <td style="width:5mm; vertical-align:top; padding:0;"></td>
    <td style="width:95mm; vertical-align:top; padding:0;">
      <?php include $rightTpl; ?>
    </td>
  </tr>
</table>
<?php if ($pi < count($group) - 1): ?>
<div style="height:5mm;"></div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endforeach; ?>

</body></html>
