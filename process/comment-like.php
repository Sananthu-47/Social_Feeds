<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$comment_id = $_POST['comment_id'];

if(isset($_POST['reply_comment_id']))
{
    $reply_comment_id = $_POST['reply_comment_id'];
}else{
    $reply_comment_id = 0;
}

$comment_message = getCommentInfo('comment',$comment_id);
$total_likes = mysqli_query($connection,"SELECT * FROM comment_likes WHERE comment_id = '$comment_id'");
$total_likes = mysqli_num_rows($total_likes);
$comment_status = commentLiked($comment_id,$user_id);
$notification_to = getCommentInfo('comment_user_id',$comment_id);

if(!$comment_status)
{
    $query = "INSERT INTO comment_likes (post_id , user_id  , comment_id , reply_comment_id ,liked_at) VALUES ('$post_id' , '$user_id' , '$comment_id' , '$reply_comment_id' , now())";
    $result = mysqli_query($connection,$query);
    $query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , post_id , comment_message) VALUES ('comment_like' , now() , 'unseen' , '$notification_to' , '$user_id' , '$post_id' , '$comment_message')";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "add-like","like" => $total_likes + 1);
    echo json_encode($response);
}
else{
    $query = "DELETE FROM comment_likes WHERE post_id = '$post_id' AND user_id = '$user_id' AND comment_id = '$comment_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM notifications WHERE type = 'comment_like' AND post_id = '$post_id' AND notification_from = '$user_id' AND comment_message = '$comment_message' AND notification_to = '$notification_to'";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "remove-like","like" => $total_likes - 1);
     echo json_encode($response);
}