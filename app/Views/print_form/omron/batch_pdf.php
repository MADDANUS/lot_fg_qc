<?php
/**
 * batch_pdf.php — Omron Batch Print PDF
 * Merender banyak lot secara bersambung: kiri → kanan, lalu baris berikutnya
 * 
 * Variabel dari controller:
 *   $type   — 'inner' atau 'outer'
 *   $lots   — array semua lot yang sudah dipecah berdasarkan standard_pack
 */

use Picqer\Barcode\BarcodeGeneratorSVG;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

// ── Helper: Barcode SVG ────────────────────────────────────────────────
$barcodeSvg = function (string $value, float $heightMm = 10, float $widthFactor = 1.3, bool $center = false): string {
    if ($value === '') return '';
    $generator = new BarcodeGeneratorSVG();
    $svg = $generator->getBarcode($value, BarcodeGeneratorSVG::TYPE_CODE_128, $widthFactor, $heightMm * 3.78);
    $encoded = 'data:image/svg+xml;base64,' . base64_encode($svg);
    $display = $center ? 'inline-block' : 'block';
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm; width:auto; max-width:100%; display:' . $display . ';" alt="' . htmlspecialchars($value) . '">';
};

// ── Helper: QR Code ────────────────────────────────────────────────────
$qrCodeImg = function (string $data, int $sizePx = 70, string $displayMm = '30mm', int $margin = 0): string {
    if ($data === '') return '';
    try {
        $qrCode = new QrCode(
            $data,
            new Encoding('UTF-8'),
            ErrorCorrectionLevel::Medium,
            $sizePx,
            0, // Force 0 margin to prevent white box overlapping borders
            \Endroid\QrCode\RoundBlockSizeMode::Margin,
            new Color(0, 0, 0),
            new Color(255, 255, 255)
        );
        $writer = new \Endroid\QrCode\Writer\SvgWriter();
        $result = $writer->write($qrCode);
        
        $svg = $result->getString();
        
        // Buang deklarasi <?xml...
        $svg = preg_replace('/<\?xml[^>]*\?>/', '', $svg);
        
        // Ubah width dan height bawaan library (pixel) menjadi milimeter ($displayMm)
        $svg = preg_replace('/width="[^"]+"/', 'width="' . $displayMm . '"', $svg, 1);
        $svg = preg_replace('/height="[^"]+"/', 'height="' . $displayMm . '"', $svg, 1);
        
        return $svg;
    } catch (\Throwable $e) {
        return '<div style="width:' . $displayMm . ';height:' . $displayMm . ';border:0.1mm solid #000;font-size:6pt;text-align:center;padding-top:5px;">QR ERR</div>';
    }
};

// ── Helper: Format Tanggal ─────────────────────────────────────────────
$fmtDate = function (?string $d): string {
    if (!$d) return '';
    $ts = strtotime($d);
    return $ts ? date('d-M-Y', $ts) : $d;
};

// ── Helper: Omron QR Format (Mendekati Sistem Lama) ────────────────────────
$generateOmronQr = function($lot, $displayDate, $randomRefNo) {
    $kode_supplier = "I01041";
    // Menghapus huruf dan spasi di belakang part no untuk QR Code
    $no_omron = preg_replace('/[a-zA-Z\s]+$/', '', $lot['item_code'] ?? '');
    $y = (int)($lot['lot_qty'] ?? ($lot['standard_pack'] ?? 0));
    $qty_str = sprintf("%08d", $y);
    $ts = strtotime($displayDate);
    $mfgdate2 = $ts ? date('dmy', $ts) : '';
    $cavity = $lot['cavity'] ?? '';
    if (trim($cavity) === '') {
        $cavity = '-';
    }
    // Dalam batch (dari DB) tidak ada $header, jadi gunakan lot
    $machine = $lot['machine'] ?? '';
    $dieno_val = $lot['die_no'] ?? '';
    if (trim($dieno_val) === '') {
        $dieno = '-    ';
    } else {
        $dieno = str_pad(substr(trim($dieno_val), 0, 5), 5, ' ', STR_PAD_RIGHT);
    }
    $shift = trim($lot['shift_id'] ?? '');
    if ($shift === '') {
        $shift = '1';
    }
    $uniq1 = strtoupper(substr($randomRefNo, -8));
    $lotno = $lot['lotno'] ?? ($lot['lot_no_combined'] ?? '');
    $lotno_str = sprintf("% 25s", $lotno);
    return $kode_supplier . $no_omron . $qty_str . $mfgdate2 . $cavity . "  " . $machine . $dieno . $shift . $uniq1 . $lotno_str;
};

