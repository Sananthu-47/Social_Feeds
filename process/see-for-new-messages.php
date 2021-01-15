<?php
include "../includes/db.php";
include "../global.php";

date_default_timezone_set("Asia/Calcutta");
$date_time_now = date("Y-m-d H:i:s");
$message_from = $_POST['message_from'];
$message_to = $_POST['message_to'];
$current_user = $_POST['current_user'];
$current_user = getUserInfo('id',$current_user);
$output = ''; 
$msg_id_array = 0;

$all_mesages = getAllMessagesWithUnseen($message_from,$message_to);
while($row = mysqli_fetch_assoc($all_mesages))
{
    if($current_user === $row['message_to'])
    {
        $message_to = $row['message_to'];
        $message_from = $row['message_from'];
        $message_sent = date_create($row['sent_at']);
        $message_sent = date_format($message_sent,'g:ia');
        $message = $row['message'];
        $message_id = $row['id'];

        $query = "UPDATE messages SET seen_status = 'seen' WHERE message_from = '$message_from' AND message_to = '$message_to' AND seen_status = 'not seen'";
        $result = mysqli_query($connection,$query);

    $output.="<div class='d-flex flex-column message friend-message' id='message-id-$message_id'>$message<span class='text-right p-0 small-text text-secondary'>$message_sent<i class='mx-1'></i> </span></div>";
    $msg_id_array = $message_id;
    }
}

$response = array("output" => $output,"id" => $msg_id_array);
echo json_encode($response);
