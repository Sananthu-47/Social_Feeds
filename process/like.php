<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$total_likes = mysqli_query($connection,"SELECT * FROM likes WHERE post_id = '$post_id'");
$total_likes = mysqli_num_rows($total_likes);
$post_status = postLiked($post_id,$user_id);

if(!$post_status)
{
    $query = "INSERT INTO likes (post_id , user_id , post_status , liked_at) VALUES ('$post_id' , '$user_id' , 'liked' , now())";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "add-like","like" => $total_likes + 1);
    echo json_encode($response);
}
else{
    $query = "DELETE FROM likes WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "remove-like","like" => $total_likes - 1);
     echo json_encode($response);
}