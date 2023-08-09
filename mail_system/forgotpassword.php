<?php
require('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token){
    require('php_mailer/PHPMailer.php');
    require('php_mailer/SMTP.php');
    require('php_mailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'aomkhamphaung@ilbcedu.com';                //SMTP username
        $mail->Password   = 'A235k2004p@';                             //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('akhamphaung@gmail.com', 'PHP Mailer');
        $mail->addAddress($email);     //Add a recipient
        $reset_link = 'http://localhost/revise_php/mail_system/reset_password.php?email='. $_POST['email']. '&reset_token=' . $reset_token;
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password reset link from php mailing system testing.';
        $mail->Body    = 'We got a request to reset your password!</br>
        Click the link below: </br>
        <a href="'.$reset_link.'">Reset Password</a>
        ';
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

if(isset($_POST['reset'])){
    $email = $_POST['email'];

    $query = "Select * from `users` where `email` = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $reset_token = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/Rangoon');
        $date = date('Y-m-d');

        $query = "Update `users` Set `reset_token` = ? , `token_expire` = ? where `email` = ?";
        $update_stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($update_stmt, 'sss', $reset_token, $date, $email);
        if(mysqli_stmt_execute($update_stmt)){
            if(sendMail($_POST['email'], $reset_token)){
                echo "
                <script>
                    alert('Password reset link already sent!');
                    window.location.href = 'index.php';
                </script>
            ";
            }else{
                echo "
                    <script>
                        alert('Function doesn't work!');
                        window.location.href = 'index.php';
                    </script>
                ";
            }
        }else{
            echo "
            <script>
                alert('Something went wrong or the link is expired!');
                window.location.href = 'index.php';
            </script>
        ";
        }
    }
    }else{
        echo "
            <script>
                alert('Email not found!');
                window.location.href = 'index.php';
            </script>
        ";
    }
}
