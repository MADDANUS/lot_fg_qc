import sys

with open('left_table.txt', 'r', encoding='utf-8') as f:
    left_html = f.read()

with open('right_table.txt', 'r', encoding='utf-8') as f:
    right_html = f.read()

replacement = f"""<td colspan="3" style="padding:0; border:none; width: 100%; overflow:hidden;">
  <div style="float:left; width: 9.6cm; height: 7.2cm; overflow:hidden;">
{left_html}
  </div>
  
  <!-- Right Label -->
  <div style="float:right; width: 9.5cm; height: 8.0cm; overflow:hidden;">
{right_html}
  </div>
  <div style="clear:both;"></div>
</td>
"""

with open(r'app\Views\print_form\label_pdf.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = []
start_idx = -1
end_idx = -1

for i, line in enumerate(lines):
    if '<td colspan="3" style="padding:0; border:none; width: 100%; overflow:hidden;">' in line:
        start_idx = i
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
