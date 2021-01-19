<?php
include "../includes/db.php";
include "../global.php";

$message_id = $_POST['msgid'];

$query = "SELECT seen_status FROM messages WHERE id = '$message_id'";
$result = mysqli_query($connection,$query);
$result = mysqli_fetch_assoc($result);
echo $result['seen_status'];