<?php
/**
 * Default Small — Label Card (1 unit)
 * 66mm lebar (dalam kode) — Target cetak 6.0 cm
 * Skala ~0.846x dari versi 78mm
 *
 * Kolom (sum ≈ 66mm):
 *   A=1.9  B=16.0  C=auto  D=6.9  E=7.6  F=4.1  G=3.5  H=2.7  I=4.1  J=1.9
 * Font: 6pt
 */
?>
<table style="width:66mm;min-width:66mm;max-width:66mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:6pt;">
<colgroup>
  <col style="width:1.9mm">    <!-- A -->
  <col style="width:16.0mm">   <!-- B -->
  <col style="width:auto">     <!-- C -->
  <col style="width:6.9mm">    <!-- D -->
  <col style="width:7.6mm">    <!-- E -->
  <col style="width:4.1mm">    <!-- F -->
  <col style="width:3.5mm">    <!-- G -->
  <col style="width:2.7mm">    <!-- H -->
  <col style="width:4.1mm">    <!-- I -->
  <col style="width:1.9mm">    <!-- J -->
</colgroup>

<!-- R1 -->
<tr>
  <td style="height:4.0mm;border-top:0.2mm solid #000;border-left:0.2mm solid #000;width:1.9mm;max-width:1.9mm;"><div style="width:1.9mm;"></div></td>
  <td colspan="2" style="border-top:0.2mm solid #000;padding:0.2mm 0.6mm;font-weight:bold;font-size:6pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;text-align:center;font-size:6pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.2mm solid #000;border-right:0.2mm solid #000;text-align:right;font-weight:bold;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:middle;">FM-QCA-18</td>
</tr>
<!-- R2 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-weight:bold;font-size:6pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.2mm solid #000;text-align:center;vertical-align:middle;padding:0;line-height:0;"><?= $qrCodeImg($qrRight, 150, '16.5mm', 0) ?></td>
  <td style="border-right:0.2mm solid #000;width:1.9mm;max-width:1.9mm;"><div style="width:1.9mm;"></div></td>
</tr>
<!-- R3 -->
<tr>
  <td style="height:4.0mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-weight:bold;font-size:6pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R4 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-weight:bold;font-size:6pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R5 -->
<tr>
  <td style="height:3.1mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:middle;"><b>DATE:</b> <?= $displayDate ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R6 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-weight:bold;font-size:6pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R7 -->
<tr>
  <td style="height:3.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.2mm solid #000;text-align:center;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R8 -->
<tr>
  <td style="height:3.7mm;border-left:0.2mm solid #000;"></td>
  <td colspan="8" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:middle;"><b>PART NO:</b> <?= esc($itemCode) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R9 -->
<tr>
  <td style="height:3.7mm;border-left:0.2mm solid #000;"></td>
  <td colspan="8" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.6mm;"><?= $barcodeSvg($itemCode, 3.0, 0.7) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R10 -->
<tr>
  <td style="height:3.1mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:top;"><b>LOTNO:</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:6pt;vertical-align:middle;">Treat/Plat</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:6pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R11 -->
<tr>
  <td style="height:0.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.2mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;font-size:6pt;"><?= esc($operator) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R12 -->
<tr>
  <td style="height:1.6mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.6mm;"><?= $barcodeSvg($lotno, 3.0, 0.7) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R13 -->
<tr>
  <td style="height:2.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:6pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:6pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R14 -->
<tr>
  <td style="height:2.0mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.6mm;font-size:6pt;vertical-align:top;"><b>QTY:</b> <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" style="border:0.2mm solid #000;padding:0.2mm;font-size:6pt;vertical-align:middle;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R15 -->
<tr>
  <td style="height:1.1mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:6pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R16 -->
<tr>
  <td style="height:1.6mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.6mm;"><?= $barcodeSvg($lotQty, 3.0, 0.7) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R17 -->
<tr>
  <td style="height:2.7mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.2mm solid #000;text-align:center;font-size:6pt;vertical-align:middle;padding:0.2mm;white-space:nowrap;">PRINT DATE</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:6pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R18 -->
<?php if (!empty($weight)): ?>
<!-- R18 (weight mode): barcode colspan 3, rowspan 2 agar R19 di sebelahnya bebas -->
<tr>
  <td style="height:2.4mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.6mm;"><?= $barcodeSvg($refNo, 4.0, 0.7) ?></td>
  <td></td><td></td><td></td><td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R19 (weight mode): user initial sejajar PRINT DATE (B,C), berat sejajar tanggal (D,E,F) -->
<tr>
  <td style="height:5.1mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.6mm solid #000;text-align:center;font-size:6pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:6pt;font-weight:bold;vertical-align:middle;overflow:hidden;white-space:nowrap;"><?= esc(str_replace(',', '.', $weight)) ?> KG</td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<?php else: ?>
<!-- R18 (no weight): barcode rowspan=2 seperti asli -->
<tr>
  <td style="height:2.4mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.6mm;"><?= $barcodeSvg($refNo, 3.0, 0.7) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R19 (no weight): user initial seperti asli -->
<tr>
  <td style="height:5.1mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.6mm solid #000;text-align:center;font-size:6pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<?php endif; ?>
<!-- R20 -->
<tr>
  <td style="height:2.7mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="4" style="text-align:center;font-size:6pt;vertical-align:middle;padding:0.3mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R21 -->
<tr>
  <td style="height:3.1mm;border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-bottom:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
</table>
