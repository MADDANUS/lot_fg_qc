<?php
$fLogin = 'app/Views/auth/login.php';
$cLogin = file_get_contents($fLogin);

// 1. getPolygon return
$cLogin = str_replace(
    'return vs;',
    'return {vs: vs, cx: cx, cy: cy};',
    $cLogin
);

// 2. shapes.forEach
$cLogin = str_replace(
    '                shapes.forEach(vs => {
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {',
    '                shapes.forEach(shapeObj => {
                    let vs = shapeObj.vs;
                    let cx = shapeObj.cx;
                    let cy = shapeObj.cy;
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {',
    $cLogin
);

// 3. tempSlots.push 1
$cLogin = str_replace(
    'if (pointInPolygon([xx, yy], vs)) tempSlots.push({x: xx, y: yy});',
    'if (pointInPolygon([xx, yy], vs)) tempSlots.push({x: xx, y: yy, cx: cx, cy: cy});',
    $cLogin
);

// 4. while loop
$cLogin = str_replace(
    '                while (tempSlots.length < N) {
                    let vs = shapes[Math.floor(Math.random() * shapes.length)];
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {',
    '                while (tempSlots.length < N) {
                    let shapeObj = shapes[Math.floor(Math.random() * shapes.length)];
                    let vs = shapeObj.vs;
                    let cx = shapeObj.cx;
                    let cy = shapeObj.cy;
                    let minX = vs[0][0], maxX = vs[0][0], minY = vs[0][1], maxY = vs[0][1];
                    vs.forEach(v => {',
    $cLogin
);

// 5. grid assign
$cLogin = str_replace(
    '                        grid[x][y].baseX = tempSlots[slotIndex].x;
                        grid[x][y].baseY = tempSlots[slotIndex].y;
                        slotIndex++;',
    '                        let slot = tempSlots[slotIndex];
                        grid[x][y].baseX = slot.x;
                        grid[x][y].baseY = slot.y;
                        grid[x][y].origShapeX = slot.x;
                        grid[x][y].origShapeY = slot.y;
                        grid[x][y].cx = slot.cx;
                        grid[x][y].cy = slot.cy;
                        slotIndex++;',
    $cLogin
);

// 6. draw loop rotation logic
$cLogin = str_replace(
    '                        const cell = grid[x][y];
                        
                        // Kalkulasi pergeseran ke atas/bawah
                        let currentBaseY = cell.baseY + scrollOffset;',
    '                        const cell = grid[x][y];
                        
                        // Rotasi jika dalam mode formasi
                        if (currentFormIdx !== 0 && cell.cx !== undefined) {
                            let angle = time * 0.02; // Kecepatan rotasi
                            let dxCenter = cell.origShapeX - cell.cx;
                            let dyCenter = cell.origShapeY - cell.cy;
                            cell.baseX = cell.cx + dxCenter * Math.cos(angle) - dyCenter * Math.sin(angle);
                            cell.baseY = cell.cy + dxCenter * Math.sin(angle) + dyCenter * Math.cos(angle);
                        }

                        // Kalkulasi pergeseran ke atas/bawah
                        let currentBaseY = cell.baseY + scrollOffset;',
    $cLogin
);

file_put_contents($fLogin, $cLogin);
echo "login.php patched successfully.\n";
