<?php
include "./connect.php";
$message = $_POST['message'];
$user_name = $_POST['username'];
$insert_message = "insert into tblmessages (messageText,sender) values('$message','$user_name')";
$connect->query($insert_message);
$connect->close();
?>