<?php
ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4 Logged in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="card col-md-6 m-3 p-2">
            <div class="card-header display-flex justify-between">
                <h4 style="margin-right: auto;">Logged in!</h4>
            </div>
            <div class="card-body display-flex">
                <?php
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                        echo "<h4>Welcome, ". $_SESSION['username'] ."</h4>";
                    }
                ?>
                <form action="assignment4.php" method="post">
                    <button class="btn btn-secondary" name="logout" onclick="return confirm('Are you sure to log out?')">Log out</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>