// ── Template path ───────────────────────────────────────────────────────
$tplRight = __DIR__ . '/inner_right.php';
$tplOuter = __DIR__ . '/outer.php';
$tplLeft  = __DIR__ . '/inner_left.php';

// ── Buat pasangan kiri-kanan (Inner = kiri+kanan 1 lot, Outer = 2 outer per row)
// Untuk Inner: setiap lot butuh 2 slot (left + right)
// Untuk Outer: setiap lot butuh 1 slot, pasangkan 2 per baris
$rohsFree = true;
$dtWib = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
$printDateLong = $dtWib->format('d-M-Y');

// Fake $grid untuk partial templates yang perlu $grid
$grid = ['font_size_pt' => 7, 'barcode_h_mm' => 9];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Calibri','dejavusans',Arial,sans-serif; font-size:10pt; color:#000; line-height:1; }
table { border-collapse:collapse; line-height:1; }
td { vertical-align:middle; line-height:1; }
</style>
</head><body>
<?php
if ($type === 'inner'):
    $omronLabelType = 'inner';
    // INNER: setiap lot = 1 baris (kiri + kanan berdampingan)
    $pages = array_chunk($lots, 3); // 3 pasang per halaman A4 portrait
    foreach ($pages as $pgIdx => $pageLots):
        if ($pgIdx > 0): ?><pagebreak><?php endif;
        foreach ($pageLots as $lotIdx => $lot):
            $itemCode    = $lot['item_code']    ?? '';
            $lotno       = $lot['lotno']        ?? '';
            $lotQty      = (string) ($lot['lot_qty'] ?? $lot['quantity'] ?? '');
            $weight      = $lot['weight']       ?? '';
            $description = $lot['description']  ?? '';
            $machine     = $lot['machine']       ?? '';
            $notification= $lot['notification']  ?? '';
            $userInitial = $lot['user_initial']  ?? '';
            $remark      = $lot['remark']        ?? '';
            $docNumber   = $lot['doc_number']    ?? '';
            $customer    = $lot['customer'] ?? ($header['customer'] ?? 'PT. OMRON MANUFACTURING OF INDONESIA');
            $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
            $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
            $dieNo       = $lot['die_no'] ?? '';
            $dwgNo       = $lot['dwg_no'] ?? '';
            $cavity      = $lot['cavity'] ?? '';
            $backNo      = $lot['back_no'] ?? '';
            $operator    = $lot['operator'] ?? '';
            $warehouse   = $lot['whs_code'] ?? '';
            $uniq          = strtoupper(substr(uniqid(), -13));
            $refNo         = $lot['ref_no'] ?? '';
            if ($refNo === '') { $refNo = 'IT1' . $uniq; }
            $randomRefNo   = strtoupper(substr(uniqid(), -8));
            $cleanItemCode = preg_replace('/[a-zA-Z\s]+$/', '', $itemCode);
            $qrRightOriginal = implode(',', [$customer, $itemCode, $lotno, $lotQty, $refNo]);
            $qrOmronLong  = $generateOmronQr($lot, $displayDate, $randomRefNo);
?>
<table style="width:195mm;border-collapse:collapse;border:none;">
  <tr>
    <?php $qrRight = $qrRightOriginal; ?>
    <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplLeft; ?></td>
    <td style="width:5mm;padding:0;border:none;"></td>
    <?php $qrLeft = $qrOmronLong; $qrRight = $qrOmronLong; ?>
    <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplRight; ?></td>
  </tr>
</table>
<div style="height:10mm;"></div>
<?php
        endforeach;
    endforeach;

