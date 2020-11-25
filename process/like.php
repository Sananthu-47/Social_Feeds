<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$post_likes = getPostInfo("likes",$post_id);
$post_status = postLiked($post_id,$user_id);

if(!$post_status)
{
    $query = "INSERT INTO likes (post_id , user_id , post_status) VALUES ('$post_id' , '$user_id' , 'liked')";
    $result = mysqli_query($connection,$query);
    $query = "UPDATE posts SET likes = '$post_likes' + 1 WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "add-like","like" => $post_likes + 1);
    echo json_encode($response);
}
else{
    $query = "DELETE FROM likes WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $query = "UPDATE posts SET likes = '$post_likes' - 1 WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = array("status" => "remove-like","like" => $post_likes - 1);
     echo json_encode($response);
}