<?php
include "../includes/db.php";
include "../global.php";

$post_id = $_POST['post_id'];
$comment_id = $_POST['comment_id'];
$reply_to = $_POST['reply_to'];
$reply_from = $_POST['reply_from'];
$reply_from = getUserInfo('id',$reply_from);
$reply_message = charecterParse(strip_tags($_POST['reply_message']));

//Insert the replied comment messages to the table comment_replies
$query = "INSERT INTO comment_replies (post_id , comment_id , replied_to, replied_from , replied_at , replied_message) VALUES ('{$post_id}' , '{$comment_id}' , '{$reply_to}' , '{$reply_from}' , now() , '{$reply_message}')";
$result = mysqli_query($connection,$query);

//Insert notification to the particular person mentioned
$query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , comment_message , post_id , comment_id) VALUES ('comment_reply' , now() , 'unseen' , '$reply_to' , '$reply_from' , '$reply_message' , '$post_id' , '$comment_id')";
$result = mysqli_query($connection,$query);

if(!$result)
{
    echo "Error".mysqli_error($result);
}else{
    echo 1;
}