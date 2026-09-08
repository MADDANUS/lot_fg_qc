<?php
/**
 * MAIN PDF TEMPLATE — label_pdf.php
 * ====================================
 * File ini hanya bertugas sebagai WRAPPER yang:
 * 1. Menyiapkan semua variabel shared (barcode, QR, helper)
 * 2. Loop setiap lot
 * 3. Include label_left.php (kiri) dan label_right.php (kanan) berdampingan
 *
 * Variabel dari controller:
 *   $header    — array header print
 *   $lots      — array lot items
 *   $shiftName — nama shift
 *   $grid      — konfigurasi ukuran
 */

use Picqer\Barcode\BarcodeGeneratorSVG;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

// ── Helper: Barcode SVG ────────────────────────────────────────────────────────
$barcodeSvg = function (string $value, float $heightMm = 10, float $widthFactor = 1.3) use ($grid): string {
    if ($value === '') return '';
    $generator = new BarcodeGeneratorSVG();
    $svg = $generator->getBarcode($value, BarcodeGeneratorSVG::TYPE_CODE_128, $widthFactor, $heightMm * 3.78);
    $encoded = 'data:image/svg+xml;base64,' . base64_encode($svg);
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm;max-width:100%;display:block;" alt="' . htmlspecialchars($value) . '">';
};

// ── Helper: QR Code PNG ────────────────────────────────────────────────────────
$qrCodeImg = function (string $data, int $sizePx = 70, string $displayMm = '30mm', int $margin = 2): string {
    if ($data === '') return '';
    try {
        $qrCode = new QrCode(
            $data,
            new Encoding('UTF-8'),
            ErrorCorrectionLevel::Medium,
            $sizePx,
            $margin,
            \Endroid\QrCode\RoundBlockSizeMode::Margin,
            new Color(0, 0, 0),
            new Color(255, 255, 255)
        );
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        return '<img src="' . $result->getDataUri() . '" style="width:' . $displayMm . ';height:' . $displayMm . ';" alt="QR">';
    } catch (\Throwable $e) {
        return '<div style="width:' . $displayMm . ';height:' . $displayMm . ';border:0.1mm solid #000;font-size:6pt;text-align:center;padding-top:5px;">QR ERR</div>';
    }
};

// ── Format tanggal ─────────────────────────────────────────────────────────────
$fmtDate = function (?string $d): string {
    if (!$d) return '';
    $ts = strtotime($d);
    return $ts ? date('d-M-Y', $ts) : $d;
};

// ── Variabel dari Header ───────────────────────────────────────────────────────
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
$docNumber    = $header['doc_number'] ?? '';

// ── Konfigurasi Grid ───────────────────────────────────────────────────────────
$fontPt   = $grid['font_size_pt'];
$barcodeH = $grid['barcode_h_mm'];
$qrSize   = match(true) {
    $fontPt <= 6 => 48,
    $fontPt <= 7 => 56,
    default      => 65,
};

$dtWib         = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
$now           = $dtWib->format('d/m/Y H:i');
$printDateLong = $dtWib->format('d-M-Y');

// ── Path partial templates ─────────────────────────────────────────────────────
$leftTpl   = __DIR__ . '/label_left.php';
$rightTpl  = __DIR__ . '/label_right.php';
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri', 'dejavusans', Arial, sans-serif; font-size:10pt; color:#000; line-height: 1; }
table { border-collapse:collapse; line-height: 1; }
td   { vertical-align:middle; line-height: 1; }
</style>
</head><body>

<?php
// Bagi lots menjadi grup @3 per halaman
$groups = array_chunk($lots, 3);
foreach ($groups as $gi => $group):
?>
<?php if ($gi > 0): ?><pagebreak><?php endif; ?>
<div style="margin:0;padding:0;">
<?php foreach ($group as $pi => $lot):
    $lotNoCombined = $lot['lot_no_combined'] ?? '';
    $refNo         = $lot['ref_no']          ?? '';
    $lotQty        = (string)($lot['lot_qty'] ?? ($lot['standard_pack'] ?? ''));
    $itemCode      = $lot['item_code']       ?? '';
    $description   = $lot['description']     ?? '';
    $lotno         = $lot['lotno']           ?? $lotNoCombined;
    $warehouse     = $lot['warehouse']       ?? '';
    $backNo        = $lot['back_no']         ?? '';
    $operator      = $lot['operator']        ?? '';
    $qrLeft  = implode('|', [$itemCode, $lotno, $lotQty, $remark, $refNo]);
    $qrRight = implode(',', [$customer, $itemCode, $lotno, $lotQty, $refNo]);
?>
<table style="width:195mm;border-collapse:collapse;border:none;"><tr>
  <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $leftTpl; ?></td>
  <td style="width:5mm;padding:0;border:none;"></td>
  <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $rightTpl; ?></td>
</tr></table>
<?php if ($pi < count($group) - 1): ?>
<div style="height:10mm;"></div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endforeach; ?>

</body></html>
