<?php
include "../includes/db.php";
include "../global.php";
date_default_timezone_set("Asia/Calcutta");
$date_time_now = date("Y-m-d H:i:s");
$current_user = $_POST['current_user'];
$message_from = getUserInfo('id',$current_user);
$message = charecterParse(strip_tags($_POST['message']));
$message_to = $_POST['message_to'];
$message_sent = date_create($date_time_now);
$message_sent = date_format($message_sent,'g:ia');

$query = "INSERT INTO messages (message_from , message_to , message, sent_at , seen_status) VALUES ('{$message_from}' , '{$message_to}' , '{$message}'  , '$date_time_now' , 'not seen')";
$result = mysqli_query($connection,$query);

if($result)
{
    echo "<div class='d-flex flex-column message my-message'>$message<span class='text-right p-0 small-text text-secondary'>$message_sent <i class='mx-1 fa fa-check-circle-o'></i> </span></div>";
}

