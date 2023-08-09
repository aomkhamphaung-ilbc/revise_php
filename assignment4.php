<?php
ob_start();
session_start();

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $name_err = 'Please Enter Username!';
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $pass_err = 'Please Enter Password!';
    }

    if(isset($username) && isset($password)){
        if($username === 'username' && $password === 'password'){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['logged_in'] = true;

            header('location: assignment4_login.php');
            exit;
        }else{
            $err =  'Credentials do not match our records!';
        }
    }
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: assignment4.php?logout=success');
}

$logout_message = '';
if(isset($_GET['logout']) && $_GET['logout'] === 'success'){
    $logout_message = 'Logout success!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="card col-md-6 m-3 p-2">
            <div class="card-header">
                <h4>Login Form</h4>
            </div>
            <div class="card-body display-flex">
                <?php
                    if(isset($err)){
                        echo "<h5 class = 'text-danger'>". $err ."</h5>";
                    }
                    if(isset($logout_message)){
                        echo "<h5 class = 'text-success'>". $logout_message . "</h5>";
                    }
                ?>
                <form action="" method="post">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your name (username)">
                    <?php if (isset($name_err)) echo "<span class='text-danger'>" . $name_err . "</span></br>"; ?>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password (password)">
                    <?php if (isset($pass_err)) echo "<span class='text-danger'>" . $pass_err . "</span></br>"; ?>
                    <button class="mt-2 btn btn-secondary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>