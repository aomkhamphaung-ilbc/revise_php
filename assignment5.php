<?php
ob_start();
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Writer\PngWriter;

if(isset($_POST['submit'])){
    if(!empty($_POST['text'])){
        $text = $_POST['text'];
        $qr_code = QrCode::create($text);

        $label =  Label::create('This is a label.');
        $writer = new PngWriter;
        $result = $writer->write($qr_code, label: $label);

        header("Content-Type: " . $result->getMimetype());
        
        echo $result->getString();
    }
    else{
        $err = "Please enter text to generate QR code!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="card col-md-6 m-3 p-2">
            <div class="card-header">
                <h4>To Generate QR Code</h4>
            </div>
            <div class="card-body display-flex">
                <?php
                    if(isset($err)){
                        echo "<h5 class = 'text-danger'>". $err ."</h5>";
                    }
                ?>
                <form action="" method="post">
                    <label for="text" class="form-label">Text</label>
                    <textarea name="text" id="" cols="60" rows="5" class="form-control"></textarea>
                    <button class="mt-2 btn btn-secondary" name="submit">Submit</button>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>

</body>

</html>