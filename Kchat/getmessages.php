<?php
include "./connect.php";
$get_messages = "select * from tblmessages ORDER by messageTime";
$resault = $connect->query($get_messages);
$data = array();
while ($row = $resault->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$connect->close();

?>