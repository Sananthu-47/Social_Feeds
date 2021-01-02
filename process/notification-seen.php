<?php
include "../includes/db.php";
include "../global.php";
$notification_id = $_POST['notification_id'];

$query = "UPDATE notifications SET notification_status = 'seen' WHERE id = '$notification_id'";
$result = mysqli_query($connection,$query);

if(!$result)
{
    echo "Error:".mysqli_error($result);
}