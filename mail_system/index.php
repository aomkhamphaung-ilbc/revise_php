<?php
ob_start();
session_start();

require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="card col-md-6 m-3 p-2">
            <div class="card-header">
                <h4>Index Page</h4>
            </div>
            <div class="card-body display-flex">
                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo "<a href='logout.php' class='btn btn-secondary float-end'>Logout</a>";
                } else {
                    echo "
                        <button type='button' onclick=\"popup('login-popup')\" class='btn btn-secondary'>Login</button>
                        <button type='button' onclick=\"popup('register-popup')\" class='btn btn-secondary ms-2'>Register</button>
                        ";
                }
                ?>

                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo "<h4 class='p-3 mt-3'>Welcome to this website, " . $_SESSION['username'] . "</h4>";
                }
                ?>
            </div>

            <div class="popup-container d-none" id="login-popup">
                <div class="card p-3 m-2">
                    <div class="login">
                        <h3>
                            <span>User Login</span>
                            <button type="reset" onclick="closePopup('login-popup')" class="float-end btn btn-secondary">X</button>
                        </h3>
                        <form action="login_register.php" method="post">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                            <?php if (isset($email_err)) echo "<span class='text-danger'>" . $email_err . "</span></br>"; ?>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                            <?php if (isset($pass_err)) echo "<span class='text-danger'>" . $pass_err . "</span></br>"; ?>
                            <button class="mt-2 btn btn-secondary" name="login">Login</button>
                        </form>
                        <div class="forget-btn">
                            <button type="button" class="btn btn-secondary float-end" onclick="popup('reset-popup')">Forgot Password?</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="popup-container d-none" id="register-popup">
                <div class="card p-3 m-2">
                    <div class="register">
                        <h3>
                            <span>User Register</span>
                            <button type="reset" onclick="closePopup('register-popup')" class="float-end btn btn-secondary">X</button>
                        </h3>
                        <form action="login_register.php" method="post">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your name">
                            <?php if (isset($name_err)) echo "<span class='text-danger'>" . $name_err . "</span></br>"; ?>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                            <?php if (isset($email_err)) echo "<span class='text-danger'>" . $email_err . "</span></br>"; ?>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                            <?php if (isset($pass_err)) echo "<span class='text-danger'>" . $pass_err . "</span></br>"; ?>
                            <button class="mt-2 btn btn-secondary" name="register">Register</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="popup-container d-none" id="reset-popup">
                <div class="card p-3 m-2">
                    <div class="reset">
                        <h3>
                            <span>Reset Password</span>
                            <button type="reset" onclick="closePopup('reset-popup')" class="float-end btn btn-secondary">X</button>
                        </h3>
                        <form action="forgotpassword.php" method="post">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">

                            <button class="mt-2 btn btn-secondary" name="reset">Send Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function popup(popupId) {
            var mainCardBody = document.querySelector('.card-body.display-flex');
            mainCardBody.style.display = 'none';

            var popups = document.querySelectorAll('.popup-container');
            for (var i = 0; i < popups.length; i++) {
                if (popups[i].id === popupId) {
                    popups[i].classList.remove('d-none');
                } else {
                    popups[i].classList.add('d-none');
                }
            }
        }


        function closePopup(popupId) {
            var popup = document.getElementById(popupId);

            var mainCardBody = document.querySelector('.card-body.display-flex');
            mainCardBody.style.display = 'flex';

            popup.classList.add('d-none');
        }
    </script>

</body>

</html>