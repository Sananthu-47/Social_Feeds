<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$total_likes = mysqli_query($connection,"SELECT * FROM likes WHERE post_id = '$post_id'");
$total_likes = mysqli_num_rows($total_likes);
$post_status = postLiked($post_id,$user_id);
$notification_to = getPostInfo('posted_by',$post_id);
$notification_to = getUserInfo('id',$notification_to);

if(!$post_status)
{
    $query = "INSERT INTO likes (post_id , user_id  , liked_at) VALUES ('$post_id' , '$user_id' , now())";
    $result = mysqli_query($connection,$query);
    $query = "INSERT INTO notifications (type , notified_at , notification_status , notification_to , notification_from , post_id , comment_message) VALUES ('like' , now() , 'unseen' , '$notification_to' , '$user_id' , '$post_id' , 'none')";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "add-like","like" => $total_likes + 1);
    echo json_encode($response);
}
else{
    $query = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection,$query);
    $query = "DELETE FROM notifications WHERE post_id = '$post_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "remove-like","like" => $total_likes - 1);
     echo json_encode($response);
}