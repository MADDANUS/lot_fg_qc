<?php
/**
 * PARTIAL — Label Kiri (Pabrik)
 * Ukuran: 9.6cm × 7.2cm
 *
 * PERSIS dari TEMPLATE lot kiri.xlsx
 * 7 kolom (A–G), 14 baris data (Row 15-20 kosong)
 *
 * Kolom (Excel units → mm proporsional dlm 96mm, total=47.57):
 *   A=9.57→19.31mm  B=9.29→18.75mm  C=10.00→20.18mm  D=6.57→13.26mm
 *   E=2.71→5.47mm   F=3.14→6.34mm   G=6.29→12.70mm
 *
 * Baris (Excel pt → mm, 1pt=0.3528mm):
 *   R1=16.50pt→5.82mm   R2=38.25pt→13.50mm  R3=15.00pt→5.29mm
 *   R4=9.00pt→3.18mm    R5=13.50pt→4.76mm   R6=9.00pt→3.18mm
 *   R7=14.25pt→5.03mm   R8=9.75pt→3.44mm    R9=12.75pt→4.50mm
 *   R10=3.75pt→1.32mm   R11=5.25pt→1.85mm   R12=9.00pt→3.18mm
 *   R13=9.00pt→3.18mm   R14=7.50pt→2.65mm
 *
 * Merged cells:
 *   A1:E1(cs5)  F1:G2(rs2,cs2)  D2:E2(cs2)  D3:G3(cs4)
 *   B4:C4(cs2)  B6:C6(cs2)  B10:C11(rs2,cs2)
 *   E11:F14(rs4,cs2)  G11:G14(rs4)
 */
?>
<table style="width:96mm;table-layout:fixed;border-collapse:collapse;">
<colgroup>
  <col style="width:19.31mm"><!-- A -->
  <col style="width:18.75mm"><!-- B -->
  <col style="width:20.18mm"><!-- C -->
  <col style="width:13.26mm"><!-- D -->
  <col style="width:5.47mm"> <!-- E -->
  <col style="width:6.34mm"> <!-- F -->
  <col style="width:12.70mm"><!-- G -->
</colgroup>

<!-- R1: A1:E1="015-PT..." all-border | F1:G2=QR rs2,cs2 -->
<tr>
  <td colspan="5" style="height:5.82mm;border:0.1mm solid #000;padding:0.5mm 1mm;">015 - PT. NIHON SEIKI INDONESIA - <?= esc($productName) ?></td>
  <td colspan="2" rowspan="2" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;"><?= $qrCodeImg($qrLeft, $qrSize) ?></td>
</tr>
<!-- R2: A2=bordered | B2="Lot Guarantee" | C2="Lot SA" | D2:E2="4M" -->
<tr>
  <td style="height:13.50mm;border:0.1mm solid #000;"></td>
  <td style="border:0.1mm solid #000;text-align:center;vertical-align:middle;"><?php if($lotGuarantee):?>Lot Guarantee<?php endif;?></td>
  <td style="border:0.1mm solid #000;text-align:center;vertical-align:middle;"><?php if($lotSa):?>Lot SA<?php endif;?></td>
  <td colspan="2" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;"><?php if($is4m):?>4M<?php endif;?></td>
</tr>
<!-- R3: A3="Part Code:" bdr-TL | B3 bdr-T | C3 bdr-T | D3:G3=description cs4 bdr-TR -->
<tr>
  <td style="height:5.29mm;border-top:0.1mm solid #000;border-left:0.1mm solid #000;padding:0.5mm 1mm;">Part Code:</td>
  <td style="border-top:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;"></td>
  <td colspan="4" style="border-top:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;padding:0.5mm 1mm;"><?= esc($description) ?></td>
</tr>
<!-- R4: A4 bdr-L | B4:C4=itemCode cs2 | D4-F4 empty | G4 bdr-R -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="padding:0 1mm;"><?= esc($itemCode) ?></td>
  <td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R5: A5="Lot No.:" bdr-L | G5 bdr-R -->
<tr>
  <td style="height:4.76mm;border-left:0.1mm solid #000;padding:0.5mm 1mm;">Lot No.:</td>
  <td></td><td></td><td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R6: A6 bdr-L | B6:C6=lotNo cs2 | G6 bdr-R -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="padding:0 1mm;"><?= esc($lotNoCombined) ?></td>
  <td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R7: A7="Qty:" bdr-L | G7 bdr-R -->
<tr>
  <td style="height:5.03mm;border-left:0.1mm solid #000;padding:0.5mm 1mm;">Qty:</td>
  <td></td><td></td><td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R8: A8 bdr-L | B8=qty | G8 bdr-R -->
<tr>
  <td style="height:3.44mm;border-left:0.1mm solid #000;"></td>
  <td style="padding:0 1mm;"><?= esc($lotQty) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R9: A9="Ref No.:" bdr-L | G9 bdr-R -->
<tr>
  <td style="height:4.50mm;border-left:0.1mm solid #000;padding:0.5mm 1mm;">Ref No.:</td>
  <td></td><td></td><td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R10: A10 bdr-L | B10:C11=refNo rs2,cs2 center | D10 empty | G10 bdr-R -->
<tr>
  <td style="height:1.32mm;border-left:0.1mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="padding:0 1mm;text-align:center;vertical-align:middle;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>
<!-- R11: A11 bdr-L | (B,C covered) | D11 | E11:F14=stamp rs4,cs2 all-bdr | G11:G14=stamp rs4 all-bdr -->
<tr>
  <td style="height:1.85mm;border-left:0.1mm solid #000;"></td>
  <td></td>
  <td colspan="2" rowspan="4" style="border:0.1mm solid #000;"></td>
  <td rowspan="4" style="border:0.1mm solid #000;"></td>
</tr>
<!-- R12: A12="Remark:" bdr-L | B12=remark | C12 | D12 -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;padding:0.5mm 1mm;">Remark:</td>
  <td style="padding:0 1mm;"><?= esc($remark) ?></td>
  <td></td><td></td>
</tr>
<!-- R13: A13 bdr-L | B-D empty -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;"></td>
  <td></td><td></td><td></td>
</tr>
<!-- R14: A14="datetime" bdr-BL | B14 bdr-B | C14 bdr-B | D14 bdr-B | (E,F=stamp end) | (G=stamp end) -->
<tr>
  <td style="height:2.65mm;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;padding:0 1mm;font-size:8pt;"><?= $now ?></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
</tr>
</table>
