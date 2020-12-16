<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$comment_user_id = $_POST['user_id'];
$comment = $_POST['comment_body'];
$notification_to = getPostInfo('posted_by',$post_id);
$notification_to = getUserInfo('id',$notification_to);

if($comment !== "")
{
    $query = "INSERT INTO comments (post_id , comment_user_id , comment , comment_date) VALUES ('$post_id' , '$comment_user_id' , '$comment' , now())";
    $result = mysqli_query($connection,$query);
    $comment_id = mysqli_insert_id($connection); 
    $query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , post_id , comment_message , comment_id) VALUES ('comment' , now() , 'unseen' , '$notification_to' , '$comment_user_id' , '$post_id' , '$comment' , '$comment_id')";
    $result = mysqli_query($connection,$query);
    $query = "SELECT * FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = mysqli_num_rows($result);
    echo $response;
}