else:
    // OUTER: 2 label per baris, bersambung
    $omronLabelType = 'outer';
    $pages = array_chunk($lots, 6); // 3 baris × 2 kolom = 6 lot per halaman
    foreach ($pages as $pgIdx => $pageLots):
        if ($pgIdx > 0): ?><pagebreak><?php endif;
        $rows = array_chunk($pageLots, 2);
        foreach ($rows as $rIdx => $rowLots):
            // Kolom 1 (Kiri)
            $lot         = $rowLots[0];
            $itemCode    = $lot['item_code']    ?? '';
            $lotno       = $lot['lotno']        ?? '';
            $lotQty      = (string) ($lot['lot_qty'] ?? $lot['quantity'] ?? '');
            $weight      = $lot['weight']       ?? '';
            $description = $lot['description']  ?? '';
            $machine     = $lot['machine']       ?? '';
            $notification= $lot['notification']  ?? '';
            $remark      = $lot['remark']        ?? '';
            $docNumber   = $lot['doc_number']    ?? '';
            $customer    = $lot['customer'] ?? ($header['customer'] ?? 'PT. OMRON MANUFACTURING OF INDONESIA');
            $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
            $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
            $dieNo       = $lot['die_no'] ?? '';
            $dwgNo       = $lot['dwg_no'] ?? '';
            $cavity      = $lot['cavity'] ?? '';
            $backNo      = $lot['back_no'] ?? '';
            $operator    = $lot['operator'] ?? '';
            $warehouse   = $lot['whs_code'] ?? '';
            $uniq          = strtoupper(substr(uniqid(), -13));
            $refNo         = $lot['ref_no'] ?? '';
            if ($refNo === '') { $refNo = 'IT1' . $uniq; }
            $randomRefNo   = strtoupper(substr(uniqid(), -8));
            $cleanItemCode = preg_replace('/[a-zA-Z\s]+$/', '', $itemCode);
            $qrOmronLong  = $generateOmronQr($lot, $displayDate, $randomRefNo);
            $qrLeft      = $qrOmronLong;
            $qrRight     = $qrOmronLong;
?>
<table style="width:195mm;border-collapse:separate;border:none;"><tr>
  <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplOuter; ?></td>
  <td style="width:5mm;padding:0;border:none;"></td>
<?php
            if (isset($rowLots[1])):
                $lot         = $rowLots[1];
                $itemCode    = $lot['item_code']    ?? '';
                $lotno       = $lot['lotno']        ?? '';
                $lotQty      = (string) ($lot['lot_qty'] ?? $lot['quantity'] ?? '');
                $weight      = $lot['weight']       ?? '';
                $description = $lot['description']  ?? '';
                $machine     = $lot['machine']       ?? '';
                $notification= $lot['notification']  ?? '';
                $remark      = $lot['remark']        ?? '';
                $docNumber   = $lot['doc_number']    ?? '';
                $customer    = $lot['customer'] ?? ($header['customer'] ?? 'PT. OMRON MANUFACTURING OF INDONESIA');
                $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
                $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
                $dieNo       = $lot['die_no'] ?? '';
                $dwgNo       = $lot['dwg_no'] ?? '';
                $cavity      = $lot['cavity'] ?? '';
                $backNo      = $lot['back_no'] ?? '';
                $operator    = $lot['operator'] ?? '';
                $warehouse   = $lot['whs_code'] ?? '';
                $uniq          = strtoupper(substr(uniqid(), -13));
                $refNo         = $lot['ref_no'] ?? '';
                if ($refNo === '') { $refNo = 'IT1' . $uniq; }
                $randomRefNo   = strtoupper(substr(uniqid(), -8));
                $cleanItemCode = preg_replace('/[a-zA-Z\s]+$/', '', $itemCode);
                $qrOmronLong  = $generateOmronQr($lot, $displayDate, $randomRefNo);
                $qrLeft      = $qrOmronLong;
                $qrRight     = $qrOmronLong;
            ?>
  <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplOuter; ?></td>
<?php       else: ?>
  <td style="width:95mm;border:none;"></td>
<?php       endif; ?>
</tr></table>
<div style="height:3mm;"></div>
<?php
        endforeach;
    endforeach;
endif;
?>
</body></html>
