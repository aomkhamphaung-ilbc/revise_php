<?php
session_start();
require('connection.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ?";

    $stmt = mysqli_prepare($con, $login_query);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['email'], $_POST['password']);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($result && mysqli_num_rows($result) > 0){
        $user_row = mysqli_fetch_assoc($result);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user_row['username'];
        header('location: index.php');
    }else{
        echo "
            <script>
                alert('Invalid credentials!');
                window.location.href = 'index.php';
            </script>
        "; 
    }
}

if (isset($_POST['register'])) {
    $user_exist_query = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
    
    $stmt = mysqli_prepare($con, $user_exist_query);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['email']);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            //already registered

            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['email'] == $_POST['email']) {
                echo "
                    <script>
                        alert('This user has already registered! Please login.');
                        window.location.href = 'index.php';
                    </script>
                ";
            }
        } else {
            $insert_query = "INSERT INTO `users`(`username`, `email`, `password`) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "sss", $_POST['username'], $_POST['email'], $_POST['password']);
            
            if (mysqli_stmt_execute($insert_stmt)) {
                echo "
                    <script>
                        alert('Registered successfully!');
                        window.location.href = 'index.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Cannot run query!');
                        window.location.href = 'index.php';
                    </script>
                ";
            }
        }
    } else {
        echo "
        <script>
            alert('Cannot run query!');
            window.location.href = 'index.php';
        </script>
        ";
    }
}
?>
