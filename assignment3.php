<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="card col-md-6 m-3 p-2">
            <div class="card-header">
                <h4>Age Calculator</h4>
            </div>
            <div class="card-body display-flex">
                <form action="" method="post">
                    <label for="birth-date" class="form-label">Birth Date</label>
                    <input type="date" name="birthday" id="birth-date" class="form-control">
                    <button class="mt-2 btn btn-secondary">Calculate Age</button>
                </form>
                <?php
                ob_start();
                if (!empty($_POST['birthday'])) {
                    $birthday = $_POST['birthday'];
                    $get_date = new DateTime($birthday);
                    $birthday_year = $get_date->format('Y');

                    $current_date = new DateTime();
                    $current_year = $current_date->format('Y');

                    $age = $current_year - $birthday_year;

                    echo 'You are ' . $age . ' years old!';
                }
                else{
                    $error = 'Please enter your birthday!';
                    echo $error;
                }

                ?>
            </div>
        </div>
    </div>

</body>

</html>