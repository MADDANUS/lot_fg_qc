import sys
content = open('app/Views/print_form/omron/inner_right.php', 'r', encoding='utf-8').read()

# Remove the div wrapper
content = content.replace('<div style="width:95mm; max-width:95mm; border:0.3mm solid #000; box-sizing:border-box;">\n', '')
content = content.replace('</table>\n</div>', '</table>')

# Row 1
content = content.replace(
    '<td colspan="5" style="border-bottom:0.3mm solid #000;',
    '<td colspan="5" style="border-top:0.3mm solid #000; border-left:0.3mm solid #000; border-bottom:0.3mm solid #000;'
)
content = content.replace(
    '<td style="border-bottom:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center;',
    '<td style="border-top:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center;'
)

# Row 2
content = content.replace(
    '<td colspan="3" style="padding:1mm 1mm 0 1mm; font-size:8pt;">',
    '<td colspan="3" style="border-left:0.3mm solid #000; padding:1mm 1mm 0 1mm; font-size:8pt;">'
)
content = content.replace(
    '<td rowspan="2" style="border-left:0.3mm solid #000; text-align:center;',
    '<td rowspan="2" style="border-right:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center;'
)

# Row 3
content = content.replace(
    '<td colspan="3" style="padding:0 1mm 1mm 1mm; text-align:center; height:16mm; vertical-align:middle;">',
    '<td colspan="3" style="border-left:0.3mm solid #000; padding:0 1mm 1mm 1mm; text-align:center; height:16mm; vertical-align:middle;">'
)

# Row 4 & 5
content = content.replace(
    '<td colspan="6" style="border-top:0.3mm solid #000; padding:1mm; font-size:8pt;">',
    '<td colspan="6" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-top:0.3mm solid #000; padding:1mm; font-size:8pt;">'
)
content = content.replace(
    '<td colspan="6" style="border-bottom:0.3mm solid #000; padding:0 1mm 1mm 1mm;',
    '<td colspan="6" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; padding:0 1mm 1mm 1mm;'
)

# Row 6
content = content.replace(
    '<td rowspan="4" style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">\n    <div style="margin:auto;">\n      <?= $qrCodeImg($qrLeft, 120, \'18mm\') ?>',
    '<td rowspan="4" style="border-left:0.3mm solid #000; border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">\n    <div style="margin:auto;">\n      <?= $qrCodeImg($qrLeft, 120, \'18mm\') ?>'
)
content = content.replace(
    '<td rowspan="4" style="border-bottom:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">\n    <div style="margin:auto;">\n      <?= $qrCodeImg($qrRight, 120, \'18mm\') ?>',
    '<td rowspan="4" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; text-align:center; vertical-align:middle; padding:1mm;">\n    <div style="margin:auto;">\n      <?= $qrCodeImg($qrRight, 120, \'18mm\') ?>'
)

# Row 10
content = content.replace(
    '<td colspan="2" style="border-right:0.3mm solid #000; padding:1mm; font-size:8pt; vertical-align:top; font-weight:bold;">\n    Notes',
    '<td colspan="2" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; padding:1mm; font-size:8pt; vertical-align:top; font-weight:bold;">\n    Notes'
)
content = content.replace(
    '<td rowspan="2" style="text-align:center; vertical-align:top; border-bottom:0.3mm solid #000; padding:1mm;',
    '<td rowspan="2" style="border-right:0.3mm solid #000; text-align:center; vertical-align:top; border-bottom:0.3mm solid #000; padding:1mm;'
)

# Row 11
content = content.replace(
    '<td colspan="2" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; height:2mm;"></td>\n  <td colspan="2" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000;"></td>',
    '<td colspan="2" style="border-left:0.3mm solid #000; border-right:0.3mm solid #000; border-bottom:0.3mm solid #000; height:2mm;"></td>\n  <td colspan="2" style="border-right:0.3mm solid #000; border-bottom:0.3mm solid #000;"></td>'
)

# Row 12
content = content.replace(
    '<td colspan="5" style="padding:1mm; font-size:8pt;">\n    Lot No',
    '<td colspan="5" style="border-left:0.3mm solid #000; padding:1mm; font-size:8pt;">\n    Lot No'
)
content = content.replace(
    '<td rowspan="3" style="border-left:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; vertical-align:top;">\n    Approval',
    '<td rowspan="3" style="border-bottom:0.3mm solid #000; border-right:0.3mm solid #000; border-left:0.3mm solid #000; padding:1mm; text-align:center; font-size:8pt; vertical-align:top;">\n    Approval'
)

# Row 13
content = content.replace(
    '<td colspan="5" style="padding:1mm; text-align:center;">\n    <div',
    '<td colspan="5" style="border-left:0.3mm solid #000; padding:1mm; text-align:center;">\n    <div'
)

# Row 14
content = content.replace(
    '<td colspan="5" style="text-align:center; font-size:8pt; padding:0 1mm 1mm 1mm;">\n    <?= esc($lotno)',
    '<td colspan="5" style="border-bottom:0.3mm solid #000; border-left:0.3mm solid #000; text-align:center; font-size:8pt; padding:0 1mm 1mm 1mm;">\n    <?= esc($lotno)'
)

open('app/Views/print_form/omron/inner_right.php', 'w', encoding='utf-8').write(content)
print("Borders added to td elements successfully!")
