<?php
include "../includes/db.php";
include "../global.php";
$post_id = $_POST['post_id'];
$comment_user_id = $_POST['user_id'];
$comment = $_POST['comment_body'];

if($comment !== "")
{
    $query = "INSERT INTO comments (post_id , comment_user_id , comment , comment_date) VALUES ('$post_id' , '$comment_user_id' , '$comment' , now())";
    $result = mysqli_query($connection,$query);
    $query = "SELECT * FROM comments WHERE post_id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $response = mysqli_num_rows($result);
    echo $response;
}
