<?php
/**
 * Omron Inner - Label Kanan
 * Lebar: 95mm, Tinggi: 80mm
 */
?>
<table style="width:100%;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:8pt;">
<colgroup>
  <col style="width:25mm"> <!-- A: Kiri QR Code -->
  <col style="width:12mm"> <!-- B: Dwg No -->
  <col style="width:15mm"> <!-- C: Mfg Date -->
  <col style="width:10mm"> <!-- D: Dies No -->
  <col style="width:8mm">  <!-- E: Cav -->
  <col style="width:25mm"> <!-- F: Kanan QR Code / Info -->
</colgroup>

<!-- Row 1: PT. NIHON SEIKI INDONESIA | I/O -->
<tr>
  <td colspan="5" style="border-top:0.3mm solid #000; border-left:0.3mm solid #000; border-bottom:0.3mm solid #000; font-weight:bold; padding:1mm; vertical-align:middle; font-size:8pt;">
    PT. NIHON SEIKI INDONESIA
  </td>
  <td style="border-top:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center; font-weight:bold; font-size:14pt; padding:1mm;">
    <?= $omronLabelType === 'outer' ? 'O' : 'I' ?>
  </td>
</tr>

<!-- Row 2: Item No | QTY | Month-Year (rowspan 2) -->
<tr>
  <td colspan="3" style="border-left:0.3mm solid #000; padding:1mm 1mm 0 1mm; font-size:8pt;">
    Item No
  </td>
  <td colspan="2" style="border-left:0.3mm solid #000; padding:1mm 1mm 0 1mm; font-size:8pt;">
    QTY
  </td>
  <td rowspan="2" style="border-right:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center; vertical-align:middle; font-size:12pt; padding:1mm;">
    <?= esc($monthYear) ?>
  </td>
</tr>

<!-- Row 3: Barcode Item Code | 1000 -->
<tr>
  <td colspan="3" style="border-left:0.3mm solid #000; padding:0 1mm 1mm 1mm; text-align:center; height:16mm; vertical-align:middle;">
    <!-- Barcode Item No -->
    <div style="display:inline-block; margin:auto;">
      <?= $barcodeSvg($itemCode, 5) ?>
      <div style="margin-top:-2px; color:#000; text-align:center;"><?= esc($itemCode) ?></div>
    </div>
  </td>
  <td colspan="2" style="border-left:0.3mm solid #000; padding:0; height:16mm;">
    <table style="width:100%; height:100%; border:none; border-collapse:collapse;">
      <tr>
        <td style="border:none; text-align:center; vertical-align:middle; font-weight:bold; font-size:14pt; height:14mm;">
          <?= esc($lotQty) ?>
        </td>
      </tr>
      <tr>
        <td style="border:none; text-align:right; vertical-align:bottom; font-size:4pt; font-weight:normal; padding-right:1mm; padding-bottom:1mm; height:2mm;">
          PC
        </td>
      </tr>
    </table>
  </td>
</tr>

<!-- Row 4: Item Name (Header) -->
<tr>
  <td colspan="6" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-top:0.3mm solid #000; padding:1mm; font-size:8pt;">
    Item Name
  </td>
</tr>

<!-- Row 5: Item Name (Value) -->
<tr>
  <td colspan="6" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; padding:0 1mm 1mm 1mm; font-weight:bold; font-size:12pt;">
    <?= esc($description) ?>
  </td>
</tr>

<!-- Row 6: QR Left (rs 4) | Material Name | QR Right (rs 4) -->
<tr>
  <td rowspan="4" style="border-left:0.3mm solid #000; border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">
    <div style="margin:auto;">
      <?= $qrCodeImg($qrLeft, 120, '18mm') ?>
    </div>
  </td>
  <td colspan="4" style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; padding:1mm; font-size:8pt; font-weight:bold;">
    Material Name
  </td>
  <td rowspan="4" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">
    <div style="margin:auto;">
      <?= $qrCodeImg($qrRight, 120, '18mm') ?>
    </div>
  </td>
</tr>

<!-- Row 7: Headers for table -->
<tr>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; font-weight:bold;">Dwg No.</td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; font-weight:bold;">Mfg. Date</td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; font-weight:bold;">Dies No</td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; font-weight:bold;">Cav</td>
</tr>

<!-- Row 8: Values for table -->
<tr>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt;">-</td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt;"><?= esc($displayDate) ?></td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt;">-</td>
  <td style="border-right:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt;">-</td>
</tr>

<!-- Row 9: Empty row to fill space -->
<tr>
  <td style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; height:2mm;"></td>
  <td style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; height:2mm;"></td>
  <td style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; height:2mm;"></td>
  <td style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; height:2mm;"></td>
</tr>

<!-- Row 10: Notes | Status | Ro | Ref No -->
<tr>
  <td colspan="2" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; padding:1mm; font-size:8pt; vertical-align:top; font-weight:bold;">
    Notes
  </td>
  <td colspan="2" style="border-right:0.3mm solid #000; padding:1mm; font-size:8pt; vertical-align:top; font-weight:bold;">
    Status<br>
    <div style="font-size:8pt; margin-top:2mm; text-align:center; font-weight:normal;"><?= esc($notification) ?></div>
  </td>
  <td rowspan="2" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; text-align:center; vertical-align:middle;">
    <!-- Ro Circle via SVG -->
    <svg width="24" height="24" style="margin:auto; display:block;">
      <circle cx="12" cy="12" r="10" stroke="black" stroke-width="4" fill="none" />
      <text x="12" y="16" font-family="sans-serif" font-size="11" font-weight="bold" text-anchor="middle" fill="black">Ro</text>
    </svg>
  </td>
  <td rowspan="2" style="border-right:0.3mm solid #000; text-align:center; vertical-align:top; border-bottom:0.3mm solid #000; padding:1mm; font-size:8pt;">
    <div style="font-size:8pt; margin-top:2mm;"><?= esc($randomRefNo) ?></div>
  </td>
</tr>

<!-- Row 11: Empty row to fill notes/status space -->
<tr>
  <td colspan="2" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; height:2mm;"></td>
  <td colspan="2" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000;"></td>
</tr>

<!-- Row 12: Lot No | Approval/Stamp -->
<tr>
  <td colspan="5" style="border-left:0.3mm solid #000; padding:1mm; font-size:8pt;">
    Lot No
  </td>
  <td rowspan="3" style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; border-left:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; vertical-align:top;">
    Approval/Stamp
  </td>
</tr>

<!-- Row 13: Barcode Lot No -->
<tr>
  <td colspan="5" style="border-left:0.3mm solid #000; padding:1mm; text-align:center;">
    <div style="margin:auto; display:inline-block;">
      <?= $barcodeSvg($lotno, 6) ?>
    </div>
  </td>
</tr>

<!-- Row 14: Lot No Text -->
<tr>
  <td colspan="5" style="border-bottom:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center; font-size:8pt; padding:0 1mm 1mm 1mm;">
    <?= esc($lotno) ?>
  </td>
</tr>

</table>
