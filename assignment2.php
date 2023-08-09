<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2</title>
</head>

<body>
    <div style="text-align: center;">
        <?php
        $row = 6;
        for ($i = 1; $i <= $row; $i++) {
            for ($j = 1; $j <= $i * 2 - 1; $j++) {
                echo "*";
            }
            echo "</br>";
        }

        for ($i = $row - 1; $i >= 1; $i--) {
            for ($j = 1; $j <= $i * 2 - 1; $j++) {
                echo "*";
            }
            echo "</br>";
        }
        ?>
    </div>
</body>

</html>