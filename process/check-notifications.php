<?php
include "../includes/db.php";
include "../global.php";
$user_id = $_POST['user_id'];

$query = "UPDATE notifications SET notification_number = 'checked' WHERE notification_number = 'not-checked' AND notification_to = '$user_id'";
$result = mysqli_query($connection,$query);

if(!$result)
{
    echo "Error:".mysqli_error($result);
}