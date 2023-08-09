<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .board {
        width: 400px;
        height: 400px;
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        border: 1px solid #000;
    }
    
    .cell {
        width: 50px;
        height: 50px;
        border: 1px solid #000;
    }
    
    .black {
        background-color: #000;
    }
    
    .white {
        background-color: #fff;
    }
</style>
</head>
<body>
<div class="board">
    <?php
    for ($row = 1; $row <= 8; $row++) {
        for ($col = 1; $col <= 8; $col++) {
            $cellClass = ($row + $col) % 2 == 0 ? 'black' : 'white';
            echo '<div class="cell ' . $cellClass . '"></div>';
        }
    }
    ?>
</div> 
</body>
</html>
