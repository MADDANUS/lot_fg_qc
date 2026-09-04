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
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm;display:block;" alt="' . htmlspecialchars($value) . '">';
};

// ── Helper: QR Code PNG ────────────────────────────────────────────────────────
$qrCodeImg = function (string $data, int $sizePx = 70): string {
    if ($data === '') return '';
    try {
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Medium)
            ->setSize($sizePx)->setMargin(2)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        return '<img src="' . $result->getDataUri() . '" style="width:' . $sizePx . 'px;height:' . $sizePx . 'px;" alt="QR">';
    } catch (\Throwable $e) {
        return '<div style="width:' . $sizePx . 'px;height:' . $sizePx . 'px;border:1px solid #000;font-size:6pt;text-align:center;padding-top:25px;">QR ERR</div>';
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
$displayDate  = $dateMode === 'production_date'
    ? $fmtDate($header['production_date'] ?? null)
    : ($header['job_order'] ?? '');
$customer     = $header['customer']        ?? '';
$userInitial  = $header['user_initial']    ?? '';
$remark       = $header['remark']          ?? '';
$lotGuarantee = !empty($header['lot_guarantee']);
$lotSa        = !empty($header['lot_sa']);
$is4m         = !empty($header['flag_4m']);
$rohsFree     = true;

// ── Konfigurasi Grid ───────────────────────────────────────────────────────────
$fontPt   = $grid['font_size_pt'];
$barcodeH = $grid['barcode_h_mm'];
$qrSize   = match(true) {
    $fontPt <= 6 => 48,
    $fontPt <= 7 => 56,
    default      => 65,
};

$now           = date('d/m/Y H:i');
$printDateLong = date('d-M-Y');

// ── Path partial templates ─────────────────────────────────────────────────────
$viewPath  = APPPATH . 'Views/print_form/';
$leftTpl   = $viewPath . 'label_left.php';
$rightTpl  = $viewPath . 'label_right.php';
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri', 'dejavusans', Arial, sans-serif; font-size:10pt; color:#000; }
table { border-collapse:collapse; }
td   { vertical-align:middle; }
</style>
</head><body>

<?php foreach ($lots as $pi => $lot):

    // ── Variabel per lot ───────────────────────────────────────────────────────
    $lotNoCombined = $lot['lot_no_combined'] ?? '';
    $refNo         = $lot['ref_no']          ?? '';
    $lotQty        = (string)($lot['lot_qty'] ?? ($lot['standard_pack'] ?? ''));
    $itemCode      = $lot['item_code']       ?? '';
    $description   = $lot['description']     ?? '';
    $lotno         = $lot['lotno']           ?? $lotNoCombined;
    $warehouse     = $lot['warehouse']       ?? '';
    $backNo        = $lot['back_no']         ?? '';
    $operator      = $lot['operator']        ?? '';

    // QR data
    $qrLeft  = implode('|', [$itemCode, $lotno, $lotQty, $refNo, $remark]);
    $qrRight = implode('|', [$customer, $itemCode, $lotno, $lotQty, $refNo]);

?>
<!-- ═══ LOT <?= $pi + 1 ?> ═══ -->
<table style="width:100%;table-layout:fixed;margin-bottom:4mm;">
<tr>

  <!-- ▐ Label Kiri ▐ -->
  <td style="width:96mm;padding:0;vertical-align:top;">
    <?php include $leftTpl; ?>
  </td>

  <!-- ▐ Gap tengah ▐ -->
  <td style="width:5mm;border:none;">&nbsp;</td>

  <!-- ▐ Label Kanan ▐ -->
  <td style="width:95mm;padding:0;vertical-align:top;">
    <?php include $rightTpl; ?>
  </td>

</tr>
</table>

<?php endforeach; ?>

</body></html>
