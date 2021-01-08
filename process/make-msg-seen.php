<?php
include "../includes/db.php";
include "../global.php";

$message_to = $_POST['message_to'];
$message_from = $_POST['message_from'];

$query = "UPDATE messages SET seen_status = 'seen' WHERE message_from = '$message_to' AND message_to = '$message_from' AND seen_status = 'not seen'";
$result = mysqli_query($connection,$query);

if($result)
{
    echo 1;
}