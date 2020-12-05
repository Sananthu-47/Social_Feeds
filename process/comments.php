<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$comment_user_id = $_POST['user_id'];
$comment = $_POST['comment_body'];
//$comment_count = getPostInfo("likes",$post_id);
//$post_status = postLiked($post_id,$user_id);


    $query = "INSERT INTO comments (post_id , comment_user_id , comment , comment_date) VALUES ('$post_id' , '$comment_user_id' , '$comment' , now())";
    $result = mysqli_query($connection,$query);
    $query = "SELECT * FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = mysqli_num_rows($result);
    //$response = array("status" => "add-like","like" => $post_likes + 1);
    echo $response;
