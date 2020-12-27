<?php
include "../includes/db.php";
include "../global.php";

$comment_id =  $_POST['comment_id'];
$query = "SELECT * FROM comment_replies WHERE comment_id = $comment_id";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($result))
{
    echo $row['replied_message'];
}
