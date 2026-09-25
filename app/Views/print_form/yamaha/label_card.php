<?php
/**
 * Yamaha - Label Card (1 unit)
 * Sizing: dari Default Medium (lebar kolom, tinggi baris, font-size)
 * Konten: Yamaha asli - QR NSI atas, QR YAMAHA bawah, HANYA barcode refNo
 *
 * Kolom: A=3  B=25  C=auto  D=10  E=11  F=6  G=5  H=4  I=6  J=3 -> 95mm
 */
$displayItemCode = $itemCode;
?>
<table style="width:95mm;min-width:95mm;max-width:95mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:9pt;">
<colgroup>
  <col style="width:3mm">  <!-- A: spacer kiri -->
  <col style="width:25mm"> <!-- B -->
  <col style="width:auto"> <!-- C -->
  <col style="width:10mm"> <!-- D -->
  <col style="width:11mm"> <!-- E -->
  <col style="width:6mm">  <!-- F -->
  <col style="width:5mm">  <!-- G -->
  <col style="width:4mm">  <!-- H -->
  <col style="width:6mm">  <!-- I -->
  <col style="width:3mm">  <!-- J: spacer kanan -->
</colgroup>

<!-- R1: REV / NR / FM-QCA-18 -->
<tr>
  <td style="height:4.59mm;border-top:0.3mm solid #000;border-left:0.3mm solid #000;width:3mm;max-width:3mm;"><div style="width:3mm;"></div></td>
  <td colspan="2" style="border-top:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.3mm solid #000;border-right:0.3mm solid #000;text-align:right;font-weight:bold;padding:0.3mm 1mm;font-size:8pt;vertical-align:middle;white-space:nowrap;">FM-QCA-18</td>
</tr>

<!-- R2: PT. NIHON SEIKI | QR NSI besar (rowspan 5: R2-R6) -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;padding:0.5mm;">
    <div style="line-height:1;">
      <div style="width:22mm;height:22mm;margin:0 auto;"><?= str_replace('style="', 'style="margin-bottom:-1mm; ', $qrCodeImg($qrRight, 200, '22mm', 0)) ?></div>
      <span style="font-size:7pt;font-weight:bold;line-height:1;">QR NSI</span>
    </div>
  </td>
  <td style="border-right:0.3mm solid #000;width:3mm;max-width:3mm;"><div style="width:3mm;"></div></td>
</tr>

<!-- R3: QUALITY CONTROL OK -->
<tr>
  <td style="height:4.59mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R4: Customer -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R5: DATE -->
<tr>
  <td style="height:3.57mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>DATE :</b> <?= str_replace(' ', '&nbsp;', strtotime($displayDate) ? date('d M Y', strtotime($displayDate)) : esc($displayDate)) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R6: PART NAME -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R7: Description | BACK NO -->
<tr>
  <td style="height:4.08mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R8: PART NO (rowspan 3: R8-R10) | Treat/Plat header | Inspection header -->
<tr>
  <td style="height:4.34mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>PART NO :</b> <?= esc($itemCode) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm 0.3mm 0.3mm 1mm;font-size:8pt;vertical-align:middle;white-space:nowrap;">Treat/Plat</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:left;padding-left:1mm;font-size:9pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R9: (PART NO covered) | empty | lotQty bold -->
<tr>
  <td style="height:4.34mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-weight:bold;font-size:9pt;vertical-align:middle;"><?= esc($lotQty) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R10: (PART NO covered) | Marking | ROHS FREE -->
<tr>
  <td style="height:2.98mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm 0.3mm 0.3mm 1mm;font-size:9pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:left;padding-left:1mm;font-size:8pt;vertical-align:middle;white-space:nowrap;">ROHS&nbsp;FREE</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R11: LOTNO (rowspan 3: R11-R13) | empty | YES -->
<tr>
  <td style="height:3.57mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>LOTNO :</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:left;padding-left:1mm;font-size:9pt;vertical-align:middle;">YES</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R12: (LOTNO covered) | empty | warehouse -->
<tr>
  <td style="height:2.47mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:left;padding-left:1mm;font-size:9pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R13: (LOTNO covered) | PRINT DATE | printDateLong -->
<tr>
  <td style="height:3.23mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;text-align:left;padding-left:0.5mm;font-size:7pt;vertical-align:middle;white-space:nowrap;">PRINT DATE</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:left;padding-left:0.5mm;font-size:7pt;vertical-align:middle;white-space:nowrap;"><?= str_replace(' ', '&nbsp;', $printDateLong) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- R14: QTY text | weight (if any) -->
<tr>
  <td style="height:4.59mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>QTY :</b> <?= esc($lotQty) ?></td>
  <?php if (!empty($weight)): ?>
  <td colspan="2" style="border:0.3mm solid #000;text-align:center;font-size:9pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;font-weight:bold;vertical-align:middle;overflow:hidden;white-space:nowrap;"><?= esc(str_replace(',', '.', $weight)) ?> KG</td>
  <?php else: ?>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;font-size:9pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <?php endif; ?>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- R15-R17: barcode refNo kiri (rowspan 3) | QR YAMAHA kanan (rowspan 3) -->
<tr>
  <td style="height:5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="4" rowspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-bottom:0.3mm solid #000;padding:1mm 1mm 0.5mm 1mm;vertical-align:middle;text-align:center;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr><td align="center"><?= $barcodeSvg($refNo, 7, 0.7) ?></td></tr>
      <tr><td style="height:2.5mm;font-size:1pt;line-height:1pt;">&nbsp;</td></tr>
      <tr><td align="center" style="font-size:9pt;"><?= esc($refNo) ?></td></tr>
    </table>
  </td>
  <td colspan="4" rowspan="3" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;padding:0.5mm;">
    <div style="width:18mm;height:18mm;margin:0 auto;"><?= $qrCodeImg($qrBottom, 120, '18mm', 0) ?></div>
    <div style="font-size:7pt;font-weight:bold;margin-top:0.5mm;line-height:1.2;">QR YAMAHA</div>
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

<!-- Baris bawah: border bawah penuh -->
<tr>
  <td style="height:3.57mm;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

</table>
