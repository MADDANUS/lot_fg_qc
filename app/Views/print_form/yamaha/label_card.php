<?php
/**
 * Yamaha — Label Card (1 unit)
 * 95mm lebar × ~80mm tinggi
 *
 * Kolom: A=5  B=19  C=19  D=12  E=9  F=6  G=6  H=7  I=7  J=5 → 95mm
 * Kolom A  : spacer border KIRI  (border-left  di semua baris)
 * Kolom J  : spacer border KANAN (border-right di semua baris)
 * Baris terakhir : spacer border BAWAH (border-bottom di semua kolom)
 */
?>
<table style="width:95mm;min-width:95mm;max-width:95mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:9pt;">
<colgroup>
  <col style="width:5mm">  <!-- A: spacer border kiri -->
  <col style="width:19mm"> <!-- B -->
  <col style="width:19mm"> <!-- C -->
  <col style="width:12mm"> <!-- D -->
  <col style="width:9mm">  <!-- E -->
  <col style="width:6mm">  <!-- F -->
  <col style="width:6mm">  <!-- G -->
  <col style="width:7mm">  <!-- H -->
  <col style="width:7mm">  <!-- I -->
  <col style="width:5mm">  <!-- J: spacer border kanan -->
</colgroup>

<!-- R1: REV / NR / FM-QCA-18 -->
<tr>
  <td style="height:5mm;border-top:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border-top:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="3" style="border-top:0.3mm solid #000;text-align:right;font-weight:bold;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">FM-QCA-18</td>
  <td style="border-top:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R2: PT. NIHON SEIKI | QR besar (rowspan 4: R2–R5) -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.3mm solid #000;text-align:center;vertical-align:top;padding:0;line-height:0;"><?= $qrCodeImg($qrRight, 200, '22mm') ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R3: QUALITY CONTROL OK -->
<tr>
  <td style="height:5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R4: Customer -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R5: DATE -->
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>DATE :</b> <?= $displayDate ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R6: PART NAME -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R7: Description | BACK NO -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R8: PART NO (rowspan 3: R8–R10) | Treat/Plat | Inspection header -->
<tr>
  <td style="height:5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>PART NO :</b> <?= esc($itemCode) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:8pt;vertical-align:middle;text-align:center;">Treat/Plat</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:8pt;vertical-align:middle;">Inspection</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R9: (PART NO rowspan) | empty | $lotQty bold besar -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-weight:bold;font-size:12pt;vertical-align:middle;"><?= esc($lotQty) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R10: (PART NO rowspan) | Marking | ROHS FREE -->
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:8pt;vertical-align:middle;text-align:center;">Marking</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R11: LOTNO (rowspan 3: R11–R13) | empty | YES -->
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:top;"><b>LOTNO :</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">YES</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R12: (LOTNO rowspan) | empty | $warehouse -->
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R13: (LOTNO rowspan) | PRINT DATE | $printDateLong -->
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;text-align:center;font-size:8pt;vertical-align:middle;padding:0.3mm;">PRINT DATE</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:8pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R14: QTY | RF5 di tengah -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>QTY :</b> <?= esc($lotQty) ?></td>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;font-size:10pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R15–R17: Barcode kiri (rowspan 3) | QR kecil kanan (rowspan 3) -->
<tr>
  <td style="height:5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="4" rowspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-bottom:0.3mm solid #000;padding:1mm 1mm 0.5mm 1mm;vertical-align:middle;text-align:center;">
    <?= $barcodeSvg($refNo, 7, 1.0) ?>
    <div style="font-size:9pt;margin-top:0.5mm;"><?= esc($refNo) ?></div>
  </td>
  <td colspan="4" rowspan="3" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;padding:0.5mm;">
    <?= $qrCodeImg($qrBottom, 120, '18mm', 0) ?>
    <div style="font-size:6pt;font-weight:bold;margin-top:0.5mm;line-height:1.2;">QRCODE YAMAHA</div>
  </td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<tr>
  <td style="height:4mm;border-left:0.3mm solid #000;"></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- BARIS BAWAH: border bawah penuh (seperti kolom A/J untuk kiri/kanan) -->
<tr>
  <td style="height:0;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

</table>
