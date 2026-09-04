with open('excel_to_html.txt', 'r', encoding='utf-8') as f:
    html = f.read()

# Left Label Mappings
html = html.replace('015 - PT . -IJP/BS', '015 - PT. NIHON SEIKI INDONESIA - <?= esc($productName) ?>')
html = html.replace('>Lot Guarantee<', '><?php if ($lotGuarantee): ?>Lot<br>Guarantee<?php else: ?>&nbsp;<?php endif; ?><')
html = html.replace('>Lot SA<', '><?php if ($lotSa): ?>Lot SA<?php else: ?>&nbsp;<?php endif; ?><')
html = html.replace('>4M<', '><?php if ($is4m): ?>4M<?php else: ?>&nbsp;<?php endif; ?><')
html = html.replace('besi (partname)', '<?= esc($description) ?>')

# Right Label Mappings
html = html.replace('BACK NO F1814', 'BACK NO <?= esc($backNo) ?>')
html = html.replace('PART NO : 111111                                                                                                     ', '<div style="font-weight:bold;">PART NO : <span style="font-weight:normal;"><?= esc($itemCode) ?></span></div><div style="margin-top:1.5mm; text-align:left;"><?= $barcodeSvg($itemCode, $barcodeH * 0.7) ?></div>')
html = html.replace('LOTNO : 111111                                               ', '<div style="font-weight:bold;">LOTNO : <span style="font-weight:normal;"><?= esc($lotno) ?></span></div><div style="margin-top:1.5mm; text-align:left;"><?= $barcodeSvg($lotno, $barcodeH * 0.7) ?></div>')
html = html.replace('>757<', '><?= esc($operator) ?><')
html = html.replace('>YES<', '><?= esc($rohsFree ? \'YES\' : \'NO\') ?><')
html = html.replace('QTY : 500', '<div style="font-weight:bold;">QTY : <span style="font-weight:normal;"><?= esc((string) $lotQty) ?></span></div><div style="margin-top:1.5mm; text-align:left;"><?= $barcodeSvg((string) $lotQty, $barcodeH * 0.7) ?></div>')
html = html.replace('>WHFGL<', '><?= esc($warehouse) ?><')
html = html.replace('>OKE<', '><?= esc($remark) ?><')
html = html.replace('2026-09-02 00:00:00', '<?= $printDateLong ?>')
html = html.replace('HDFKSHDFASHDFHI', '<?= esc($refNo) ?>')
html = html.replace('HUHOEOSUFHSFHSUFHU1', '<div style="text-align:center;"><?= $barcodeSvg($refNo, $barcodeH * 0.6) ?></div>')
html = html.replace('2026-02-09 16:05:00', '<?= $now ?>')
html = html.replace('>78Y<', '><?= esc($shiftName ?: $userInitial) ?><')

# Insert QR Code for Left side. 
# Looking at original: Col 6,7 (merged) in Row 3-5? 
# In excel_to_html.txt, there is a cell `<td colspan="2" rowspan="3" style="text-align: center; vertical-align: top; ...` which is Col 6,7 Row 2,3,4.
# I'll replace `>&nbsp;</td>` on that line with `><?= $qrCodeImg($qrLeft, $qrSize) ?></td>`
# Wait, let's just do a string replacement on the exact line for QR Left:
html = html.replace(
    '<td colspan="2" rowspan="3" style="text-align: center; vertical-align: top; font-weight: normal; font-size: 11.0pt; padding: 1mm; border-top: 0.1mm solid #000; border-bottom: 0.1mm solid #000; border-left: 0.1mm solid #000; border-right: 0.1mm solid #000;">&nbsp;</td>',
    '<td colspan="2" rowspan="3" style="text-align: center; vertical-align: middle; padding: 1mm; border-top: 0.1mm solid #000; border-bottom: 0.1mm solid #000; border-left: 0.1mm solid #000; border-right: 0.1mm solid #000;"><?= $qrCodeImg($qrLeft, $qrSize) ?></td>'
)

# Insert QR Code for Right side.
# In Excel: Row 2, Col 11 to 14?
# `excel_to_html.txt` has `<td colspan="4" rowspan="4" style="text-align: center; vertical-align: top; font-weight: normal; font-size: 11.0pt; padding: 1mm; border-top: 0.1mm solid #000; border-bottom: 0.1mm solid #000; border-left: 0.1mm solid #000; border-right: 0.1mm solid #000;">&nbsp;</td>`
html = html.replace(
    '<td colspan="4" rowspan="4" style="text-align: center; vertical-align: top; font-weight: normal; font-size: 11.0pt; padding: 1mm; border-top: 0.1mm solid #000; border-bottom: 0.1mm solid #000; border-left: 0.1mm solid #000; border-right: 0.1mm solid #000;">&nbsp;</td>',
    '<td colspan="4" rowspan="4" style="text-align: center; vertical-align: middle; padding: 1mm; border-top: 0.1mm solid #000; border-bottom: 0.1mm solid #000; border-left: 0.1mm solid #000; border-right: 0.1mm solid #000;"><div style="width:<?= $qrSize + 4 ?>px; margin: 0 auto;"><?= $qrCodeImg($qrRight, $qrSize) ?></div></td>'
)

with open('excel_mapped.txt', 'w', encoding='utf-8') as f:
    f.write(html)
