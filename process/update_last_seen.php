<?php 
include "../includes/db.php";
include "../global.php";

$username = $_POST['username'];

$time = time() + 10;
$query = "UPDATE users SET last_seen = '{$time}' WHERE username = '{$username}'";
$result = mysqli_query($connection,$query);
if($result)
{
    echo "Online";
}