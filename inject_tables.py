import re

with open('left_table.txt', 'r', encoding='utf-8') as f:
    left_html = f.read().strip()

with open('right_table.txt', 'r', encoding='utf-8') as f:
    right_html = f.read().strip()

with open(r'app\Views\print_form\label_pdf.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Build new replacement block
new_block = '''<!-- ====== LOT <?= $pi + 1 ?> ====== -->
<tr>
<td colspan="3" style="padding:0; border:none;">
<table style="border-collapse: collapse; table-layout: fixed; width: 100%;">
<tbody>
<tr>
<!-- LEFT LABEL CELL -->
<td style="width: 9.6cm; height: 7.2cm; padding: 0; border: none; vertical-align: top; overflow: hidden;">
''' + left_html + '''
</td>
<!-- GAP KOLOM TENGAH -->
<td style="width: 5mm; padding:0; border:none;"></td>
<!-- RIGHT LABEL CELL -->
<td style="width: 9.5cm; height: 8.0cm; padding: 0; border: none; vertical-align: top; overflow: hidden;">
''' + right_html + '''
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<!-- GAP BAWAH ANTAR BARIS -->'''

# Find and replace the entire per-lot block
# Pattern: from <!-- ====== LOT to <!-- GAP BAWAH ANTAR BARIS -->
pattern = r'<!-- ====== LOT.*?<!-- GAP BAWAH ANTAR BARIS -->'
new_content = re.sub(pattern, new_block, content, flags=re.DOTALL)

if new_content == content:
    print('ERROR: No replacement made - pattern not found!')
else:
    with open(r'app\Views\print_form\label_pdf.php', 'w', encoding='utf-8') as f:
        f.write(new_content)
    print('Success! label_pdf.php updated.')
