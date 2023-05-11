<?php
include "./connect.php";
$message = $_POST['message'];
$user_name = $_POST['username'];
$photo = $_FILES['file'];
if (isset($photo))
{
    move_uploaded_file($photo['tmp_name'],"./imgs/".$photo['name']);
}
if(!empty($message) || !empty($photo['name']))
{
    $photo_name = $photo['name'];
    $insert_message = "insert into tblmessages (messageText,sender,messagePhoto) values('$message','$user_name','$photo_name')";
    $connect->query($insert_message);
    $connect->close();
}

?>