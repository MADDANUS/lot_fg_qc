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
$barcodeSvg = function (string $value, float $heightMm = 10, float $widthFactor = 1.3): string {
    if ($value === '') return '';
    $generator = new BarcodeGeneratorSVG();
    $svg = $generator->getBarcode($value, BarcodeGeneratorSVG::TYPE_CODE_128, $widthFactor, $heightMm * 3.78);
    $encoded = 'data:image/svg+xml;base64,' . base64_encode($svg);
    return '<img src="' . $encoded . '" style="height:' . $heightMm . 'mm; width:auto; display:block;" alt="' . htmlspecialchars($value) . '">';
};

// ── Helper: QR Code ────────────────────────────────────────────────────
$qrCodeImg = function (string $data, int $sizePx = 70, string $displayMm = '18mm', int $margin = 2): string {
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

// ── Helper: Format Tanggal ─────────────────────────────────────────────
$fmtDate = function (?string $d): string {
    if (!$d) return '';
    $ts = strtotime($d);
    return $ts ? date('d-M-Y', $ts) : $d;
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
$grid = ['font_size_pt' => 8, 'barcode_h_mm' => 10];
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
    // INNER: setiap lot = 1 baris (kiri + kanan berdampingan)
    $pages = array_chunk($lots, 3); // 3 pasang per halaman A4 portrait
    foreach ($pages as $pgIdx => $pageLots):
        if ($pgIdx > 0): ?><pagebreak><?php endif;
        foreach ($pageLots as $lotIdx => $lot):
            $itemCode    = $lot['item_code']    ?? '';
            $lotno       = $lot['lotno']        ?? '';
            $lotQty      = (string) ($lot['lot_qty'] ?? $lot['quantity'] ?? '');
            $description = $lot['description']  ?? '';
            $machine     = $lot['machine']       ?? '';
            $notification= $lot['notification']  ?? '';
            $userInitial = $lot['user_initial']  ?? '';
            $remark      = $lot['remark']        ?? '';
            $docNumber   = $lot['doc_number']    ?? '';
            $customer    = 'OMRON';
            $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
            $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
            $qrLeft      = implode('|', [$itemCode, $lotno, $lotQty, $remark, $docNumber]);
            $qrRight     = implode(',', ['OMRON', $itemCode, $lotno, $lotQty, $docNumber]);
            $randomRefNo = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
?>
<table style="width:195mm;border-collapse:separate;border:none;">
  <tr>
    <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplLeft; ?></td>
    <td style="width:5mm;padding:0;border:none;"></td>
    <td style="width:95mm;padding:0;vertical-align:top;border:none;"><?php include $tplRight; ?></td>
  </tr>
</table>
<div style="height:3mm;"></div>
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
            $description = $lot['description']  ?? '';
            $machine     = $lot['machine']       ?? '';
            $notification= $lot['notification']  ?? '';
            $remark      = $lot['remark']        ?? '';
            $docNumber   = $lot['doc_number']    ?? '';
            $customer    = 'OMRON';
            $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
            $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
            $qrLeft      = implode('|', [$itemCode, $lotno, $lotQty, $remark, $docNumber]);
            $qrRight     = implode(',', ['OMRON', $itemCode, $lotno, $lotQty, $docNumber]);
            $randomRefNo = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
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
                $description = $lot['description']  ?? '';
                $machine     = $lot['machine']       ?? '';
                $notification= $lot['notification']  ?? '';
                $remark      = $lot['remark']        ?? '';
                $docNumber   = $lot['doc_number']    ?? '';
                $displayDate = $fmtDate($lot['production_date'] ?? null) ?: $fmtDate($lot['doc_date'] ?? null);
                $monthYear   = $lot['doc_date'] ? date('M-y', strtotime($lot['doc_date'])) : date('M-y');
                $qrLeft      = implode('|', [$itemCode, $lotno, $lotQty, $remark, $docNumber]);
                $qrRight     = implode(',', ['OMRON', $itemCode, $lotno, $lotQty, $docNumber]);
                $randomRefNo = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
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
