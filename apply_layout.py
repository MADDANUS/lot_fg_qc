import sys

# Read mapped excel html
with open('excel_mapped.txt', 'r', encoding='utf-8') as f:
    excel_html = f.read()

# Wrap it in a single td
replacement = '<td colspan="3" style="padding:0; border:none; width: 100%; overflow:hidden;">\n' + excel_html + '\n</td>\n'

# Read label_pdf.php
with open(r'app\Views\print_form\label_pdf.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = []
start_idx = -1
end_idx = -1

for i, line in enumerate(lines):
    if '<td class="lbl-left"' in line:
        start_idx = i - 4 # To include the comment above it
    if '<!-- GAP BAWAH ANTAR BARIS -->' in line:
        end_idx = i - 2
        break

if start_idx != -1 and end_idx != -1:
    new_lines = lines[:start_idx] + [replacement] + lines[end_idx+1:]
    with open(r'app\Views\print_form\label_pdf.php', 'w', encoding='utf-8') as f:
        f.writelines(new_lines)
    print('Replaced successfully')
else:
    print('Failed to find markers')
