<?php
session_start();
$_SESSION['error'] = "";
include "./connect.php";
$email = $_SESSION['email'];
$check_if_email_is_existed = "select * from tblusers where userEmail = '$email'";
$email_resault = $connect->query($check_if_email_is_existed);
if (empty($_SESSION['email']) || empty($_SESSION['password'])) {
    $_SESSION['error'] = "please fill out all fields";
    header("location:index.php");
} else {
    if ($email_resault->num_rows > 0) {
        $check_password = "select * from tblusers where userEmail = '$email'";
        $resualt = $connect->query($check_password);
        while ($row = $resualt->fetch_assoc()) {
            if ($row['userPassword'] == $_SESSION['password']) {
                $user_name = $row['userName'];
            } else {
                $_SESSION['error'] = "password is wrong";
                header("location:index.php");
            }
        }
    } else {
        $_SESSION['error'] = "this email isn't existed";
        header("location:index.php");
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
    <title>Kchat</title>
    <link rel="shortcut icon" href="./imgs/logo.ico" type="image/x-icon">
    <!--CSS Files-->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <header class="container-fluid py-3 d-flex justify-content-between align-items-center bg-primary">
        <h3 class="text-white"><i class="fa-solid fa-user me-2"></i><span>
                <?php echo $user_name; ?>
            </span></h3>
        <form action="./logout.php" method="post">
            <input type="submit" value="Log out" class="btn btn-dark">
        </form>
    </header>
    <section class="messages">

    </section>
    <footer class="d-flex justify-content-between container-fluid pt-4">
        <textarea class="txt form-control me-3" onkeydown="sendMessage()"></textarea>
        <button class="send btn btn-primary px-4"><i class="fa-regular fa-paper-plane"></i></button>
    </footer>
    <!--JS Fils-->
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/home.js"></script>
    <script>
        function sendMessage() {
            if (event.key == "Enter") {
                let addRequest = new XMLHttpRequest();
                addRequest.onreadystatechange = function () {
                    if (addRequest.readyState == 4 && addRequest.status == 200) {

                    }
                }
                addRequest.open("POST", "addmessage.php", true)
                addRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                addRequest.send(`message=${message.value}&username=${userName.innerText}`);
                message.value = "";
            }
        }
    </script>
</body>

</html>
