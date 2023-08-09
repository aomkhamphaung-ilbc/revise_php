<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require('connection.php');
        if(isset($_GET['email']) && isset($_GET['reset_token'])){
            date_default_timezone_set('Asia/Rangoon');
            $date = date('Y-m-d');
            $query = "select * from users where email = ? AND reset_token = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ss', $_GET['email'], $_GET['reset_token']);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                echo"
                <div class='row'>
                    <div class='col-md-3'>
                    </div>

                    <div class='p-3 m-2 card col-md-6'>
                    <form method='post'>
                        <h3>Create New Password</h3>
                        <label for='password' class='form-label'>Password</label>
                        <input type='password' class='form-control' name='password' placeholder='Enter your new password!'>
                        <button type='submit' name='update-password' class='btn btn-secondary mt-2'>Update Password</button>
                        <input type='hidden' name='email' value='$_GET[email]'>
                    </form>
                    </div> 
                </div>               
                ";
            }else{
                echo "
                    <script>
                        alert('Something went wrong!');
                        window.location.href = 'index.php';
                    </script>
                ";
            }
        }
        else{
            echo "Something went wrong!";
        }
    ?>

    <?php
        if(isset($_POST['update-password'])){
            $password = $_POST['password'];
            $update = "Update `users` set `password` = ?, `reset_token` = NULL, `token_expire` = NULL where `email` = ?";
            $update_stmt = mysqli_prepare($con, $update);
            mysqli_stmt_bind_param($update_stmt, 'ss', $password, $_GET['email']);
            if(mysqli_stmt_execute($update_stmt)){
                $affected_rows = mysqli_stmt_affected_rows($update_stmt);
                if($affected_rows > 0){
                    echo "
                    <script>
                        alert('Password updated successfully!');
                        window.location.href='index.php'
                    </script>
                ";
                }
            }else{
                echo "
                    <script>
                        alert('Something went wrong!);
                        window.location.href='index.php'
                    </script>
                ";
            }
        }
    ?>
</body>
</html>