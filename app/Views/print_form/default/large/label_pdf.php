<?php
/**
 * Default Large — PDF Wrapper
 * Layout: 1 kolom × 2 baris = 2 label per halaman A4
 * Urutan: atas → bawah
 * Ukuran label: 187mm × 123mm
 *
 * Variabel dari controller: $header, $lots, $shiftName, $grid
 */

use Picqer\Barcode\BarcodeGeneratorSVG;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

$barcodeSvg = function (string $value, float $heightMm = 7, float $widthFactor = 1.5): string {
    if ($value === '') return '';
    $generator = new BarcodeGeneratorSVG();
    $svg = $generator->getBarcode($value, BarcodeGeneratorSVG::TYPE_CODE_128, $widthFactor, $heightMm * 3.78);
    $encoded = 'data:image/svg+xml;base64,' . base64_encode($svg);
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm;max-width:100%;display:block;" alt="' . htmlspecialchars($value) . '">';
};

$qrCodeImg = function (string $data, int $sizePx = 120, string $displayMm = '37mm', int $margin = 2): string {
    if ($data === '') return '';
    try {
        $qrCode = new QrCode($data, new Encoding('UTF-8'), ErrorCorrectionLevel::Medium, $sizePx, $margin,
            \Endroid\QrCode\RoundBlockSizeMode::Margin, new Color(0,0,0), new Color(255,255,255));
        $result = (new PngWriter())->write($qrCode);
        return '<img src="' . $result->getDataUri() . '" style="width:' . $displayMm . ';height:' . $displayMm . ';" alt="QR">';
    } catch (\Throwable $e) {
        return '<div style="width:' . $displayMm . ';height:' . $displayMm . ';border:0.2mm solid #000;font-size:8pt;text-align:center;">QR ERR</div>';
    }
};

$fmtDate = function (?string $d): string {
    if (!$d) return '';
    $ts = strtotime($d);
    return $ts ? date('d-M-Y', $ts) : $d;
};

$productName  = $header['product_name']    ?? '';
$dateMode     = $header['date_mode']       ?? 'production_date';
// DATE di label: pakai DocDate dari SAP jika ada; fallback ke production_date / job_order
$displayDate  = !empty($header['doc_date'])
    ? $fmtDate($header['doc_date'])
    : ($dateMode === 'production_date'
        ? $fmtDate($header['production_date'] ?? null)
        : ($header['job_order'] ?? ''));
$customer     = $header['customer']        ?? '';
$userInitial  = $header['user_initial']    ?? '';
$remark       = $header['remark']          ?? '';
$lotGuarantee = !empty($header['lot_guarantee']);
$lotSa        = !empty($header['lot_sa']);
$is4m         = !empty($header['flag_4m']);
$rohsFree     = true;
$docNumber    = $header['doc_number']      ?? '';
$qrSize       = 120;

$dtWib         = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
$now           = $dtWib->format('d/m/Y H:i');
$printDateLong = $dtWib->format('d-M-Y');

$cardTpl     = __DIR__ . '/label_card.php';
$perPage     = 2;   // 2 label per halaman (1 kolom × 2 baris)
$gapRow      = '5mm';
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri','dejavusans',Arial,sans-serif; font-size:14pt; color:#000; line-height:1; }
table { border-collapse:collapse; line-height:1; }
td { vertical-align:top; line-height:1; }
</style>
</head><body>

<?php
$pages = array_chunk($lots, $perPage);
foreach ($pages as $pageIdx => $pageLots):
?>
<?php if ($pageIdx > 0): ?><pagebreak><?php endif; ?>
<div style="margin:0;padding:0;">
<?php foreach ($pageLots as $lotIdx => $lot):
    $lotNoCombined = $lot['lot_no_combined'] ?? '';
    $refNo         = $lot['ref_no']          ?? '';
    $lotQty        = (string)($lot['lot_qty'] ?? ($lot['standard_pack'] ?? ''));
    $itemCode      = $lot['item_code']       ?? '';
    $description   = $lot['description']     ?? '';
    $lotno         = $lot['lotno']           ?? $lotNoCombined;
    $warehouse     = $lot['warehouse']       ?? '';
    $backNo        = $lot['back_no']         ?? '';
    $operator      = $lot['operator']        ?? '';
    $qrRight = implode(',', [$customer, $itemCode, $lotno, $lotQty, $refNo]);
?>
<?php if ($lotIdx > 0): ?><div style="height:<?= $gapRow ?>;"></div><?php endif; ?>
<?php include $cardTpl; ?>
<?php endforeach; ?>
</div>
<?php endforeach; ?>

</body></html>

