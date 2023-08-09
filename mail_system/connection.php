<?php
$con = mysqli_connect("localhost", "root", "", "php_mail");
if(mysqli_connect_error()){
    echo "<script>alert('Cannot connect to database!')</script>";
    exit();
}
?>