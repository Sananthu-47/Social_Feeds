<?php
include "../includes/db.php";
include "../global.php";

$message_from = $_POST['message_from'];
$message_to = $_POST['message_to'];
$current_user = $_POST['current_user'];
$output = ''; 

$all_mesages = getAllMessagesWithUnseen($message_from,$message_to);
while($row = mysqli_fetch_assoc($all_mesages))
{
    if($current_user === $row['message_to'])
    {
    $output.="<div class='d-flex flex-column message friend-message'>{$row['message']}<span class='text-right p-0 small-text text-secondary'>{$row['sent_at']}<i class='mx-1'></i> </span></div>";
    }
}

echo $output;