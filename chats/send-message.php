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
$output = '';
$msg_id_array = 0;

$query = "INSERT INTO messages (message_from , message_to , message, sent_at , seen_status) VALUES ('{$message_from}' , '{$message_to}' , '{$message}'  , '$date_time_now' , 'not seen')";
$result = mysqli_query($connection,$query);
$message_id = mysqli_insert_id($connection);

if($result)
{
    $output.="<div class='d-flex flex-column message my-message' id='message-id-$message_id'>$message<span class='text-right p-0 small-text text-secondary'>$message_sent <i class='mx-1 fa fa-check-circle-o'></i></span>
    <i class='fa fa-ellipsis-v chat-options'>
    <div class='more-options d-none'>
    <ul class='list-group list-group-flush'>
    <li class='list-group-item bg-dark p-1 text-white delete-msg' data-msg-id='$message_id'>Delete</li>
    </ul>
    </div>
    </i></div>";
    $msg_id_array = $message_id;
}

$response = array("output" => $output,"id" => $msg_id_array);
echo json_encode($response);