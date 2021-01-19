<?php
include "../includes/db.php";
include "../global.php";

$message_id = $_POST['message_id'];
$current_user = $_POST['current_user'];
$current_user = getUserInfo('id',$current_user);
$message_from = getAllMessgaesById('message_from',$message_id);

if($current_user !== $message_from)
{
    $query = "UPDATE messages SET msg_deleted = 'deleted' WHERE id = '$message_id'";
    $result = mysqli_query($connection,$query);
}else{
    $query = "DELETE FROM messages WHERE id = '$message_id'";
    $result = mysqli_query($connection,$query);
}

if(!$result)
{
    echo mysqli_error($result);
}
