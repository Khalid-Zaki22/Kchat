<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    header("location:home.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kchat-Login</title>
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
         <form action="" method="post" class="mt-5" >
            <label class="text-white">Your Email</label>
            <input type="email" name="email" class="form-control mb-3">
            <label class="text-white">Your Password</label>
            <input type="password" name="password" class="form-control mb-3">
            <div class="btns">
               <input type="submit" value="Login" class="btn btn-dark">
               <a href="./signup.php" class="btn btn-dark">Signup</a>
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