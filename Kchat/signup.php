<?php
session_start();
$_SESSION['error'] = "";
include "./connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    //check if inputs are empty
    if (empty($user_name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "please fill out all fields";
    }
    // check email
    else if (!str_contains($email, "@gmail.com")) {
        $_SESSION['error'] = "not valid gmail";
    }
    // check password length
    else if (strlen($password) < 8) {
        $_SESSION['error'] = "password length should be 8 letters or digits or more";
    }

    // insert new user
    else {
        // check if the user is existed before 
        $check_if_user_name_is_existed = "select * from tblusers where userName = '$user_name'";
        $user_name_resault = $connect->query($check_if_user_name_is_existed);
        $check_if_email_is_existed = "select * from tblusers where userEmail = '$email'";
        $email_resault = $connect->query($check_if_email_is_existed);
        if ($user_name_resault->num_rows > 0) {
            $_SESSION['error'] = "this username is already existed";
        } else if ($email_resault->num_rows > 0) {
            $_SESSION['error'] = "this email is already existed";
        } else {
            $add_user = "insert into tblusers (userName , userEmail , userPassword) values ('$user_name','$email','$password')";
            $connect->query($add_user);
            header("location:index.php");
        }
    }

}
$connect->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kchat-Signup</title>
    <link rel="shortcut icon" href="./imgs/logo.ico" type="image/x-icon">
    <!--CSS Files-->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="login container bg-primary">
        <div class="title  d-flex justify-content-center py-5">
            <img src="./imgs/logo.svg">
            <h1 class="text-white">Kchat</h1>
        </div>
        <form action="" method="post" class="mt-5">
            <label class="text-white">Your User Name</label>
            <input type="text" name="username" class="form-control mb-3">
            <label class="text-white">Your Email</label>
            <input type="text" name="email" class="form-control mb-3">
            <label class="text-white">Your Password</label>
            <input type="password" name="password" class="form-control mb-3">
            <div class="btns">
                <input type="submit" value="Ok" class="btn btn-dark">
                <a href="./index.php" class="btn btn-dark">Cancel</a>
            </div>

            <?php
            // print the error
            if (!empty($_SESSION['error'])) {
                $error = $_SESSION['error'];
                echo "
                  <div class='alert alert-danger mt-5' >
                  $error
                  </div>
                ";
            }
            ?>
        </form>
    </div>

    <!--JS Fils-->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>