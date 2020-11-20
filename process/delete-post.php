<?php
    include "../includes/db.php";
    include "../global.php";
    $user = $_POST['request_from'];
    $post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE id = '$post_id'";
    $result = mysqli_query($connection,$query);
    $total_post = getUserInfo('posts',$user) - 1;
    $query = "UPDATE users SET posts = '$total_post' WHERE username = '$user'";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        echo 1;
    }else{
        echo "Couldn't delete post";
    }